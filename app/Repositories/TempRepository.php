<?php 
namespace App\Repositories;

use App\Models\TempModel;

class TempRepository
{

	protected $model;

	public function __construct(TempModel $temp)
	{
		$this->model = $temp;
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