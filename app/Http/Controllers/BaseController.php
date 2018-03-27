<?php

namespace App\Http\Controllers;

use Auth;
use App\Traits\ResponseAble;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BaseController extends Controller
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ResponseAble;

	/**
	 * 平台
	 * @var string
	 */
	public $platform;

	/**
	 * 版本
	 * @var string
	 */
	public $version;

	/**
	 * BaseController constructor.
	 */
	public function __construct()
	{
	}

	/**
	 * 获取当前登陆用户
	 * @param string $guard
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function getUser($guard = 'UserApi')
	{
		static $user;
		if($user){
			return $user;
		}
		return Auth::guard($guard)->user();
	}
}
