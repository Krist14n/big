<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Log;
use App\User;

class SendVcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $vc_quantity = $request['vcqty'];
        $vc_users_id = $request['userid'];
        $current_user_id = Auth::user()->id;

        $total_to_send = 0;

        foreach ($vc_quantity as $key => $value) {
            $total_to_send += $value;
        }

        if($total_to_send <= Auth::user()->vc){

            if(count($vc_users_id)<=10){

                foreach ($vc_quantity as $key => $value) {

                    if($value != null){

                        //update log 
                        $vc_log = new Log;
                        $vc_log->sender_id = $current_user_id;
                        $vc_log->receiver_id = $vc_users_id[$key];
                        $vc_log->quantity = $value;
                        $vc_log->save();

                        //update current user vc
                        $update_current_user_vc = User::where('id',$current_user_id)
                                                        ->decrement('vc', $value);
                        //update receiver vc
                        $update_receiver_user_vc = User::where('id',$vc_users_id[$key])
                                                        ->increment('vc', $value);                               
                    }
                }
                $request->session()->flash('success', 'Your vc has been sent correctly!');
                return redirect()->route('home');

            }else{
                $request->session()->flash('error', 'Cannot send vc to more than 10 users at a time!');
                return redirect()->route('home');
            }
        }else{
                $request->session()->flash('error', 'You do not have enough vc to send!');
                return redirect()->route('home');
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
