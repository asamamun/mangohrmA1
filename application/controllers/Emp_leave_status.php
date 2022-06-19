<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_leave_status extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('employee/Emp_leave_status_model');
        $this->load->model('Common_model');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('url', 'form', 'file'));
    }

    public function show_leave_status() {
        $data['leave_status_pvt'] = $this->Emp_leave_status_model->single_leave_status($this->session->userdata('emp_selected_id_no'));
        $data['leave_status_details_pvt'] = $this->Emp_leave_status_model->single_leave_status_details($this->session->userdata('emp_selected_id_no'));
      
       // $dataAll = $this->Emp_leave_status_model->single_leave_status_details($this->session->userdata('emp_selected_id_no'));
          //  $singlerow[];
       // foreach ($dataAll as $row) {
            //$row->isd;
         //   $singlerow['leave_from'] = $row->leave_from;
          //  $singlerow['leave_to'] = $row->leave_to;
          //  $singlerow['leave_days'] = $row->leave_days;
          //  $singlerow['leavetype'] = $row->leavetype;
               //  $fullnameArr=$this->Common_model->get_empname_by_emp_id_no($row->approved_by);
               //  $fullname=$fullnameArr[0]['fname']." ". $fullnameArr[0]['mname']. " ". $fullnameArr[0]['lname'];
           // $singlerow['approved_by'] =$fullname; 
       // }
        
                    
             // $fh = fopen("leaveStatus", "at");
             // fwrite($fh, . "\n");
             // fclose($fh);

             

       // $data['leave_status_details_pvt'] = $singlerow;        
        echo json_encode($data);
    }

}
