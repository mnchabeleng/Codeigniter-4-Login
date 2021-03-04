<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
	public function index()
	{
        helper(['form']);

		$data = [];

		if( $this->request->getMethod() == 'post' )
		{

			$rules = [
				'email' => ['label' => 'Email', 'rules' => 'required|min_length[3]|max_length[55]|valid_email'],
				'password' => ['label' => 'Password', 'rules' => 'required|min_length[3]|max_length[155]'],
			];
			
			if( !$this->validate($rules) )
			{
				$data['validation'] = $this->validator;
			}
			else
			{
				$model = new UserModel();
				$user = $model->where('email', $this->request->getVar('email'))->first();
				$session = session();

				if( !$user )
				{
					$session->setFlashData('error', 'Invalid login.');
				}
				else
				{
					if( !password_verify($this->request->getVar('password'), $user['password']) )
					{
						$session->setFlashData('error', 'Invalid login.');
					}
					else
					{
						$temp = $this->request->getVar('stay') ? false : true;
						$session->setFlashData('success', 'Login success.');
						$this->setUserSession($session, $user, $temp);
						return redirect()->to('/');
					}
				}
			}
		}
		
		$data['title'] = 'Login';

		return view('login', $data);
	}

    private function setUserSession($session, $user, $temp = true)
	{
		$sessionTime = 1800;

		$data = [
			'id' => $user['id'],
			'first_name' => $user['first_name'],
			'last_name' => $user['last_name'],
			'email' => $user['email'],
			'is_logged_in' => true
		];

		if($temp == true)
		{
			$session->setTempdata('user', $data, $sessionTime);
		}
		else
		{
			$session->set('user', $data);
		}

		return true;
	}
}
