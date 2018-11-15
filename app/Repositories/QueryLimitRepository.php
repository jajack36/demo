<?php 
namespace App\Repositories;

use App\Models\QueryLimitModel;

class QueryLimitRepository
{

	protected $model;

	public function __construct(QueryLimitModel $limit)
	{
		$this->model = $limit;
	}
	
	public function getData()
	{
		return $this->model
			->first();
	}
	
	public function update($id, $data)
	{
		return $this->model
			->where('id', $id)
			->update($data);
	}
}