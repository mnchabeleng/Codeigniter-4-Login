<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL',
			'first_name TEXT NOT NULL',
			'last_name TEXT NOT NULL',
			'email TEXT NOT NULL',
			'password TEXT NOT NULL',
			'created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP'
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
