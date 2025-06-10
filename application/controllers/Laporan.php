<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public $user;

	function __construct(){
		parent::__construct();
		$this->load->library('Cetak_pdf');
		$this->load->model('Puskesmas','puskes');
                is_logged_in();
                $this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
	}
	
	function index()
	{	
	       redirect('dashboard');
	}

        function pendaftaran(){
                $data['title'] = 'Dashboard';
                $data['user'] = $this->user;
                $this->load->view('inc/header',$data);
                $this->load->view('laporan/pendaftaran',$data);
                $this->load->view('inc/footer');
        }
        function cetak_kartu($no_rm = null){
                if (!$no_rm) {
                        redirect('pasien');
                }
                $pdf = new FPDF('P', 'mm','A4');

                $pdf->AddPage();
                $pasien = $this->db->get_where('pasien', ['no_ktp_pasien' => $no_rm])->row();
                if (!$pasien) {
                        redirect('pasien');
                }
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(108,10,'UPT. PUSKESMAS BUHIT',"L R T",1,"C");
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(108,7,'Jl. SIMANINDO KM 2 SAMOSIR',"L R",1,"C");
                $pdf->SetFont('Arial','B',10);
                $pdf->SetFillColor(238, 238, 238);
                $pdf->Cell(108,7,'KARTU PASIEN',"L R T",1,"C",TRUE);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(30,7,'Nama',"L T",0);
                $pdf->Cell(8,7,':',"T",0,'C');
                $pdf->Cell(70,7,$pasien->nama,"R T",1);
                $pdf->Cell(30,7,'No KTP',"L",0);
                $pdf->Cell(8,7,':',0,0,'C');
                $pdf->Cell(70,7,$pasien->no_ktp_pasien,"R",1);
                $pdf->Cell(30,7,'Tanggal Lahir',"L",0);
                $pdf->Cell(8,7,':',0,0,'C');
                $pdf->Cell(70,7,$pasien->tgl_lahir,"R",1);
                $pdf->Cell(30,7,'Alamat',"L B",0);
                $pdf->Cell(8,7,':',"B",0,'C');
                $pdf->Cell(70,7,$pasien->alamat,"B R",1);
                $pdf->SetFillColor(238, 238, 238);
                $pdf->Cell(108,7,'KARTU HARAP DIBAWA JIKA INGIN BEROBAT',"B R L",1,"C",TRUE);
                $pdf->Output('Kartu_berobat'.$no_rm.'.pdf' , 'I' );
        }

        function cetak_resep($no_rm = null){
                if (!$no_rm) {
                        redirect('pemeriksaan');
                }
                $pdf = new FPDF('P', 'mm','A4');

                $pdf->AddPage();
                $resep_obat = $this->db->get_where('resep_obat', ['no_rm' => $no_rm])->result();
                if (!$resep_obat) {
                        redirect('pemeriksaan');
                }
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(140,10,'UPT. PUSKESMAS BUHIT',"L R T",1,"C");
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(140,7,'Jl. SIMANINDO KM 2 SAMOSIR',"L R",1,"C");
                $pdf->SetFont('Arial','B',10);
                $pdf->SetFillColor(238, 238, 238);
                $pdf->Cell(140,7,'RESEP OBAT',"L R T",1,"C",TRUE);
                $pdf->SetFont('Arial','B',9);
                $pdf->Cell(6,7,'no',1,0,'C');
                $pdf->Cell(20,7,'No Rm',1,0,'C');
                $pdf->Cell(60,7,'Nama Obat',1,0,'C');
                $pdf->Cell(14,7,'Jumlah',1,0,'C');
                $pdf->Cell(40,7,'Pemakaiaan',1,1,'C');
                $pdf->SetFont('Arial','',8);

                $no=1;
                foreach ($resep_obat as $data){
                        $pdf->Cell(6,7,$no,1,0,'C');
                        $pdf->Cell(20,7,$data->no_rm,1,0,'C');
                        $pdf->Cell(60,7,$data->nama_obat,1,0);
                        $pdf->Cell(14,7,$data->jumlah,1,0,'C');
                        $pdf->Cell(40,7,'',1,1);
                $no++;
                }
                $pdf->Output('Resep_obat'.$no_rm.'.pdf' , 'I' );
        }
        
}
