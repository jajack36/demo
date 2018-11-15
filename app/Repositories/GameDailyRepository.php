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

	public function create($data)
	{
		return $this->model
			->create($data);
	}

	public function update($userID, $data)
	{
		return $this->model
			->where(['user_id' => $userID])
			->update($data);
	}
	
	public function exists($userID, $date)
	{
		return $this->model
			->where(['user_id' => $userID, 'bet_time' => $date])
			->first();
	}
}