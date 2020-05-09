<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public $user;

	function __construct(){
		parent::__construct();
		$this->load->model('Puskesmas','puskes');
		is_logged_in();
		$this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
	}

	function index()
	{	
		$data['title'] = 'Dashboard';
		$data['user'] = $this->user;
		$this->load->view('inc/header',$data);
		$this->load->view('edit_akun',$data);
		$this->load->view('inc/footer');
	}
	function password()
	{	
		$data['title'] = 'Dashboard';
		$data['user'] = $this->user;
		$this->load->view('inc/header',$data);
		$this->load->view('edit_password',$data);
		$this->load->view('inc/footer');
	}
	function editProses(){
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('telpon', 'Username', 'numeric');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		$this->form_validation->set_message('numeric', '%s harus angka!!');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Dashboard';
			$data['user'] = $this->user;
			$this->load->view('inc/header',$data);
			$this->load->view('edit_akun',$data);
			$this->load->view('inc/footer');

		} else {
			$username = $this->input->post('username', true);
			$data = [
				'nama' => $this->input->post('nama', true),
				'telpon' => $this->input->post('telpon')
			];

			$this->db->where('username', $username);
			$this->db->update('user', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">Profil berhasil diubah</div>'
			);
			redirect('user');
		}
	}
	function editPassword(){
		$this->form_validation->set_rules('password_lama', 'Password Lama', 'required');
		$this->form_validation->set_rules('password', 'Password Baru', 'required');
		$this->form_validation->set_rules('r_password', 'Konfirmasi Password', 'required');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Dashboard';
			$data['user'] = $this->user;
			$this->load->view('inc/header',$data);
			$this->load->view('edit_password',$data);
			$this->load->view('inc/footer');

		} else {
			$username = $this->input->post('username', true);
			$password_lama = $this->input->post('password_lama', true);
			$password = $this->input->post('password', true);
			$r_password = $this->input->post('r_password', true);
			$user = $this->user;
			if (!password_verify($password_lama, $user['password'])) {
				$this->session->set_flashdata('message', 
					'<div class="alert alert-danger" role="alert">Password Lama Tidak Sama!!</div>'
				);
				redirect('user/password');
			}
			if ($password != $r_password) {
				$this->session->set_flashdata('message', 
					'<div class="alert alert-danger" role="alert">Konfirmasi Password Salah!!</div>'
				);
				redirect('user/password');
			}
			$data = [
				'password' => password_hash($password, PASSWORD_DEFAULT)
			];

			$this->db->where('username', $username);
			$this->db->update('user', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">Profil berhasil diubah</div>'
			);
			redirect('user/password');
		}
	}
}
