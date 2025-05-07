<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_obat extends CI_Controller {

	public $user;

	function __construct(){
		parent::__construct();
		$this->load->model('Puskesmas','puskes');
		is_logged_in();
		if (is_level() == 2 || is_level() == 4 || is_level() == 5) {
			redirect('inc/notpound');
		}
		$this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
	}
	function index()
	{	
		$data['title'] = 'Kategori Obat';
		$data['user'] = $this->user;
		$data['list_kategori'] = $this->puskes->list_kategori_obat();
		$this->load->view('inc/header',$data);
		$this->load->view('kategori_obat',$data);
		$this->load->view('inc/footer');
	}

	function add()
	{
		
		// form rules
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		if ($this->form_validation->run() == false) {
			
			$data['list_kategori'] = $this->puskes->list_kategori_obat();
			$data['title'] = 'Kategori Obat';
			$data['user'] = $this->user;
			$this->load->view('inc/header',$data);
			$this->load->view('kategori_obat',$data);
			$this->load->view('inc/footer');

		} else {

			$data = [
				'kategori_obat' => $this->input->post('nama_kategori')
			];

			$this->db->insert('kategori_obat', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">Kategori obat berhasil ditambahkan</div>'
			);
			redirect('kategori_obat');
		}
	}
	function delete($id)
	{
		$this->db->delete('kategori_obat', ['id_kategori_obat' => $id]);
		$this->db->delete('obat', ['id_kategori_obat' => $id]);
		$this->session->set_flashdata('message', 
			'<div class="alert alert-success" role="alert">Kategori obat beserta isinya berhasil dihapus</div>'
		);
		redirect('kategori_obat');
	}
	function editProses(){
		$this->form_validation->set_rules('kategori_obat', 'Kategori Obat', 'required');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Kategori Obat';
			$data['user'] = $this->user;
			$data['list_kategori'] = $this->puskes->list_kategori_obat();
			$this->load->view('inc/header',$data);
			$this->load->view('kategori_obat',$data);
			$this->load->view('inc/footer');

		} else {
			$id = $this->input->post('id_kategori_obat', true);
			$data = [
				'kategori_obat' => $this->input->post('kategori_obat', true)
			];

			$this->db->where('id_kategori_obat', $id);
			$this->db->update('kategori_obat', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">Kategori Obat berhasil diubah</div>'
			);
			redirect('kategori_obat');
		}
	}
}
