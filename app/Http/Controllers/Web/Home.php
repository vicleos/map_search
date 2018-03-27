<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\WebController;
//use Illuminate\Http\Request;

class Home extends WebController
{
	/**
	 * Create a new controller instance.
	 */
	public function __construct()
	{
	}

	public function index()
	{
		return view('web.home');
	}
}
