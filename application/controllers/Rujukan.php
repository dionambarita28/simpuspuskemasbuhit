<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rujukan extends CI_Controller {

	public $user;

	function __construct(){
		parent::__construct();
		$this->load->model('Puskesmas','puskes');
		is_logged_in();
		if (is_level() != 4) {
			redirect('inc/notpound');
		}
		$this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
	}

	function index()
	{	
		$data['title'] = 'Rujukan';
		$data['user'] = $this->user;
		$data['rekam_list'] = $this->puskes->rekam_medis_list();
		$data['klinik_list'] = $this->puskes->list_poli();
		$data['list_dokter'] = $this->puskes->list_dokter();
		$dokter = $this->db->get_where('dokter', ['username' => $this->session->userdata('username')])->row_array();
		$data['rujuk_internal'] = $this->db->get_where('rujuk_internal', ['klinik_rujuk' => $dokter['klinik']])->result_array();
		$data['rujuk_external'] = $this->db->get_where('rujuk_external', ['dokter_perujuk' => $dokter['id']])->result_array();
		$data['pasien'] = $this->puskes->list_pasien();
		$data['rujuk_internalr'] = $this->db->get_where('rujuk_internal', ['dokter_rujuk' => $dokter['id']])->result_array();
		$this->load->view('inc/header',$data);
		$this->load->view('list_rujukan',$data);
		$this->load->view('inc/footer');
	}
	function riwayat_resep()
	{	
		$data['title'] = 'Resep Obat';
		$data['user'] = $this->user;
		$data['resep_list'] = $this->db->get('resep_obat')->result_array();
		$this->load->view('inc/header',$data);
		$this->load->view('riwayat_resep',$data);
		$this->load->view('inc/footer');
	}
	function periksa($id_rujuk = null)
	{	
		if (!$id_rujuk) {
			redirect('rujukan');
		}
		$data['title'] = 'Rujukan';
		$data['user'] = $this->user;
		$no_rm = $this->db->get_where('rujuk_internal', ['id_rujuk' => $id_rujuk])->row()->no_rm;
		$data['rekam_medis'] = $this->db->get_where('rekam_medis', ['no_rm' => $no_rm])->row();
		$data['rujuk_internal'] = $this->db->get_where('rujuk_internal', ['id_rujuk' => $id_rujuk])->row();
		$data['pemeriksaan'] = $this->db->get_where('pemeriksaan', ['no_rm' => $no_rm])->row();
		if (!$data['rujuk_internal'] || $data['rujuk_internal']->status == 1) {
			redirect('rujukan');
		}
		$this->load->view('inc/header',$data);
		$this->load->view('periksa_rujukan',$data);
		$this->load->view('inc/footer');
	}
	function rujuk_internal($no_rm = null)
	{	
		if (!$no_rm) {
			redirect('pemeriksaan');
		}
		$data['title'] = 'Rujukan';
		$data['user'] = $this->user;
		$data['rekam_medis'] = $this->db->get_where('rekam_medis', ['no_rm' => $no_rm])->row();
		$data['pemeriksaan'] = $this->db->get_where('pemeriksaan', ['no_rm' => $no_rm])->row();
		$data['dokter'] = $this->db->get_where('dokter', ['klinik' => 1])->result();
		$data['klinik_list'] = $this->puskes->list_poli();
		if (!$data['rekam_medis'] || $data['rekam_medis']->status == 0) {
			redirect('pemeriksaan');
		}
		$this->load->view('inc/header',$data);
		$this->load->view('rujuk_internal',$data);
		$this->load->view('inc/footer');
	}

	function addDiagnosa()
	{
		
		// form rules
		$this->form_validation->set_rules('diagnosa_rujuk', 'Diagnosa Penyakit Rujukan', 'required');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		if ($this->form_validation->run() == false) {
			$id_rujuk = $this->input->post('id_rujuk', true);
			if (!$id_rujuk) {
			redirect('rujukan');
			}
			$data['title'] = 'Rujukan';
			$data['user'] = $this->user;
			$no_rm = $this->db->get_where('rujuk_internal', ['id_rujuk' => $id_rujuk])->row()->no_rm;
			$data['rekam_medis'] = $this->db->get_where('rekam_medis', ['no_rm' => $no_rm])->row();
			$data['rujuk_internal'] = $this->db->get_where('rujuk_internal', ['id_rujuk' => $id_rujuk])->row();
			$data['pemeriksaan'] = $this->db->get_where('pemeriksaan', ['no_rm' => $no_rm])->row();
			if (!$data['rujuk_internal'] || $data['rujuk_internal']->status == 1) {
				redirect('rujukan');
			}
			$this->load->view('inc/header',$data);
			$this->load->view('periksa_rujukan',$data);
			$this->load->view('inc/footer');

		} else {
			$id_rujuk = $this->input->post('id_rujuk', true);
			$data = [
				'diagnosa_rujuk' => $this->input->post('diagnosa_rujuk', true),
				'saran_tindakan' => $this->input->post('saran_tindakan'),
				'status' => 1
			];

			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">
				  <strong>Berhasil Diperiksa!!!</strong>
				</div>'
			);
			$this->db->where('id_rujuk', $id_rujuk);
			$this->db->update('rujuk_internal',$data);
			redirect('rujukan');
		}
	}
	function editRujuk(){
		$this->form_validation->set_rules('diagnosa_rujuk', 'Diagnosa Rujuk', 'required');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Rujukan';
			$data['user'] = $this->user;
			$data['rekam_list'] = $this->puskes->rekam_medis_list();
			$data['klinik_list'] = $this->puskes->list_poli();
			$data['list_dokter'] = $this->puskes->list_dokter();
			$dokter = $this->db->get_where('dokter', ['username' => $this->session->userdata('username')])->row_array();
			$data['rujuk_internal'] = $this->db->get_where('rujuk_internal', ['klinik_rujuk' => $dokter['klinik']])->result_array();
			$data['rujuk_external'] = $this->db->get_where('rujuk_external', ['dokter_perujuk' => $dokter['id']])->result_array();
			$data['pasien'] = $this->puskes->list_pasien();
			$data['rujuk_internalr'] = $this->db->get_where('rujuk_internal', ['dokter_rujuk' => $dokter['id']])->result_array();
			$this->load->view('inc/header',$data);
			$this->load->view('list_rujukan',$data);
			$this->load->view('inc/footer');

		} else {
			$id_rujuk = $this->input->post('id_rujuk', true);
			$data = [
				'diagnosa_rujuk' => $this->input->post('diagnosa_rujuk', true),
				'saran_tindakan' => $this->input->post('saran_tindakan'),
			];

			$this->db->where('id_rujuk', $id_rujuk);
			$this->db->update('rujuk_internal', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">Diagnosa Rujukan berhasil diubah</div>'
			);
			redirect('rujukan');
		}
	}

	function hapus_internal($id = null){
		if (!$id) {
			redirect('rujukan');
		}
		$this->db->delete('rujuk_internal', ['id' => $id]);
		$this->session->set_flashdata('message2', 
			'<div class="alert alert-success" role="alert">Rujuk Internal berhasil dihapus</div>'
		);
		redirect('rujukan');
	}
	function hapus_external($id = null){
		if (!$id) {
			redirect('rujukan');
		}
		$this->db->delete('rujuk_external', ['id' => $id]);
		$this->session->set_flashdata('message3', 
			'<div class="alert alert-success" role="alert">Rujuk Internal berhasil dihapus</div>'
		);
		redirect('rujukan');
	}
}