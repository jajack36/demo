<?php 
namespace App\Repositories;

use App\Model\GameHistoryModel;

class GameHistoryRepository
{

	protected $model;

	public function __construct(GameHistoryModel $history)
	{
		$this->model = $history;
	}
	
	
}