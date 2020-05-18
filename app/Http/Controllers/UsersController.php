<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getUsers(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $users = User::orderBy('name', 'asc')->select('id', 'name', 'email')->limit(5)->get();
        } else {
            $users = User::orderBy('name', 'asc')->select('id', 'name', 'email')->where('email', 'like', '%' . $search . '%')->limit(5)->get();
        }

        // $response = $users->map(function ($users){
        //     return [
        //         'id' => $users->id, // value
        //         'name' => $users->name, // label
        //         // 'email' => $users->email,
        //     ];
        // });

        $response = array();
        foreach($users as $user){
           $response[] = array("value"=>$user->id,"label"=>($user->name .  "(" . $user->email . ")"), "email"=>$user->email,);
        }

        echo json_encode($response);
        exit;
    }
}
