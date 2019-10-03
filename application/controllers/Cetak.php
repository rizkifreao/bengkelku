<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

	function __construct(){
		parent::__construct();
		// if (!$this->session->userdata("id")){
		// 	redirect("Login");
		// }

		$id = $this->session->userdata("id");
		$this->user = $this->M_user->getDetail($id);
	}

	public function faktur($id){
        $data['filename'] = "Faktur";

		$data["data"] = $faktur = $this->M_penjualan->getDetailByFk($id);
		$data["rowDetailWo"] = $this->M_workorder_detail->getAllBy("workorderid = ".$id);
		$data["rowWo"] = $wo = $this->M_workorder->getDetail($id);
		$data["rowFeedback"] = $this->M_feedback->getAllBy("penjualanid = ".$faktur->penjualanid);
		$data["rowCust"] = $this->M_pelanggan->getDetail($wo->pelangganid);

		$data['konten'] = "page/export/faktur";
		// echo json_encode($data);
        $this->load->view("page/export/templatePdf",$data);
	}

	public function laporanfaktur(){
        $data['filename'] = "Laporan Faktur";

		$data["rowData"] = $this->M_penjualan->getAll();

		$data['konten'] = "page/export/laporanfaktur";
        $this->load->view("page/export/templatePdf",$data);
	}

	public function pelanggan($id){
        $data['filename'] = "Pelanggan";

		$data["data"] = $this->M_pelanggan->getDetail($id);
		$data["rowData"] = $this->M_workorder->getAllBy("pelangganid = $id");

		$data['konten'] = "page/export/pelanggan";
        $this->load->view("page/export/templatePdf",$data);
	}

	public function workorder($id){
        $data['filename'] = "Workorder";

		$data["data"] = $wo = $this->M_workorder->getDetail($id);
		$data["rowData"] = $this->M_workorder_detail->getAllBy("workorderid = ".$id);
		$data["rowCust"] = $this->M_pelanggan->getDetail($wo->pelangganid);

		$data['konten'] = "page/export/workorder";
        $this->load->view("page/export/templatePdf",$data);
	}

	public function pembelian($id){
        $data['filename'] = "Pembelian";

		$data["data"] = $this->M_pembelian->getDetail($id);
		$data["rowData"] = $this->M_pembelian_detail->getAllBy("pembelianid = ".$id);

		$data['konten'] = "page/export/pembelian";
        $this->load->view("page/export/templatePdf",$data);
	}
}
