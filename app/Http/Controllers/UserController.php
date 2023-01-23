<?php

namespace App\Http\Controllers;

use App\Mail\MailNotification;
use App\Mail\MailRejectNotification;
use App\Models\User;
use App\Models\Admin;
use App\Models\Reply;
use Telegram\Bot\Api;
use App\Models\Ticket;
use App\Models\Worker;
use App\Models\Departement;
use App\Models\RegisterRequest;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function login() {
        return view('login', [
            'title' => 'login'
        ]);
    }

    public function auth(Request $request) {
        $cred = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($cred)) {
            $request->session()->regenerate();
            if((auth()->user()->user_role_id == 2) || (auth()->user()->user_role_id == 3)) {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/');
            }
        }

        return back()->with('error', 'Gagal masuk!');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register() {
        return view('register', [
            'title' => 'register',
            'departement' => Departement::all(),
        ]);
    }

    public function storeRegisterRequest(Request $request) {
        $cred = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'departement_id' => 'required',
            'telegram_username' => 'required',
            'password' => 'required',
            'confirmPassword' => ['same:password']
        ]);

        RegisterRequest::create($cred);

        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        $admin = User::where('user_role_id', 3)->get();

        foreach ($admin as $a) {
            if ($a->telegram_chat_id != null) {
                $telegram->sendMessage([
                    'chat_id' => $a->telegram_chat_id,
                    'text' => 'Permintaan registrasi baru dari '.$cred['name'].' telah masuk. Silakan diperiksa segera.'
                ]);
            }
        }

        return redirect('/login')->with('success_register_request', 'Permintaan registrasi Anda sudah masuk dan sedang diperiksa oleh Admin. Kami akan mengirimkan pembaruan mengenai permintaan anda melalui E-mail.');
    }

    public function register_approve(RegisterRequest $request) {
        $cred = $request->toArray();

        $cred['user_role_id'] = 1;
        $cred['password'] = Hash::make($cred['password']);
        $cred['telegram_chat_id'] = null;
        $cred['id'] = null;

        User::create($cred);
        Mail::to($cred['email'])->send(new MailNotification($request));
        
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        $admin = User::where('user_role_id', 3)->get();
        foreach ($admin as $a) {
            if ($a->telegram_chat_id != null) {
                $telegram->sendMessage([
                    'chat_id' => $a->telegram_chat_id,
                    'text' => 'Permohonan registrasi '.$cred['name'].' telah disetujui.'
                ]);
            }
        }

        RegisterRequest::destroy($request->id);
        return back()->with('approved', 'Anda telah menyetujui permohonan registrasi '.$cred['name'].'.');
    }

    public function register_reject(RegisterRequest $request) {
        $cred = $request->toArray();
        Mail::to($request->email)->send(new MailRejectNotification($request));

        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        $admin = User::where('user_role_id', 3)->get();
        foreach ($admin as $a) {
            if ($a->telegram_chat_id != null) {
                $telegram->sendMessage([
                    'chat_id' => $a->telegram_chat_id,
                    'text' => 'Permohonan registrasi '.$cred['name'].' telah ditolak.'
                ]);
            }
        }

        RegisterRequest::destroy($request->id);
        return back()->with('approved', 'Anda telah menolak permohonan registrasi '.$cred['name'].'.');
    }

    public function mail() {
        $request = RegisterRequest::where('id', 2)->first();
        Mail::to('rvalms@icloud.com')->send(new MailNotification($request));
    }

    public function storeAccount(Request $request) {
        $cred = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'departement_id' => 'required',
            'telegram_username' => 'required',
            'password' => 'required',
            'confirmPassword' => ['same:password']
        ]);

        $cred['user_role_id'] = 1;
        $cred['password'] = Hash::make($cred['password']);
        $cred['telegram_chat_id'] = null;

        User::create($cred);
        $data = User::where('name', $cred['name'])->where('email', $cred['email'])->where('departement_id', $cred['departement_id'])->first();

        $user_id = $data->id;

        Auth::loginUsingId($user_id);;
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    public function dashboard() {
        return view('user-dashboard', [
            'title' => 'user',
            'tickets' => Ticket::with(['user', 'category', 'status'])->where('user_id', auth()->user()->id)->sortable()->latest()->get(),
            'user' => User::where('id', auth()->user()->id)->first(),
            'departement' => Departement::all(),
        ]);
    }

    public function ticket(Ticket $ticket) {
        return view('user-ticket', [
            'title' => 'user',
            'ticket' => $ticket,
            // 'worker' => Worker::where('user_id', $ticket->user->id)->first(),
            // 'admin' => Admin::where('user_id', $ticket->admin_user_id)->first(),
            'replies' => Reply::where('ticket_id', $ticket->id)->latest()->get()
        ]);
    }

    public function updateProfile(Request $request) {
        $user_data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'phone_number' => 'required',
            'departement_id' => 'nullable',
        ]);

        User::where('id', auth()->user()->id)->update($user_data);

        $updated_user = User::find(auth()->user()->id);
        
        if ($updated_user->telegram_chat_id != null) {
            $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
            $telegram->sendMessage([
                'chat_id' => $updated_user->telegram_chat_id,
                'text' => 'Saudara '.$updated_user->name.', profil Anda berhasil diperbarui.'
            ]);
        }

        return redirect('/user')->with('user_success', 'Profil Anda berhasil diperbarui.');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'oldPassword' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'confirmPassword' => ['same:password']
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->password)]);

        $updated_user = User::find(auth()->user()->id);
        if ($updated_user->telegram_chat_id != null) {
            $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
            $telegram->sendMessage([
                'chat_id' => $updated_user->telegram_chat_id,
                'text' => 'Saudara '.$updated_user->name.', kata sandi Anda berhasil diperbarui.'
            ]);
        }

        return redirect('/user')->with('password_success', 'Kata sandi Anda berhasil diperbarui.');
    }

    public function register_request() {
        return view('admin/register-request', [
            'title' => 'register_request',
            'request' => RegisterRequest::with('departement')->paginate(10)
        ]);
    }
}
