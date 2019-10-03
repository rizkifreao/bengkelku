<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelayanan extends CI_Controller {
	
	var $kelas = "Pelayanan";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}

	}

	public function index(){
		$data["rowData"] = $this->M_mst_pelayanan->getAll();
		$data['konten'] = "pelayanan/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
		$data["data"] = $this->M_mst_pelayanan->getDetail($id);
		$data["rowData"] = $this->M_mst_pelayanan_detail->getAllByFk($id);
		$data['konten'] = "pelayanan/detail";
		$this->load->view('template',$data);
	}

	public function detailJson($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_mst_pelayanan->getDetail($id);
	    echo json_encode( $rowData );
	}

	public function add(){
		$id = $this->input->post("pelayananid");
		$data["nama"] = $this->input->post("nama");
		$data["tipepelayananid"] = $this->input->post("tipepelayananid");
		
		if($id)
			$this->M_mst_pelayanan->update($id,$data);
		else 
			$this->M_mst_pelayanan->add($data);

		redirect($this->kelas);
	}

	public function delete($id){		
		$this->M_mst_pelayanan->delete($id);
		redirect($this->kelas);
	}

	public function deleteDetail($id){		
		$pelayananid = $this->M_mst_pelayanan_detail->getDetail($id)->pelayananid;
		$this->M_mst_pelayanan_detail->delete($id);
		redirect($this->kelas."/detail/$pelayananid");
	}
}
