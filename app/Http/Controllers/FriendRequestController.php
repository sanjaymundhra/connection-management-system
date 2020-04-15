<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\FriendRequest;

class FriendRequestController extends Controller
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
     * Send Friend Request
     *
     * @return void
     */
    public function send(Request $request)
    {
        $user_one = auth()->user()->id;
        if($request->ajax()){
            $user_two = $request->user_two;
            $user_exists = User::find($user_two);
            if($user_exists && $user_one!=$user_two ){
                $req_sent = FriendRequest::create(
                    ['user_one_id' => $user_one, 'user_two_id' => $user_two,'status' => 0,'action_by' => $user_one,'created_at'=>now(),'updated_at'=>now()  ]
                );
                if($req_sent){
                    return response()->json( 'ok', 200 );
                }
            }
            return response()->json( 'error', 500 );
        }
        else{
            return response()->json( 'Not allowed', 405 );
        }
    } 

    /**
     * Accept Friend Request
     *
     * @return void
     */
    public function accept(Request $request)
    {
        $user_two = auth()->user()->id;
        if($request->ajax()){
            $user_one = $request->user_one;
            $user_exists = User::find($user_one);
            if($user_exists && $user_one!=$user_two ){
                $req_received= FriendRequest::where(['user_one_id' => $user_one, 'user_two_id' => $user_two,'status' => 0])
                    ->update([
                        'status' => 1 ,'action_by' => $user_two,'updated_at'=>now()
                    ]);
                if($req_received){
                    return response()->json( 'ok', 200 );
                }
            }
            return response()->json( 'error', 500 );
        }
        else{
            return response()->json( 'Not allowed', 405 );
        }
    }
    /**
     * Block user
     *
     * @return void
     */
    public function block(Request $request)
    {
        $user_one = auth()->user()->id;
        if($request->ajax()){
            $user_two = $request->user_two;
            $user_exists = User::find($user_two);
            if($user_exists && $user_one!=$user_two ){
                $block = FriendRequest::where(['user_one_id' => $user_one, 'user_two_id' => $user_two])
                    ->orWhere(['user_one_id' => $user_two, 'user_two_id' => $user_one])
                    ->update(
                        ['status' => 2,'action_by' => $user_one,'updated_at'=>now()]
                    );
                if(!$block){
                    $block = FriendRequest::create([
                        ['user_one_id' => $user_one, 'user_two_id' => $user_two,'status' => 2,'action_by' => $user_one,'created_at'=>now(),'updated_at'=>now()  ]
                    ]);
                }
                if($block)
                    return response()->json( 'ok', 200 );
            }
            return response()->json( 'error', 500 );
        }
        else{
            return response()->json( 'Not allowed', 405 );
        }
    }
}
