<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* @author Muhammad syazili
* @copyright Teknik Informatika, Fasilkom Unsri 2018
*/
class Informasi extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_informasi'); //memanggil model m_informasi
		$this->load->model('m_komentar'); //memanggil model m_komentar
		$this->load->model('m_pemberitahuan'); //memanggil model m_pemberitahuan
	}

	public function index()
	{
		//cek apakah session id_akun sudah di set
		if ($this->session->userdata('id_akun')){
			$this->tampil_informasi();
		}
		else{
			redirect(base_url('akses'));
			exit;
		}
	}

	private function upload_file($file, $path, $types, $max_size, $redirect_error)
	{
		$config['upload_path']          = $path;
		$config['encrypt_name']         = TRUE;
		$config['allowed_types']        = $types;
		$config['max_size']             = $max_size;
		$config['remove_spaces']        = TRUE;
		$config['file_ext_tolower']		= TRUE;
 
		$this->load->library('upload', $config);

		if ($this->upload->do_upload($file)) {
			return $this->upload->data("file_name");
		}
		else{
			$error = $this->upload->display_errors();
			$this->session->set_flashdata('m', '<div class="alert alert-danger text-center text-capitalize">'.$error.'</div>');
			redirect(base_url($redirect_error));
			exit;
		}
	}

	private function download_file($file, $path)
	{
		force_download($path.$file,NULL);
	}

	private function delete_file($path, $file)
	{
		return unlink($path.$file);
	}

	public function tampil_informasi()
	{
		if ($this->m_informasi->cek_informasi() === 0) {
			$this->session->set_flashdata('m', '<div class="alert alert-danger text-center text-capitalize">belum ada informasi!</div>');

			$data = array(
			'title'					=> $this->uri->segment(1),
			'navbar'				=> 'navbar_paskaakses',
			'content'				=> 'v_tampil_informasi',
			'data_informasi'		=> $this->m_informasi->get_semua_informasi(),
			'data_komentar'			=> $this->m_komentar->get_semua_komentar(),
			'data_pengguna'			=> $this->m_informasi->get_pengguna($this->session->userdata('id_akun')), //get semua pengguna kecuali diri sendiri
			'id_akun'				=> $this->session->userdata('id_akun'),
			'role'					=> $this->session->userdata('role'),
			'nama'					=> $this->session->userdata('nama')
			);
			$this->load->view('master/template', $data);
		}
		else{
			//cek apakah $_GET id memiliki isi
			if (empty(base64_decode($this->input->get('id')))) {
				$data = array(
				'title'					=> $this->uri->segment(1),
				'navbar'				=> 'navbar_paskaakses',
				'content'				=> 'v_tampil_informasi',
				'data_informasi'		=> $this->m_informasi->get_semua_informasi(),
				'data_komentar'			=> $this->m_komentar->get_semua_komentar(),
				'data_pengguna'			=> $this->m_informasi->get_pengguna($this->session->userdata('id_akun')), //get semua pengguna kecuali diri sendiri
				'id_akun'				=> $this->session->userdata('id_akun'),
				'role'					=> $this->session->userdata('role'),
				'nama'					=> $this->session->userdata('nama')
				);
				$this->load->view('master/template', $data);
			}
			else{
				$id['id_informasi'] = base64_decode($this->input->get('id'));

				$data = array(
				'title'					=> $this->uri->segment(1),
				'navbar'				=> 'navbar_paskaakses',
				'content'				=> 'v_tampil_informasi',
				'data_informasi'		=> $this->m_informasi->get_informasi_by_IdInformasi_2($id),
				'data_komentar'			=> $this->m_komentar->get_semua_komentar(),
				'data_pengguna'			=> $this->m_informasi->get_pengguna($this->session->userdata('id_akun')), //get semua pengguna kecuali diri sendiri
				'id_akun'				=> $this->session->userdata('id_akun'),
				'role'					=> $this->session->userdata('role'),
				'nama'					=> $this->session->userdata('nama')
				);
				$this->load->view('master/template', $data);
			}
		}
	}

	public function tambah_informasi()
	{
		if ($this->input->post('btn_tambah')) {
			
			//cek apakah filed berkas sudah memiliki isi
			if (empty($_FILES["berkas"]["tmp_name"])) {
				$berkas = '';
			}
			else{
				$berkas = $this->upload_file('berkas', './files_input/', 'jpg|jpeg|png|doc|docx|ppt|pptx|xls|xlsx|pdf|zip|rar', '5120', 'informasi/tambah_informasi');
			}

			$d_informasi['tanggal']		= $this->input->post('tanggal');
			$d_informasi['teks']		= html_escape($this->input->post('teks'));
			$d_informasi['berkas']		= $berkas;
			$d_informasi['id_pembuat']	= $this->session->userdata('id_akun');

			//set data informasi ke basis data
			$id_informasi = $this->m_informasi->set_informasi($d_informasi);

			for ($i=0; $i <= count($this->input->post('tandai'))-1 ; $i++) {
				$d_tandai['id_penanda'] 	= $this->session->userdata('id_akun');
				$d_tandai['id_ditanda'] 	= $this->input->post('tandai')[$i];
				$d_tandai['id_informasi'] 	= $id_informasi;
				
				//set data pemberitahuan ke basis data
				$this->m_pemberitahuan->set_pemberitahuan($d_tandai);	
			}

			$this->session->set_flashdata('m', '<div class="alert alert-success text-center text-capitalize">tambah informasi berhasil</div>');
			redirect(base_url('informasi'));
			exit;
		}
		else{
			$data = array(
			'title'			=> str_replace('_', ' ', $this->uri->segment(2)),
			'navbar'		=> 'navbar_paskaakses',
			'content'		=> 'v_tambah_informasi',
			'data_pengguna'	=> $this->m_informasi->get_pengguna($this->session->userdata('id_akun')) //get semua pengguna kecuali diri sendiri
			);
			$this->load->view('master/template', $data);
		}
	}

	public function ubah_informasi()
	{
		if ($this->input->post('btn_ubah')) {
			
			//cek apakah filed berkas sudah memiliki isi
			if (empty($_FILES["berkas"]["tmp_name"])) {
				$berkas = $this->input->post('berkas_lama');
			}
			else{
				//hapus berkas lama
				$hapus_berkas = $this->delete_file('./files_input/', $this->input->post('berkas_lama'));
				if ($hapus_berkas) {
					//unggah berkas baru
					$berkas = $this->upload_file('berkas', './files_input/', 'jpg|jpeg|png|doc|docx|ppt|pptx|xls|xlsx|pdf|zip|rar', '5120', 'informasi/ubah_informasi');
				}
			}

			$d_informasi['tanggal']		= $this->input->post('tanggal');
			$d_informasi['teks']		= html_escape($this->input->post('teks'));
			$d_informasi['berkas']		= $berkas;

			$id_informasi['id_informasi'] = $this->input->post('id_informasi');

			//update data informasi ke basis data
			$this->m_informasi->update_informasi($d_informasi, $id_informasi);

			$id['id_penanda'] = $this->session->userdata('id_akun');
			$id['id_informasi'] = $this->input->post('id_informasi');

			//delete data pemberitahuan lama
			$this->m_pemberitahuan->delete_pemberitahuan($id);

			for ($i=0; $i <= count($this->input->post('tandai'))-1 ; $i++) {
				$d_tandai['id_penanda'] 	= $this->session->userdata('id_akun');
				$d_tandai['id_ditanda'] 	= $this->input->post('tandai')[$i];
				$d_tandai['id_informasi'] 	= $this->input->post('id_informasi');
				
				//set data pemberitahuan baru ke basis data
				$this->m_pemberitahuan->set_pemberitahuan($d_tandai);
			}

			$this->session->set_flashdata('m', '<div class="alert alert-success text-center text-capitalize">ubah informasi berhasil</div>');
			redirect(base_url('informasi'));
			exit;
		}
		else{
			$id['id_informasi'] = base64_decode($this->input->get('id'));

			$data = array(
			'title'				=> str_replace('_', ' ', $this->uri->segment(2)),
			'navbar'			=> 'navbar_paskaakses',
			'content'			=> 'v_ubah_informasi',
			'data_informasi'	=> $this->m_informasi->get_informasi_by_IdInformasi_1($id),
			'data_pengguna'		=> $this->m_informasi->get_pengguna($this->session->userdata('id_akun')) //get semua pengguna kecuali diri sendiri
			);
			$this->load->view('master/template', $data);
		}
	}

	public function hapus_informasi()
	{
		$id['id_informasi'] = base64_decode($this->input->get('id'));

		$berkas = $this->m_informasi->get_berkas_by_IdInformasi($id)->berkas;
		if (empty($berkas)) {
			//hapus informasi
			$this->m_informasi->delete_informasi($id);
		}
		else{
			//hapus berkas
			$this->delete_file('./files_input/', $berkas);

			//hapus informasi
			$this->m_informasi->delete_informasi($id);
		}
		
		$this->session->set_flashdata('m', '<div class="alert alert-success text-center text-capitalize">hapus informasi berhasil</div>');
		redirect(base_url("informasi"));
		exit;
	}

	public function undah_berkas()
	{
		$file = base64_decode($this->input->get('id'));
		$this->download_file($file, './files_input/');
	}
}