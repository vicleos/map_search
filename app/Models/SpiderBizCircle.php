<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpiderBizCircle extends Model
{
	protected $table = 'spider_biz_circle';

	public function getAreaName()
	{
		return $this->area_name;
	}

	public function getAreaId()
	{
		return $this->area_id;
	}

	public function getQuanPin()
	{
		return $this->quanpin;
	}

	public function getLat()
	{
		return $this->lat;
	}

	public function getLng()
	{
		return $this->lng;
	}

	public function getHouseCount()
	{
		return $this->house_count;
	}

	public function getPositionBorder()
	{
		return $this->position_border;
	}

	public function getMinPriceTotal()
	{
		return $this->min_price_total;
	}

	public function getAvgUnitPrice()
	{
		return $this->avg_unit_price;
	}
}
