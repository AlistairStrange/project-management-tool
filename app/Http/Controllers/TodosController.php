<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTodoList;
use Illuminate\Support\Facades\Auth;

class TodosController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($ticketId, StoreTodoList $request)
    {
        $ticket = Ticket::findOrFail($ticketId);
        $user = Auth::user();
        
        $this->authorize('create', Todo::class);

        // Store the todo and assign it to the specific ticket
        $list = Todo::create([
            'subject' => $request->listSubject,
            ]);
        
        // Setting up relationships
        $ticket->todos()->save($list);
        $user->todos()->save($list);

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

        $this->authorize('delete', $list);

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

        $this->authorize('completed', $list);

        if(!$list->completed) {
            // Update all todo's items via mass update
            if(count($list->items) > 0){
                $list->items()->update(['completed' => true]);
            } else {
                $list->completed = true;
                $list->save();
                return redirect()->back()->with('status', 'There are no items in the list. Main list is marked as completed');
            }
    
            $list->completed = true;
            $list->save();
    
            return redirect()->back()->with('status', "All list's items completed successfully");
        } else {
            $list->completed = false;
            $list->save();

            if(count($list->items) > 0) {
                $list->items()->update(['completed' => false]);

                return redirect()->back()->with('status', 'List & all items reopened successfully');
            }

            return redirect()->back()->with('status', 'List reopened successfully');
        }
    }
}
