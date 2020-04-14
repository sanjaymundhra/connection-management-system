<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

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
                $req_sent = DB::table('friend_request')->insert([
                    ['user_one_id' => $user_one, 'user_two_id' => $user_two,'status' => 0,'action_by' => $user_one,'created_at'=>now(),'updated_at'=>now()  ]
                ]);
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
}
