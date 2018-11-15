<?php 
namespace App\Repositories;

use App\Models\GameDailyModel;

class GameDailyRepository
{

	protected $model;

	public function __construct(GameDailyModel $daily)
	{
		$this->model = $daily;
	}
	
	
}