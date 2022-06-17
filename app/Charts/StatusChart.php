<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Ticket;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class StatusChart extends BaseChart
{
    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'status_chart';
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        // return Chartisan::build()
        //     ->labels(['First', 'Second', 'Third'])
        //     ->dataset('Sample', [1, 2, 3])
        //     ->dataset('Sample 2', [3, 2, 1]);
        $query_open = Ticket::where('status_id', 1)->get();
        $open = count($query_open);
        $query_closed = Ticket::where('status_id', 2)->get();
        $closed = count($query_closed);
        return Chartisan::build()
            ->labels(['Open', 'Closed'])
            ->dataset('Sample', [$open, $closed]);
    }
}