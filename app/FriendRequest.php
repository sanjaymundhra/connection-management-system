<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    protected $table='friend_request';

    protected $fillable = ['user_one_id','user_two_id','status','action_by'];
}
