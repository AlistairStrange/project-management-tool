<?php

namespace App\View\Components;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class OpenVsClosedChart extends Component
{
    public $dataLineChart = [
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
        // ***START Line Chart construct***
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
        // IF yes, push the values to result $dataLineChart array
        foreach($this->dataLineChart as $index => $value) {
            $month = $value[0];

            // Open tickets
            if(Arr::exists($open, $month)){
                array_push($this->dataLineChart[$index], $open[$month]);
            } else {
                array_push($this->dataLineChart[$index], 0);
            }

            // Closed tickets
            if(Arr::exists($closed, $month)){
                array_push($this->dataLineChart[$index], $closed[$month]);
            } else {
                array_push($this->dataLineChart[$index], 0);
            }
        }
        // ***END Line Chart construct***

        // ENCODING FOR GOOGLE CHARTS
        $this->dataLineChart = json_encode($this->dataLineChart);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.open-vs-closed-chart')
            ->with('dataLineChart', $this->dataLineChart);
    }
}
