<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller {

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
		$data['title'] = 'Obat';
		$data['user'] = $this->user;
		$data['obat_list'] = $this->puskes->list_obat();
		$data['list_kategori'] = $this->puskes->list_kategori_obat();
		$data['list_satuan_obat'] = $this->puskes->list_satuan_obat();
		$this->load->view('inc/header',$data);
		$this->load->view('obat',$data);
		$this->load->view('inc/footer');
	}
	function pengambilan_resep()
	{	
		$data['title'] = 'Obat Pasien';
		$data['user'] = $this->user;
		$data['resep_list'] = $this->db->get('resep_obat')->result_array();
		$this->load->view('inc/header',$data);
		$this->load->view('pengambilan_resep',$data);
		$this->load->view('inc/footer');
	}
	function addObat()
	{	
		$data['title'] = 'Obat';
		$data['user'] = $this->user;
		$data['list_kategori'] = $this->puskes->list_kategori_obat();
		$data['list_satuan_obat'] = $this->puskes->list_satuan_obat();
		$this->load->view('inc/header',$data);
		$this->load->view('tambah_obat',$data);
		$this->load->view('inc/footer');
	}

	function addProses()
	{
		
		// form rules
		$this->form_validation->set_rules('nama', 'Nama Obat', 'required');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		if ($this->form_validation->run() == false) {
			
			$data['title'] = 'Obat';
			$data['user'] = $this->user;
			$data['list_kategori'] = $this->puskes->list_kategori_obat();
			$data['list_satuan_obat'] = $this->puskes->list_satuan_obat();
			$this->load->view('inc/header',$data);
			$this->load->view('tambah_obat',$data);
			$this->load->view('inc/footer');

		} else {

			$data = [
				'nama_obat' => $this->input->post('nama', true),
				'kategori' => $this->input->post('kategori-obat', true),
				'satuan' => $this->input->post('satuan-obat', true),
				'keterangan' => $this->input->post('keterangan')
			];

			$this->db->insert('obat', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Jenis Obat</strong> berhasil ditambahkan!!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>'
			);
			redirect('obat');
		}
	}

	function delete($id)
	{
		$this->db->delete('obat', ['id' => $id]);
		$this->session->set_flashdata('message', 
			'<div class="alert alert-success" role="alert">Obat berhasil dihapus</div>'
		);
		redirect('obat');
	}
	function setuju_resep($id){
		$this->db->set('status', 1, FALSE);
		$this->db->where('id', $id);
		$this->db->update('resep_obat');
		$this->session->set_flashdata('message', 
			'<div class="alert alert-success" role="alert">1 Resep Disetujui</div>'
		);
		redirect('obat/pengambilan_resep');
	}
	function tolak_resep($id){
		$id_obat = $this->db->get_where('resep_obat', ['id' => $id])->row()->id_obat;
		$jumlah = $this->db->get_where('resep_obat', ['id' => $id])->row()->jumlah;
		$stok = $this->db->get_where('obat', ['id' => $id_obat])->row()->stok;
		$this->db->set('status',3, FALSE);
		$this->db->where('id', $id);
		$this->db->update('resep_obat');

		$this->db->set('stok',$stok+$jumlah, FALSE);
		$this->db->where('id', $id_obat);
		$this->db->update('obat');
		
		$this->session->set_flashdata('message', 
			'<div class="alert alert-success" role="alert">1 Resep Ditolak</div>'
		);
		redirect('obat/pengambilan_resep');
	}
	function update_obat($id = null){
		if (!$id){
			redirect('obat');
		}
		$data['title'] = 'Obat';
		$data['user'] = $this->user;
		$data['list_kategori'] = $this->puskes->list_kategori_obat();
		$data['list_satuan_obat'] = $this->puskes->list_satuan_obat();
		$data['obat'] = $this->db->get_where('obat', ['id' => $id])->row_array();
		$this->load->view('inc/header',$data);
		$this->load->view('edit/edit_obat',$data);
		$this->load->view('inc/footer');
	}
	function editProses(){
		$this->form_validation->set_rules('nama', 'Nama Obat', 'required');
		$this->form_validation->set_rules('stok', 'Stok Obat', 'integer|numeric');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		$this->form_validation->set_message('numeric', '%s harus angka!!');
		if ($this->form_validation->run() == false) {
			$id = $this->input->post('id', true);
			$data['title'] = 'Obat';
			$data['user'] = $this->user;
			$data['list_kategori'] = $this->puskes->list_kategori_obat();
			$data['list_satuan_obat'] = $this->puskes->list_satuan_obat();
			$data['obat'] = $this->db->get_where('obat', ['id' => $id])->row_array();
			$this->load->view('inc/header',$data);
			$this->load->view('edit/edit_obat',$data);
			$this->load->view('inc/footer');

		} else {
			$id = $this->input->post('id', true);
			$stok = $this->db->get_where('obat', ['id' => $id])->row()->stok;
			if ($this->input->post('stok', true) > $stok) {
				$this->session->set_flashdata('message', 
					'<div class="alert alert-danger" role="alert">Silahkan Menambah Stok Di Pegadaan Obat!!</div>'
				);
				redirect('obat/update_obat/'.$id);
			}
			$data = [
				'nama_obat' => $this->input->post('nama', true),
				'kategori' => $this->input->post('kategori-obat', true),
				'satuan' => $this->input->post('satuan-obat', true),
				'keterangan' => $this->input->post('keterangan'),
				'stok' => $this->input->post('stok',true)
			];

			$this->db->where('id', $id);
			$this->db->update('obat', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">Data Obat berhasil diubah</div>'
			);
			redirect('obat');
		}
	}
}
