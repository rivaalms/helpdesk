<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{    
    public function adminreply(Request $request) {
        $rules = [
            'ticket_id' => 'required',
            'message' => 'required',
        ];

        $data = $request->validate($rules);
        $data['user_id'] = auth()->user()->id;

        Reply::create($data);
        return back();
    }
}
