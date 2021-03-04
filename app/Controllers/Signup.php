<?php

namespace App\Controllers;

class Signup extends BaseController
{
	public function index()
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
