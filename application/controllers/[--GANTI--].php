<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class [--GANTI--] extends CI_Controller {
	
	var $kelas = "[--GANTI--]";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}

	}

	public function index(){

		$data["rowData"] = $this->M_mst_komplikasi->getAll();
		$data['konten'] = "masterrules";
		$this->load->view('template',$data);
	}

	public function detail($id){

		$data["data"] = $this->M_mst_komplikasi->getDetail($id);
		$data['konten'] = "masterrules";
		$this->load->view('template',$data);
	}

	public function add($idkomplikasi){
		if($this->input->post("btnsubmit")){
			$data["idkomplikasi"] = $idkomplikasi;
			$data["idrefatribut"] = $this->input->post("idrefatribut");
			$data["point"] = $this->input->post("point");
			$this->M_rules->add($data);
			redirect($this->kelas);
		}

		$data['rowKomplikasi'] = $this->M_mst_komplikasi->getDetail($idkomplikasi);
		$data['rowAtribut'] = $this->M_mst_atribut->getAll();
		$data['konten'] = "masterrules_add";
		$this->load->view('template',$data);
	}

	public function update($id){
		if($this->input->post("btnsubmit")){
			$data["idrefatribut"] = $this->input->post("idrefatribut");
			$data["idkomplikasi"] = $this->input->post("idkomplikasi");
			$data["point"] = $this->input->post("point");
			$this->M_rules->update($id,$data);
			redirect($this->kelas);
		}

		$data["data"] = $this->M_mst_komplikasi->getDetail($id);
		$data['konten'] = "masterrules";
		$this->load->view('template',$data);
	}

	public function delete($id){		

		$this->M_rules->delete($id);
		redirect($this->kelas);
	}
}
