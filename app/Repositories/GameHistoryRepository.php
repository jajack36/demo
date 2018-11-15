<?php 
namespace App\Repositories;

use App\Models\GameHistoryModel;

class GameHistoryRepository
{

	protected $model;

	public function __construct(GameHistoryModel $history)
	{
		$this->model = $history;
	}
	
	
}