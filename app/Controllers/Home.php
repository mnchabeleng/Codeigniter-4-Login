<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Welcome'
		];

		return view('home', $data);
	}

	public function profile()
	{
		echo 'Profile';
	}
}
