<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GameHistorySeeder extends Seeder
{
   
    public function run()
    {
    	$faker = Faker::create('zh_TW');

    	$users = ['ryan', 'ravi', 'hugo', 'alice','kae','tim', 'justin', 'emma', 'serina', 'sin'];

    	for($j = 0; $j < 10; $j++){
    		$datas = [];
	    	for ($i = 0; $i < 10000; $i++) {
	    		$user = $users[rand(0, 9)];
	    		$hours = '+'.rand(1, 8).' hours';
			  	$datas[] = [
			      	'user_id' => $user,
		        	'amount' => $faker->randomFloat(3, 0, 1000),
		        	'result' => $faker->randomFloat(3, -1000, 1000),
		        	'bet_time' => $faker->dateTimeInInterval('', $hours),
		        	'created_at' => date('Y-m-d H:i:s'),
		        	'updated_at' => date('Y-m-d H:i:s')
			  	];
	    	}

			App\Models\GameHistoryModel::insert($datas);
		}
    }
}
