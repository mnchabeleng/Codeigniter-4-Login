<?php

namespace App\Controllers;

class Logout extends BaseController
{
	public function index()
	{
		$session = session();

		if( $session->get('user') )
		{
			$session->destroy();
		}

		return redirect()->to('/login');
	}
}
