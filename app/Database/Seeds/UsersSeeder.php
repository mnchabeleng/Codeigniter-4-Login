<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
	public function run()
	{
		$model = model('UserModel');

		for($i = 0; $i < 100; $i++)
		{
			$model->insert([
				'first_name'	=> static::faker()->firstName,
				'last_name'		=> static::faker()->lastName,
				'email'			=> static::faker()->email,
				'password'		=> 'password',
			]);
		}
	}
}
