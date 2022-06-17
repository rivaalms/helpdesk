<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function closeticket(Ticket $ticket) {
        Ticket::where('id', $ticket->id)->update(['status_id' => 2, 'closed_at' => Carbon::now()]);
        
        $closedCount = Admin::where('user_id', auth()->user()->id)->first()->value('ticket_closed');
        $closedCount++;
        Admin::where('user_id', auth()->user()->id)->update(['ticket_closed' => $closedCount]);
        return back()->withInput();
    }

    public function openticket(Ticket $ticket) {
        Ticket::where('id', $ticket->id)->update(['status_id' => 1, 'closed_at' => null]);
        $closedCount = Admin::where('user_id', auth()->user()->id)->first()->value('ticket_closed');
        $closedCount--;
        Admin::where('user_id', auth()->user()->id)->update(['ticket_closed' => $closedCount]);
        return back()->withInput();
    }
}
