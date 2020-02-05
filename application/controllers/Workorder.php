<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Workorder
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Rizki Pebrianto <rizkipebrianto96@gmail.com>
 * @param     ...
 * @return    ...
 *
 */

class Workorder extends CI_Controller
{
    
	var $kelas = "Workorder";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}

		$id = $this->session->userdata("id");
		$this->user = $this->M_user->getDetail($id);

	}

	public function index(){
		$data["rowData"] = $this->M_workorder->getAll();
		$data['konten'] = "workorder/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
		$data["data"] = $wo = $this->M_workorder->getDetail($id);
		$data["rowData"] = $this->M_workorder_detail->getAllBy("workorderid = ".$id);
		$data["rowCust"] = $this->M_pelanggan->getDetail($wo->pelangganid);
		$data['konten'] = "workorder/detail";
		$this->load->view('template',$data);
	}

	public function detailJson($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_workorder->getDetail($id);
	    echo json_encode( $rowData );
	}

	public function add(){
		$id = $this->input->post("workorderid");
		$data["userid"] = $this->user->userid;
		$data["nomor"] = $this->nomor("WO");
		$data["pelangganid"] = $this->input->post("pelangganid");
		$data["tanggal_masuk"] = date("Y-m-d H:i:s");
		$data["keluhan"] = $this->input->post("keluhan");
		$data["keterangan"] = $this->input->post("keterangan");
		
		if($id) 
			$this->M_workorder->update($id,$data);
		else 
			$this->M_workorder->add($data);

		redirect($this->kelas);
	}

	public function addDetail(){
		$data["workorderid"] = $workorderid = $this->input->post("workorderid");
		$data["pelayananid"] = $pelayananid = $this->input->post("pelayananid");
		$data["sparepartid"] = $sparepartid = $this->input->post("sparepartid");
		$sparepart = $this->M_sparepart->getDetail($sparepartid);
		
		$data["qty"] = $qty = $this->input->post("qty");
		if($sparepart->stokakhir < $qty){
			$this->session->set_flashdata("warning","Stok <strong>$sparepart->nama</strong> tidak mencukupi");
		}else{
			$data["total"] = $sparepart->hargajual*$qty;
			$this->M_workorder_detail->add($data);
		}

		redirect($this->kelas."/detail/".$workorderid);
	}

	public function save($id){
		// $id = $this->input->post("workorderid");
		$rowDetailWo = $this->M_workorder_detail->getAllBy("workorderid = ".$id);
		$total = 0;

		foreach ($rowDetailWo as $detailWo) {
			//update stok SPAREPART
			$total+=$detailWo->total;
			$sparepart = $this->M_sparepart->getDetail($detailWo->sparepartid);
			$dataSparepart["stokakhir"]= $sparepart->stokakhir - $detailWo->qty;
			$this->M_sparepart->update($detailWo->sparepartid,$dataSparepart);
		}

		//add FAKTUR
		$dataPenjualan["woid"] = $id;
		$dataPenjualan["total"] = $total;
		$dataPenjualan["userid"] = $this->user->userid;
		$dataPenjualan["nomorfaktur"] = $this->nomor("FA");
		// TODO DEV
		// $dataPenjualan["tanggal_faktur"] = date("Y-m-d H:i:s");
		$dataPenjualan["tanggal_faktur"] = $this->input->post("tanggal");
		$this->M_penjualan->add($dataPenjualan);
		
		//update status WO
		$dataWo["status"] = "F";
		// TODO DEV
		// $dataWo["tanggal_keluar"] = date("Y-m-d H:i:s");
		$dataWo["tanggal_keluar"] = $this->input->post("tanggal");
		$this->M_workorder->update($id,$dataWo);

		redirect($this->kelas);
	}

	public function update($id){
		if($this->input->post("btnsubmit")){
			$data["idrefatribut"] = $this->input->post("idrefatribut");
			$this->M_workorder->update($id,$data);
			redirect($this->kelas);
		}
		$data["data"] = $this->M_workorder->getDetail($id);
		$data['konten'] = "workorder/index";
		$this->load->view('template',$data);
	}

	public function batal($id){
		$data["status"] = "NF";
		$this->M_workorder->update($id,$data);
		redirect($this->kelas);
	}

	public function delete($id){		
		$rowWorkorder = $this->M_workorder_detail->getAllBy("workorderid = $id");
		foreach ($rowWorkorder as $row) {
			$this->deleteDetail($row->detailwoid, 1);
		}

		$this->M_workorder->delete($id);
		redirect($this->kelas);
	}

	public function deleteDetail($id, $loop = 0){		
		$workorderid = $this->M_workorder_detail->getDetail($id)->workorderid;
		$this->M_workorder_detail->delete($id);
		if($loop != 1) redirect($this->kelas."/detail/".$workorderid);
	}

	public function nomor($param){
		$max = $this->M_workorder->getMax()->workorderid;
		$nomor = sprintf("%04d",$max);
		return $param.$nomor;
	}

}


/* End of file Workorder.php */
/* Location: ./modules/controllers/Workorder.php */