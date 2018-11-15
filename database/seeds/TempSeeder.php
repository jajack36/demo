<?php

use Illuminate\Database\Seeder;

class TempSeeder extends Seeder
{
   
    public function run()
    {
		App\Models\TempModel::create([
        	'offset' => 0,
        	'limit' => 10000,
        ]);
        
    }
}
