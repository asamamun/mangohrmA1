<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Leave_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_leavetype() {
        $this->db->select('id, leavetype');
        $query = $this->db->get('leavetype');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $data['none']['NO Data found'];
        }
    }

    public function add_leave($data) {

        $this->db->insert('emp_leave', $data);
    }

    public function gel_all_value() {

        $this->db->select('leavetype.leavetype,leavetype.desc,emp_leave.*');
        $this->db->from('emp_leave');
        $this->db->join('leavetype', 'leavetype.id = emp_leave.leave_id');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function empid_check($empid) {
        $query = $this->db->get_where('employee', array('empid' => $empid));
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    /*Edit emp_leave */
    public function get_by_leave_id($id) {

        $this->db->select('leavetype.leavetype,leavetype.desc,emp_leave.*');
        $this->db->from('emp_leave');
        $this->db->join('leavetype', 'leavetype.id = emp_leave.leave_id');
        $this->db->where('emp_leave.id', $id); 
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_leave($id) {
        // $this->db->where('id', $id);
        $this->db->query("delete from emp_leave where `id`=$id");
    }
 public function update_leave_table($id,$data) {
    //public function update_leave_table($id) {
        $this->db->where('id', $id);
        $this->db->update('emp_leave', $data);
         //$this->db->query("update emp_leave set eid='$eid',leave_id='$leave_id',leave_from='$stdate',leave_to='$endate',leave_days='$leave_days',approved_by='$approved_by',approved='$approved',comments='$comments',created='$created' where id='$id'");
        return $this->db->affected_rows();
    }

}
