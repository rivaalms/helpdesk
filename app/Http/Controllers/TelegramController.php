<?php

namespace App\Http\Controllers;

use App\Traits\MakeComponents;
use App\Traits\RequestTrait;
use Illuminate\Http\Request;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    use RequestTrait;
    use MakeComponents;

    public function webhook() {
        return $this->apiRequest('setWebhook', [
            'url' => url(route('webhook')),
        ]) ? ['success'] : ['something went wrong'];
    }

    public function index() {
        $result = json_decode(file_get_contents('php://input'));
        $action = $result->message->text;
        $userId = $result->message->from->id;
        if ($action == '/start') {
            $text = "Bot berhasil";
            $this->apiRequest('sendMessage', [
                'chat_id' => $userId,
                'text' => $text,
                // 'reply_markup' =>
            ]);
        }
    }
    
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
        return $this->telegram->getUpdates();
        $this->telegram->sendMessage();
    }
}
