<?php

use Illuminate\Database\Seeder;

class QueryLimitSeeder extends Seeder
{
   
    public function run()
    {
		App\Models\QueryLimitModel::create([
        	'offset' => 0,
        	'limit' => 10000,
        ]);
        
    }
}
