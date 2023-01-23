<?php

namespace App\Http\Controllers;

use App\Models\User;
use Telegram\Bot\Api;
use App\Models\Webhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebhookController extends Controller
{
    public function __construct() {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    public function getwebhookupdates() {
        $url = $this->telegram->getWebhookUpdates();
        return $url;
    }

    public function logs_append(Request $request) {
        $handle = fopen(Storage::path('logs.txt'), "r");
        $linecount = 0;

        while (fgets($handle)) {
            $linecount++;
        }
        fclose($handle);

        if ($linecount < 300) {
            Storage::append('logs.txt', json_encode($request->all(), JSON_PRETTY_PRINT));
        } else {
            Storage::put('logs.txt', json_encode($request->all(), JSON_PRETTY_PRINT));
        }
    }

    public function webhook($token, Request $request) {
        $data = $request->all();
        do {
            if (isset($data['my_chat_member']['new_chat_member']) == false) {
                $chat_id = $data['message']['chat']['id'];
                $username = $data['message']['from']['username'];
                $first_name = $data['message']['from']['first_name'];
                $last_name = $data['message']['from']['last_name'];
                break;
            }
            if ($data['my_chat_member']['new_chat_member']['status'] == 'kicked') {
                WebhookController::logs_append($request);
                break;
            }
            $chat_id = $data['my_chat_member']['chat']['id'];
            $username = $data['my_chat_member']['from']['username'];
            $first_name = $data['my_chat_member']['from']['first_name'];
            $last_name = $data['my_chat_member']['from']['last_name'];
        } while (0);

        $telegram_username = null;
        $telegram_chat_id = null;

        if (isset($data['message']) == true) {
            $user = User::where('telegram_username', $username)->orWhere('telegram_chat_id', $chat_id)->first();
        
            if ($user != null) {
                $telegram_username = $user->telegram_username;
                $telegram_chat_id = $user->telegram_chat_id;
            }

            if ($request['message']['text'] == '/start') {
                if (($telegram_username != null) && ($telegram_chat_id != null)) {
                    $this->telegram->sendMessage([
                        'chat_id' => $chat_id,
                        'text' => 'Akun Telegram Anda sudah teregistrasi.'
                    ]);
                }
                if (($telegram_username != null) && ($telegram_chat_id == null)) {
                    User::where('id', $user->id)->update(['telegram_chat_id' => $chat_id]);
                    $this->telegram->sendMessage([
                        'chat_id' => $chat_id,
                        'text' => 'Data atas nama '.$first_name.' '.$last_name.' dengan username '.$telegram_username.' telah disimpan.',
                    ]);
                }
                if (($telegram_username == null) && ($telegram_chat_id != null)) {
                    User::where('id', $user->id)->update(['telegram_username' => $username]);
                    $this->telegram->sendMessage([
                        'chat_id' => $chat_id,
                        'text' => 'Sistem mendeteksi bahwa Anda mengganti username Telegram Anda. Perubahan telah disimpan.'
                    ]);
                }
                if (($telegram_username == null) && ($telegram_chat_id == null)) {
                    $this->telegram->sendMessage([
                        'chat_id' => $chat_id,
                        'text' => 'Maaf, akun Telegram Anda tidak terdaftar di sistem.'
                    ]);
                }
            } else {
                $this->telegram->sendMessage([
                    'chat_id' => $chat_id,
                    'text' => 'Perintah yang Anda masukkan tidak valid.'
                ]);
            }
            WebhookController::logs_append($request);
        } else {
            WebhookController::logs_append($request);
        }
    }
}
