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
	
	public function getData($offset = 0, $limit)
	{
		return $this->model
			->offset($offset)
			->limit($limit)
			->orderBy('id', 'ASC')
			->get();
	}
	
}