<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Todo;
use App\TodoItem;
use Illuminate\Http\Request;

class TodoItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $todoId)
    {
        $list = Todo::findOrFail($todoId);

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
     * Display the specified resource.
     *
     * @param  \App\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function show(TodoItem $todoItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function edit(TodoItem $todoItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TodoItem  $todoItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TodoItem $todoItem)
    {
        //
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

        $item->delete();

        return redirect()->back()->with('status', 'Todo task removed');
    }

    public function completed($itemId)
    {
        $item = TodoItem::findOrFail($itemId);

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
