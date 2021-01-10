<?php namespace App\Models;
use CodeIgniter\Model;

class MahasiswaModel extends Model
{
		protected $table = 'tbl_mahasiswa';

		public function getMahasiswa($id = false)
		{
			if ($id == false) {
				return $this->findAll();
			}else{
				return $this->getWhere(['id_mahasiswa'=>$id])->getRowArray();
			}
		}
		public function addMahasiswa($data)
		{
			return $this->db->table($this->table)->insert($data);
		}
		public function updateMahasiswa($data, $id)
		{
			return $this->db->table($this->table)->update($data,['id_mahasiswa'=>$id]);
		}
		public function deleteMahasiswa($id)
		{
			return $this->db->table($this->table)->delete(['id_mahasiswa'=>$id]);
		}
	}