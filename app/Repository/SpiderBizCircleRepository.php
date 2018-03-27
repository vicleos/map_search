<?php

namespace App\Repository;

use App\Models\SpiderBizCircle;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class SpiderBizCircleRepository
 * @package App\Repository
 */
class SpiderBizCircleRepository extends BaseRepository
{

	/**
	 * Specify Model class name
	 *
	 * @return string
	 */
	public function model()
	{
		return SpiderBizCircle::class;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Collection|mixed|SpiderBizCircle[]
	 */
	public function getAll()
	{
		return $this->model->get();
	}
}