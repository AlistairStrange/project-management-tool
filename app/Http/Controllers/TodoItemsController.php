<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Ticket;
use App\TodoItem;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTodoItem;

class TodoItemsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoItem $request, $todoId)
    {
        $list = Todo::findOrFail($todoId);

        $this->authorize('addItem', $list);

        // Creates new item
        $item = TodoItem::create([
            'description' => $request->itemDescription,
        ]);
        
        // Associate new item with the list
        $list->items()->save($item);

        // Return user back to the ticket show view
        return redirect()->back()->with('status', 'New To-Do item added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($itemId)
    {
        $item = TodoItem::findOrFail($itemId);

        $this->authorize('delete', $item);

        $item->delete();

        return redirect()->back()->with('status', 'Todo task removed');
    }

    public function completed($itemId)
    {
        $item = TodoItem::findOrFail($itemId);

        $this->authorize('completed', $item);

        // Check whether we need to complete or re-open the item
        if($item->completed == false)
        {
            $item->completed = true;
        } else {
            $item->completed = false;
        }
        
        $item->save();

        return redirect()->back()->with('status', 'Todo task updated');
    }
}
