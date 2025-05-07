<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {

	public $user;

	function __construct(){
		parent::__construct();
		$this->load->model('Puskesmas','puskes');
		is_logged_in();
		if (is_level() != 1) {
			redirect('inc/notpound');
		}
		$this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
	}
	function index(){
		$data['title'] = 'Petugas';
		$data['user'] = $this->user;
		$data['list_petugas'] = $this->puskes->list_petugas();
		$this->load->view('inc/header',$data);
		$this->load->view('list_petugas',$data);
		$this->load->view('inc/footer');
	}
	function dokter(){
		$data['title'] = 'Dokter';
		$data['user'] = $this->user;
		$data['list_dokter'] = $this->puskes->list_dokter();
		$data['list_klinik'] = $this->puskes->list_poli();
		$data['username']= $this->db->get_where('user', ['level' => 4])->result_array();
		$this->load->view('inc/header',$data);
		$this->load->view('list_dokter',$data);
		$this->load->view('inc/footer');
	}
	function tambah()
	{	
		$data['title'] = 'Petugas';
		$data['user'] = $this->user;
		$this->load->view('inc/header',$data);
		$this->load->view('tambah_petugas',$data);
		$this->load->view('inc/footer');
	}
	function tambah_dokter()
	{	
		$data['title'] = 'Dokter';
		$data['user'] = $this->user;
		$data['list_dokter'] = $this->puskes->list_dokter();
		$data['list_klinik'] = $this->puskes->list_poli();
		$data['username']= $this->db->get_where('user', ['level' => 4])->result_array();
		$this->load->view('inc/header',$data);
		$this->load->view('tambah_dokter',$data);
		$this->load->view('inc/footer');
	}
	function addProses()
	{
		if ($this->input->post('password') != $this->input->post('r_password')) {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-danger" role="alert"><strong>Error</strong> Konfirmasi Password Tidak Sama!!</div>'
			);
			redirect('petugas/tambah');
		}
		$username = $this->db->get_where('user', ['username' => $this->input->post('username',true)])->num_rows();
		if ($username > 0) {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-danger" role="alert"><strong>Username</strong> Sudah Ada!!</div>'
			);
			redirect('petugas/tambah');
		}
		// form rules
		$this->form_validation->set_rules('nama', 'Nama Obat', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('telpon', 'Password', 'numeric');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		$this->form_validation->set_message('numeric', '%s harus angka!!');
		if ($this->form_validation->run() == false) {
			
			$data['title'] = 'Petugas';
			$data['user'] = $this->user;
			$this->load->view('inc/header',$data);
			$this->load->view('tambah_petugas',$data);
			$this->load->view('inc/footer');

		} else {

			$data = [
				'nama' => $this->input->post('nama', true),
				'username' => $this->input->post('username', true),
				'password' => password_hash($this->input->post('password'),true),
				'telpon' => $this->input->post('telpon'),
				'level' => $this->input->post('level'),
			];

			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert"><strong>Petugas</strong> berhasil ditambahkan!!</div>'
			);
			redirect('petugas');
		}
	}
	function addDokterProses()
	{
		
		$username = $this->db->get_where('dokter', ['username' => $this->input->post('username',true)])->row();
		if ($username > 0) {
			$this->session->set_flashdata('message', 
				'<div class="alert alert-danger" role="alert"><strong>Username</strong> Sudah Digunakan Dokter Lain!!</div>'
			);
			redirect('petugas/tambah_dokter');
		}
		// form rules
		$this->form_validation->set_rules('nama_dokter', 'Nama Dokter', 'required');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		if ($this->form_validation->run() == false) {
			
			$data['title'] = 'Dokter';
			$data['user'] = $this->user;
			$data['list_dokter'] = $this->puskes->list_dokter();
			$data['list_klinik'] = $this->puskes->list_poli();
			$data['username']= $this->db->get_where('user', ['level' => 4])->result_array();
			$this->load->view('inc/header',$data);
			$this->load->view('tambah_dokter',$data);
			$this->load->view('inc/footer');

		} else {

			$data = [
				'nama_dokter' => $this->input->post('nama_dokter', true),
				'poli_id' => $this->input->post('klinik', true),
				'username' => $this->input->post('username',true)
			];

			$this->db->insert('dokter', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert"><strong>Dokter</strong> berhasil ditambahkan!!</div>'
			);
			redirect('petugas/dokter');
		}
	}
	function editProses(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('telpon', 'Username', 'numeric');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		$this->form_validation->set_message('numeric', '%s harus angka!!');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Petugas';
			$data['user'] = $this->user;
			$this->load->view('inc/header',$data);
			$this->load->view('tambah_petugas',$data);
			$this->load->view('inc/footer');

		} else {
			$id = $this->input->post('id', true);
			if ($this->input->post('password')) {
				if ($this->input->post('password') != $this->input->post('r_password')) {
					$this->session->set_flashdata('message', 
						'<div class="alert alert-danger" role="alert"><strong>Error</strong> Konfirmasi Password Tidak Sama!!</div>'
					);
					redirect('petugas');
				}else{
					$data = [
						'nama' => $this->input->post('nama', true),
						'username' => $this->input->post('username', true),
						'password' => password_hash($this->input->post('password'),true),
						'telpon' => $this->input->post('telpon')
					];
				}
			}else{
				$data = [
					'nama' => $this->input->post('nama', true),
					'username' => $this->input->post('username', true),
					'telpon' => $this->input->post('telpon')
				];
			}

			$this->db->where('id', $id);
			$this->db->update('user', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">Petugas berhasil diubah</div>'
			);
			redirect('petugas');
		}
	}
	function editDokterProses(){
		$this->form_validation->set_rules('nama_dokter', 'Nama Dokter', 'required');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Dokter';
			$data['user'] = $this->user;
			$data['list_dokter'] = $this->puskes->list_dokter();
			$data['list_klinik'] = $this->puskes->list_poli();
			$data['username']= $this->db->get_where('user', ['level' => 4])->result_array();
			$this->load->view('inc/header',$data);
			$this->load->view('tambah_dokter',$data);
			$this->load->view('inc/footer');

		} else {
			$id = $this->input->post('id', true);
			
			$data = [
				'nama_dokter' => $this->input->post('nama_dokter', true),
				'poli_id' => $this->input->post('klinik',true)
			];
			$this->db->where('dokter_id', $id);
			$this->db->update('dokter', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">Dokter berhasil diubah</div>'
			);
			redirect('petugas/dokter');
		}
	}
	function delete_petugas($id){
		$this->db->delete('user', ['id' => $id]);
		$this->session->set_flashdata('message', 
			'<div class="alert alert-success" role="alert">Petugas berhasil dihapus</div>'
		);
		redirect('petugas');
	}
	function delete_dokter($id){
		$this->db->delete('dokter', ['dokter_id' => $id]);
		$this->session->set_flashdata('message', 
			'<div class="alert alert-success" role="alert">Dokter berhasil dihapus</div>'
		);
		redirect('petugas/dokter');
	}
}