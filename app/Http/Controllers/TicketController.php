<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reply;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/tickets', [
            'tickets' => Ticket::with('user', 'status', 'category')->filter(request(['search']))->latest()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('/admin/ticket-view', [
            'ticket' => $ticket,
            'replies' => Reply::where('ticket_id', $ticket->id)->get()

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('/admin/edit-ticket', [
            'ticket' => $ticket,
            'category' => Category::all(),
            'status' => Status::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $rules = [
            'subject' => 'required|max:255',
            'status_id' => 'required',
            'category_id' => 'required',
            'detail' => 'nullable'
        ];

        $data = $request->validate($rules);

        $data['user_id'] = $ticket->user_id;

        Ticket::where('id', $ticket->id)->update($data);
        return redirect('/admin/tickets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        Ticket::destroy($ticket->id);
        return redirect('/admin/tickets');
    }

    public function summary() {
        for ($i = 9; $i >= 0; $i--) {
            $count_closed[] = Ticket::where('status_id', 2)->whereBetween('closed_at', [Carbon::now()->subDays($i)->startOfDay(), Carbon::now()->subDays($i)->endOfDay()])->count();
        }
        
        // $count_days = Carbon::now()->subDays(9);
        // for ($i = 0; $i < 10; $i++) {
        //     $dates[] = $count_days->copy()->addDays($i)->format('d-m');
        // }

        $count_days = Carbon::now();
        for ($i = 9; $i >= 0; $i--) {
            $dates[] = $count_days->copy()->subDays($i)->format('d-m');
        }
        // $closed = $count_closed->all();

        return view('admin/index', [
            'tickets' => Ticket::all(),
            'count_open' => Ticket::where('status_id', 1)->count(),
            'count_closed' => Ticket::where('status_id', 2)->count(),

            'count_uncategorized' => Ticket::where('category_id', 1)->count(),
            'count_computer' => Ticket::where('category_id', 2)->count(),
            'count_software' => Ticket::where('category_id', 3)->count(),
            'count_network' => Ticket::where('category_id', 4)->count(),
            
            'count_closed_tendays' => $count_closed,
            'days' => $dates
            
            // 'count_closed_tendays' => Ticket::where('category_id', 2)->whereBetween(),
        ]);
    }
}
