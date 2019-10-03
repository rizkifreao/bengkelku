<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class M_mst_pelayanan_detail extends CI_Model {

    var $table_name = "mst_pelayanan_detail";
    var $pk = "pelayanandetailid";
    var $fk = "pelayananid";

    function getAll() {
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
    
    function getAllBy($kondisi) {
        $query = $this->db->get_where($this->table_name, $kondisi);
        return $query->result();
    }
    
    function getAllByFk($id) {
        $this->db->where($this->fk, $id);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
    
    function getAllByParent($merkid, $jenisid, $pelayananid) {
        $this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->join("sparepart c", "c.sparepartid = ".$this->table_name.".sparepartid");
        $this->db->where($this->table_name.".merkid", $merkid);
        $this->db->where($this->table_name.".jenisid", $jenisid);
        $this->db->where($this->table_name.".pelayananid", $pelayananid);
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result();
    }
    
    function getDetail($id) {
        $this->db->where($this->pk, $id);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function add($data) {
        $this->db->insert($this->table_name, $data);
    }
    
    function update($id, $data) {
        $this->db->where($this->pk, $id);
        $this->db->update($this->table_name, $data);
    }
    
    function delete($id) {
        $this->db->where($this->pk, $id);
        $this->db->delete($this->table_name);
    }
}