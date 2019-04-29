<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* @author Muhammad syazili
* @copyright Teknik Informatika, Fasilkom Unsri 2018
*/

class m_informasi extends CI_Model{
	private $table1 = 'informasi';
  private $table2 = 'akun';


	public function cek_informasi()
	{	
    return $this->db->count_all_results($this->table1);
  }

  public function get_semua_informasi()
  {
    $this->db->select('akun.nama, akun.role, informasi.tanggal, informasi.teks, informasi.berkas, informasi.id_informasi, informasi.id_pembuat');
    $this->db->from($this->table1);
    $this->db->join($this->table2, 'informasi.id_pembuat = akun.id_akun');
	  $query = $this->db->get();
  	return $query->result();
  }

  public function get_pengguna($where)
  {
    $this->db->select('id_akun, nama');
    $this->db->from($this->table2);
    $this->db->where('id_akun !=', $where);
    $query = $this->db->get();
    return $query->result();
  }

  public function set_informasi($data)
  {
    $this->db->insert($this->table1, $data);
    return $this->db->insert_id();
  }

  public function get_informasi_by_IdInformasi_1($where)
  {
    $query = $this->db->get_where($this->table1, $where);
    return $query->row();
  }

  public function update_informasi($data, $where)
  {
    $this->db->where($where);
    return $this->db->update($this->table1, $data);
  }

  public function get_berkas_by_IdInformasi($where)
  {
    $query = $this->db->get_where($this->table1, $where);
    return $query->row();
  }

  public function delete_informasi($where)
  {
      $this->db->where($where);
        return $this->db->delete($this->table1);
  }

  public function get_informasi_by_IdInformasi_2($where)
  {
    $this->db->select('akun.nama, akun.role, informasi.tanggal, informasi.teks, informasi.berkas, informasi.id_informasi, informasi.id_pembuat');
    $this->db->from($this->table1);
    $this->db->join($this->table2, 'informasi.id_pembuat = akun.id_akun');
    $this->db->where($where);
    $query = $this->db->get();
    return $query->result();
  }
}