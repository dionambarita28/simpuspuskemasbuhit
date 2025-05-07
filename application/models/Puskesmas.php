<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puskesmas extends CI_Model {


	function list_obat(){

	  $this->db->order_by("id_obat", "DESC");
	  $query = $this->db->get("obat");
	  return $query->result_array();
	}

	function list_labor(){

	  $this->db->order_by("id", "DESC");
	  $query = $this->db->get("laboratorium");
	  return $query->result_array();
	}
	
	function list_petugas(){

	  $this->db->order_by("id", "DESC");
	  $query = $this->db->get("user");
	  return $query->result_array();
	}

	function list_keluhan(){

		$this->db->order_by("created_at", "DESC");
		$query = $this->db->get("keluhan");
		return $query->result_array();
	  }

	function resep_obat(){
	  $this->db->order_by("id", "DESC");
	  $query = $this->db->get("resep_obat");
	  return $query->result_array();
	}

	function list_pasien(){
	  $this->db->order_by("id", "DESC");
	  $query = $this->db->get("pasien");
	  return $query->result_array();
	}

	function rujuk_internal(){
	  $this->db->order_by("id", "DESC");
	  $query = $this->db->get("rujuk_internal");
	  return $query->result_array();
	}

	function list_registrasi(){
	  $this->db->order_by("id", "DESC");
	  $query = $this->db->get("pendaftaran");
	  return $query->result_array();
	}
	
	function rekam_medis_list(){
	  $this->db->order_by("id", "DESC");
	  $query = $this->db->get("rekam_medis");
	  return $query->result_array();
	}

	function list_poli(){
	  $this->db->order_by("poli_id", "ASC");
	  $query = $this->db->get("poli");
	  return $query->result_array();
	}

	function list_dokter(){
	  $this->db->order_by("dokter_id", "DESC");
	  $query = $this->db->get("dokter");
	  return $query->result_array();
	}

	function list_kategori_obat(){

	  $this->db->order_by("id_kategori_obat", "DESC");
	  $query = $this->db->get("kategori_obat");
	  return $query->result_array();
	}

	function list_satuan_obat(){

	  $this->db->order_by("id_satuan", "DESC");
	  $query = $this->db->get("satuan_obat");
	  return $query->result_array();
	}

	function getObats($postData){

     $response = array();

     if(isset($postData['search']) ){
       // Select record
       $this->db->select('*');
       $this->db->where("nama_obat like '%".$postData['search']."%' ");

       $records = $this->db->get('obat')->result();

       foreach($records as $row ){
	        $this->db->where('id_satuan', $row->id);
			$this->db->limit(1);
			$query = $this->db->get('satuan_obat')->row();
       		$response[] = array("value"=>$row->id,"label"=>$row->nama_obat,"satuan"=>$query->nama_satuan);
       }

     }

     return $response;
	}
	function getStok($id){
		  $this->db->where('id_obat', $id);
		  $this->db->limit(1);
		  $query = $this->db->get('obat')->row();
		  return $query->stok;
	}

	function getPasien($postData){

		$response = array();
   
		if(isset($postData['no_ktp']) ){
		  // Select record
		  $this->db->select('*');
		  $this->db->where("no_ktp_pasien like '%".$postData['no_ktp']."%' ");
   
		  $records = $this->db->get('pasien')->result();
   
		  foreach($records as $row ){
			 $response[] = array("value"=>$row->id,"label"=>$row->no_ktp_pasien);
		  }
   
		}
   
		return $response;
	 }

  	function get_dokter_list($klinik){
		  $this->db->where('poli_id', $klinik);
		  $this->db->order_by('dokter_id','ASC');
		  $query = $this->db->get('dokter');
		  foreach($query->result() as $row)
		  {
			$output .= '<option value="'.$row->dokter_id.'">'.$row->nama_dokter.'</option>';

		  }
		  return $output;
	}


	public function riwayat($no_ktp_pasien)
	{
		$this->db->select('*');
		$this->db->from('rekam_medis');
		$this->db->join('dokter', 'dokter.dokter_id = rekam_medis.dokter_id', 'left');
		$this->db->join('poli', 'poli.poli_id = rekam_medis.poli_id', 'left');
		$this->db->where('no_ktp_pasien', $no_ktp_pasien);
		$query = $this->db->get();
		return $query;
	}


}