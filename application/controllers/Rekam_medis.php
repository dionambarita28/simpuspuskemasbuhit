<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekam_medis extends CI_Controller {

	public $user;

	function __construct(){
		parent::__construct();
		$this->load->model('Puskesmas','puskes');
		is_logged_in();
		$this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
	}

	function index()
	{	
		$data['title'] = 'Rekam Medis';
		$data['user'] = $this->user;
		$data['rekam_list'] = $this->puskes->rekam_medis_list();
		$data['poli_list'] = $this->puskes->list_poli();
		$data['list_dokter'] = $this->puskes->list_dokter();
		$this->load->view('inc/header',$data);
		$this->load->view('rekam_medis_list',$data);
		$this->load->view('inc/footer');
	}
	function rekam($no_ktp_pasien = null)
	{	
		if (!$no_ktp_pasien) {
			redirect('pasien/list_registrasi');
		}
		$data['title'] = 'Rekam Medis';
		$data['user'] = $this->user;
		$data['list_klinik'] = $this->puskes->list_poli();
		$data['pasien'] = $this->db->get_where('pasien', ['no_ktp_pasien' => $no_ktp_pasien])->row();
		$data['dokter'] = $this->db->get_where('dokter', ['poli_id' => 1])->result();
		$data['pendaftaran'] = $this->db->get_where('pendaftaran', ['no_ktp_pasien' => $no_ktp_pasien])->row();
		if (!$data['pasien']) {
			redirect('pasien/list_registrasi');
		}
		$this->load->view('inc/header',$data);
		$this->load->view('rekam_medis',$data);
		$this->load->view('inc/footer');
	}

	function addProses()
	{
		$rekam_m = $this->db->get_where('rekam_medis', ['no_rm' => $this->input->post('no_rm', true)])->row();
	    if ($rekam_m) {
	    $this->session->set_flashdata('message', 
			'<div class="alert alert-danger" role="alert">
			  <strong>Nomor Rekam Medis Sudah Ada!!!</strong>
			</div>'
		);
		redirect('pendaftaran');
		}
		// form rules
		$this->form_validation->set_rules('tgl_rekam', 'Tanggal Rekam Medis', 'required');
		$this->form_validation->set_rules('dokter_tujuan', 'Dokter Tujuan', 'required');
		$this->form_validation->set_rules('no_rm', 'Nomor Rekam Medis', 'required|numeric');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		$this->form_validation->set_message('numeric', '%s harus angka!!');
		if ($this->form_validation->run() == false) {
			$no_ktp_pasien = $this->input->post('no_ktp_pasien', true);

			$data['title'] = 'Rekam Medis';
			$data['user'] = $this->user;
			$data['list_klinik'] = $this->puskes->list_poli();
			$data['pasien'] = $this->db->get_where('pasien', ['no_ktp_pasien' => $no_ktp_pasien])->row();
			$data['pendaftaran'] = $this->db->get_where('pendaftaran', ['no_ktp_pasien' => $no_ktp_pasien])->row();
			if (!$data['pasien']) {
				redirect('pasien/list_registrasi');
			}
			$this->load->view('inc/header',$data);
			$this->load->view('rekam_medis',$data);
			$this->load->view('inc/footer');

		} else {

			$data = [
				'no_rm' => $this->input->post('no_rm', true),
				'no_pendaftaran' => $this->input->post('no_pendaftaran', true),
				'no_ktp_pasien' => $this->input->post('no_ktp_pasien', true),
				'tgl_rekam' => $this->input->post('tgl_rekam', true),
				'nama_pasien' => $this->input->post('nama_pasien', true),
				'poli_id' => $this->input->post('klinik_tujuan', true),
				'dokter_id' => $this->input->post('dokter_tujuan')
			];

			$this->db->insert('rekam_medis', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert"><strong>Rekam Medis Baru</strong> berhasil ditambahkan!!</div>'
			);
			redirect('rekam_medis');
		}
	}

	function load_dokter(){
	if($this->input->post('klinik'))
	  {
	   echo $this->puskes->get_dokter_list($this->input->post('klinik'));
	  }
	}

	function delete_rm($id){
		$this->db->delete('rekam_medis', ['id' => $id]);
		$this->session->set_flashdata('message', 
			'<div class="alert alert-success" role="alert">Rekam Medis berhasil dihapus</div>'
		);
		redirect('rekam_medis');
	}

	function riwayat_rekam()
	{	
		$data['title'] = 'Riwayat Rekam';
		$data['user'] = $this->user;
		$data['pasien_list'] = $this->puskes->list_pasien();
		$this->load->view('inc/header',$data);
		$this->load->view('riwayat_rekam',$data);
		$this->load->view('inc/footer');
	}
	function searchObat(){
 
        $postData = $this->input->post();

	    // Get data
	    $data = $this->puskes->getObats($postData);

	    echo json_encode($data);
    }
}
