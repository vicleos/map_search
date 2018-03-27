<?php

namespace App\Http\Controllers;

use App\Traits\ResponseAble;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class WebController
 * @package App\Http\Controllers
 */
class WebController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ResponseAble;

    /**
     * 用户认证方式
     * @var string
     */
    protected $guard = 'webApi';

    /**
     * WebController constructor.
     */
    public function __construct()
    {
    }
}
