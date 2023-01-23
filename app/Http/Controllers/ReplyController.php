<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reply;
use App\Models\Ticket;
use Telegram\Bot\Api;
use Illuminate\Http\Request;

class ReplyController extends Controller
{    
    public function adminreply(Request $request) {
        $data = $request->validate([
            'ticket_id' => 'required',
            'message' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;

        Reply::create($data);
        
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        $user = User::find($data['user_id']);
        // $admin = User::where('user_role_id', 2)->get();
        $ticket = Ticket::find($data['ticket_id']);
        $ticket_user = User::find($ticket->user_id);

        if (!empty($user->telegram_chat_id)) {
            $telegram->sendMessage([
                'chat_id' => $user->telegram_chat_id,
                'text' => 'Anda membuat balasan pada tiket #'.$data['ticket_id'].'. Balasan telah disimpan.',
            ]);
        }

        if (!empty($ticket_user->telegram_chat_id)) {
            $telegram->sendMessage([
                'chat_id' => $ticket_user->telegram_chat_id,
                'text' => 'Teknisi telah menjawab balasan Anda pada tiket #'.$data['ticket_id'].'.',
            ]);
        }

        return back()->with('reply_success', 'Balasan telah disimpan.');
    }

    public function userReply(Request $request) {
        $data = $request->validate([
            'ticket_id' => 'required',
            'message' => 'required',
        ]);

        $data['user_id'] = auth()->user()->id;

        Reply::create($data);
        
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        $user = User::find($data['user_id']);
        $admin = User::where('user_role_id', 2)->get();

        if (!empty($user->telegram_chat_id)) {
            $telegram->sendMessage([
                'chat_id' => $user->telegram_chat_id,
                'text' => 'Anda membuat balasan pada tiket #'.$data['ticket_id'].'. Balasan telah terkirim.',
            ]);
        }

        foreach ($admin as $a) {
            if (!empty($a->telegram_chat_id)) {
                $telegram->sendMessage([
                    'chat_id' => $a->telegram_chat_id,
                    'text' => 'Balasan baru dari '.$user->name.' pada tiket #'.$data['ticket_id'].'. Mohon segera diperiksa.',
                ]);
            }
        }

        return back()->with('reply_success', 'Balasan telah disimpan.');
    }
}
