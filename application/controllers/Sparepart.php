<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sparepart extends CI_Controller {
	
	var $kelas = "Sparepart";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}
	}

	public function index(){
		$data["rowData"] = $this->M_sparepart->getAll();
		$data['konten'] = "sparepart/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
		$data["data"] = $this->M_sparepart->getDetail($id);
		$data['konten'] = "sparepart/detail";
		$this->load->view('template',$data);
	}

	public function detailJson($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_sparepart->getDetail($id);
	    echo json_encode( $rowData );
	}

	public function add(){
		$id = $this->input->post("sparepartid");
		$data["nama"] = $this->input->post("nama");
		$data["kategoriid"] = $this->input->post("kategoriid");
		$data["jenisid"] = $this->input->post("jenisid");
		$data["satuanid"] = $this->input->post("satuanid");
		$data["hargajual"] = $this->input->post("hargajual");
		
		if($id) 
			$this->M_sparepart->update($id,$data);
		else 
			$this->M_sparepart->add($data);

		redirect($this->kelas);
	}

	public function delete($id){		
		$this->M_sparepart->delete($id);
		redirect($this->kelas);
	}
}
