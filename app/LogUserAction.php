<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogUserAction extends Model
{
    protected $table='user_log_activity';
    protected $fillable = ['created_by','created_for','action'];
}
