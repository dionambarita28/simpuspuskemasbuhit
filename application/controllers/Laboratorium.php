<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratorium extends CI_Controller {

	public $user;

	function __construct(){
		parent::__construct();
		$this->load->model('Puskesmas','puskes');
		is_logged_in();
		if (is_level() == 2 || is_level() == 4 || is_level() == 3) {
			redirect('inc/notpound');
		}
		$this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
	}

	function index()
	{	
		$data['title'] = 'Laboratorium';
		$data['user'] = $this->user;
		$data['rekam_medis'] = $this->puskes->rekam_medis_list();
		$data['list_labor'] = $this->puskes->list_labor();
		$data['list_pasien'] = $this->puskes->list_pasien();
		$this->load->view('inc/header',$data);
		$this->load->view('labor',$data);
		$this->load->view('inc/footer');
	}
	function periksaProses(){
		$this->form_validation->set_rules('keterangan_labor', 'Keterangan Labor', 'required');
		$this->form_validation->set_rules('no_labor', 'Nomor Labor', 'required|numeric');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		$this->form_validation->set_message('numeric', '%s harus angka!!');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Laboratorium';
			$data['user'] = $this->user;
			$data['rekam_medis'] = $this->puskes->rekam_medis_list();
			$data['list_labor'] = $this->puskes->list_labor();
			$data['list_pasien'] = $this->puskes->list_pasien();
			$this->load->view('inc/header',$data);
			$this->load->view('labor',$data);
			$this->load->view('inc/footer');

		} else {
			$id = $this->input->post('id', true);
			$data = [
				'keterangan_labor' => $this->input->post('keterangan_labor', true),
				'no_labor' => $this->input->post('no_labor', true),
				'status' => 1
			];

			$this->db->where('id', $id);
			$this->db->update('laboratorium', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">Pemeriksaan Laboratorium berhasil</div>'
			);
			redirect('laboratorium');
		}
	}
}
