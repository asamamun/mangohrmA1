<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
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

    public function get_desig($desigid) {
        $query = $this->db->query("select designame from designation where `desigid`= " . $desigid);
        return $query->row();
    }

    public function emp_default_dept_load() {
        $this->db->select('deptname, deptid');
        $query = $this->db->get_where("department", array('deleted' => 0));
        return $query->result();
    }

    public function emp_default_sec_load() {
        $this->db->select('secid, secname');
        $query = $this->db->get_where("section", array('deleted' => 0));
        return $query->result();
    }

    public function emp_default_desig_load() {
        $this->db->select('desigid, designame');
        $query = $this->db->get_where("designation", array('deleted' => 0));
        return $query->result();
    }

    public function emp_default_country_load() {
        $this->db->select('countrycode, countryname');
        $query = $this->db->get("country");
        return $query->result();
    }

    public function get_emp_id_by_empid($empid) {
        $empquery = $this->db->get_where("employee", array('empid' => $empid));

        if ($empquery->num_rows() === 1) {
            $emp_row = $empquery->result_array();
            return $emp_sl_id = $emp_row['0']['id'];
        } else
            return FALSE;
    }

    public function get_sec_by_dept_id($deptid) {
        $this->db->select('secid, secname');
        $query = $this->db->get_where("section", array('deptid' => $deptid));
        return $query->result();
    }

    public function chcking_empid_unique($empid) {
        $query = $this->db->get_where("employee", array('empid' => $empid));
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function dept_wise_sec($CurEmpId) {
        $this->db->select('deptid');
        $query = $this->db->get_where('employee', array('empid' => $CurEmpId));
        $queryresult = $query->result_array();
        $deptidno = $queryresult['0']['deptid'];
        $this->db->select('secid, secname');
        $query = $this->db->get_where("section", array('deptid' => $deptidno));
        return $query->result();
    }

    public function get_id_by_empid($empid) {
        $this->db->select('id');
        $query = $this->db->get_where('employee', array('empid' => $empid));
        $result = $query->result_array();
        return $id = $result['0']['id'];
    }

    public function get_empid_by_id($id) {
        $this->db->select('empid');
        $query = $this->db->get_where('employee', array('id' => $id));
        $result = $query->result_array();
        return $id = $result['0']['empid'];
    }

    public function get_empname_by_emp_id_no($id) {
        $this->db->select('fname, mname, lname');
        $query = $this->db->get_where('employee', array('id' => $id));
        return $result = $query->result_array();
        // return $id=$result['0']['empid'];
    }

    //Use Leave controller 
    public function get_emp_sec_emp_sec_id($id) {
        //$this->db->select(*);
        $query = $this->db->get_where('section', array('secid' => $id));
        $result = $query->row();
        return $secname = $result->secname;
    }

    //Use Leave controller 
    public function get_emp_sec_emp_dept_id($id) {
        //$this->db->select(*);
        $query = $this->db->get_where('department', array('deptid' => $id));
        $result = $query->row();
        return $deptname = $result->deptname;
    }

    //Use Leave controller 
    public function get_emp_sec_emp_desig_id($id) {
        //$this->db->select(*);
        $query = $this->db->get_where('designation', array('desigid' => $id));
        $result = $query->row();
        return $designame = $result->designame;
    }

    public function get_empdetails_by_emp_id_no($id) {
        $query = $this->db->get_where('employee', array('id' => $id));
        return $result = $query->row();
        // return $id=$result['0']['empid'];
    }

}
