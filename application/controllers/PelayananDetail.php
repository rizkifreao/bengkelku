<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PelayananDetail extends CI_Controller {
	
	var $kelas = "PelayananDetail";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}

	}

	public function index(){
		$data["rowData"] = $this->M_mst_pelayanan_detail->getAll();
		$data['konten'] = "pelayanan/detail";
		$this->load->view('template',$data);
	}

	public function all($id,$pelangganid){
	    header('Content-Type: application/json');
		$pelanggan = $this->M_pelanggan->getDetail($pelangganid);
		$rowData = $this->M_mst_pelayanan_detail->getAllByParent($pelanggan->merkid,$pelanggan->jenisid,$id);
		// var_dump($rowData);die;
	    echo json_encode( $rowData );
	}

	public function detail($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_mst_pelayanan_detail->getDetail($id);
	    echo json_encode( $rowData );
	}

	public function add(){
		$detailid = $this->input->post("pelayanandetailid");
		$data["pelayananid"] = $id = $this->input->post("pelayananid");
		$data["merkid"] = $this->input->post("merkid");
		$data["jenisid"] = $this->input->post("jenisid");
		$data["sparepartid"] = $this->input->post("sparepartid");
		if($detailid)
			$this->M_mst_pelayanan_detail->update($detailid,$data);
		else 
			$this->M_mst_pelayanan_detail->add($data);

		redirect("Pelayanan/detail/".$id);
	}

	public function delete($id){		
		$this->M_mst_pelayanan_detail->delete($id);
		redirect($this->kelas);
	}
}
