<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* @author Muhammad syazili
* @copyright Teknik Informatika, Fasilkom Unsri 2018
*/

class m_komentar extends CI_Model{
	private $table1 = 'komentar';
  private $table2 = 'akun';

  public function get_semua_komentar()
  {
    $this->db->select('komentar.*, akun.nama, akun.role');
    $this->db->from($this->table1);
    $this->db->join($this->table2, 'komentar.id_pembuat = akun.id_akun');
    $query = $this->db->get();
    return $query->result();
  }

  public function set_komentar($data)
  {
    return $this->db->insert($this->table1, $data);
  }

  public function get_komentar_by_IdKomentar($where)
  {
    $query = $this->db->get_where($this->table1, $where);
    return $query->row();
  }

  public function update_komentar($data, $where)
  {
    $this->db->where($where);
    return $this->db->update($this->table1, $data);
  }

  public function get_berkas_by_IdKomentar($where)
  {
    $query = $this->db->get_where($this->table1, $where);
    return $query->row();
  }

  public function delete_komentar($where)
  {
      $this->db->where($where);
        return $this->db->delete($this->table1);
  }
}