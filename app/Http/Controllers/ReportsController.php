<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\ProjectBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReportsController extends Controller
{
    public $projects;
    public $users;
    public $statuses;
    public $data;

    public function __construct () {
        $this->data = '';
        $this->projects = ProjectBoard::all('id', 'abbreviation');
        $this->users = User::all('id', 'email');
        $this->statuses = [
            'Open',
            'In Progress',
            'QA',
            'In Review',
            'Closed',
            'Rejected',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(?Request $request)
    {
        
        return view('reports.index', [
            'projects' => $this->projects,
            'statuses' => $this->statuses,
            'users'=> $this->users,
        ]);
    }
    

    /**
     * Request should cotain following optional data:
     * Project ID's array,
     * Status' array,
     * Assignee's IDs array,
     * Date range string,
     * Contact string (email),
     * Reporter string (email)
     *
     * @param Request $request
     * @return void
     */
    public function getData(Request $request)
    {
        // Flashing selected data to session.
        $request->flash();


        $data = new Ticket();
        $data = $data->newQuery();

        if($request->projects) {
            $data->whereIntegerInRaw('project_board_id', $request->projects);
        }

        if($request->status) {
            $data->whereIn('status', $request->status);
        }

        if($request->users) {
            $data->whereIntegerInRaw('assignee_id', $request->users);
        }

        if($request->contact) {
            $data->where('contact', $request->contact);
        }

        if($request->reporter) {
            $data->where('reporter', $request->reporter);
        }

        if($request->daterange) {
            $dates = explode(" - ", $request->daterange);

            $startdate = $dates[0];
            $enddate = $dates[1];

            $data->whereDate('created_at', '>=', $startdate);
            $data->whereDate('created_at', '<=', $enddate);
        }

        // Returning all variables (Projects, Statuses & Users) for dropdowns
        // Returning data for displaying filterd out data from database
        // Returning Request for pre-selecting the options of the filter
        return view('reports.index', [
            'projects' => $this->projects,
            'statuses' => $this->statuses,
            'users'=> $this->users,
            'data' => $data->paginate(15),
        ]);

    }

}
