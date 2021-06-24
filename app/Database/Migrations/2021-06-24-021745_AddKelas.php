<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKelas extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'kelas_id'          => [
					'type'           => 'VARCHAR',
					'constraint'     => "10",					
			],
			'kelas'       => [
					'type'       => 'VARCHAR',
					'constraint' => '100',
			],
			'deskripsi' => [
					'type' => 'TEXT',
					'null' => true,
			],
		]);
		$this->forge->addKey('kelas_id', true);
		$this->forge->createTable('kelas');
	}

	public function down()
	{
		$this->forge->dropTable('kelas');
	}
}
