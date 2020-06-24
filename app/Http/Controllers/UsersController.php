<?php

namespace App\Http\Controllers;

use App\User;
use App\ProjectBoard;
use Illuminate\Http\Request;

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

    public function edit(User $user)
    {
        $boards = ProjectBoard::all();
        
        return view('users.edit', ['user' => $user,])->with('boards', $boards);
    }


    public function getUsers(Request $request = null)
    {

        isset($request) ? $search = $request->search : null;

        if (!isset($search)) {
            $users = User::orderBy('name', 'asc')->select('id', 'name', 'email', 'role', 'isAdmin')->limit(5)->get();
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
