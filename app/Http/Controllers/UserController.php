<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\Worker;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login() {
        return view('login');
    }

    public function auth(Request $request) {
        $cred = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($cred)) {
            $request->session()->regenerate();
            if(auth()->user()->user_role_id == 2) {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/');
            }
        }

        return back()->with('error', 'Login Failed');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function dashboard() {
        return view('user-dashboard', [
            'tickets' => Ticket::where('user_id', auth()->user()->id)->latest()->get(),
            'user' => User::where('id', auth()->user()->id)->first(),
            'departement' => Departement::all(),
        ]);
    }

    public function ticket(Ticket $ticket) {
        return view('user-ticket', [
            'ticket' => $ticket,
            'worker' => Worker::where('user_id', $ticket->user->id)->first(),
            'admin' => Admin::where('user_id', $ticket->admin_user_id)->first(),
            'replies' => Reply::where('ticket_id', $ticket->id)->get()
        ]);
    }
}
