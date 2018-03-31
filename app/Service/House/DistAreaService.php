<?php
namespace App\Service\House;
/**
 * 城市行政区，商圈相关逻辑服务类
 * Class DistAreaService
 * @package App\Service\House
 */
class DistAreaService
{
	private $cityId;

	/**
	 * DistAreaService constructor.
	 */
	public function __construct(){}

	public function setCityId(int $cityId)
	{
		$this->cityId = $cityId;
		return $this;
	}

	public function getCityId()
	{
		return $this->cityId;
	}

	/**
	 * 获取 SpiderDistrictRepository 仓库实例
	 * @return \Illuminate\Foundation\Application|\App\Repository\SpiderDistrictRepository
	 */
	public function getDistrictRepository()
	{
		return app('\App\Repository\SpiderDistrictRepository');
	}

	/**
	 * 根据城市ID获取行政区列表
	 * @return array
	 */
	public function getDistrictList($maxLat, $maxLng, $minLat, $minLng)
	{
		$list = $this->getDistrictRepository()->getByPolygon($maxLat, $maxLng, $minLat, $minLng);
		$listFormat = [];
		foreach ($list as $row){
			unset($row->ste);
			unset($row->rpt);
			$listFormat[] = json_decode(json_encode($row), true);
		}
		return [
			'data' => $listFormat
		];
	}

}