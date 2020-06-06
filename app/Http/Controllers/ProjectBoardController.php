<?php

namespace App\Http\Controllers;

use App\ProjectBoard;
use Illuminate\Http\Request;

class ProjectBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = ProjectBoard::all();
        
        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Redirect to create a new Project Board
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = ProjectBoard::create([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'description' => $request->description,
        ]);

        $project->save();

        return redirect()->back()->with('status', 'New Project Board created successfully');
    }

    /**
     * Display the specified resourpce.
     *
     * @param  \App\ProjectBoard  $projectBoard
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = ProjectBoard::findOrFail($id);
        
        return view('projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectBoard  $projectBoard
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = ProjectBoard::findOrFail($id);

        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectBoard  $projectBoard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = ProjectBoard::findOrFail($id);

        $project->update($request->all());

        return redirect()->route('project.show', $project->id)->with('status', 'Project Board successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectBoard  $projectBoard
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = ProjectBoard::findOrFail($id);

        $project->delete();

        return redirect()->route('home')->with('status', 'Ticket successfully deleted');
    }

    /**
     * Fetching list of all project boards - used while createing/updating tickets
     *
     * @return void
     */
    public function getProjects()
    {
        $projects = ProjectBoard::all();
        
        return $projects;
    }
}
