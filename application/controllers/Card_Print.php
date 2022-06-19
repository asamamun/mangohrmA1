<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Card_Print extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->database();
    }

    public function IndividualCard($id) {
        $query = $this->db->query("select employee.id, employee.deptid, employee.plantid, employee.empid, employee.fname, employee.mname, employee.lname, employee.deptid, designation.designame, department.deptname from employee 
join designation on employee.desigid=designation.desigid 
join department on employee.deptid=department.deptid and employee.id=$id");
        $data['emp_card_info'] = $query->result();
        $comquery = $this->db->query("select * from companysetup");
        $data['emp_company_info'] = $comquery->result();
        $this->load->view('employee/emp_card/CardPrintView', $data);
    }

}
