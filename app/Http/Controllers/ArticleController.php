<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Ticket;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Telegram\Bot\Api;

class ArticleController extends Controller
{
    public function index() {
        return view('index', [
            'computer_cat' => Category::where('id', 1)->first(),
            'software_cat' => Category::where('id', 2)->first(),
            'network_cat' => Category::where('id', 3)->first(),
            'computer' => Article::where('category_id', 2)->limit(3)->get(),
            'software' => Article::where('category_id', 3)->limit(3)->get(),
            'network' => Article::where('category_id', 4)->limit(3)->get(),
            'articles' => Article::all()
        ]);
    }

    public function autocomplete(Request $request) {
        $data = Article::select('subject')->where('subject', 'like', "%{$request->terms}%")->pluck('subject');
        return response()->json($data);
    }

    public function faqArticle(Article $faq) {
        return view('article', [
            'faq' => $faq,
            'category' => Category::all()->except([1])
        ]);
    }

    public function openticket() {
        return view('create', [
            'category' => Category::all(),
            'admin' => User::where('user_role_id', 2)->get()
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'subject' => 'required|max:255',
            'category_id' => 'required',
            'admin_user_id' => 'required',
            'detail' => 'required'
        ]);

        $data['status_id'] = 1;
        $data['user_id'] = auth()->user()->id;
        
        Ticket::create($data);
        
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        $telegram->sendMessage([
            'chat_id' => '1744403820',
            'text' => 'testing dari ArticleController',
        ]);

        return redirect('/user');
    }
}
