<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengadaan_obat extends CI_Controller {

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
		$data['title'] = 'Pengadaan Obat';
		$data['user'] = $this->user;
		$data['list_kategori'] = $this->puskes->list_kategori_obat();
		$data['obat_list'] = $this->puskes->list_obat();
		$data['list_satuan_obat'] = $this->puskes->list_satuan_obat();
		$this->load->view('inc/header',$data);
		$this->load->view('pengadaan_obat',$data);
		$this->load->view('inc/footer');
	}

	function add()
	{
		
		// form rules
		$this->form_validation->set_rules('supplier', 'Supplier', 'required');
		$this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required');
		$this->form_validation->set_rules('qty_obat', 'Jumlah', 'required|numeric|integer');
		$this->form_validation->set_rules('harga', 'Jumlah', 'numeric|integer');

		$this->form_validation->set_message('required', '%s harus diisi!!');
		$this->form_validation->set_message('numeric', '%s harus angka!!');
		$this->form_validation->set_message('integer', '%s harus angka saja!!');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Pengadaan Obat';
			$data['user'] = $this->user;
			$data['list_kategori'] = $this->puskes->list_kategori_obat();
			$data['obat_list'] = $this->puskes->list_obat();
			$data['list_satuan_obat'] = $this->puskes->list_satuan_obat();
			$this->load->view('inc/header',$data);
			$this->load->view('pengadaan_obat',$data);
			$this->load->view('inc/footer');

		} else {

			$data = [
				'supplier' => $this->input->post('supplier', true),
				'nama_obat' => $this->input->post('supplier', true),
				'stok' => $this->input->post('qty_obat', true),
				'harga' => $this->input->post('harga'),
				'expired' => $this->input->post('expired')
			];

			$this->db->insert('riwayat_pengadaan', $data);

	  		$stok_before = $this->puskes->getStok($this->input->post('obatid',true));
			$data2 = [
				'supplier' => $this->input->post('supplier', true),
				'stok' => $this->input->post('qty_obat', true)+$stok_before,
				'harga' => $this->input->post('harga'),
				'expired' => $this->input->post('expired')
			];

			$this->db->where('id_obat', $this->input->post('obatid',true));
			$this->db->update('obat',$data2);

			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">Pengaadaan obat berhasil ditambahkan</div>'
			);
			redirect('pengadaan_obat');
		}
	}
	

	function delete($id)
	{
		$this->db->delete('kategori_obat', ['id' => $id]);
		$this->session->set_flashdata('message', 
			'<div class="alert alert-success" role="alert">Kategori obat beserta isinya berhasil dihapus</div>'
		);
		redirect('kategori_obat');
	}
}
