<?php

namespace App\Http\Controllers;

use App\User;
use App\ProjectBoard;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = ProjectBoard::all('id', 'abbreviation');
        $users = User::all('id', 'email');
        // 'Open','In Progress','QA','In Review','Closed','Rejected'
        $status = [
            'Open' => 'open',
            'In Progress' => 'in_progress',
            'QA' => 'qa',
            'In Review' => 'in_review',
            'Closed' => 'closed',
            'Rejected' => 'rejected',
        ];

        return view('reports.index', [
            'projects' => $projects,
            'status' => $status,
            'users'=> $users,
        ]);
    }

    public function getData(Request $request)
    {
        dd($request);
    }

}
