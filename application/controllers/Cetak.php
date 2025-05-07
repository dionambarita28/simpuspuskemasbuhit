
<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Cetak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->add_package_path( APPPATH . 'third_party/fpdf');
        $this->load->library('pdf');
        $this->load->model('Puskesmas','puskes');

    }

	function index()
	{
        
	}

    function laporan_pendaftaran()
    {
        $this->pdf = new Pdf();
        $this->pdf->Add_Page('P','A4',0);
        $this->pdf->AliasNbPages();
        $this->pdf->SetLeftMargin(20);
        $this->pdf->SetRightMargin(20);

        $this->pdf->SetFont('Arial','B',16);
        $this->pdf->Cell(0,7,'Laporan Pasien',0,1,'C');
        $this->pdf->Ln();

        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(8,7,'No',1,0,'C');
        $this->pdf->Cell(20,7,'No Daftar',1,0,'C');
        $this->pdf->Cell(40,7,'No KTP',1,0,'C');
        $this->pdf->Cell(65,7,'Nama Pasien',1,0,'C');
        $this->pdf->Cell(25,7,'Tgl Daftar',1,0,'C');
        $this->pdf->Cell(0,7,'Jenis',1,1,'C');

        $this->pdf->SetFont('Arial','',10);
        if ($this->input->post('seluruh')) {
            $this->db->order_by("id", "DESC");
            $pendaftaran = $this->db->get('pendaftaran')->result();
            $no=1;
            foreach ($pendaftaran as $data){
                $this->pdf->Cell(8,7,$no,1,0,'C');
                $this->pdf->Cell(20,7,$data->no_pendaftaran,1,0);
                $this->pdf->Cell(40,7,$data->no_ktp_pasien,1,0);
                $this->pdf->Cell(65,7,$data->nama_pasien,1,0);
                $this->pdf->Cell(25,7,$data->tgl_berobat,1,0);
                $this->pdf->Cell(0,7,$data->jenis_pasien,1,1);
                $no++;
            }
        }else{
            if ($this->input->post('bulan')) {
                $this->db->select('*');
                $this->db->from('pendaftaran');
                $this->db->like('tgl_berobat',$this->input->post('bulan'));
                $this->db->order_by("id", "DESC");
                $pendaftaran = $this->db->get()->result();
                $no=1;
                foreach ($pendaftaran as $data){
                    $this->pdf->Cell(8,7,$no,1,0,'C');
                    $this->pdf->Cell(35,7,$data->no_ktp_pasien,1,0);
                    $this->pdf->Cell(70,7,$data->nama_pasien,1,0);
                    $this->pdf->Cell(25,7,$data->tgl_berobat,1,0);
                    $this->pdf->Cell(0,7,$data->jenis_pasien,1,1);
                    $no++;
                }
            }
        }
        $this->pdf->Output( 'laporan_pendaftaran.pdf' , 'I' );
    }

    function laporan_pasien()
    {
        $this->pdf = new Pdf();
        $this->pdf->Add_Page('P','A4',0);
        $this->pdf->AliasNbPages();
        $this->pdf->SetLeftMargin(20);
        $this->pdf->SetRightMargin(20);

        $this->pdf->SetFont('Arial','B',16);
        $this->pdf->Cell(0,7,'Laporan Pasien',0,1,'C');
        $this->pdf->Ln();

        $this->pdf->SetFont('Arial','B',8);
        $this->pdf->Cell(8,7,'No',1,0,'C');
        $this->pdf->Cell(40,7,'No KTP',1,0,'C');
        $this->pdf->Cell(60,7,'Nama Pasien',1,0,'C');
        $this->pdf->Cell(30,7,'No Hp',1,0,'C');
        $this->pdf->Cell(15,7,'Kelamin',1,0,'C');
        $this->pdf->Cell(20,7,'Tgl Lahir',1,1,'C');

        $this->pdf->SetFont('Arial','',8);
        $this->db->order_by("id", "DESC");
        $pasien = $this->db->get('pasien')->result();
        $no=1;
        foreach ($pasien as $data){
            $this->pdf->Cell(8,7,$no,1,0,'C');
            $this->pdf->Cell(40,7,$data->no_ktp_pasien,1,0);
            $this->pdf->Cell(60,7,$data->nama,1,0);
            $this->pdf->Cell(30,7,$data->no_hp,1,0);
            $this->pdf->Cell(15,7,$data->kelamin,1,0);
            $this->pdf->Cell(20,7,$data->tgl_lahir,1,1);
            $no++;
        }
        $this->pdf->Output( 'laporan_pasien.pdf' , 'I' );
    }

    
    function info_rm($id = null)
    {
        if (!$id) {
            redirect('dashboard');
        }
        $rekam_medis = $this->db->get_where('rekam_medis', ['id' => $id])->row();
        if (!$rekam_medis) {
            redirect('dashboard');
        }
        $dokter_tujuan = $this->db->get_where('dokter', ['dokter_id' => $rekam_medis->dokter_id])->row()->nama_dokter;
        $resep_obat = $this->db->get_where('resep_obat', ['id_rm' => $id])->result();
        $no_rm = $rekam_medis->no_rm;
        $no_ktp_pasien = $rekam_medis->no_ktp_pasien;
        $pasien = $this->db->get_where('pasien', ['no_ktp_pasien' => $no_ktp_pasien])->row();
        if (!$pasien) {
            redirect('dashboard');
        }
        $lab = $this->db->get_where('laboratorium', ['no_rm' => $no_rm])->row();
        $pemeriksaan = $this->db->get_where('pemeriksaan', ['no_rm' => $no_rm])->row();
        $rujuk_external = $this->db->get_where('rujuk_external', ['no_rm' => $no_rm])->num_rows();
        $rujuk_internal = $this->db->get_where('rujuk_internal', ['no_rm' => $no_rm])->num_rows();
        if ($lab) {
            $diagnosa_lab = $lab->keterangan_labor;
        }else{
            $diagnosa_lab = "-";
        }
        if ($pemeriksaan) {
            $diagnosa = $pemeriksaan->diagnosa_penyakit;
            $tgl_p = $pemeriksaan->tgl_pemeriksaan;
        }else{
            $diagnosa = "-";
            $tgl_p = "-";
        }
        if ($rujuk_external > 0) {
            $rujuk_e = "Pernah";
        }else{
            $rujuk_e = "-";
        }
        if ($rujuk_internal > 0) {
            $rujuk_i = "Pernah";
        }else{
            $rujuk_i = "-";
        }

        $this->pdf = new Pdf();
        $this->pdf->Add_Page('P','A4',0);
        $this->pdf->AliasNbPages();
        $this->pdf->SetLeftMargin(20);
        $this->pdf->SetRightMargin(20);

        $this->pdf->SetFont('Arial','B',16);
        $this->pdf->Cell(0,7,'Informasi Rekam Medis',0,1,'C');
        $this->pdf->Ln();

        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(35,7,"No Rekam Medis",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$no_rm,0,1);
        $this->pdf->Cell(35,7,"Nama Pasien",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$pasien->nama,0,1);
        $this->pdf->Cell(35,7,"No KK",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$pasien->no_ktp_pasien,0,1);
        $this->pdf->Cell(35,7,"Alamat",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->MultiCell(45,7,$pasien->alamat,0,1);
        $this->pdf->Cell(35,7,"TTL",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$pasien->tgl_lahir,0,1);
        $this->pdf->Cell(35,7,"Jenis Kelamin",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$pasien->kelamin,0,1);
        $this->pdf->Cell(35,7,"Diagnosa Labor",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->MultiCell(45,7,$diagnosa_lab,0,1);
        
        $this->pdf->SetXY(120,57);
        $this->pdf->Cell(27,7,"Rujuk Internal",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(0,7,$rujuk_i,0,1);
        $this->pdf->SetXY(120,64);
        $this->pdf->Cell(27,7,"Rujuk External",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(0,7,$rujuk_e,0,1);
        $this->pdf->SetXY(120,71);
        $this->pdf->Cell(35,7,"Diagnosa:",0,1);
        $this->pdf->SetFont('Arial','',10);
        $this->pdf->SetXY(125,78);
        $this->pdf->MultiCell(65,7,$diagnosa,0,'L');
        $this->pdf->Ln(50);

        $this->pdf->SetFont('Arial','B',14);
        $this->pdf->Cell(0,7,'Riwayat Pemberian Obat',0,1,'C');
        $this->pdf->Ln(5);

        $this->pdf->SetFont('Arial','',10);
        $this->pdf->Cell(15,7,"Oleh :",0,0);

        $this->pdf->Cell(90,7,$dokter_tujuan,0,0);
        $this->pdf->Cell(35,7,"Tgl Pemeriksaan :",0,0,'C');
        $this->pdf->Cell(0,7,$tgl_p,0,1);

        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(8,7,"No",1,0,'C');
        $this->pdf->Cell(35,7,"No RM",1,0);
        $this->pdf->Cell(70,7,"Nama Obat",1,0);
        $this->pdf->Cell(25,7,"Jumlah",1,0);
        $this->pdf->Cell(0,7,"ID Obat",1,1);

        $this->pdf->SetFont('Arial','',10);

        $no=1;
        foreach ($resep_obat as $resep){
            $this->pdf->Cell(8,7,$no,1,0,'C');
            $this->pdf->Cell(35,7,$resep->no_rm,1,0);
            $this->pdf->Cell(70,7,$resep->nama_obat,1,0);
            $this->pdf->Cell(25,7,$resep->jumlah,1,0);
            $this->pdf->Cell(0,7,$resep->id_obat,1,1);
            $no++;
        }
        $this->pdf->Output( 'rekam_medis'.$no_rm.'.pdf' , 'I' );
    }


// error cetak (PR)
    function riwayat($no_ktp_pasien = null)
    {
        error_reporting(0);
        if (!$no_ktp_pasien) {
            error_reporting(0);
            redirect('rekam_medis/riwayat_rekam');
        }
        // $rekam_medis = $this->db->get_where('rekam_medis', ['no_ktp_pasien' => $no_ktp_pasien])->result();
        $rekam_medis = $this->puskes->riwayat($no_ktp_pasien)->result();
        //var_dump($rekam_medis);die();
        $rmr = $this->db->get_where('rekam_medis', ['no_ktp_pasien' => $no_ktp_pasien])->num_rows();
        $klinik = $this->puskes->list_poli();
        $dokter = $this->puskes->list_dokter();
        $pasien = $this->db->get_where('pasien', ['no_ktp_pasien' => $no_ktp_pasien])->row();
       

        $this->pdf = new Pdf();
        $this->pdf->Add_Page('P','A4',0);
        $this->pdf->AliasNbPages();
        $this->pdf->SetLeftMargin(20);
        $this->pdf->SetRightMargin(20);

        $this->pdf->SetFont('Arial','B',16);
        $this->pdf->Cell(0,7,'Riwayat Pasien',0,1,'C');
        $this->pdf->Ln();

        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(35,7,"Nama Pasien",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$pasien->nama,0,1);
        $this->pdf->Cell(35,7,"No KK",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$pasien->no_ktp_pasien,0,1);
        $this->pdf->Cell(35,7,"Jenis Pasien",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$pasien->jenis_pasien,0,1);
        $this->pdf->Cell(35,7,"Alamat",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->MultiCell(45,7,$pasien->alamat,0,1);
        $this->pdf->Cell(35,7,"TTL",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$pasien->tgl_lahir,0,1);
        $this->pdf->Cell(35,7,"Jenis Kelamin",0,0);
        $this->pdf->Cell(6,7,":",0,0);
        $this->pdf->Cell(45,7,$pasien->kelamin,0,1);
        $this->pdf->Ln(20);

        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(8,7,"No",1,0,'C');
        $this->pdf->Cell(35,7,"Tgl Rekam",1,0);
        $this->pdf->Cell(35,7,"No RM",1,0);
        $this->pdf->Cell(45,7,"Klinik",1,0);
        $this->pdf->Cell(45,7,"Dokter",1,1);

        $this->pdf->SetFont('Arial','',10);
        if ($rmr > 0) {
            $no=1;
            foreach ($rekam_medis as $rekam){
                $this->pdf->Cell(8,7,$no,1,0,'C');
                $this->pdf->Cell(35,7,$rekam->tgl_rekam,1,0);
                $this->pdf->Cell(35,7,$rekam->no_rm,1,0);
                $this->pdf->Cell(45,7,$rekam->nama_klinik,1,0);
                $this->pdf->Cell(45,7,$rekam->nama_dokter,1,0);
                // foreach ($klinik as $kl){
                //     $kli = $kl['nama_klinik'];
                // }
                // if ($rekam->poli_id == $kl['id']) {
                //         $this->pdf->Cell(45,7,$kli,1,0);
                //     }
                // foreach ($dokter as $dr){
                //     if ($rekam->dokter_tujuan == $dr['id']) {
                //         $this->pdf->Cell(45,7,$dr['nama_dokter'],1,0);
                //     }
                // if($rekam->poli_id == $klinik['id'])
                // {
                //     $this->pdf->Cell(45,7,$klinik['nama_kelinik'],1,0);
                // }
                // // $this->pdf->Cell(45,7,($rekam->poli_id == $dokter['nama_kelinik'])? 'selected' : '',1,0);
                // $this->pdf->Cell(45,7,($rekam->dokter_id == $dokter['nama_dokter'])? 'selected' : '',1,0);
                }
                $no++;
            // }
        }else{
            $this->pdf->Cell(0,7,"TIDAK ADA REKAMAN",1,0,'C');
        }
        $this->pdf->Output( 'Riwayat_'.$no_ktp_pasien.'.pdf' , 'I' );
    }

    function cetak_rujuk($id_rujuk = null){
            if (!$id_rujuk) {
                    redirect('rujukan');
            }
            $this->pdf = new Pdf();

            $this->pdf->Add_Page('P','A4',0);
            $this->pdf->AliasNbPages();
            $this->pdf->SetLeftMargin(20);
            $this->pdf->SetRightMargin(20);

            $this->pdf->SetFont('Arial','B',16);
            $this->pdf->Cell(0,7,'Surat Rujukan',0,1,'C');
            $this->pdf->Ln();
            $rujuk = $this->db->get_where('rujuk_external', ['id_rujuk' => $id_rujuk])->row();
            $dokter_perujuk = $this->db->get_where('dokter', ['dokter_id' => $rujuk->dokter_id])->row();
            $no_rm = $this->db->get_where('rekam_medis', ['no_rm' => $rujuk->no_rm])->row();
            $resep = $this->db->get_where('resep_obat', ['no_rm' => $rujuk->no_rm])->result();
            $pemeriksaan = $this->db->get_where('pemeriksaan', ['no_rm' => $rujuk->no_rm])->row();
            $pasien = $this->db->get_where('pasien', ['no_ktp_pasien' => $no_rm->no_ktp_pasien])->row();
            if (!$rujuk) {
                    redirect('rujukan');
            }
            
            $this->pdf->SetFont('Arial','',12);
            $this->pdf->Cell(20,7,'Yth. Dokter',0,0);
            $this->pdf->Cell(8,7,':',0,0,'C');
            $this->pdf->Cell(0,7,$rujuk->dokter_tujuan,0,1);
            $this->pdf->Cell(20,7,'Di RSUD',0,0);
            $this->pdf->Cell(8,7,':',0,0,'C');
            $this->pdf->Cell(0,7,$rujuk->rs_tujuan,0,1);
            $this->pdf->Ln(15);
            $this->pdf->Cell(0,7,'Mohon pemeriksaan dan pengobatan lebih lanjut terhadap penderita.',0,1,"C");
            $this->pdf->Cell(28,9,'Nama Pasien',0,0);
            $this->pdf->Cell(8,9,':',0,0,'C');
            $this->pdf->Cell(0,9,$pasien->nama,0,1);
            $this->pdf->Cell(28,9,'Jenis Kelamin',0,0);
            $this->pdf->Cell(8,9,':',0,0,'C');
            $this->pdf->Cell(0,9,$pasien->kelamin,0,1);
            $this->pdf->Cell(28,9,'Tgl Lahir',0,0);
            $this->pdf->Cell(8,9,':',0,0,'C');
            $this->pdf->Cell(0,9,$pasien->tgl_lahir,0,1);
            $this->pdf->Cell(28,9,'Alamat',0,0);
            $this->pdf->Cell(8,9,':',0,0,'C');
            $this->pdf->Cell(0,9,$pasien->alamat,0,1);
            $this->pdf->Cell(28,9,'Dokter Perujuk',0,0);
            $this->pdf->Cell(8,9,':',0,0,'C');
            $this->pdf->Cell(0,9,$dokter_perujuk->nama_dokter,0,1);
            $this->pdf->Ln(15);
            $this->pdf->Cell(45,7,'Diagnosa Sementara:',0,0);
            $this->pdf->MultiCell(0,7,$pemeriksaan->diagnosa_penyakit,0,1);
            $this->pdf->Ln(5);
            $this->pdf->Cell(45,7,'Obat Yg Diberikan:',0,1);
                $no=1;
                foreach ($resep as $data){
                    $this->pdf->Cell(35,7,"",0,0 ,'C');
                    $this->pdf->Cell(10,7,$no.'.',0,0 ,'C');
                    $this->pdf->Cell(0,7,$data->nama_obat,0,1);
                    $no++;
                }
            $this->pdf->Ln(5);

            $this->pdf->MultiCell(0,7,'Demikian surat rujukan ini kami kirim, kami moho balasan atas surat rujukan ini. Atas perhatian Bapak/Ibu kami ucapkan terima kasih.',0,1);
            $this->pdf->Ln(15);

            $this->pdf->Cell(120,7,'',0,0);
            $this->pdf->Cell(0,7,'Hormat Kami',0,1,"C");
            $this->pdf->Ln(10);
            $this->pdf->Cell(120,7,'',0,0);
            $this->pdf->Cell(0,7,'(..................................)',0,1,"C");
            $this->pdf->Output('Surat_rujukan'.$id_rujuk.'.pdf' , 'I' );
        }
}

/*
* application/controllers/Testpdf.php
*/
