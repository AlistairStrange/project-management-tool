<?php

namespace App\View\Components;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class GraphCharts extends Component
{
    public $data = [
        ['Jan',],
        ['Feb',],
        ['Mar',],
        ['Apr',],
        ['May',],
        ['Jun',],
        ['Jul',],
        ['Aug',],
        ['Sep',],
        ['Oct',],
        ['Nov',],
        ['Dec',],
    ];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    
    {
        $currentYear = Carbon::now()->year;
        
        // Returns array of DB records where key is the month abbreviation and
        // value are collections of tickets 
        $open = DB::table('tickets')->where('status', 'Open')
            ->whereYear('created_at', $currentYear)
            ->orderBy('created_at', 'ASC')
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->created_at)->format('M');
            });

        $closed = DB::table('tickets')->where('status', 'Closed')
            ->whereYear('updated_at', $currentYear)
            ->orderBy('updated_at', 'ASC')
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->created_at)->format('M');
            });

        // Replacing ticket collections in each month by number of tickets
        foreach ($open as $month => $tickets) {
            $open[$month] = $tickets->count();
        }

        // Replacing ticket collections in each month by number of tickets
        foreach ($closed as $month => $tickets) {
            $closed[$month] = $tickets->count();
        }

        // Formatting for Google Charts
        // Check if the month has any recorcds in Open / Close tickets records
        // IF yes, push the values to result $data array
        foreach($this->data as $index => $value) {
            $month = $value[0];

            // Open tickets
            if(Arr::exists($open, $month)){
                array_push($this->data[$index], $open[$month]);
            } else {
                array_push($this->data[$index], 0);
            }

            // Closed tickets
            if(Arr::exists($closed, $month)){
                array_push($this->data[$index], $closed[$month]);
            } else {
                array_push($this->data[$index], 0);
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.graph-charts')->with('data', json_encode($this->data));
    }
}
