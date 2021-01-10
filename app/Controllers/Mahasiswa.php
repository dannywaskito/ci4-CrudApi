<?php namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\RESTful\ResourceController;


class Mahasiswa extends ResourceController
{
	protected $format 	 = 'json';
	protected $modelName = 'App\Models\MahasiswaModel';

	public function index()
	{
		return $this->respond($this->model->findAll(),200);
	}
	public function detail($id=NULL)
	{
		$get = $this->model->getMahasiswa($id);
		return $this->respond($get,200);
	}
	public function add()
	{
		$valid = $this->validate([
				'nim' =>[
				'label'  => 'Nim',
				'rules'  => 'required|is_unique[tbl_mahasiswa.nim]',
				'errors' => [
					'required' => '{field} Wajib Diisi bosku',
					'is_unique' =>'{field} Tidak Boleh Sama',
				]
			],
			'nama_mahasiswa' =>[
				'label'  => 'Nama Mahasiswa',
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} Wajib Diisi bosku',
				]
			],
			'prodi' =>[
				'label'  => 'Program Studi',
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} Wajib Diisi bosku',
				]
			],
			'alamat' =>[
				'label'  => 'Alamat',
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} Wajib Diisi bosku',
				]
			],
		]);
		if (!$valid) {
			$response = [
				'status' => 500,
				'error'  => true,
				'data'   => \Config\Services::validation()->getErrors(),
			];
			return $this->respond($response, 500);
		}else{
			$nim = $this->request->getPost('nim');
			$nama_mahasiswa = $this->request->getPost('nama_mahasiswa');
			$prodi = $this->request->getPost('prodi');
			$alamat = $this->request->getPost('alamat');
			$data = [
				'nim'  => $nim,
				'nama_mahasiswa'  => $nama_mahasiswa,
				'prodi'=> $prodi,
				'alamat' => $alamat,
			];
			$simpan = $this->model->addMahasiswa($data);
			if ($simpan) {
				$msg = ['message' => 'Mahasiswa Berhasil Ditambahkan bosku'];
				$response = [
				'status' => 200,
				'error'  => false,
				'data'   => $msg,
			];
			return $this->respond($response, 200);
			}
		}
	}
	public function edit($id=null)
	{
		$valid = $this->validate([
				'nim' =>[
				'label'  => 'Nim',
				'rules'  => 'required|is_unique[tbl_mahasiswa.nim]',
				'errors' => [
					'required' => '{field} Wajib Diisi bosku',
					'is_unique' =>'{field} Tidak Boleh Sama',
				]
			],
			'nama_mahasiswa' =>[
				'label'  => 'Nama Mahasiswa',
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} Wajib Diisi bosku',
				]
			],
			'prodi' =>[
				'label'  => 'Program Studi',
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} Wajib Diisi bosku',
				]
			],
			'alamat' =>[
				'label'  => 'Alamat',
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} Wajib Diisi bosku',
				]
			],
		]);
		if (!$valid) {
			$response = [
				'status' => 500,
				'error'  => true,
				'data'   => \Config\Services::validation()->getErrors(),
			];
			return $this->respond($response, 500);
		}else{
			$nim = $this->request->getPost('nim');
			$nama_mahasiswa = $this->request->getPost('nama_mahasiswa');
			$prodi = $this->request->getPost('prodi');
			$alamat = $this->request->getPost('alamat');
			$data = [
				'nim'  => $nim,
				'nama_mahasiswa'  => $nama_mahasiswa,
				'prodi'=> $prodi,
				'alamat' => $alamat,
			];
			$edit = $this->model->updateMahasiswa($data, $id);
			if ($edit) {
				$msg = ['message' => 'Mahasiswa Berhasil Diupdate bosku'];
				$response = [
				'status' => 200,
				'error'  => false,
				'data'   => $msg,
			];
			return $this->respond($response, 200);
			}
		}
	}
	public function hapus($id=null)
	{
		$msg = ['message' => 'Mahasiswa Berhasil DiHapus bosku'];
		$this->model->deleteMahasiswa($id);
		$response = [
			'data'   => $msg,
		];
		return $this->respond($response, 200);
	}
}
