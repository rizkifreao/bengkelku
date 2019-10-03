<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {
	
	var $kelas = "Jenis";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}

	}

	public function index(){
		$data["rowData"] = $this->M_mst_jenis->getAll();
		$data['konten'] = "jenis/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_mst_jenis->getDetail($id);
	    echo json_encode( $rowData );
	}

	public function add(){
		$id = $this->input->post("jenisid");
		$data["nama"] = $this->input->post("nama");
		
		if($id) 
			$this->M_mst_jenis->update($id,$data);
		else 
			$this->M_mst_jenis->add($data);

		redirect($this->kelas);
	}

	public function delete($id){		
		$this->M_mst_jenis->delete($id);
		redirect($this->kelas);
	}
}
