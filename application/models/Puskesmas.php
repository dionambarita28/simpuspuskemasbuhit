<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puskesmas extends CI_Model {


	function list_obat(){

	  $this->db->order_by("id", "DESC");
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
	  $this->db->order_by("id", "ASC");
	  $query = $this->db->get("poli");
	  return $query->result_array();
	}
	function list_dokter(){
	  $this->db->order_by("id", "DESC");
	  $query = $this->db->get("dokter");
	  return $query->result_array();
	}
	function list_kategori_obat(){

	  $this->db->order_by("id", "DESC");
	  $query = $this->db->get("kategori_obat");
	  return $query->result_array();
	}
	function list_satuan_obat(){

	  $this->db->order_by("id", "DESC");
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
	        $this->db->where('id', $row->id);
			$this->db->limit(1);
			$query = $this->db->get('satuan_obat')->row();
       		$response[] = array("value"=>$row->id,"label"=>$row->nama_obat,"satuan"=>$query->nama_satuan);
       }

     }

     return $response;
	}
	function getStok($id){
		  $this->db->where('id', $id);
		  $this->db->limit(1);
		  $query = $this->db->get('obat')->row();
		  return $query->stok;
	}
  	function get_dokter_list($klinik){
		  $this->db->where('klinik', $klinik);
		  $this->db->order_by('id','ASC');
		  $query = $this->db->get('dokter');
		  foreach($query->result() as $row)
		  {
			$output .= '<option value="'.$row->id.'">'.$row->nama_dokter.'</option>';

		  }
		  return $output;
	}
}