<?php

namespace App\Repository;

use App\Models\SpiderDistrict;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class SpiderDistrictRepository
 * @package App\Repository
 */
class SpiderDistrictRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SpiderDistrict::class;
    }

	/**
	 * @return \App\Models\SpiderDistrict[]|mixed
	 */
	public function getAll()
	{
		return $this->model->get();
    }
}