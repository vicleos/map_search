<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\WebController;
use App\Repository\SpiderDistrictRepository;
use App\Repository\SpiderBizCircleRepository;
use App\Repository\SpiderHouseRepository;
use Illuminate\Http\Request;

class Index extends WebController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
    }

	public function index(Request $request, SpiderHouseRepository $houseRepository, SpiderDistrictRepository $districtRepository, SpiderBizCircleRepository $bizCircleRepository)
	{
//		$cityDataJson = json_encode($houseRepository->getAll()->toArray(), JSON_UNESCAPED_UNICODE);
//		$maxLat = '34.91586596173386';
//		$minLat = '34.88135338391958';
//		$maxLng = '113.629493599648';
//		$minLng = '113.6072156230005';
		$maxLat = '34.74778';
		$minLat = '34.67484';
		$maxLng = '113.745';
		$minLng = '113.6919';
//		$polygonData = $houseRepository->getByPolygon($maxLat,$maxLng,$minLat,$minLng);
		$polygonData = $houseRepository->getAll();
		$districtData = $districtRepository->getAll();
		$bizCircleData = $bizCircleRepository->getAll();
		$formatData = $districtFormatData = $bizCircleFormatData = [];
		foreach ($polygonData ?? [] as $item){
			$formatData[] = [
				'id' => $item->id,
				'name' => $item->name,
				'lng' => $item->lng,
				'lat' => $item->lat,
				'total' => $item->total ?: 0,
			];
		}

		foreach ($bizCircleData as $bItem){
			$bizCircleFormatData[] = [
				'name' => $bItem->getAreaName(),
				'lat' => $bItem->getLat(),
				'lng' => $bItem->getLng(),
				'count' => $bItem->getHouseCount(),
				'position_border' => $bItem->getPositionBorder()
			];
		}

		foreach ($districtData as $dItem){
			$districtFormatData[] = [
				'name' => $dItem->getDistrictName(),
				'lat' => $dItem->getLat(),
				'lng' => $dItem->getLng(),
				'count' => $dItem->getCount(),
				'position_border' => $dItem->getPositionBorder()
			];
		}
		$cityDataJson = json_encode($formatData, JSON_UNESCAPED_UNICODE);
		$bizCircleDataJson = json_encode($bizCircleFormatData, JSON_UNESCAPED_UNICODE);
		$districtDataJson = json_encode($districtFormatData, JSON_UNESCAPED_UNICODE);
		return view('web.index', compact('cityDataJson', 'districtDataJson', 'bizCircleDataJson'));
    }
}
