<?php

namespace App\Http\Controllers;

use App\Chat;
use Input;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {

        $chat = Chat::get();
        return view('chat', compact('chat'));
    }

    //
    public function getchat(){
        ini_set('max_execution_time',7200);
        while (Chat::where('check',0)->count() < 1)
        {
            usleep(1000);
        }
        if (Chat::where('check',0)->count() < 1)
        {
            $data = Chat::where('check',0)->first();
            $id = $data->id;
            $chat = Chat::find($id);
            $chat->check = 1;
            $chat->save();
            return response()->json([
                'msg' => $data->msg,
            ]);
        }
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $chat = new Chat;
        $chat->msg = $request->input('msg');
        $chat->user_id = $user->id;
        $chat->check = 0;
        $chat->save();

    }
}
