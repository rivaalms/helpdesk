<?php

namespace App\Http\Controllers;

use App\Models\User;
use Telegram\Bot\Api;
use App\Models\Webhook;
use App\Traits\RequestTrait;
use Illuminate\Http\Request;
use App\Traits\MakeComponents;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Monolog\Handler\TelegramBotHandler;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    // use RequestTrait;
    // use MakeComponents;

    // public function webhook() {
    //     return $this->apiRequest('setWebhook', [
    //         'url' => url(route('webhook')),
    //     ]) ? ['success'] : ['something went wrong'];
    // }

    // public function data() {
    //     $result = json_decode(file_get_contents('php://input'));
    //     dd($result);
    //     foreach ($result as $event) {
    //         process_event($event);
    //     }
    //     dd($result);
        
        // $action = $result->message->text;
        // $userId = $result->message->from->id;
        // if ($action == '/start') {
        //     $text = "Bot berhasil";
        //     $this->apiRequest('sendMessage', [
        //         'chat_id' => $userId,
        //         'text' => $text,
        //         // 'reply_markup' =>
        //     ]);
        // }
    // }
    
    public function __construct() {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    public function sendMessage($id) {
        $act = $this->telegram->getUpdates()->first();
        // $collect = collect($act);

        return $this->telegram->sendMessage([
            'chat_id' => $id,
            'text' => 'Bot telah diaktifkan'
        ]);
    }

    public function messages() {
        // $data = $this->telegram->getWebhookUpdates();
        // dd($data);
        $response = $this->telegram->setWebhook(['url' => env('WEBHOOK_URL')]);
    }

    public function setWebhook() {
        // $response = $this->telegram->setWebhook(['url' => 'https://example.com/<token>/webhook']);
        $url = env('WEBHOOK_URL');
        $this->telegram->setWebhook([
            'url' => $url.'/telegram/webhook/'.env('TELEGRAM_BOT_TOKEN')
        ]);
        return ['message' => 'Webhook set.'];
    }

    public function webhook($token, Request $request) {
        $data = $request->all();
        $chat_id = $data['message']['chat']['id'];
        $username = $data['message']['chat']['username'];
        $first_name = $data['message']['from']['first_name'];
        $last_name = $data['message']['from']['last_name'];

        $check = User::where('telegram_chat_id', $chat_id)->first();

        if ($request['message']['text'] == '/start') {
            if ($check == null) {
                // Webhook::create([
                //     'username' => $username,
                //     'chat_id' => $chat_id,
                // ]);
                User::where('telegram_username', $username)->update([
                    'telegram_chat_id' => $chat_id
                ]);
                $this->telegram->sendMessage([
                    'chat_id' => $chat_id,
                    'text' => 'Data atas nama '.$first_name.' '.$last_name.' dengan username '.$username.' telah disimpan.',
                ]);
            } else {
                if ($username != $check->telegram_username) {
                    Webhook::where('username', $check->username)->update([
                        'username' => $username
                    ]);
                    $this->telegram->sendMessage([
                        'chat_id' => $chat_id,
                        'text' => 'Sistem mendeteksi bahwa Anda merubah username Anda. Perubahan telah disimpan.'
                    ]);
                } else {
                    $this->telegram->sendMessage([
                        'chat_id' => $chat_id,
                        'text' => 'Anda telah melakukan registrasi akun Telegram Anda.'
                    ]);
                }
            }
        } else {
            $this->telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => 'Perintah yang Anda masukkan tidak valid']);
        }

        Storage::put('logs.txt', json_encode($request->all(), JSON_PRETTY_PRINT));
    }
}
