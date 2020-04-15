<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $names = ['ramesh','suresh','dinesh','rakesh','hitesh'];
        $users = array();
        foreach($names as $name){
            $users[] = [
                'name' => $name,
                'email' => $name.'@gmail.com',
                'gender' => 'male',
                'password' => Hash::make('password')
            ];
        }
        User::insert($users);
        $users = User::all();
        $hobbies = DB::table('hobbies')->pluck('id')->toArray();      
        $hobby_user = array();
        foreach($users as $user){
            shuffle($hobbies);
            $n = rand(0, count($hobbies));
            $hobbies = array_slice($hobbies, 0 , $n);
            foreach($hobbies as $hobby_id){                
                $hobby_user[] = ['hobby_id'=>$hobby_id,'user_id'=>$user->id];
            }
        }
        DB::table('hobby_user')->insert($hobby_user);
    }
}
