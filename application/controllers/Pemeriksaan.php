<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemeriksaan extends CI_Controller {

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
		$data['title'] = 'Pemeriksaan';
		$data['user'] = $this->user;
		$dokter = $this->db->get_where('dokter', ['username' => $this->session->userdata('username')])->row_array();
		$data['rekam_list'] = $this->db->get_where('rekam_medis', ['dokter_tujuan' => $dokter['id']])->result_array();;
		$data['poli_list'] = $this->puskes->list_poli();
		$data['list_dokter'] = $this->puskes->list_dokter();
		$this->load->view('inc/header',$data);
		$this->load->view('pemeriksaan',$data);
		$this->load->view('inc/footer');
	}
	function riwayat_resep()
	{	
		$data['title'] = 'Resep Obat';
		$data['user'] = $this->user;
		$dokter_id = $this->db->get_where('dokter', ['username' => $this->session->userdata('username')])->row();
		$data['resep_list'] = $this->db->get_where('resep_obat', ['dokter_id' => $dokter_id->id])->result_array();
		$this->load->view('inc/header',$data);
		$this->load->view('riwayat_resep',$data);
		$this->load->view('inc/footer');
	}
	function periksa($no_rm = null)
	{	
		if (!$no_rm) {
			redirect('pemeriksaan');
		}
		$data['title'] = 'Pemeriksaan';
		$data['user'] = $this->user;
		$data['rekam_medis'] = $this->db->get_where('rekam_medis', ['no_rm' => $no_rm])->row();
		$pemeriksaan = $this->db->get_where('pemeriksaan', ['no_rm' => $no_rm])->row();
		if (!$data['rekam_medis'] || $data['rekam_medis']->status == 1) {
			redirect('pemeriksaan');
		}
		$this->load->view('inc/header',$data);
		$this->load->view('periksa',$data);
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
	function rujuk_external($no_rm = null)
	{	
		if (!$no_rm) {
			redirect('pemeriksaan');
		}
		$data['title'] = 'Rujukan';
		$data['user'] = $this->user;
		$data['rekam_medis'] = $this->db->get_where('rekam_medis', ['no_rm' => $no_rm])->row();
		$data['pasien'] = $this->db->get_where('pasien', ['no_pasien' => $data['rekam_medis']->no_pasien])->row();
		$data['pemeriksaan'] = $this->db->get_where('pemeriksaan', ['no_rm' => $no_rm])->row();
		$data['klinik_list'] = $this->puskes->list_poli();
		if (!$data['rekam_medis'] || $data['rekam_medis']->status == 0) {
			redirect('pemeriksaan');
		}
		$this->load->view('inc/header',$data);
		$this->load->view('rujuk_external',$data);
		$this->load->view('inc/footer');
	}
	function resep($no_rm = null)
	{	
		if (!$no_rm) {
			redirect('pemeriksaan');
		}
		$data['title'] = 'Resep Obat';
		$data['user'] = $this->user;
		$data['rekam_medis'] = $this->db->get_where('rekam_medis', ['no_rm' => $no_rm])->row();
		$data['pemeriksaan'] = $this->db->get_where('pemeriksaan', ['no_rm' => $no_rm])->row();
		$data['resep_list'] = $this->db->get_where('resep_obat', ['no_rm' => $no_rm])->result();
		$data['list_kategori'] = $this->puskes->list_kategori_obat();
		$data['obat_list'] = $this->puskes->list_obat();
		$data['list_satuan_obat'] = $this->puskes->list_satuan_obat();
		if (!$data['rekam_medis'] || $data['rekam_medis']->status == 0) {
			redirect('pemeriksaan');
		}
		$this->load->view('inc/header',$data);
		$this->load->view('resep',$data);
		$this->load->view('inc/footer');
	}

	function addResep(){

			$this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required');
			$this->form_validation->set_rules('jumlah', 'Jumlah Obat', 'required|numeric|integer');
			$this->form_validation->set_message('required', '%s harus diisi!!');
			$this->form_validation->set_message('numeric', '%s harus angka!!');
			$this->form_validation->set_message('integer', '%s harus angka saja!!');
			if ($this->form_validation->run() == false) {
				$no_rm = $this->input->post('no_rm', true);
				if (!$no_rm) {
				redirect('pemeriksaan');
				}
				$data['title'] = 'Resep Obat';
				$data['user'] = $this->user;
				$data['rekam_medis'] = $this->db->get_where('rekam_medis', ['no_rm' => $no_rm])->row();
				$data['pemeriksaan'] = $this->db->get_where('pemeriksaan', ['no_rm' => $no_rm])->row();
				$data['resep_list'] = $this->puskes->resep_obat();
				$data['list_kategori'] = $this->puskes->list_kategori_obat();
				$data['obat_list'] = $this->puskes->list_obat();
				$data['list_satuan_obat'] = $this->puskes->list_satuan_obat();
				if (!$data['rekam_medis'] || $data['rekam_medis']->status == 0) {
					redirect('pemeriksaan');
				}
				$this->load->view('inc/header',$data);
				$this->load->view('resep',$data);
				$this->load->view('inc/footer');
				
			} else {
				$no_rm = $this->input->post('no_rm', true);
				$obat = $this->db->get_where('obat', ['id' => $this->input->post('id_obat', true)])->row();
				if (!$obat) {
					$this->session->set_flashdata('message', 
						'<div class="alert alert-danger" role="alert">
						  <strong>Nama Obat Tidak Ada!!!</strong>
						</div>'
					);
					redirect('pemeriksaan/resep/'.$no_rm);
				}
				$data = [
					'no_rm' => $this->input->post('no_rm', true),
					'id_obat' => $this->input->post('id_obat', true),
					'nama_obat' => $this->input->post('nama_obat', true),
					'jumlah' => $this->input->post('jumlah', true),
					'id_rm' => $this->input->post('id_rm', true),
					'dokter_id' => $this->input->post('dokter_id', true)
				];
				$stok = $this->db->get_where('obat', ['id' => $this->input->post('id_obat', true)])->row()->stok;
				if ($this->input->post('jumlah') > $stok) {
					$this->session->set_flashdata('message', 
						'<div class="alert alert-danger" role="alert">
						  <strong>Jumlah Melebihi Stok Tersedia!!!</strong>
						</div>'
					);
					redirect('pemeriksaan/resep/'.$no_rm);
				}
				$this->db->insert('resep_obat', $data);
				$bulan = date('F');
				$tahun = date('Y');
				$pemakaian_obat = $this->db->get_where('pemakaian_obat', ['bulan' => $bulan])->row();
				if ($pemakaian_obat->tahun != $tahun) {
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
			        $this->db->update_batch('pemakaian_obat', $data, 'id');
				}else{
					$jumlah = $pemakaian_obat->jumlah+$this->input->post('jumlah', true);
					$data = [
						'jumlah' => $jumlah
					];
					$this->db->where('bulan', $bulan);
					$this->db->update('pemakaian_obat', $data);
				}
				$this->session->set_flashdata('message', 
					'<div class="alert alert-success" role="alert">
					  <strong>Resep Berhasil Ditambah!!!</strong>
					</div>'
				);
				$this->db->set('stok', $stok - $this->input->post('jumlah'), FALSE);
				$this->db->where('id', $this->input->post('id_obat', true));
				$this->db->update('obat');
				redirect('pemeriksaan/resep/'.$no_rm);
			}
	}

	function addProses()
	{
		
		// form rules
		$this->form_validation->set_rules('diagnosa_penyakit', 'Diagnosa Penyakit', 'required');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		if ($this->form_validation->run() == false) {
			$no_rm = $this->input->post('no_rm', true);
			if (!$no_rm) {
				redirect('pemeriksaan');
			}
			$data['title'] = 'Pemeriksaan';
			$data['user'] = $this->user;
			$data['rekam_medis'] = $this->db->get_where('rekam_medis', ['no_rm' => $no_rm])->row();
			if (!$data['rekam_medis']) {
				redirect('pemeriksaan');
			}
			$this->load->view('inc/header',$data);
			$this->load->view('periksa',$data);
			$this->load->view('inc/footer');

		} else {

			$data = [
				'no_rm' => $this->input->post('no_rm', true),
				'diagnosa_penyakit' => $this->input->post('diagnosa_penyakit', true),
				'tgl_pemeriksaan' => $this->input->post('tgl_pemeriksaan', true)
			];

			$this->db->insert('pemeriksaan', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">
				  <strong>Berhasil Diperiksa!!!</strong>
				</div>'
			);
			$this->db->set('status', 1, FALSE);
			$this->db->where('no_rm', $this->input->post('no_rm', true));
			$this->db->update('rekam_medis');
			redirect('pemeriksaan');
		}
	}
	function addRujuk_internal()
	{
		
		// form rules
		$this->form_validation->set_rules('dokter_rujuk', 'Dokter Rujukan', 'required');
		$this->form_validation->set_message('required', '%s harus dipilih!!');
		if ($this->form_validation->run() == false) {
			$no_rm = $this->input->post('no_rm', true);
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

		} else {

			$data = [
				'no_rm' => $this->input->post('no_rm', true),
				'no_pasien' => $this->input->post('no_pasien', true),
				'nama_pasien' => $this->input->post('nama_pasien', true),
				'klinik_perujuk' => $this->input->post('klinik_perujuk', true),
				'dokter_perujuk' => $this->input->post('dokter_perujuk', true),
				'klinik_rujuk' => $this->input->post('klinik_rujuk', true),
				'dokter_rujuk' => $this->input->post('dokter_rujuk', true),
				'status' => 0,
			];

			$this->db->insert('rujuk_internal', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">
				  <strong>Berhasil Dirujuk Internal!!!</strong>
				</div>'
			);
			redirect('pemeriksaan');
		}
	}
	function addRujuk_external()
	{
		
		// form rules
		$this->form_validation->set_rules('dokter_tujuan', 'Nama Dokter Rujukan', 'required');
		$this->form_validation->set_rules('rs_tujuan', 'Rumah Sakit Rujukan', 'required');
		$this->form_validation->set_message('required', '%s harus diisi!!');
		if ($this->form_validation->run() == false) {
			$no_rm = $this->input->post('no_rm', true);
			if (!$no_rm) {
			redirect('pemeriksaan');
			}
			$data['title'] = 'Rujukan';
			$data['user'] = $this->user;
			$data['rekam_medis'] = $this->db->get_where('rekam_medis', ['no_rm' => $no_rm])->row();
			$data['pasien'] = $this->db->get_where('pasien', ['no_pasien' => $data['rekam_medis']->no_pasien])->row();
			$data['pemeriksaan'] = $this->db->get_where('pemeriksaan', ['no_rm' => $no_rm])->row();
			$data['klinik_list'] = $this->puskes->list_poli();
			if (!$data['rekam_medis'] || $data['rekam_medis']->status == 0) {
				redirect('pemeriksaan');
			}
			$this->load->view('inc/header',$data);
			$this->load->view('rujuk_external',$data);
			$this->load->view('inc/footer');

		} else {

			$data = [
				'no_rm' => $this->input->post('no_rm', true),
				'no_pasien' => $this->input->post('no_pasien', true),
				'klinik_perujuk' => $this->input->post('klinik_perujuk', true),
				'dokter_perujuk' => $this->input->post('dokter_perujuk', true),
				'rs_tujuan' => $this->input->post('rs_tujuan', true),
				'dokter_tujuan' => $this->input->post('dokter_tujuan', true)
			];

			$this->db->insert('rujuk_external', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">
				  <strong>Berhasil Dirujuk Eksternal!!!</strong>
				</div>'
			);
			redirect('pemeriksaan');
		}
	}
	function addLab($id_rm = null){
		if (!$id_rm) {
			redirect('pemeriksaan');
		}
		$rekam_medis = $this->db->get_where('rekam_medis', ['id' => $id_rm])->row();
		$no_pasien = $rekam_medis->no_pasien;
		$data = [
				'id_rm' => $id_rm,
				'no_rm' => $rekam_medis->no_rm,
				'no_pasien' => $no_pasien,
				'tgl_labor' => date('d-m-Y'),
				'no_labor' => date('Ymd')+$rekam_medis->no_rm
			];

			$this->db->insert('laboratorium', $data);
			$this->session->set_flashdata('message', 
				'<div class="alert alert-success" role="alert">
				  <strong>Berhasil dikirim ke Lab!!!</strong>
				</div>'
			);
			redirect('pemeriksaan');

	}

	function delete_resep_o($id){
		$no_rm = $this->db->get_where('resep_obat', ['id' => $id])->row()->no_rm;
		$this->db->delete('resep_obat', ['id' => $id]);
		$this->session->set_flashdata('message2', 
			'<div class="alert alert-success" role="alert">Resep Obat berhasil dihapus</div>'
		);
		redirect('pemeriksaan/resep/'.$no_rm);
	}
}
