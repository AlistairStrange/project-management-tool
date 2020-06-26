<?php

namespace App\Http\Controllers;

use App\User;
use App\ProjectBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {   
        $users = $this->getUsers();
        return view('users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function create()
    {
        $boards = ProjectBoard::all();

        return view('users.create')->with('boards', $boards);
    }

    public function store(Request $request)
    {        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'admin' => $request->isAdmin,
        ]);
        
        // Synchronizing many to many relationship properties (pivot table)
        $user->projects()->attach($request->boards);

        return redirect()->route('user.index')->with('status', $user->name . ' successfully created');
    }

    public function edit(User $user)
    {
        $boards = ProjectBoard::all();
        
        return view('users.edit', ['user' => $user,])->with('boards', $boards);
    }

    public function update(Request $request, User $user)
    {
        // Updating simple model properties
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'admin' => $request->isAdmin,
        ]);

        // Synchronizing many to many relationship properties (pivot table)
        $user->projects()->sync($request->boards);

        return redirect()->route('user.index')->with('status', $user->name . ' successfully updated');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('status', 'User successfully removed');
    }


    public function getUsers(Request $request = null)
    {

        isset($request) ? $search = $request->search : null;

        if (!isset($search)) {
            $users = User::orderBy('name', 'asc')->select('id', 'name', 'email', 'role', 'isAdmin')->get();
        } else {
            $users = User::orderBy('name', 'asc')->select('id', 'name', 'email', 'role', 'isAdmin')->where('email', 'like', '%' . $search . '%')->limit(5)->get();
        }

        // $response = $users->map(function ($users){
        //     return [
        //         'id' => $users->id, // value
        //         'name' => $users->name, // label
        //         // 'email' => $users->email,
        //     ];
        // });

        // $response = array();
        // foreach($users as $user){
        //    $response[] = array("value"=>$user->id,"name"=>$user->name, "email"=>$user->email, "role"=>$user->role, "isAdmin"=>$user->isAdmin);
        // }

        return $users;
    }
}
