<?php

namespace App\Repository;

use App\Models\SpiderHouse;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class SpiderHouseRepository
 * @package App\Repository
 */
class SpiderHouseRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SpiderHouse::class;
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Collection|static[]|SpiderHouse[]
	 */
	public function getAll()
	{
		return $this->model->get();
    }

	public function getByPolygon($maxLat, $maxLng, $minLat, $minLng)
	{
		$sql = "select id,name,lng, lat,total, ST_GeomFromText ('POLYGON((";
		$sql .= $minLng.' '.$maxLat.',';
		$sql .= $minLng.' '.$minLat.','.$maxLng.' '.$minLat.','.$maxLng.' '.$maxLat.',';
		$sql .= $minLng.' '.$maxLat;
		$sql .= "))') as ste, Point ( lng, lat) as rpt FROM spider_house where id > 0 HAVING st_contains(ste, rpt) = 1";
//		SELECT id,name,lng, lat, ST_GeomFromText ('POLYGON((113.6072156230005 34.91586596173386,113.6072156230005 34.88135338391958,113.629493599648 34.88135338391958,113.629493599648 34.91586596173386,113.6072156230005 34.91586596173386))') as ste, ST_PointFromGeoHash(ST_GeoHash ( lng, lat, 10 ), 0) as rpt FROM spider_house where id > 0 HAVING st_contains(ste, rpt) = 1
		$rst = collect(\DB::select($sql))->values()->toArray();
		return $rst;
    }
}