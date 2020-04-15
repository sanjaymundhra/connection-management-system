<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogUserAction;

class LogUserActionController extends Controller
{
    public function index(Request $request){
        $userActions = LogUserAction::all();
        return view('history',compact('userActions'));
    }
}
