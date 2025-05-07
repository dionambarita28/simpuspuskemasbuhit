<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{

	public $user;

	function __construct()
	{
		parent::__construct();
		$this->load->model('Puskesmas', 'puskes');
		is_logged_in();
		if (is_level() == 3 || is_level() == 4 || is_level() == 5) {
			redirect('inc/notpound');
		}
		$this->load->add_package_path( APPPATH . 'third_party/fpdf');
        $this->load->library('pdf');
		$this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
	}

	function index()
	{
		$data['title'] = 'Pasien';
		$data['user'] = $this->user;
		$data['pasien_list'] = $this->puskes->list_pasien();
		$this->load->view('inc/header', $data);
		$this->load->view('pasien', $data);
		$this->load->view('inc/footer');
	}
	function list_registrasi()
	{
		$data['title'] = 'Pendaftaran';
		$data['user'] = $this->user;
		$data['list_registrasi'] = $this->puskes->list_registrasi();
		$data['list_registrasi2'] = $this->db->get_where('pendaftaran', ['tgl_berobat' => date('d-m-Y')])->result_array();
		$this->load->view('inc/header', $data);
		$this->load->view('list_registrasi', $data);
		$this->load->view('inc/footer');
	}
	function addPasien()
	{
		$data['title'] = 'Pasien';
		$data['user'] = $this->user;
		$this->load->view('inc/header', $data);
		$this->load->view('tambah_pasien', $data);
		$this->load->view('inc/footer');
	}
	function add_Pasien()
	{
		$data['title'] = 'Pasien';
		$data['user'] = $this->user;
		$this->load->view('inc/header', $data);
		$this->load->view('tambah_pasien2', $data);
		$this->load->view('inc/footer');
	}

	function checkPasien()
	{
		if ($this->input->post('no_ktp_pasien',true)) {
			$no_ktp = $this->input->post('no_ktp_pasien', true);
			$data['pasien'] = $this->db->get_where('pasien', ['no_ktp_pasien' => $no_ktp])->row();
			$data['keluhan'] = $this->db->order_by('id','DESC')->get_where('keluhan', ['no_ktp_pasien' => $no_ktp])->result_array();

			$data['no_ktp_pasien'] = $this->input->post('no_ktp_pasien',true);
			$data['title'] = 'Pasien';
			$data['user'] = $this->user;
			$this->load->view('inc/header', $data);
			$this->load->view('checkPasien', $data);
			$this->load->view('inc/footer');
			
		} else {
			$data['title'] = 'Pasien';
			$data['user'] = $this->user;
			$this->load->view('inc/header', $data);
			$this->load->view('checkPasien', $data);
			$this->load->view('inc/footer'); 
		}
	}

	function printPasien()
	{
		// form rules
		$this->form_validation->set_rules('keluhan', 'Keluhan', 'required');
		$this->form_validation->set_rules('no_ktp_pasien', 'No Ktp Pasien', 'required|numeric');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		$this->form_validation->set_message('numeric', '%s harus angka!!');
		if ($this->form_validation->run() == false) {
			$no_ktp = $this->input->post('no_ktp_pasien', true);
			$data['pasien'] = $this->db->get_where('pasien', ['no_ktp_pasien' => $no_ktp])->row();
			$data['keluhan'] = $this->puskes->list_keluhan();

			$data['no_ktp_pasien'] = $this->input->post('no_ktp_pasien',true);
			$data['title'] = 'Pasien';
			$data['user'] = $this->user;
			$this->load->view('inc/header', $data);
			$this->load->view('checkPasien', $data);
			$this->load->view('inc/footer');
		} else {
			$pasien = $this->db->get_where('pasien', ['no_ktp_pasien' => $this->input->post('no_ktp_pasien', true)])->row();

			$data2 = [
				'no_ktp_pasien' => $this->input->post('no_ktp_pasien', true),
				'keluhan' => $this->input->post('keluhan'),
				'created_at' => date("Y-m-d")
			];
			$this->db->insert('keluhan', $data2);

			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success" role="alert">
				  Pasien Baru Ditambahkan!
				</div>'
			);
			redirect('pasien/PrintDataPasien/'.$this->input->post("no_ktp_pasien"));
		}
	}

	function addProses()
	{

		// form rules
		// $this->form_validation->set_rules('nama', 'Nama Lengkap Pasien', 'required');
		// $this->form_validation->set_rules('no_ktp_pasien', 'No Ktp Pasien', 'required|numeric');
		// $this->form_validation->set_rules('no_nik', 'No NIK', 'required|numeric');
		// $this->form_validation->set_rules('alamat', 'Alamat', 'required');
		// $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
		// $this->form_validation->set_rules('keluhan', 'Keluhan Sakit', 'required');
		// $this->form_validation->set_rules('no_hp', 'No Hp', 'required');
		// $this->form_validation->set_message('required', '%s harus diisi!!');
		// $this->form_validation->set_message('numeric', '%s harus angka!!');
		// if ($this->form_validation->run() == false) {

		// 	$data['title'] = 'Pasien';
		// 	$data['user'] = $this->user;
		// 	$data['list_kategori'] = $this->puskes->list_kategori_obat();
		// 	$data['list_satuan_obat'] = $this->puskes->list_satuan_obat();
		// 	$this->load->view('inc/header', $data);
		// 	$this->load->view('tambah_pasien', $data);
		// 	$this->load->view('inc/footer');
		// } else {
			$pasien = $this->db->get_where('pasien', ['no_ktp_pasien' => $this->input->post('no_ktp_pasien', true)])->row();

			if ($pasien) {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger" role="alert">
				  <strong>Nomor KTP Pasien Sudah Ada,!</strong>
				</div>'
				);
				redirect('pasien');
			}
			$data = [
				'no_ktp_pasien' => $this->input->post('no_ktp_pasien', true),
				'no_nik' => $this->input->post('no_nik', true),
				'nama' => $this->input->post('nama', true),
				'kelamin' => $this->input->post('kelamin', true),
				'alamat' => $this->input->post('alamat'),
				'tgl_lahir' => $this->input->post('tgl_lahir', true),
				'no_hp' => $this->input->post('no_hp'),
				'jenis_pasien' => $this->input->post('jenis_pasien'),

			];
			
			//var_dump($data);die();
			$this->db->insert('pasien', $data);
			// $insertId = $this->db->insert_id();
			$data2 = [
				'no_ktp_pasien' => $this->input->post('no_ktp_pasien', true),
				'keluhan' => $this->input->post('keluhan'),
				'created_at' => date("Y-m-d")
			];

			$this->db->insert('keluhan', $data2);

			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success" role="alert">
				  Pasien Baru Ditambahkan!
				</div>'
			);
			redirect('pasien/PrintDataPasien/'.$this->input->post("no_ktp_pasien"));
		// }
	}

	public function autoPasien(){
		// POST data
		$postData = $this->input->post();
	
		// Get data
		$data = $this->puskes->getPasien($postData);
	
		echo json_encode($data);
	}

	function addRegistrasi()
	{
		$pendaftar = $this->db->get_where('pendaftaran', ['tgl_berobat' => date('d-m-Y')])->row();
		if ($pendaftar) {
			if ($pendaftar->no_pendaftaran == $this->input->post('no_pendaftaran')) {
				$this->session->set_flashdata(
					'message',
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
			$no_ktp_pasien = $this->input->post('no_ktp_pasien', true);
			$data['title'] = 'Pendaftaran';
			$data['user'] = $this->user;
			$data['list_klinik'] = $this->puskes->list_poli();
			$data['pasien'] = $this->db->get_where('pasien', ['no_ktp_pasien' => $no_ktp_pasien])->row();
			$this->load->view('inc/header', $data);
			$this->load->view('pendaftaran', $data);
			$this->load->view('inc/footer');
		} else {

			$data = [
				'no_pendaftaran' => $this->input->post('no_pendaftaran', true),
				'no_ktp_pasien' => $this->input->post('no_ktp_pasien', true),
				'nama_pasien' => $this->input->post('nama_pasien', true),
				'tgl_berobat' => $this->input->post('tgl_berobat', true),
				'jenis_pasien' => $this->input->post('jenis_pasien'),
				'biaya' => $this->input->post('biaya')
			];

			$this->db->insert('pendaftaran', $data);
			$bulan = date('F');
			$tahun = date('Y');
			$kunjungan = $this->db->get_where('kunjungan', ['bulan' => $bulan])->row();
			if ($kunjungan->tahun != $tahun) {
				$data = array(
					array(
						'id' => 1,
						'tahun' => $tahun, 'jumlah' => 0
					),
					array(
						'id' => 2,
						'tahun' => $tahun, 'jumlah' => 0
					),
					array(
						'id' => 3,
						'tahun' => $tahun, 'jumlah' => 0
					),
					array(
						'id' => 4,
						'tahun' => $tahun, 'jumlah' => 0
					),
					array(
						'id' => 5,
						'tahun' => $tahun, 'jumlah' => 0
					),
					array(
						'id' => 6,
						'tahun' => $tahun, 'jumlah' => 0
					),
					array(
						'id' => 7,
						'tahun' => $tahun, 'jumlah' => 0
					),
					array(
						'id' => 8,
						'tahun' => $tahun, 'jumlah' => 0
					),
					array(
						'id' => 9,
						'tahun' => $tahun, 'jumlah' => 0
					),
					array(
						'id' => 10,
						'tahun' => $tahun, 'jumlah' => 0
					)
				);
				$this->db->update_batch('kunjungan', $data, 'id');
			} else {
				$jumlah = $kunjungan->jumlah + 1;
				$data = [
					'jumlah' => $jumlah
				];
				$this->db->where('bulan', $bulan);
				$this->db->update('kunjungan', $data);
			}
			$this->session->set_flashdata(
				'message',
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
		// $this->form_validation->set_rules('nama', 'Nama Pasien', 'required');
		// $this->form_validation->set_rules('no_ktp_pasien', 'No Ktp Pasien', 'required|numeric');
		// $this->form_validation->set_rules('no_nik', 'No NIK', 'required|numeric');
		// $this->form_validation->set_rules('no_hp', 'No HP', 'required|numeric');
		// $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
		// $this->form_validation->set_message('required', '%s harus diisi!!');
		// $this->form_validation->set_message('numeric', '%s harus angka!!');
		// if ($this->form_validation->run() == false) {
		// 	$no_ktp_pasien = $this->input->post('no_ktp_pasien', true);
		// 	// if (!$no_ktp_pasien) {
		// 	// 	redirect('pasien');
		// 	// }
		// 	$data['title'] = 'Pasien';
		// 	$data['user'] = $this->user;
		// 	$data['pasien'] = $this->db->get_where('pasien', ['no_ktp_pasien' => $no_ktp_pasien])->row();
		// 	// if (!$data['pasien']) {
		// 	// 	redirect('pasien');
		// 	// }
		// 	$this->load->view('inc/header', $data);
		// 	$this->load->view('edit_pasien', $data);
		// 	$this->load->view('inc/footer');
		// } else {
			$where = ['no_ktp_pasien' => $this->input->post('no_ktp_pasien', true)];

			$data = [
				'nama' => $this->input->post('nama', true),
				'no_nik' => $this->input->post('no_nik', true),
				'alamat' => $this->input->post('alamat'),
				'kelamin' => $this->input->post('kelamin', true),
				'tgl_lahir' => $this->input->post('tgl_lahir', true),
				'jenis_pasien' => $this->input->post('jenis_pasien'),
				'no_hp' => $this->input->post('no_hp'),
			];

			//$this->db->where('no_ktp_pasien', $no_ktp_pasien);
			$this->db->update('pasien', $data, $where);
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success" role="alert">Data Pasien berhasil diubah</div>'
			);
			redirect('pasien');
		// }
	}

	function daftar($no_ktp_pasien = null)
	{
		if (!$no_ktp_pasien) {
			redirect('pasien');
		}
		$data['title'] = 'Daftar Pasien';
		$data['user'] = $this->user;
		$data['pasien'] = $this->db->get_where('pasien', ['no_ktp_pasien' => $no_ktp_pasien])->row();
		if (!$data['pasien']) {
			redirect('pasien');
		}
		$this->load->view('inc/header', $data);
		$this->load->view('pendaftaran', $data);
		$this->load->view('inc/footer');
	}

	function editPasien($no_ktp_pasien = null)
	{
		if (!$no_ktp_pasien) {
			redirect('pasien');
		}
		$data['title'] = 'Pasien';
		$data['user'] = $this->user;
		$data['pasien'] = $this->db->get_where('pasien', ['no_ktp_pasien' => $no_ktp_pasien])->row();
		if (!$data['pasien']) {
			redirect('pasien');
		}
		$this->load->view('inc/header', $data);
		$this->load->view('edit_pasien', $data);
		$this->load->view('inc/footer');
	}

	function delete_pasien($id)
	{
		$this->db->delete('pasien', ['id' => $id]);
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success" role="alert">Pasien berhasil dihapus</div>'
		);
		redirect('pasien');
	}

	function delete_register($id)
	{
		$this->db->delete('pendaftaran', ['id' => $id]);
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success" role="alert">Data Registrasi berhasil dihapus</div>'
		);
		redirect('pasien/list_registrasi');
	}

	function PrintDataPasien($no_ktp_pasien = null)
    {
        if (!$no_ktp_pasien) {
            redirect('pasien');
        }
        $keluhan = $this->db->order_by('id','DESC')->get_where('keluhan', ['no_ktp_pasien' => $no_ktp_pasien])->row();
        $pasien = $this->db->get_where('pasien', ['no_ktp_pasien' => $no_ktp_pasien])->row();
        if (!$pasien) {
            redirect('dashboard');
        }

        $this->pdf = new Pdf();
        $this->pdf->Add_Page('P','A4',0);
        $this->pdf->AliasNbPages();
        $this->pdf->SetLeftMargin(20);
        $this->pdf->SetRightMargin(20);

        $this->pdf->SetFont('Arial','B',16);
        $this->pdf->Cell(0,7,'Informasi Pasien',0,1,'C');
        $this->pdf->Ln();

        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(35,7,"Nama Pasien",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$pasien->nama,0,1);
        $this->pdf->Cell(35,7,"No KTP Pasien",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$no_ktp_pasien,0,1);
        $this->pdf->Cell(35,7,"No NIK",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$pasien->no_nik,0,1);
        $this->pdf->Cell(35,7,"No HP",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$pasien->no_hp,0,1);
        $this->pdf->Cell(35,7,"Alamat",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->MultiCell(45,7,$pasien->alamat,0,1);
        $this->pdf->Cell(35,7,"TTL",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$pasien->tgl_lahir,0,1);
        $this->pdf->Cell(35,7,"Jenis Kelamin",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$pasien->kelamin,0,1);
        $this->pdf->Cell(35,7,"Jenis Pasien",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->MultiCell(45,7,$pasien->jenis_pasien,0,1);
       
        $this->pdf->Ln(20);

        $this->pdf->SetFont('Arial','B',14);
        $this->pdf->Cell(0,7,'Keluhan',0,1,'C');
        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(35,7,"Tanggal",1,0);
        $this->pdf->Cell(0,7,"Keluhan",1,1);

        $this->pdf->SetFont('Arial','',10);

        $this->pdf->Cell(35,7,$keluhan->created_at,1,0);
        $this->pdf->MultiCell(0,7,$keluhan->keluhan,1,1);
        $this->pdf->Output( 'pasien_'.$no_ktp_pasien.'.pdf' , 'I' );
    }
}
