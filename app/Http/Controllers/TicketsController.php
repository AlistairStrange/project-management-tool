<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class TicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function test() {
        return view ('tickets.test');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = $this->getTickets();

        return view('tickets.index', $tickets);
    }

    /**
     * Returns only tickets assigned to the user
     * Depends on selection of the user from within of the index views
     * either he choos eall tickets -> called standard index methods
     * or he selects "Only my tickets" ->called this functuin
     *
     * @return void
     */
    public function indexOnlySelectedTickets()
    {
        $tickets = $this->getTickets(Auth::user());

        return view('tickets.index', $tickets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Redirect to create views
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if($request->hasFile('file')) {
        //     dd($request);
        //     $this->fileUpload($request->file('file'));
        // }
        
        $ticket = Ticket::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'assignee_id' => $request->assignee,
            'reporter' => isset(Auth::user()->email) ? Auth::user()->email : "bot@user.com",
            'contact' => $request->contact,
            'priority' => $request->priority,
            'deadline' => $request->deadline,
        ]);

        // File storing to Media table -> id of the Ticket is used as an "model_id" on the media table
        foreach($request->input('attachment', []) as $file) {
            $ticket->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('attachment');
        }

        $ticket->save();

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
        $editTicket = Ticket::findOrFail($ticket->id);

        // retrieving attachments from the media library -> further process in _fieupload.blade.php
        $editTicket->attachment = $editTicket->getMedia('attachment');

        return view('tickets.edit', ['ticket' => $editTicket,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $ticket->update([
            'subject' => $request->subject,
            'description' => $request->description,
            'assignee_id' => $request->assignee,
            'contact' => $request->contact,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
        ]);
        
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

        return redirect()->route('tickets')->with('status', 'Ticket ID: ' . $ticket->id . ' successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets')->with('status', 'Ticket successfully deleted');
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
        switch ($ticket->status) {
            case 'Open':
                // Change status from Open to In Progress
                $ticket->update(['status' => 'In Progress']);
                break;
            case 'In Progress':
                // Change status from In Progress to Quality Assurance
                $ticket->update(['status' => 'QA']);
                break;
            case 'QA':
                // Change status from Quality Assurance to In Review
                $ticket->update(['status' => 'In Review']);
                break;
            case 'In Review':
                // Change status from In Review to Closed
                $ticket->update(['status' => 'Closed']);
                break;
            case 'Closed':
                // throw an error because Closed is the last status
                return redirect()->route('tickets')->with('error', 'You cannot move ticket from Closed to the next status category. Only back to open');
                break;
        }

        return redirect()->route('tickets')->with('status', 'Ticket ID: ' . $ticket->id . ' has been successfully moved to ' . $ticket->status);
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
        switch ($ticket->status) {
            case 'Open':
                // throw an error because you can't move ticket more backwards
                return redirect()->route('tickets')->with('error', 'Ticket cannot be moved more backwards. Open status is starting position');
                break;
            case 'In Progress':
                // Moves ticket back to Open
                $ticket->update(['status' => 'Open']);
                break;
            case 'QA':
                // Moves the ticket back to In Progress
                $ticket->update(['status' => 'In Progress']);
                break;
            case 'In Review':
                // Moves ticket back to QA
                $ticket->update(['status' => 'QA']);
                break;
            case 'Closed':
                // Back to In Progress
                $ticket->update(['status' => 'In Progress']);
                return redirect()->route('tickets')->with('status', 'Ticket ID: ' . $ticket->id . ' needs more work, so it was moved back to ' . $ticket->status);
                break;
            }

        return redirect()->route('tickets')->with('status', 'Ticket ID: ' . $ticket->id . ' has been successfully moved to ' . $ticket->status);
    }

    private function getTickets(User $user = null)
    {
        if(isset($user) && $user === Auth::user()) {
            // get tickets only for logged user (assigned)
            $openTickets = $user->tickets()->Open()->get();
            $inProgressTickets = $user->tickets()->InProgress()->get();
            $qualityAssuranceTickets = $user->tickets()->QualityAssurance()->get();
            $inReviewTickets = $user->tickets()->InReview()->get();
            $closedTickets = $user->tickets()->Closed()->get();
            $btnAll = 0;
        } else {
            // Get all tickets of the project board
            $openTickets = Ticket::Open()->get();
            $inProgressTickets = Ticket::InProgress()->get();
            $qualityAssuranceTickets = Ticket::QualityAssurance()->get();
            $inReviewTickets = Ticket::InReview()->get();
            $closedTickets = Ticket::Closed()->get();
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
}
