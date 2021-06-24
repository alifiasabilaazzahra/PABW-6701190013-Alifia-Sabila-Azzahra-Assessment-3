<?php

namespace App\Controllers;
use App\Models\KelasModel;
use Config\Services;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
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
	public function index()
	{
		return view('list');
	}
	public function get()
    {
        $request = Services::request();
        $datatable = new KelasModel($request);

        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $list->kelas_id;
                $row[] = $list->kelas;
                $row[] = $list->deskripsi;
				$row[] = '<a class="btn btn-sm btn-primary" href="'.$list->kelas_id.'/edit">Edit</a>&nbsp;<a href="#" data-href="'.base_url('/'.$list->kelas_id.'/delete').'" onclick="confirmToDelete(this)" class="btn btn-sm btn-danger">Hapus</a>';
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $datatable->countAll(),
                'recordsFiltered' => $datatable->countFiltered(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }
	public function tambah() {
		return view('tambah');
	}
	public function add() {
		// lakukan validasi
		$request = Services::request();
        $validation =  Services::validation();
        $validation->setRules(['kelas' => 'required']);
        $isDataValid = $validation->withRequest($request)->run();

        // jika data valid, simpan ke database
        if($isDataValid){
            $model = new KelasModel($request);
            $model->insert([
				"kelas_id" => "KL".$this->randString(),
                "kelas" => $request->getPost('kelas'),
                "deskripsi" => $request->getPost('deskripsi'),
            ]);
            return redirect('/');
        }
		
        // tampilkan form create
        echo view('tambah');
	}
	public function edit($id) {
		$request = Services::request();
		$model = new KelasModel($request);
		$data['data'] = $model->where('kelas_id', $id)->first();
		
		if(!$data['data']){
			throw PageNotFoundException::forPageNotFound();
		}
		echo view('edit', $data);
	}
	public function update($id) {
		$request = Services::request();
		// ambil artikel yang akan diedit
        $model = new KelasModel($request);
        $data['data'] = $model->where('kelas_id', $id)->first();
        
        // lakukan validasi data artikel
        $validation =  Services::validation();
        $validation->setRules([
            'kelas_id' => 'required',
            'kelas' => 'required'
        ]);
        $isDataValid = $validation->withRequest($request)->run();
        // jika data vlid, maka simpan ke database
        if($isDataValid){
            $model->update($id, [
                "kelas" => $request->getPost('kelas'),
                "deskripsi" => $request->getPost('deskripsi'),
            ]);
            return redirect('/');
        }

        // tampilkan form edit
        echo view('edit', $data);
    }

    //--------------------------------------------------------------------------

	public function delete($id){
		$request = Services::request();
        $model = new KelasModel($request);
        $model->delete($id);
        return redirect('/');
    }
}
