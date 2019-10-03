<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
	
	var $kelas = "Pelanggan";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}
	}

	public function index(){
		$data["rowData"] = $this->M_pelanggan->getAll();
		$data['konten'] = "pelanggan/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
		$data["data"] = $this->M_pelanggan->getDetail($id);
		$data["rowData"] = $this->M_workorder->getAllBy("pelangganid = $id");
		$data['konten'] = "pelanggan/detail";
		$this->load->view('template',$data);
	}

	public function detailJson($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_pelanggan->getDetail($id);
	    echo json_encode( $rowData );
	}

	public function add(){
		$id = $this->input->post("pelangganid");
		$data["nama_pemilik"] = $this->input->post("nama_pemilik");
		$data["notelp"] = $this->input->post("notelp");
		$data["alamat"] = $this->input->post("alamat");
		$data["nopolisi"] = $this->input->post("nopolisi");
		$data["merkid"] = $this->input->post("merkid");
		$data["jenisid"] = $this->input->post("jenisid");
		
		if($id) 
			$this->M_pelanggan->update($id,$data);
		else 
			$this->M_pelanggan->add($data);

		redirect($this->kelas);
	}

	public function delete($id){		
		$this->M_pelanggan->delete($id);
		redirect($this->kelas);
	}
}
