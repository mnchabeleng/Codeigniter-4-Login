<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CiSessions extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id TEXT NOT NULL',
			'ip_address TEXT NOT NULL',
			'timestamp INTEGER NOT NULL',
			'data TEXT NOT NULL',
			'ci_sessions_timestamp TEXT PRIMARY KEY NOT NULL',
		]);
		$this->forge->addKey('ci_sessions_timestamp', true);
		$this->forge->createTable('ci_sessions');
	}

	public function down()
	{
		$this->forge->dropTable('ci_sessions');
	}
}
