<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merk extends CI_Controller {
	
	var $kelas = "Merk";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}

	}

	public function index(){
		$data["rowData"] = $this->M_mst_merk->getAll();
		$data['konten'] = "merk/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_mst_merk->getDetail($id);
	    echo json_encode( $rowData );
	}

	public function add(){
		$id = $this->input->post("merkid");
		$data["nama"] = $this->input->post("nama");
		
		if($id)
			$this->M_mst_merk->update($id,$data);
		else 
			$this->M_mst_merk->add($data);

		redirect($this->kelas);
	}

	public function delete($id){		
		$this->M_mst_merk->delete($id);
		redirect($this->kelas);
	}
}
