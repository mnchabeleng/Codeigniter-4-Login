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

	public function login()
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
				// Store the user in the database
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
						$session->setFlashData('success', 'Login success.');
						$this->setUserSession($session, $user);
						return redirect()->to('/');
					}
				}
			}
		}
		
		$data['title'] = 'Login';

		return view('login', $data);
	}

	private function setUserSession($session, $user)
	{
		$data = [
			'id' => $user['id'],
			'first_name' => $user['first_name'],
			'last_name' => $user['last_name'],
			'email' => $user['email'],
			'is_logged_in' => true
		];

		$session->set('user', $data);

		return true;
	}

	public function logout()
	{
		$session = session();

		if( $session->get('user') )
		{
			$session->destroy();
		}

		return redirect()->to('/login');
	}

	public function signup()
	{
		helper(array('form'));
		
		$data = [];

		if( $this->request->getMethod() == 'post' )
		{
			$rules = [
				'first_name' => ['label' => 'First name','rules' => 'required|min_length[3]|max_length[25]'],
				'last_name' => ['label' => 'Last name', 'rules' => 'required|min_length[3]|max_length[25]'],
				'email' => ['label' => 'Email', 'rules' => 'required|min_length[3]|max_length[55]|valid_email|is_unique[users.email]'],
				'password' => ['label' => 'Password', 'rules' => 'required|min_length[3]|max_length[155]'],
				'confirm_password' => ['label' => 'Confirm password', 'rules' => 'matches[password]']
			];
			
			if( !$this->validate($rules) )
			{
				$data['validation'] = $this->validator;
			}
			else
			{
				$user = [
					'first_name' => $this->request->getVar('first_name'),
					'last_name' => $this->request->getVar('last_name'),
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password')
				];

				$model = new UserModel();
				$model->save($user);

				session()->setFlashData('success', 'Signup complete.');
				return redirect()->to('/login');
			}
		}

		$data['title'] = 'Signup';

		return view('signup', $data);
	}
}
