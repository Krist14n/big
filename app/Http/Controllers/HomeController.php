<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Log;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $vc = Auth::user()->vc;

        $users = User::where('id', '!=', Auth::user()->id)->get();

        $logs = Log::join('users', 'users.id', '=', 'logs.sender_id')
                    ->where('status','=','unread')
                    ->where('receiver_id', '=', Auth::user()->id)
                    ->get();

        $logs_count = Log::where('receiver_id', '=', Auth::user()->id)
                    ->where('status','=','unread')
                    ->count();

        $all_logs = Log::where('sender_id', '=', Auth::user()->id)
                        ->orWhere('receiver_id', '=', Auth::user()->id)
                        ->orderBy('created_at','desc')
                        ->get();

        return view('home',['vc'=>$vc, 'users'=>$users, 'logs'=>$logs, 'logs_count'=>$logs_count, 'all_logs'=>$all_logs]);
    }

    public function updateLogs(){

        $logs_count = Log::where('receiver_id', '=', Auth::user()->id)
                            ->update(['status' => 'read']);
        return("success");

    }
}
