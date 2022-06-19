<?php



class Emp_Manage extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
                $this->load->model('employee/Employee_model');
        $this->load->model('section/section_model');
        $this->load->model('Common_model');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('url', 'form', 'file'));
    }
    
    public function index(){
        $empname['empname']=$this->Common_model->get_empname_by_emp_id_no($this->session->userdata('emp_selected_id_no'));
       // print_r($empname);
       // exit();
        $this->load->view('employee/employee_manage_view', $empname);               
    }
    
}