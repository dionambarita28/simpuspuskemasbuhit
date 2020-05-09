<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

	public $user;

	function __construct(){
		parent::__construct();
		$this->load->model('Puskesmas','puskes');
		is_logged_in();
		if (is_level() == 3 || is_level() == 4 || is_level() == 5) {
			redirect('inc/notpound');
		}
		$this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
	}

	function index()
	{	
		$data['title'] = 'Pasien';
		$data['user'] = $this->user;
		$data['pasien_list'] = $this->puskes->list_pasien();
		$this->load->view('inc/header',$data);
		$this->load->view('pasien',$data);
		$this->load->view('inc/footer');
	}
	function list_registrasi()
	{	
		$data['title'] = 'Pendaftaran';
		$data['user'] = $this->user;
		$data['list_registrasi'] = $this->puskes->list_registrasi();
		$data['list_registrasi2'] = $this->db->get_where('pendaftaran', ['tgl_berobat' => date('d-m-Y')])->result_array();
		$this->load->view('inc/header',$data);
		$this->load->view('list_registrasi',$data);
		$this->load->view('inc/footer');
	}
	function addPasien()
	{	
		$data['title'] = 'Pasien';
		$data['user'] = $this->user;
		$this->load->view('inc/header',$data);
		$this->load->view('tambah_pasien',$data);
		$this->load->view('inc/footer');
	}

	function addProses()
	{
		
		// form rules
		$this->form_validation->set_rules('nama', 'Nama Pasien', 'required');
		$this->form_validation->set_rules('no_pasien', 'No Rekam Medis', 'required|numeric');
		$this->form_validation->set_rules('no_ktp', 'No Ktp', 'required|numeric');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('tinggi', 'Tinggi', 'numeric');
		$this->form_validation->set_rules('berat', 'Berat', 'numeric');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		$this->form_validation->set_message('numeric', '%s harus angka!!');
		if ($this->form_validation->run() == false) {
			
			$data['title'] = 'Pasien';
			$data['user'] = $this->user;
			$data['list_kategori'] = $this->puskes->list_kategori_obat();
			$data['list_satuan_obat'] = $this->puskes->list_satuan_obat();
			$this->load->view('inc/header',$data);
			$this->load->view('tambah_pasien',$data);
			$this->load->view('inc/footer');

		} else {
		    $pasien = $this->db->get_where('pasien', ['no_pasien' => $this->input->post('no_pasien', true)])->row();

		    if ($pasien) {
		    $this->session->set_flashdata('message', 
				'<div class="alert alert-danger" role="alert">
				  <strong>Nomor Pasien Sudah Ada!!!</strong>
				</div>'
			);
			redirect('pasien');
		    }
			$data = [
				'no_pasien' => $this->input->post('no_pasien', true),
				'no_ktp' => $this->input->post('no_ktp', true),
				'nama' => $this->input->post('nama', true),
				'pekerjaan' => $this->input->post('pekerjaan',true),
				'alamat' => $this->input->post('alamat'),
				'kelamin' => $this->input->post('kelamin', true),
				'tgl_lahir' => $this->input->post('tgl_lahir', true),
				'agama' => $this->input->post('agama'),
				'tinggi' => $this->input->post('tinggi'),
				'berat' => $this->input->post('berat'),
				'jenis_pasien' => $this->input->post('jenis_pasien'),

			];

			$this->db->insert('pasien', $data);
			$insertId = $this->db->insert_id();
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">
				  Pasien Baru Ditambahkan!
				</div>'
			);
			redirect('pasien');
		}
	}

	function addRegistrasi()
	{
		$pendaftar = $this->db->get_where('pendaftaran', ['tgl_berobat' => date('d-m-Y')])->row();
	    if ($pendaftar) {
	    	if ($pendaftar->no_pendaftaran == $this->input->post('no_pendaftaran')) {
			    $this->session->set_flashdata('message', 
					'<div class="alert alert-danger" role="alert">
					  <strong>Nomor Pendaftaran Sudah Ada!!!</strong>
					</div>'
				);
				redirect('pasien');
	    	}
		}
		// form rules
		$this->form_validation->set_rules('no_pendaftaran', 'Nomor Pendaftaran', 'required|numeric');
		$this->form_validation->set_rules('biaya', 'Biaya', 'numeric|integer');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		$this->form_validation->set_message('numeric', '%s harus angka!!');
		$this->form_validation->set_message('integer', '%s tidak boleh ada tanda baca!!');
		if ($this->form_validation->run() == false) {
			$no_pasien = $this->input->post('no_pasien', true);
			$data['title'] = 'Pendaftaran';
			$data['user'] = $this->user;
			$data['list_klinik'] = $this->puskes->list_poli();
			$data['pasien'] = $this->db->get_where('pasien', ['no_pasien' => $no_pasien])->row();
			$this->load->view('inc/header',$data);
			$this->load->view('pendaftaran',$data);
			$this->load->view('inc/footer');
		} else {

			$data = [
				'no_pendaftaran' => $this->input->post('no_pendaftaran', true),
				'no_pasien' => $this->input->post('no_pasien', true),
				'nama_pasien' => $this->input->post('nama_pasien', true),
				'tgl_berobat' => $this->input->post('tgl_berobat',true),
				'jenis_pasien' => $this->input->post('jenis_pasien'),
				'biaya' => $this->input->post('biaya')
			];

			$this->db->insert('pendaftaran', $data);
			$bulan = date('F');
			$tahun = date('Y');
			$kunjungan = $this->db->get_where('kunjungan', ['bulan' => $bulan])->row();
			if ($kunjungan->tahun != $tahun) {
				$data = array(
		            array('id' => 1 ,
		                'tahun' => $tahun,'jumlah' => 0),
		            array('id' => 2 ,
		                'tahun' => $tahun,'jumlah' => 0),
		            array('id' => 3 ,
		                'tahun' => $tahun,'jumlah' => 0),
		            array('id' => 4 ,
		                'tahun' => $tahun,'jumlah' => 0),
		            array('id' => 5 ,
		                'tahun' => $tahun,'jumlah' => 0),
		            array('id' => 6 ,
		                'tahun' => $tahun,'jumlah' => 0),
		            array('id' => 7 ,
		                'tahun' => $tahun,'jumlah' => 0),
		            array('id' => 8 ,
		                'tahun' => $tahun,'jumlah' => 0),
		            array('id' => 9 ,
		                'tahun' => $tahun,'jumlah' => 0),
		            array('id' => 10 ,
		                'tahun' => $tahun,'jumlah' => 0)     
		        );
		        $this->db->update_batch('kunjungan', $data, 'id');
			}else{
				$jumlah = $kunjungan->jumlah+1;
				$data = [
					'jumlah' => $jumlah
				];
				$this->db->where('bulan', $bulan);
				$this->db->update('kunjungan', $data);
			}
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">
				  <strong>Registrasi baru berhasil</strong> silahkan tunggu panggilan.
				</div>'
			);
			redirect('pasien/list_registrasi');
		}
	}

	function editProses()
	{
		
		// form rules
		$this->form_validation->set_rules('nama', 'Nama Pasien', 'required');
		$this->form_validation->set_rules('no_pasien', 'No Rekam Medis', 'required|numeric');
		$this->form_validation->set_rules('no_ktp', 'No Ktp', 'required|numeric');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('tinggi', 'Tinggi', 'numeric');
		$this->form_validation->set_rules('berat', 'Berat', 'numeric');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		$this->form_validation->set_message('numeric', '%s harus angka!!');
		if ($this->form_validation->run() == false) {
			$no_pasien = $this->input->post('no_pasien', true);
			if (!$no_pasien) {
				redirect('pasien');
			}
			$data['title'] = 'Pasien';
			$data['user'] = $this->user;
			$data['pasien'] = $this->db->get_where('pasien', ['no_pasien' => $no_pasien])->row();
			if (!$data['pasien']) {
				redirect('pasien');
			}
			$this->load->view('inc/header',$data);
			$this->load->view('edit_pasien',$data);
			$this->load->view('inc/footer');

		} else {
			$no_pasien = $this->input->post('no_pasien', true);

			$data = [
				'no_ktp' => $this->input->post('no_ktp', true),
				'nama' => $this->input->post('nama', true),
				'pekerjaan' => $this->input->post('pekerjaan',true),
				'alamat' => $this->input->post('alamat'),
				'kelamin' => $this->input->post('kelamin', true),
				'tgl_lahir' => $this->input->post('tgl_lahir', true),
				'agama' => $this->input->post('agama'),
				'tinggi' => $this->input->post('tinggi'),
				'berat' => $this->input->post('berat'),
				'jenis_pasien' => $this->input->post('jenis_pasien'),
			];

			$this->db->where('no_pasien', $no_pasien);
			$this->db->update('pasien', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">Data Pasien berhasil diubah</div>'
			);
			redirect('pasien');
		}
	}
	function daftar($no_pasien = null)
	{	
		if (!$no_pasien) {
			redirect('pasien');
		}
		$data['title'] = 'Daftar Pasien';
		$data['user'] = $this->user;
		$data['pasien'] = $this->db->get_where('pasien', ['no_pasien' => $no_pasien])->row();
		if (!$data['pasien']) {
			redirect('pasien');
		}
		$this->load->view('inc/header',$data);
		$this->load->view('pendaftaran',$data);
		$this->load->view('inc/footer');
	}
	function editPasien($no_pasien = null)
	{	
		if (!$no_pasien) {
			redirect('pasien');
		}
		$data['title'] = 'Pasien';
		$data['user'] = $this->user;
		$data['pasien'] = $this->db->get_where('pasien', ['no_pasien' => $no_pasien])->row();
		if (!$data['pasien']) {
			redirect('pasien');
		}
		$this->load->view('inc/header',$data);
		$this->load->view('edit_pasien',$data);
		$this->load->view('inc/footer');
	}
	function delete_pasien($id){
		$this->db->delete('pasien', ['id' => $id]);
		$this->session->set_flashdata('message', 
			'<div class="alert alert-success" role="alert">Pasien berhasil dihapus</div>'
		);
		redirect('pasien');
	}
	function delete_register($id){
		$this->db->delete('pendaftaran', ['id' => $id]);
		$this->session->set_flashdata('message', 
			'<div class="alert alert-success" role="alert">Data Registrasi berhasil dihapus</div>'
		);
		redirect('pasien/list_registrasi');
	}
}
