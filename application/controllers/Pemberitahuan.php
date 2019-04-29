<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* @author Muhammad syazili
* @copyright Teknik Informatika, Fasilkom Unsri 2018
*/
class Pemberitahuan extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_pemberitahuan'); //memanggil model m_pemberitahuan
	}

	public function index()
	{
		//cek apakah session id_akun sudah di set
		if ($this->session->userdata('id_akun')){
			$this->tampil_pemberitahuan();
		}
		else{
			redirect(base_url('akses'));
			exit;
		}
	}

	public function tampil_pemberitahuan()
	{
		if ($this->m_pemberitahuan->cek_pemberitahuan() === 0) {
			$this->session->set_flashdata('m', '<div class="alert alert-danger text-center text-capitalize">belum ada pemberihatuan!</div>');

			$id['id_ditanda'] = $this->session->userdata('id_akun');

			$data = array(
			'title'					=> $this->uri->segment(1),
			'navbar'				=> 'navbar_paskaakses',
			'content'				=> 'v_tampil_pemberitahuan',
			'data_pemberitahuan'	=> $this->m_pemberitahuan->get_pemberitahuan_by_IdDitanda($id),
			);
			$this->load->view('master/template', $data);
		}
		else{
			$id['id_ditanda'] = $this->session->userdata('id_akun');

			$data = array(
			'title'					=> $this->uri->segment(1),
			'navbar'				=> 'navbar_paskaakses',
			'content'				=> 'v_tampil_pemberitahuan',
			'data_pemberitahuan'	=> $this->m_pemberitahuan->get_pemberitahuan_by_IdDitanda($id),
			);
			$this->load->view('master/template', $data);
		}
	}
}