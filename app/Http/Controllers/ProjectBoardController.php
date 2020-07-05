<?php

namespace App\Http\Controllers;

use App\User;
use App\ProjectBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateProjectValidator;
use App\Http\Requests\UpdateProjectValidator;

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
        $projectManagers = User::all()->where('role', 'pm');
        
        // Redirect to create a new Project Board
        return view('projects.create')->with('owners', $projectManagers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProjectValidator $request)
    {
        $project = ProjectBoard::create([
            'name' => ucfirst($request->name),
            'abbreviation' => strtoupper($request->abbreviation),
            'description' => $request->description,
            'owner_id' => $request->owner,
        ]);

        $project->save();

        // Assigning new Project board to the PM by default
        $user = User::findOrFail($request->owner);
        $project->users()->attach($user);

        return redirect()->route('project.index')->with('status', 'New Project Board created successfully');
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
        $projectManagers = User::all()->where('role', 'pm');

        return view('projects.edit', ['project' => $project])->with('owners', $projectManagers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectBoard  $projectBoard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectValidator $request, $id)
    {
        $project = ProjectBoard::findOrFail($id);

        $project->update($request->all());

        // Assigning the Project board to the PM by default
        $user = User::findOrFail($request->owner);
        $project->users()->sync($user);

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
        $user = Auth::user();

        // Returns either all project boards if logged user is admin or
        // only these projects where the user is assigned to
        if($user->isAdmin) {
            $projects = ProjectBoard::all();
        } else {
            $projects = $user->projects;
        }
        
        return $projects;
    }
}
