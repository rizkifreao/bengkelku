<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipePelayanan extends CI_Controller {
	
	var $kelas = "TipePelayanan";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}

	}

	public function index(){
		$data["rowData"] = $this->M_mst_tipe_pelayanan->getAll();
		$data['konten'] = "tipepelayanan/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_mst_tipe_pelayanan->getDetail($id);
	    echo json_encode( $rowData );
	}

	public function add(){
		$id = $this->input->post("tipepelayananid");
		$data["nama"] = $this->input->post("nama");
		$data["waktu"] = $this->input->post("waktu");
		
		if($id)
			$this->M_mst_tipe_pelayanan->update($id,$data);
		else 
			$this->M_mst_tipe_pelayanan->add($data);

		redirect($this->kelas);
	}

	public function delete($id){		
		$this->M_mst_tipe_pelayanan->delete($id);
		redirect($this->kelas);
	}
}
