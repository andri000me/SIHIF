<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* @author Muhammad syazili
* @copyright Teknik Informatika, Fasilkom Unsri 2018
*/

class m_akses extends CI_Model{
	private $table = 'akun';

	public function cek_email($email)
	{	
    $this->db->where($email);
    return $this->db->count_all_results($this->table);
  }

  public function cek_password($password)
	{	
    $this->db->where($password);
    return $this->db->count_all_results($this->table);
  }

  //mengambil data akun berdasarkan email
  public function get_DataAkun($email)
	{	
    $query = $this->db->get_where($this->table, $email);
    return $query->row();
  }
}