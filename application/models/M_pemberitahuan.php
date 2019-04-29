<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* @author Muhammad syazili
* @copyright Teknik Informatika, Fasilkom Unsri 2018
*/

class m_pemberitahuan extends CI_Model{
	private $table1 = 'pemberitahuan';
	private $table2 = 'akun';

	public function cek_pemberitahuan()
	{	
	    return $this->db->count_all_results($this->table1);
	}

	public function set_pemberitahuan($data)
	{	
	    $this->db->insert($this->table1, $data);
    	return $this->db->insert_id();
	}

	public function delete_pemberitahuan($where)
	{
	    $this->db->where($where);
      	return $this->db->delete($this->table1);
	}

	public function get_pemberitahuan_by_IdDitanda($where)
	{
		$this->db->select('akun.nama, pemberitahuan.*');
	    $this->db->from($this->table1);
	    $this->db->join($this->table2, 'pemberitahuan.id_penanda = akun.id_akun');
	    $this->db->where($where);
		$query = $this->db->get();
	  	return $query->result();
	}
}