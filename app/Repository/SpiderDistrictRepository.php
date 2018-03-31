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

	private $column = [];
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

	/**
	 * 指定要查询的字段列
	 * @param array $column
	 * @return $this
	 */
	public function showColumn(array $column){
		$this->column = $column;
		return $this;
	}

	public function getColumn()
	{
		return $this->column;
	}

	public function getByPolygon($maxLat, $maxLng, $minLat, $minLng)
	{
		$sql = "select id, district_name as name, lng, lat, count, position_border, ST_GeomFromText ('POLYGON((";
		$sql .= $minLng.' '.$maxLat.',';
		$sql .= $minLng.' '.$minLat.','.$maxLng.' '.$minLat.','.$maxLng.' '.$maxLat.',';
		$sql .= $minLng.' '.$maxLat;
		$sql .= "))') as ste, Point ( lng, lat) as rpt FROM spider_district where id > 0 HAVING st_contains(ste, rpt) = 1";
		$rst = collect(\DB::select($sql))->values()->toArray();
		return $rst;
	}
}