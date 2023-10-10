<?php
namespace App\Models;

use CodeIgniter\Model;

class M_model extends Model
{

    public function tampil($table)
    {
        return $this->db->table($table)->get()->getResult();
    }

    public function hapus($table, $where)
    {
        return $this->db->table($table)->delete($where);
    }

    public function simpan($table, $data)
    {
        return $this->db->table($table)->insert($data);
    }

    public function getWhere($table, $where)
    {
        return $this->db->table($table)->getWhere($where)->getRow();
    }

    public function getWhere2($table, $where)
    {
        return $this->db->table($table)->getWhere($where)->getRowArray();
    }

    public function qedit($table, $data, $where)
    {
        return $this->db->table($table)->update($data, $where);
    }

    public function join2($table1, $table2, $on)
    {
        return $this->db->table($table1)->join($table2, $on, 'left')->get()->getResult();
    }

    public function join3($table1, $table2, $table3, $on, $on2)
    {
        return $this->db->table($table1)->join($table2, $on, 'left')->join($table3, $on2, 'left')->get()->getResult();
    }
    public function join4($table1, $table2, $table3, $table4, $on, $on2, $on3)
    {
        return $this->db->table($table1)->join($table2, $on, 'left')->join($table3, $on2, 'left')->join($table4, $on3, 'left')->get()->getResult();
    }


    public function joinW($table1, $table2, $on, $where)
    {
        return $this->db->table($table1)->join($table2, $on, 'left')->getWhere($where)->getRow();
    }

    public function tampilW($table1, $table2, $on, $where)
    {
        return $this->db->table($table1)->join($table2, $on, 'left')->getWhere($where)->getResult();
    }

    public function tampilWH($table1, $table2, $table3, $on, $on2, $where)
    {
        return $this->db->table($table1)->join($table2, $on, 'left')->join($table3, $on2, 'left')->getWhere($where)->getResult();
    }

    public function tampilWhere($table, $where)
    {
        return $this->db->table($table)->getWhere($where)->getResult();
    }

    public function filter2($table, $awal, $akhir)
    {
        return $this->db->query("
			SELECT *
			FROM " . $table . "
			WHERE " . $table . ".tanggal
			BETWEEN '" . $awal . "'
			and '" . $akhir . "'"

        )->getResult();
    }

    // public function filter1($table, $murid, $awal, $akhir){
    //     return $this->db->query("
    //         SELECT * FROM ".$table." 
    //         WHERE ".$table.".murid='".$murid"',
    //         ".$table.".tanggal
    //         BETWEEN '".$awal."'
    // 		and '".$akhir."'"

    // 	    )->getResult(); 
    // }

    public function filter($table, $murid, $awal, $akhir)
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        $builder->where('murid', $murid);
        $builder->where('tanggal >=', $awal);
        $builder->where('tanggal <=', $akhir);
        return $builder->get()->getResult();
    }

    public function filter1($table, $murid, $tgl)
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        $builder->where('murid', $murid);
        $builder->where('tanggal', $tgl);
        return $builder->get()->getResult();
    }

    public function simpanBatch($table, $data)
    {

        // $this->db->transBegin();


        $this->db->table($table)->insertBatch($data);


        // $this->db->transCommit();
    }

    public function updateMulti($table, $data)
    {
        foreach ($data as $row) {
            $where = array('id_absensi' => $row['id_absensi']);
            unset($row['id_absensi']);
            $this->db->table($table)->update($row, $where);
        }
    }

    public function getData($table1, $table2, $on, $date, $user)
    {
        $builder = $this->db->table($table1);
        $builder->select('*');
        $builder->join($table2, $on);
        $builder->where('tanggal', $date);
        $builder->where('createdBy', $user);
        return $builder->get()->getResult();
    }

    public function filter5($table, $murid, $tgl)
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        $builder->whereIn('murid', $murid);
        $builder->where('tanggal', $tgl);
        return $builder->get()->getResult();
    }
    public function getAllData()
    {
        $builder = $this->db->table('pinjaman'); // Nama tabel di sini

        return $builder->get()->getResultArray(); // Mengambil semua data dari tabel
    }
    public function getAllData1()
    {
        $builder = $this->db->table('angsuran'); // Nama tabel di sini

        return $builder->get()->getResultArray(); // Mengambil semua data dari tabel
    }
    public function getAllData2()
    {
        $builder = $this->db->table('simpanan'); // Nama tabel di sini

        return $builder->get()->getResultArray(); // Mengambil semua data dari tabel
    }
}