<?php

use Illuminate\Database\Seeder;
use App\Hobby;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hobbies')->truncate();
        Hobby::insert([
            ['name' => 'playing'],
            ['name' => 'dancing'],
            ['name' => 'cooking'],
            ['name' => 'singing']
        ]);
    }
}
