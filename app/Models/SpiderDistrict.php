<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpiderDistrict extends Model
{
    protected $table = 'spider_district';

	public function getDistrictName()
	{
		return $this->district_name;
    }

	public function getLat()
	{
		return $this->lat;
    }

	public function getLng()
	{
		return $this->lng;
    }
    
    public function getPositionBorder()
	{
		return $this->position_border;
	}

	public function getCount()
	{
		return $this->count;
	}
}
