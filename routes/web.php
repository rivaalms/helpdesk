<?php

use App\Models\RegisterRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\UserRoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'auth']);

Route::get('/getwebhookupdates', [WebhookController::class, 'getwebhookupdates']);

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'storeRegisterRequest']);
Route::get('/register/{request}/approve', [UserController::class, 'register_approve']);
Route::get('/register/{request}/reject', [UserController::class, 'register_reject']);

Route::get('/mail', [UserController::class, 'mail']);
Route::get('/mailview', function() {
    return view('mail', [
        'nama' => RegisterRequest::where('id', 2)->first()->name
    ]);
});

Route::post('/logout', [UserController::class, 'logout']);

Route::get('/', [ArticleController::class, 'index']);
Route::get('/autocomplete', [ArticleController::class, 'autocomplete'])->name('autocomplete');

Route::post('/search', [ArticleController::class, 'search']);

// Route::get('/category', [CategoryController::class, 'index']);

Route::get('/category/{category}', [CategoryController::class, 'category']);

Route::get('/article/{faq}', [ArticleController::class, 'faqArticle']);

Route::get('/create', [ArticleController::class, 'openticket'])->middleware('auth');
Route::post('/create', [ArticleController::class, 'store']);

Route::get('/user', [UserController::class, 'dashboard']);
Route::post('/user/profile', [UserController::class, 'updateProfile']);
Route::post('/user/password', [UserController::class, 'updatePassword']);

Route::get('/tickets/{ticket}', [UserController::class, 'ticket']);
Route::post('/tickets/{reply}', [ReplyController::class, 'userReply']);

Route::get('/admin/dashboard', [TicketController::class, 'summary'])->middleware('auth');

Route::get('/admin/register-request', [UserController::class, 'register_request'])->middleware('auth');

Route::resource('/admin/tickets', TicketController::class)->middleware('auth');
Route::post('/admin/tickets/{reply}', [ReplyController::class, 'adminreply'])->middleware('auth');
Route::post('/admin/tickets/{ticket}/open', [StatusController::class, 'openticket'])->middleware('auth');
Route::post('/admin/tickets/{ticket}/close', [StatusController::class, 'closeticket'])->middleware('auth');

Route::match(['get', 'post'], 'telegram/webhook/{token}', [WebhookController::class, 'webhook'])->name('webhook');

// Route::any('/telegram'.env('TELEGRAM_TOKEN'), [TelegramController::class, 'index'])->name('webhook');

