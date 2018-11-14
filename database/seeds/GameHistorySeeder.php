<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GameHistorySeeder extends Seeder
{
   
    public function run()
    {
    	$faker = Faker::create('zh_TW');

    	$users = ['ryan', 'ravi', 'hugo', 'alice','kae','tim', 'justin', 'emma', 'serina', 'sin'];

    	for ($i = 0; $i < 100000; $i++) {

    		$user = $users[rand(0, 9)];

    		App\Models\GameHistoryModel::create([
	        	'user_id' => $user,
	        	'amount' => $faker->randomFloat(3, 0, 1000),
	        	'result' => $faker->randomFloat(3, 0, 1000),
	        	'bet_time' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now'),
	        ]);
    	}

        
    }
}
