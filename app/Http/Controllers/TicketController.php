<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Reply;
use Telegram\Bot\Api;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Worker;
use App\Models\Category;
use App\Models\Departement;
use App\Models\RegisterRequest;
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
            'title' => 'tickets',
            'tickets' => Ticket::with(['user', 'status', 'category'])->filter(request(['search']))->sortable()->latest()->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/create-admin', [
            'title' => 'tickets',
            'user' => User::where('user_role_id', 1)->get(),
            'category' => Category::all(),
            'admin' => User::where('user_role_id', 2)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'subject' => 'required|max:255',
            'category_id' => 'required',
            'detail' => 'required'
        ]);

        $data['status_id'] = 1;

        $user = User::where('id', $data['user_id'])->first();
        $admin = User::where('user_role_id', 2)->get();

        Ticket::create($data);
        
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        foreach ($admin as $a) {
            if (!empty($a->telegram_chat_id)) {
                $telegram->sendMessage([
                    'chat_id' => $a->telegram_chat_id,
                    'text' => 'Tiket baru atas nama '.$user->name.' dengan subjek "'.$data['subject'].'". Mohon segera diperiksa.',
                ]);
            }
        }

        if (!empty($user->telegram_chat_id)) {
            $ticket = Ticket::where('subject', $data['subject'])->where('user_id', $data['user_id'])->first();
            $telegram->sendMessage([
                'chat_id' => $user->telegram_chat_id,
                'text' => 'Tiket baru atas nama Anda telah dibuatkan oleh teknisi. Subjek tiket: "'.$data['subject'].'". ID tiket: #'.$ticket->id.'.',
            ]);
        }

        return redirect('/admin/tickets')->with('ticket_success', 'Tiket berhasil dibuat.');
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
            'title' => 'tickets',
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
            'title' => 'tickets',
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
            'detail' => 'required'
        ];

        $data = $request->validate([
            'subject' => 'required|max:255',
            'status_id' => 'required',
            'category_id' => 'required',
            'detail' => 'required'
        ]);

        $data['user_id'] = $ticket->user_id;

        $user = User::find($ticket->user_id);
        $admin = User::where('user_role_id', 2)->get();
        
        Ticket::find($ticket->id)->update($data);
        
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        foreach ($admin as $a) {
            if (!empty($a->telegram_chat_id)) {
                $telegram->sendMessage([
                    'chat_id' => $a->telegram_chat_id,
                    'text' => 'Data tiket dengan ID #'.$ticket->id.' telah diperbarui.',
                ]);
            }
        }

        if (!empty($user->telegram_chat_id)) {
            $ticket = Ticket::find($ticket->id);
            $telegram->sendMessage([
                'chat_id' => $user->telegram_chat_id,
                'text' => 'Data tiket Anda dengan ID #'.$ticket->id.' telah diperbarui oleh teknisi.',
            ]);
        }

        return redirect('/admin/tickets')->with('update_success', 'Tiket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $admin = User::where('user_role_id', 2)->get();
        $user = User::find($ticket->user_id);
        
        $ticket_id = $ticket->id;

        Ticket::destroy($ticket->id);
        Reply::where('ticket_id', $ticket->id)->delete();

        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        foreach ($admin as $a) {
            if (!empty($a->telegram_chat_id)) {
                $telegram->sendMessage([
                    'chat_id' => $a->telegram_chat_id,
                    'text' => 'Tiket dengan ID #'.$ticket_id.' telah dihapus oleh teknisi.',
                ]);
            }
        }

        if (!empty($user->telegram_chat_id)) {
            $telegram->sendMessage([
                'chat_id' => $user->telegram_chat_id,
                'text' => 'Tiket Anda dengan ID #'.$ticket_id.' telah dihapus oleh teknisi.',
            ]);
        }

        return redirect('/admin/tickets')->with('delete', 'Tiket berhasil dihapus.');
    }

    public function summary() {
        $user = User::all();
        $departement = Departement::all();
        $ticket = Ticket::all();

        if ((request('closed_start') != null) && (request('closed_end') != null)) {
            $date_start = date_create(request('closed_start'));
            $date_end = date_create(request('closed_end'));
        } else {
            $date_start = date_create(\Carbon\Carbon::parse('30 days ago'));
            $date_end = date_create(\Carbon\Carbon::now());
        }

        $date_count[] = null;
        $date_diff = date_diff($date_start, $date_end)->format('%a');

        for ($i = 0; $i <= $date_diff; $i++) {
            $date = date_create(date_format($date_start, "Y-m-d"));
            date_add($date, date_interval_create_from_date_string($i." days"));
            $date_ticket = $ticket->where('status_id', 2)->whereBetween('closed_at', [$date->format('Y-m-d H:i:s'), \Carbon\Carbon::create($date->format('Y-m-d'))->endOfDay()->format('Y-m-d H:i:s')])->count();

            setLocale(LC_TIME, 'Indonesian');
            $date_count[$i] = ['date' => strftime('%e %b', $date->getTimestamp()), 'value' => $date_ticket];
        }

        //jumlah user dalam departement
        foreach ($departement as $i => $d) {
            $count_div[] = [$d->name, 0];
            foreach ($user as $j => $u) {
                if ($u->departement_id == $d->id) {
                    $ticket_count = Ticket::where('user_id', $u->id)->count();
                    $count_div[$i][1] += $ticket_count;
                }
            }
            $user_departement[] = $user->where('departement_id', $d->id)->count();
        }

        return view('admin/index', [
            'title' => 'summary',
            'tickets' => Ticket::filter(['ticket_div_start' => (request('ticket_div_start') != null ? request('ticket_div_start') : Carbon::parse('30 days ago')->startOfDay()->format('Y-m-d H:i:s')), 'ticket_div_end' => (request('ticket_div_end') != null ? request('ticket_div_end') : Carbon::now()->endOfDay()->format('Y-m-d H:i:s'))])->get(),

            'count_open' => Ticket::where('status_id', 1)->filter(['status_start' => (request('status_start') != null ? request('status_start') : Carbon::parse('30 days ago')->startOfDay()->format('Y-m-d H:i:s')), 'status_end' => (request('status_end') != null ? request('status_end') : Carbon::now()->endOfDay()->format('Y-m-d H:i:s'))])->count(),

            'count_closed' => Ticket::where('status_id', 2)->filter(['status_start' => (request('status_start') != null ? request('status_start') : Carbon::parse('30 days ago')->startOfDay()->format('Y-m-d H:i:s')), 'status_end' => (request('status_end') != null ? request('status_end') : Carbon::now()->endOfDay()->format('Y-m-d H:i:s'))])->count(),

            'count_computer' => Ticket::where('category_id', 1)->filter(['category_start' => (request('category_start') != null ? request('category_start') : Carbon::parse('30 days ago')->startOfDay()->format('Y-m-d H:i:s')), 'category_end' => (request('category_end') != null ? request('category_end') : Carbon::now()->endOfDay()->format('Y-m-d H:i:s'))])->count(),

            'count_software' => Ticket::where('category_id', 2)->filter(['category_start' => (request('category_start') != null ? request('category_start') : Carbon::parse('30 days ago')->startOfDay()->format('Y-m-d H:i:s')), 'category_end' => (request('category_end') != null ? request('category_end') : Carbon::now()->endOfDay()->format('Y-m-d H:i:s'))])->count(),

            'count_network' => Ticket::where('category_id', 3)->filter(['category_start' => (request('category_start') != null ? request('category_start') : Carbon::parse('30 days ago')->startOfDay()->format('Y-m-d H:i:s')), 'category_end' => (request('category_end') != null ? request('category_end') : Carbon::now()->endOfDay()->format('Y-m-d H:i:s'))])->count(),

            'date_count' => $date_count,
            'date_diff' => $date_diff,

            'departements' => $departement,

            'user_departement' => User::filter(['user_div_start' => (request('user_div_start') != null ? request('user_div_start') : Carbon::parse('30 days ago')->startOfDay()->format('Y-m-d H:i:s')), 'user_div_end' => (request('user_div_end') != null ? request('user_div_end') : Carbon::now()->endOfDay()->format('Y-m-d H:i:s'))])->get(),

            'user' => $user,
        ]);
    }
}
