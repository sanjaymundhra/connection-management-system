<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hobbies()
    {
        return $this->belongsToMany('App\Hobby');
    }

    public function friend_request_status()
    {
        $status = DB::table('friend_request')->select('status')
                    ->where([
                        'user_one_id'=>auth()->user()->id,
                        'user_two_id'=>$this->id,
                        'action_by'=>auth()->user()->id,
                    ])->first();
        if($status){
            return ['req'=>'sent','status'=>$status->status];
        }
        else{
            $status = DB::table('friend_request')->select('status')
                    ->where([
                        'user_one_id'=>$this->id,
                        'user_two_id'=>auth()->user()->id,
                        'action_by'=>$this->id,
                    ])->first();
            if($status){
                return ['req'=>'received','status'=>$status->status];
            }
        }
        return ['req'=>'none','status'=>-1];
    }
    public function is_blocked()
    {
        $status = DB::table('friend_request')->select('status')
                    ->where([
                        'user_one_id'=>auth()->user()->id,
                        'user_two_id'=>$this->id,
                        'action_by'=>auth()->user()->id,
                    ])->first();
        if($status){
            return $status->status;
        }
        return -1;
    }
    public function has_blocked()
    {
        $status = DB::table('friend_request')->select('status')
                    ->where([
                        'user_one_id'=>$this->id,
                        'user_two_id'=>auth()->user()->id,
                        'action_by'=>$this->id,
                    ])
                    ->orWhere([
                        'user_one_id'=>auth()->user()->id,
                        'user_two_id'=>$this->id,
                        'action_by'=>$this->id,
                    ])
                    ->first();
        if($status){
            return $status->status;
        }
        return -1;
    }
}
