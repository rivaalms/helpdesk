<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Telegram\Bot\Api;

class StatusController extends Controller
{
    public function closeticket(Ticket $ticket) {
        Ticket::where('id', $ticket->id)->update(['status_id' => 2, 'closed_at' => Carbon::now()]);

        $ticket = Ticket::find($ticket->id);
        $ticket_chat_id = $ticket->user->telegram_chat_id;
        $admin_chat_id = auth()->user()->telegram_chat_id;

        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        if ($ticket_chat_id != null) {
            $telegram->sendMessage([
            'chat_id' => $ticket_chat_id,
            'text' => 'Teknisi telah menandai tiket Anda dengan ID #'.$ticket->id.' dengan status \'Selesai\'.' 
            ]);
        }

        if ($admin_chat_id != null) {
            $telegram->sendMessage([
                'chat_id' => $admin_chat_id,
                'text' => 'Tiket dengan ID #'.$ticket->id.' telah ditandai selesai.'
            ]);
        } 

        return back()->with('close_success', 'Tiket berhasil ditandai selesai.');
    }

    public function openticket(Ticket $ticket) {
        Ticket::where('id', $ticket->id)->update(['status_id' => 1, 'closed_at' => null]);
        
        $ticket = Ticket::find($ticket->id);
        $ticket_chat_id = $ticket->user->telegram_chat_id;
        $admin_chat_id = auth()->user()->telegram_chat_id;

        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        if ($ticket_chat_id != null) {
            $telegram->sendMessage([
            'chat_id' => $ticket_chat_id,
            'text' => 'Teknisi telah membuka kembali tiket Anda dengan ID #'.$ticket->id.'.' 
            ]);
        }

        if ($admin_chat_id != null) {
            $telegram->sendMessage([
                'chat_id' => $admin_chat_id,
                'text' => 'Tiket dengan ID #'.$ticket->id.' telah dibuka kembali.'
            ]);
        }

        return back()->with('open_success', 'Tiket berhasil ditandai diproses.');
    }
}
