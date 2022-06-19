<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_Shift_wise extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('report/Shift_Wise_Report_model');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('url', 'form',));
    }

## First Load value of EMPLOYEE_VIEW (It may not necessary)      

    public function index() {
        $this->load->helper('url');
        $data['shift'] = $this->Shift_Wise_Report_model->get_shift_info();
        $data['emp_status'] = $this->Shift_Wise_Report_model->get_enum_values("emp_job", "emp_status");
        //print_r($data);
        //exit();
        $this->load->view('report/shift_wise_report_view', $data);
    }
    
    public function LoadShiftInfo(){
        $shiftid=$_GET['shiftinfo'];
        $emp_status=$_GET['emp_status'];
        
        if($emp_status===""){
            $emp_status='active';
        }
        //exit();
       $info=$this->Shift_Wise_Report_model->get_emp_info_filter_by_shiftid($shiftid, $emp_status);
       $shiftin= Array();
       foreach($info as $a){
           $shiftdetails['id']=$a->id;
           $shiftdetails['empid']=str_pad($a->empid, 7, 0, STR_PAD_LEFT);
           $shiftdetails['deptname']=$a->deptname;
           $shiftdetails['secname']=$a->secname;
           $shiftdetails['designame']=$a->designame;
           $shiftdetails['fname']=$a->fname;
           $shiftdetails['mname']=$a->mname;
           $shiftdetails['lname']=$a->lname;
           $shiftdetails['startdate']=$a->startdate;
           $shiftdetails['basic_salary']=$a->basic_salary;
           $shiftdetails['status']=  ucfirst($a->emp_status);
           $shiftin[]=$shiftdetails;          
       }
       if($shiftin){
       $data['shiftinfo']=$shiftin;
       
       }else {
           $data['shiftinfo']="NoData";
       }
        echo json_encode($data);
    }
}
