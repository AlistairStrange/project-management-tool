<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Ticket;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($ticketId, Request $request)
    {
        // Store the todo and assign it to the specific ticket
        $list = Todo::create([
            'subject' => $request->listSubject,
        ]);
        
        $ticket = Ticket::findOrFail($ticketId);

        $ticket->todos()->save($list);

        return redirect()->back()->with('status', 'New To-Do list created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($todoId)
    {
        // Soft delete the todo
        $list = Todo::findOrFail($todoId);

        $list->delete();

        return redirect()->back()->with('status', 'To-Do list removed');
    }

    /**
     * Complete the whole todo and by default mark as completed
     * all todo items assigned to the todo list
     *
     * @return void
     */
    public function completed($todoId)
    {
        $list = Todo::findOrFail($todoId);

        // Update all todo's items via mass update
        if(count($list->items) > 0){
            $list->items()->update(['completed' => true]);
        } else {
            return redirect()->back()->with('error', 'There are no items in the list');
        }

        return redirect()->back()->with('status', "All list's items completed successfully");
    }
}
