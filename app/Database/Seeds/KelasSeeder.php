<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KelasSeeder extends Seeder
{
	public function randString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
	public function run()
	{
		$data = [
			'kelas_id' => "KL-".$this->randString(),
			'kelas' => 'TIFCID19A',
			'deskripsi'    => 'Kelas Reguler'
		];
		$this->db->query("INSERT INTO kelas (kelas_id, kelas,deskripsi) VALUES(:kelas_id:, :kelas:, :deskripsi:)", $data);
	}
}
