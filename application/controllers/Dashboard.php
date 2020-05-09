<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $user;

	function __construct(){
		parent::__construct();
		$this->load->model('Puskesmas','puskes');
		is_logged_in();
		$this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
	}
	public function index()
	{	
		$data['title'] = 'Dashboard';
		$data['user'] = $this->user;
		$data['kunjungan'] = sprintf("%04d",$this->db->get_where('kunjungan', ['bulan' => date('F')])->row()->jumlah);
		$data['obat'] = sprintf("%04d",$this->db->get_where('pemakaian_obat', ['bulan' => date('F')])->row()->jumlah);
		$data['lab'] = sprintf("%04d",$this->db->get_where('laboratorium', ['tgl_labor' => date('d-m-Y')])->num_rows());
		$data['pasien'] = sprintf("%04d",$this->db->get('pasien')->num_rows());
		$data['pasien'] = sprintf("%04d",$this->db->get('pasien')->num_rows());
		$this->load->view('inc/header',$data);
		$this->load->view('dashboard',$data);
		$this->load->view('inc/footer');
	}
	function getKunjungan(){
		$this->db->order_by("id", "ASC");
	 	$query = $this->db->get("kunjungan");
	 	$data = json_encode($query->result());
	 	print_r($data);
	 	exit();
	}
	function getObat(){
		$this->db->order_by("id", "ASC");
	 	$query = $this->db->get("pemakaian_obat");
	 	$data = json_encode($query->result());
	 	print_r($data);
	 	exit();
	}
}
