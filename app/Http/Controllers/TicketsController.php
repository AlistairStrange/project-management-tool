<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $openTickets = Ticket::Open()->get();
        $inProgressTickets = Ticket::InProgress()->get();
        $qualityAssuranceTickets = Ticket::QualityAssurance()->get();
        $inReviewTickets = Ticket::InReview()->get();
        $closedTickets = Ticket::Closed()->get();

        return view('tickets.index', [
            'openTickets' => $openTickets,
            'inProgressTickets' => $inProgressTickets,
            'qualityAssuranceTickets' => $qualityAssuranceTickets,
            'inReviewTickets' => $inReviewTickets,
            'closedTickets' => $closedTickets,
        ]);
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
        $ticket = Ticket::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'assignee' => $request->assignee,
            'reporter_id' => isset(Auth::user()->id) ? Auth::user()->id : 1,
            'contact' => $request->contact,
            'priority' => $request->priority,
            'deadline' => $request->deadline,
        ]);

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

        return view('tickets.edit', ['ticket' => $editTicket]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
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
                // do smth
                break;
            case 'In Progress':
                // do smth
                break;
            case 'QA':
                // do smth
                break;
            case 'In Review':
                // do smth
                break;
            case 'Closed':
                // throw an error
                break;
        }
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
                // throw an error
                break;
            case 'In Progress':
                // do smth
                break;
            case 'QA':
                // do smth
                break;
            case 'In Review':
                // do smth
                break;
            case 'Closed':
                // do smth
                break;
        }
    }
}
