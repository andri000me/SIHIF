<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* @author Muhammad syazili
* @copyright Teknik Informatika, Fasilkom Unsri 2018
*/
class Akses extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_akses'); //memanggil model m_akses
		
	}

	public function index()
	{
		//cek apakah session id_akun sudah di set
		if ($this->session->userdata('id_akun')){

			redirect(base_url('informasi'));
			exit;
		}
		else{
			$this->login();
		}
	}

	private function call_view_login()
	{
		$data = array(
		'title'		=> $this->uri->segment(1),
		'navbar'	=> 'navbar_praakses',
		'content'	=> 'v_login'
		);
		$this->load->view('master/template', $data);
	}

	public function login()
	{

		//cek apakah button login sudah diklik
		if ($this->input->post('btn_login')) {

			$email['email'] = $this->input->post('email');

			//cek apakah email benar
			if ($this->m_akses->cek_email($email) !== 0) {

				$password['password'] = md5($this->input->post('password'));

				//cek apakah password benar
				if ($this->m_akses->cek_password($password) !== 0) {
					
					$s['id_akun'] = $this->m_akses->get_DataAkun($email)->id_akun;
					$s['role'] = $this->m_akses->get_DataAkun($email)->role;
					$s['nama'] = $this->m_akses->get_DataAkun($email)->nama;

					//set session
					$this->session->set_userdata($s);

					redirect(base_url('informasi'));
					exit;
				}
				else{
					$this->session->set_flashdata('m', '<div class="alert alert-danger text-center text-capitalize">password salah!</div>');
					$this->call_view_login();
				}
			}
			else{
				$this->session->set_flashdata('m', '<div class="alert alert-danger text-center text-capitalize">email salah!</div>');
				$this->call_view_login();
			}
		}
		else{
			$this->call_view_login();
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('akses'));
		exit;
	}
}