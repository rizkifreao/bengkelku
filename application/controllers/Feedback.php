<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {
	
	var $kelas = "Feedback";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}

	}

	public function index(){
		$data["rowData"] = $this->M_mst_feedback->getAll();
		$data['konten'] = "feedback/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_mst_feedback->getDetail($id);
	    echo json_encode( $rowData );
	}

	public function add(){
		$id = $this->input->post("mstfeedbackid");
		$data["pertanyaan"] = $this->input->post("pertanyaan");
		
		if($id)
			$this->M_mst_feedback->update($id,$data);
		else 
			$this->M_mst_feedback->add($data);

		redirect($this->kelas);
	}

	public function delete($id){		
		$this->M_mst_feedback->delete($id);
		redirect($this->kelas);
	}
}
