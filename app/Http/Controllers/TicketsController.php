<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use Carbon\Carbon;
use App\ProjectBoard;
use Illuminate\Http\Request;
use App\Events\TicketChanged;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;
use App\Http\Requests\CreateTicketValidator;
use App\Http\Requests\UpdateTicketValidator;
use App\Http\Controllers\ProjectBoardController;

class TicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($abbreviation)
    {
        $project = ProjectBoard::firstWhere('abbreviation', $abbreviation);

        $tickets = $this->getTickets($project);

        return view('tickets.index', $tickets)->with('project', $project);
    }

    /**
     * Returns only tickets assigned to the user
     * Depends on selection of the user from within of the index views
     * either he choos eall tickets -> called standard index methods
     * or he selects "Only my tickets" ->called this functuin
     *
     * @return void
     */
    public function indexOnlySelectedTickets($abbreviation)
    {
        $project = ProjectBoard::firstWhere('abbreviation', $abbreviation);
        $user = Auth::user();

        $tickets = $this->getTickets($project, $user);

        return view('tickets.index', $tickets)->with('project', $project);
    }

    public function indexAllUsersTickets()
    {
        $user = Auth::user();
        $tickets = $this->getTickets($user);

        return view('tickets.index', $tickets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Ticket::class);

        // Fetching available project boards
        $projects = new ProjectBoardController();
        $projects = $projects->getProjects();
        
        // Redirect to create views
        return view('tickets.create', ['projects' => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTicketValidator $request)
    {
        $this->authorize('create', Ticket::class);
        
        $ticket = Ticket::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'reporter' => isset(Auth::user()->email) ? Auth::user()->email : "bot@user.com",
            'contact' => $request->contact,
            'priority' => $request->priority,
            'deadline' => $request->deadline,
        ]);

        // Associating the ticket with specific user (assignee = owner)
        $user = User::find($request->assignee);
        $user->tickets()->save($ticket);

        // Associating the ticket with specific project board
        $project = ProjectBoard::find($request->project);
        $project->tickets()->save($ticket);

        // File storing to Media table -> id of the Ticket is used as an "model_id" on the media table
        foreach($request->input('attachment', []) as $file) {
            $ticket->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('attachment');
        }

        $change = 'New ticket was created -' . $ticket->subject . '-';

        // Send E-mail notification
        $this->sendEmailNotification($ticket, $change);

        return redirect()->back()->with('status', 'Ticket created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        // retrieving attachments associated with ticket
        $ticket->attachments = $ticket->getMedia('attachment');

        // Creating new attribute for each attachment -> url for download
        foreach($ticket->attachments as $file) {
            $file->downloadPath = $file->getFullUrl();
        }

        // Retrieving Project board of a ticket
        $ticket->project = $ticket->projectBoard->abbreviation;

        return view('tickets.show', ['ticket' => $ticket]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $editTicket = Ticket::findOrFail($ticket->id);

        // Fetching available project boards
        $projects = new ProjectBoardController();
        $projects = $projects->getProjects();


        // retrieving attachments from the media library -> further process in _fieupload.blade.php
        $editTicket->attachment = $editTicket->getMedia('attachment');

        return view('tickets.edit', ['ticket' => $editTicket, 'projects' => $projects,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketValidator $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $ticket->update([
            'subject' => $request->subject,
            'description' => $request->description,
            'contact' => $request->contact,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
        ]);

        $change = $ticket->getChanges();

        // Associating the ticket with specific user (assignee = owner)
        $user = User::find($request->assignee);
        $user->tickets()->save($ticket);

        $change['assignee'] = $user->name;

        // Associating the ticket with specific project board
        $project = ProjectBoard::find($request->project);
        $project->tickets()->save($ticket);
        
        $change['project'] = $project->abbreviation;

        // Retrieving all attachments for ticket which is being edited
        $ticket->attachment = $ticket->getMedia('attachment');

        // Checking if project has any attachments and if yes then if they are the same
        // If not the same, we delete the record of it in DB
        if (count($ticket->attachment) > 0) {
            foreach ($ticket->attachment as $file) {
                if (!in_array($file->file_name, $request->input('attachment', []))) {
                    $file->delete();
                }
            }
        }
        // ???
        $file = $ticket->attachment->pluck('file_name')->toArray();

        // ??? Adding newly attached files
        foreach ($request->input('attachment', []) as $item) {
            if (count($file) === 0 || !in_array($item, $file)) {
                $ticket->addMedia(storage_path('tmp/uploads/' . $item))->toMediaCollection('attachment');
            }
        }

        // Send E-mail notification
        $this->sendEmailNotification($ticket, $change);

        return redirect()->route('ticket.show', $ticket)->with('status', 'Ticket ID: ' . $ticket->id . ' successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        $ticket->delete();

        $change = 'Ticket has been deleted';
        $this->sendEmailNotification($ticket, $change);

        return redirect()->route('tickets', $ticket->projectBoard->abbreviation)->with('status', 'Ticket successfully deleted');
    }

    public function fileUpload(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    
        $file = $request->file('file');
    
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
    
        $file->move($path, $name);
    
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    /**
     * Changig 'status' of the ticket
     * Moving ticket forward from Open up to Closed
     * Throws an error for 'Closed' (last status - no moving forward)
     *
     * @param Ticket $ticket
     * @return void
     */
    public function nextStatus(Ticket $ticket)
    {
        $this->authorize('statusChange', $ticket);

        switch ($ticket->status) {
            case 'Open':
                // Change status from Open to In Progress
                $ticket->update(['status' => 'In Progress']);
                $change = 'Ticket was moved from -Open- to -In Progress-';
                break;
            case 'In Progress':
                // Change status from In Progress to Quality Assurance
                $ticket->update(['status' => 'QA']);
                $change = 'Ticket was moved from -In Progress- to -Quality Assurance-';
                break;
            case 'QA':
                // Change status from Quality Assurance to In Review
                $ticket->update(['status' => 'In Review']);
                $change = 'Ticket was moved from -Quality Assurance- to -Ready for review-';
                break;
            case 'In Review':
                // Change status from In Review to Closed
                $ticket->update(['status' => 'Closed']);
                $change = 'Ticket is now CLOSED';
                break;
            case 'Closed':
                // throw an error because Closed is the last status
                return redirect()->route('tickets')->with('error', 'You cannot move ticket from Closed to the next status category. Only back to open');
                break;
        }

        // Send E-mail notification
        $this->sendEmailNotification($ticket, $change);

        // Redirect back - project view, only users tickets project view or All Users tickets view
        return redirect()->back()->with('status', 'Ticket ID: ' . $ticket->id . ' has been successfully moved to ' . $ticket->status);
    }

    /**
     * Changing 'status' of the ticket
     * Moving ticket backwards from Closed up to Open
     * Throws an error for 'Open' (first status - no moving backwards)
     *
     * @param Ticket $ticket
     * @return void
     */
    public function prevStatus(Ticket $ticket)
    {
        $this->authorize('statusChange', $ticket);

        switch ($ticket->status) {
            case 'Open':
                // throw an error because you can't move ticket more backwards
                return redirect()->route('tickets')->with('error', 'Ticket cannot be moved more backwards. Open status is starting position');
                break;
            case 'In Progress':
                // Moves ticket back to Open
                $ticket->update(['status' => 'Open']);
                $change = 'Ticket was moved back from -In Progress- to -Open-';
                break;
            case 'QA':
                // Moves the ticket back to In Progress
                $ticket->update(['status' => 'In Progress']);
                $change = 'Ticket was moved back from -Quality Assurance- to -In Progress-';
                break;
            case 'In Review':
                // Moves ticket back to QA
                $ticket->update(['status' => 'QA']);
                $change = 'Ticket was moved back from -In Review- to -Quality Assurance-';
                break;
            case 'Closed':
                // Back to In Progress
                $ticket->update(['status' => 'In Progress']);
                $change = 'Ticket needs work and was Re-Opened';
                return redirect()->back()->with('status', 'Ticket ID: ' . $ticket->id . ' needs more work, so it was moved back to ' . $ticket->status);
                break;
            }

        // Send E-mail notification
        $this->sendEmailNotification($ticket, $change);

        return redirect()->back()->with('status', 'Ticket ID: ' . $ticket->id . ' has been successfully moved to ' . $ticket->status);
    }

    public function getTickets($project = null, $user = null)
    {
        // Since we're using concat method during the iteration, we need to create an empty collections
        // used later on in the iteration
        $openTickets = collect([]);
        $inProgressTickets = collect([]);
        $qualityAssuranceTickets = collect([]);
        $inReviewTickets = collect([]);
        $closedTickets = collect([]);

        if(isset($user) && isset($project)) {
            // Get all tickets assinged to specific user from specific project board
            $openTickets = $project->tickets()->where('assignee_id', $user->id)->Open()->get();
            $inProgressTickets = $project->tickets()->where('assignee_id', $user->id)->InProgress()->get();
            $qualityAssuranceTickets = $project->tickets()->where('assignee_id', $user->id)->QualityAssurance()->get();
            $inReviewTickets = $project->tickets()->where('assignee_id', $user->id)->InReview()->get();
            $closedTickets = $project->tickets()->where('assignee_id', $user->id)->Closed()->get();
            $btnAll = 0;
        } elseif(isset($project)) {
            // Get all ticket from specific project board
            $openTickets = $project->tickets()->Open()->get();
            $inProgressTickets = $project->tickets()->InProgress()->get();
            $qualityAssuranceTickets = $project->tickets()->QualityAssurance()->get();
            $inReviewTickets = $project->tickets()->InReview()->get();
            $closedTickets = $project->tickets()->Closed()->get();
            $btnAll = 1;
        } elseif(isset($user) && !isset($project)) {
            // Iterate through all users projects and for each get all users tickets categorized by status
            foreach($user->projects as $project) {
                $openTickets = $openTickets->concat($project->tickets()->where('assignee_id', $user->id)->Open()->get());
                $inProgressTickets = $inProgressTickets->concat($project->tickets()->where('assignee_id', $user->id)->InProgress()->get());
                $qualityAssuranceTickets = $qualityAssuranceTickets->concat($project->tickets()->where('assignee_id', $user->id)->QualityAssurance()->get());
                $inReviewTickets = $inReviewTickets->concat($project->tickets()->where('assignee_id', $user->id)->InReview()->get());
                $closedTickets = $closedTickets->concat($project->tickets()->where('assignee_id', $user->id)->Closed()->get());
            }

            $btnAll = 1;
        }

        return [
            'openTickets' => $openTickets,
            'inProgressTickets' => $inProgressTickets,
            'qualityAssuranceTickets' => $qualityAssuranceTickets,
            'inReviewTickets' => $inReviewTickets,
            'closedTickets' => $closedTickets,
            'btnAll' => $btnAll,
        ];
    }
    
    public function sendEmailNotification(Ticket $ticket, $change)
    {
        // Get all recipients of the notification
        if($ticket->contact !== $ticket->reporter) {
            $recipients = [
                $ticket->contact,
                $ticket->reporter,
            ];
        } else {
            $recipients = $ticket->contact;
        }

        // Get currently authenticated user who fired the event
        $user = Auth::user();

        // Runs the event
        event(new TicketChanged($ticket, $user, $recipients, $change));

        return true;
    }
}
