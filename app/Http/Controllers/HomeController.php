<?php

namespace App\Http\Controllers;

use App\Hobby;
use Illuminate\Http\Request;
use App\User;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        $hobbies = Hobby::all();
        return view('home',compact('users','hobbies'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function filteredUsers(Request $request)
    {
        $users = User::where('id', '!=', auth()->id());
        $hobbies = Hobby::all();
        $gender = $request->filter_gender;$hobby = $request->filter_hobby;
        if($hobby){
            $users = $users->whereHas('hobbies', function($q) use ($hobby){
                $q->where('name', '=', $hobby);

            });
        }
        $users = $users->get();
        if($gender){
            $users = $users->filter(function ($value, $key) use ($gender)  {
                        return $value->gender==$gender;
                    });
        }        
        
        return view('home',compact('users','hobbies'));
    }
    
}
