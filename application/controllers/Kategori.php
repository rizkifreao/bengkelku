<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	
	var $kelas = "Kategori";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}

	}

	public function index(){
		$data["rowData"] = $this->M_mst_kategori->getAll();
		$data['konten'] = "kategori/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_mst_kategori->getDetail($id);
	    echo json_encode( $rowData );
	}

	public function add(){
		$id = $this->input->post("kategoriid");
		$data["nama"] = $this->input->post("nama");
		
		if($id) 
			$this->M_mst_kategori->update($id,$data);
		else 
			$this->M_mst_kategori->add($data);

		redirect($this->kelas);
	}

	public function delete($id){		
		$this->M_mst_kategori->delete($id);
		redirect($this->kelas);
	}
}
