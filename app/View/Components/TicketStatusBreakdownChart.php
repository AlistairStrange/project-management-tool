<?php

namespace App\View\Components;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class TicketStatusBreakdownChart extends Component
{
    public $dataBarChart = [
        ['', '# of Tickets'],
    ];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    
    {
        // ***START Bar Chart construct***
        $open = DB::table('tickets')->where('status', 'Open')->count();
        array_push($this->dataBarChart, ['Open', $open]);

        $progress = DB::table('tickets')->where('status', 'In Progress')->count();
        array_push($this->dataBarChart, ['In Progress', $progress]);

        $qa = DB::table('tickets')->where('status', 'QA')->count();
        array_push($this->dataBarChart, ['QA', $qa]);

        $review = DB::table('tickets')->where('status', 'In Review')->count();
        array_push($this->dataBarChart, ['In Review', $review]);
        // ***END Bar Chart construct***

        // ENCODING FOR GOOGLE CHARTS
        $this->dataBarChart = json_encode($this->dataBarChart);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.ticket-status-breakdown-chart')
            ->with('dataBarChart', $this->dataBarChart);
    }
}