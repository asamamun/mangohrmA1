<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_attach_Model extends CI_Model {

    public $table = 'emp_attachment';
    var $column = array('id', 'eid', 'title', 'filename', 'filedesc', 'created');
    var $order = array('id' => 'asc');

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->database();
    }

    public function insertData($data) {
        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function LoadTableData($eid) {
        $query = $this->db->get_where($this->table, array("eid" => $eid));
        return $query->result();
    }

    public function delete_attachment($id) {
        $this->db->select('filename');
        $query = $this->db->get_where($this->table, array("id" => $id));
        if ($query->num_rows() == 1) {
            $this->db->where('id', $id);
            $this->db->delete($this->table);
             return $query->row();
        }
       
    }

}
