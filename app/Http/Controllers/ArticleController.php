<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use Telegram\Bot\Api;
use App\Models\Ticket;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index() {
        //NOTE - Initiate Telegram Webhook
        // $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        // $url = env('WEBHOOK_URL');
        // $telegram->setWebhook([
        //     'url' => $url.'/telegram/webhook/'.env('TELEGRAM_BOT_TOKEN')
        // ]);

        return view('index', [
            'title' => 'home',
            'time' => intval(Carbon::now()->format('H')),
            'category' => Category::all(),
            'articles' => Article::all(),
        ]);
    }

    public function autocomplete(Request $request) {
        $data = Article::select('subject')->where('subject', 'like', "%{$request->terms}%")->pluck('subject');
        return response()->json($data);
    }

    public function search(Request $request) {
        $data = $request;
        $path = Article::select('id')->where('subject', $data['search'])->pluck('id');
        // dd(count($path));

        if (count($path)) {
            $url = '/article/'.$path[0];
            return redirect(url($url));
        }
        
        return view('not-found');
        
    }

    public function faqArticle(Article $faq) {
        return view('article', [
            'title' => 'category',
            'faq' => $faq,
            'category' => Category::all()
        ]);
    }

    public function openticket() {
        return view('create', [
            'title' => 'create',
            'category' => Category::all(),
            'admin' => User::where('user_role_id', 2)->get()
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'subject' => 'required|max:255',
            'category_id' => 'required',
            'detail' => 'required'
        ]);

        $data['status_id'] = 1;
        $data['user_id'] = auth()->user()->id;

        $user = User::where('id', $data['user_id'])->first();
        $admin = User::where('user_role_id', 2)->get();
        
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        Ticket::create($data);

        foreach ($admin as $a) {
            if (!empty($a->telegram_chat_id)) {
                $telegram->sendMessage([
                    'chat_id' => $a->telegram_chat_id,
                    'text' => 'Tiket baru dari '.$user->name.' dengan subjek "'.$data['subject'].'". Mohon segera diperiksa.',
                ]);
            }
        }

        if (!empty($user->telegram_chat_id)) {
            $ticket = Ticket::where('subject', $data['subject'])->where('user_id', $data['user_id'])->first();
            $telegram->sendMessage([
                'chat_id' => $user->telegram_chat_id,
                'text' => 'Anda membuat tiket dengan subjek "'.$data['subject'].'". ID Tiket Anda: #'.$ticket->id.'.'
            ]);
        }

        return redirect('/user')->with('ticket_success', 'Tiket Anda telah berhasil dibuat.');
    }
}
