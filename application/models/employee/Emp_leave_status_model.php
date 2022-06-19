<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_leave_status_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Common_model');
    }

    public function single_leave_status($emp_id_no) {
        $query = $this->db->query("SELECT leavetype.leavetype, sum(emp_leave.leave_days) as leave_days FROM `emp_leave`, leavetype, employee WHERE emp_leave.leave_id = leavetype.id and emp_leave.eid = employee.id and emp_leave.`eid`=$emp_id_no group by leavetype.leavetype");
        return $query->result();
    }

    public function single_leave_status_details($emp_id_no) {
        $query = $this->db->query("SELECT employee.fname, employee.mname, employee.lname, employee.empid, leavetype.leavetype, emp_leave.approved_by, emp_leave.leave_days, emp_leave.leave_from, emp_leave.leave_to FROM `emp_leave`, leavetype, employee WHERE emp_leave.leave_id = leavetype.id and emp_leave.approved_by= employee.id and emp_leave.eid=$emp_id_no");
        return $query->result();

         
    }

}
