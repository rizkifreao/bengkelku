<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forecast extends CI_Controller {
	
	var $kelas = "Forecast";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}
	}

	public function index($iscetak = 0){
		$rowSparepart = $this->M_sparepart->getAll();

		$arrSparepart = array();

		foreach ($rowSparepart as $row) :
			$sparepart = new stdClass();
			$sparepart->sparepartid = $row->sparepartid;
			$sparepart->nama = $row->nama;
			$sparepart->stokakhir = ($row->stokakhir)?$row->stokakhir:0;
			$sparepart->satuan = $this->M_mst_satuan->getDetail($row->satuanid)->nama;
			$sparepart->safety = $this->calculate($row->sparepartid);
			array_push($arrSparepart, $sparepart);
		endforeach;

		if(!$iscetak){
			$data["rowData"] = $arrSparepart;
			$data['konten'] = "forecast/index";
			$this->load->view('template',$data);
		}
		else{
			$this->cetak($arrSparepart);
		}
	}

	public function cetak($rowData){
        $data['filename'] = "Forecast Sparepart";

		$data["rowData"] = $rowData;

		$data['konten'] = "page/export/sparepart";
        $this->load->view("page/export/templatePdf",$data);
	}

	public function detail($id){
		$data["data"] = $this->M_sparepart->getDetail($id);
		$data['konten'] = "forecast/detail";
		$this->load->view('template',$data);
	}

	public function calculate($id){
		$Z = 1.6;
		$tanggal = date("Y-m-d", strtotime("-31 day"));
		$no = 1;

		// PEMBELIAN
		$pembelian = $this->pembelian($id);

		// PENJUALAN
		$penjualan = $this->penjualan($id, $tanggal);

		$rataLeadtime = $pembelian["rataLeadtime"];
		$sdR = $pembelian["sdR"];

		$rataPenjualan = $penjualan["rataPenjualan"];
		$sdS = $penjualan["sdS"];

		$SS = $Z * sqrt(($rataLeadtime*pow($sdS,2))+(pow($rataPenjualan,2)*pow($sdR,2)));
		$SSbulat = ceil($SS);
		return $SSbulat;
	}

	function pembelian($sparepartid){
		$queryLead = "SELECT
		        a.waktu
		        FROM
		        mst_tipe_pelayanan AS a
		        INNER JOIN mst_pelayanan AS b ON b.tipepelayananid = a.tipepelayananid
		        INNER JOIN mst_pelayanan_detail AS c ON c.pelayananid = b.pelayananid
		        INNER JOIN sparepart AS d ON c.sparepartid = d.sparepartid
		        WHERE
		        d.sparepartid = $sparepartid
		      ";

		$waktu = ($this->db->query($queryLead)->row())?$this->db->query($queryLead)->row()->waktu:0;
		$totalLeadtime = 0;
		$totalFrekuensi = 0;
		$totalFxd = 0;

		for ($i = $waktu ; $i<= $waktu+3 ; $i++) :
			$queryJml = "SELECT
					        COUNT(leadtime) AS jml
					      FROM
					        (
					          SELECT
					            a.pembelianid,
					            a.tanggal,
					            a.tanggal_datang,
					            DATEDIFF(a.tanggal_datang, a.tanggal) AS leadtime,
					            b.pembeliandetailid,
					            b.sparepartid
					          FROM
					            pembelian a
					          INNER JOIN pembelian_detail b ON b.pembelianid = a.pembelianid
					          WHERE
					            b.sparepartid = $sparepartid
					          ORDER BY
					            pembelianid DESC
					          LIMIT 8
					        ) AS beli
					      WHERE
					        leadtime = $i
		      ";
			$frekuensiBeli = $this->db->query($queryJml)->row()->jml;
			$tableBeli[$i] = $frekuensiBeli;
			$totalLeadtime += ($i*$frekuensiBeli);
			$totalFrekuensi += $frekuensiBeli;
		endfor;
		// $rataLeadtime = $totalLeadtime/4;
		$rataLeadtime = round($totalLeadtime/8,2);

		// DRAW TABLE
		foreach ($tableBeli as $beli) :
			$frekuensiBeli = $beli;
			$deviasi = $rataLeadtime-$waktu;
			$dedev = pow($deviasi,2);
			$fxd = $frekuensiBeli*$dedev;
			$totalFxd += $fxd;
		endforeach;

		$sdR = 0;
		if($totalFrekuensi>1){
			$sdR = round(sqrt($totalFxd/($totalFrekuensi-1)),2);
		}
		
		$data["rataLeadtime"] = $rataLeadtime;
		$data["sdR"] = $sdR;
		return $data;
	}

	function penjualan($sparepartid, $tanggal){
	  $arrayJual = array();
      for ($i=1; $i <= 30; $i++) :
        $tanggal = date("Y-m-d", strtotime("1 day", strtotime($tanggal)));
        $queryPenjualan="SELECT SUM(qty) as jumlah, sparepartid from(
                  SELECT
                    c.nama,
                    b.detailwoid,
                    b.sparepartid,
                    a.workorderid,
                    b.qty,
                    a.`status`,
                    d.penjualanid,
                    d.woid,
                    d.tanggal_faktur
                  FROM
                    sparepart AS c ,
                    workorder AS a
                  INNER JOIN workorder_detail AS b ON b.workorderid = a.workorderid
                  INNER JOIN penjualan AS d ON d.woid = a.workorderid
                  WHERE
                    b.sparepartid = c.sparepartid
                    AND b.sparepartid = $sparepartid
                    AND tanggal_faktur = '$tanggal'
                ) as penjualan
            ";
        $rowPenjualan = $this->db->query($queryPenjualan)->row();
        $frekuensiJual = ($rowPenjualan->jumlah)?$rowPenjualan->jumlah:0;
        array_push($arrayJual, $frekuensiJual);
      endfor;

		$countJual = 0;
		$totalPenjualan = 0;
		$totalPengamatan = 26;
		$totalFxdJual = 0;
		$rataPenjualan = 0;

		$arrayCountJual = array_count_values(($arrayJual));
		foreach ($arrayCountJual as $key => $value) :
			if($key != 0):
			  $totalPenjualan += ($key*$value);
			  $countJual++;
			endif;
		endforeach;
		
		if($totalPenjualan != 0 && $countJual != 0)
			$rataPenjualan = round($totalPenjualan/26,2);
		// $rataPenjualan = $totalPenjualan/$countJual;

		foreach ($arrayCountJual as $key => $value) :
			if($key != 0):
			  $deviasiJual = $rataPenjualan-$key;
			  $dedevJual = pow($deviasiJual,2);
			  $fxdJual = $value*$dedevJual;
			  $totalFxdJual += $fxdJual;
			endif;
		endforeach;

		$sdS = round(sqrt($totalFxdJual/($totalPengamatan-1)),2);

		$data["rataPenjualan"] = $rataPenjualan;
		$data["sdS"] = $sdS;
		return $data;
	}
}
