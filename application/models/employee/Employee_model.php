<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {

    var $table = 'employee';
    var $column = array('empid', 'fname', 'mname', 'lname', 'dln', 'gender', 'maritalstatus', 'phone', 'homephone', 'email', 'blood', 'nid', 'fathersname', 'mothersname', 'bankname', 'bankaccno', 'bankacctype'); //set column field database for order and search
    var $order = array('empid' => 'desc'); // default order 

    public function __construct() {
        parent::__construct();
        $this->load->database();
         $this->load->library('session');
    }

    private function _get_datatables_query() {

        $this->db->from($this->table);
        $this->db->where("deleted", 0);
        $i = 0;

        foreach ($this->column as $item) { // loop column 
            if (isset($_POST['search']['value'])) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->where('deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id) {
        $this->db->from($this->table);
        $this->db->where('empid', $id);
        $query = $this->db->get();
        return $query->row();
    }
	
    public function get_by_only_id($id) {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }	

    public function emp_save($data) {
        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function emp_update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();

    }

    public function delete_by_id($id) {
        $this->db->where('empid', $id);
        $this->db->update($this->table, array('deleted' => '1'));
    }

    public function get_deptname($deptcode) {
        //$this->db->select('deptname');
        //$this->db->select('deptname');
        //$query = $this->db->get();
        //return $query->result();
        //$this->db->where('deptid', $deptcode);
        //$query=$this->db->get('department');
        $query = $this->db->query("select deptname from department where `deptid`= " . $deptcode);
        return $query->row();
    }

    public function load_dept() {
        $this->db->select('deptname, deptid');
        $query = $this->db->get_where("department", array('deleted' => 0));
        return $query->result();
    }

    public function get_desig($desigid) {
        $query = $this->db->query("select designame from designation where `desigid`= " . $desigid);
        return $query->row();
    }

    function getLastInserted() {
        $query = $this->db->query("SELECT MAX(empid) FROM employee");
        $row = $query->row();
        return $row;
    }

}
