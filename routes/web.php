<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\StatusController;
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

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/', [ArticleController::class, 'index']);
Route::get('/autocomplete', [ArticleController::class, 'autocomplete'])->name('autocomplete');

// Route::get('/category', [CategoryController::class, 'index']);

Route::get('/category/{category}', [CategoryController::class, 'category']);

Route::get('/faq/{faq}', [ArticleController::class, 'faqArticle']);

Route::get('/create', [ArticleController::class, 'openticket'])->middleware('auth');
Route::post('/create', [ArticleController::class, 'store']);

Route::get('/user', [UserController::class, 'dashboard']);

Route::get('/tickets/{ticket}', [UserController::class, 'ticket']);

Route::get('/admin/dashboard', [TicketController::class, 'summary']);

Route::resource('/admin/tickets', TicketController::class);
Route::post('/admin/tickets/{reply}', [ReplyController::class, 'adminreply']);
Route::get('/admin/tickets/{ticket}/open', [StatusController::class, 'openticket']);
Route::get('/admin/tickets/{ticket}/close', [StatusController::class, 'closeticket']);

// Route::group(['prefix' => 'telegram'], function() {
//     Route::get('/messages', [TelegramController::class, 'messages'])->name('telegram.messages');
//     Route::get('/messages/{id}', [TelegramController::class, 'sendMessage']);
//     // Route::post('/<token>/webhook', function() {
//     //     $update = Telegram::commandsHandler(true);
//     //     return 'ok';
//     // });
// });

// Route::any('/telegram'.env('TELEGRAM_TOKEN'), [TelegramController::class, 'index'])->name('webhook');

Route::get('/webhook', [TelegramController::class, 'webhook'])->name('webhook');