<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*	
 *	@author 	: Md Nazrul Islam Bhuiyan
 *	date		: 15 May, 2016
 *	Human Resource Management System Pro
 *	url			:	http://bdcoder26.com/mangohrm
 *  Mobile		: +8801818685043
 */
class Emp_job extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('employee/emp_job_model');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('url', 'form'));
    }
    public function index() {
        $this->load->helper('url');
        $this->load->view('employee/emp_job_view');
    }	
      public function load_emp_job_data_ajax($id) {
	  $ids = $this->session->userdata('emp_selected_id_no');
      $data = $this->emp_job_model->get_by_id($ids);
      echo json_encode($data);
      }
    public function emp_job_ajax_update() {
          $this->_validate();
		  $continueval =$this->input->post('continue');
		  if($continueval==1){
            $data = array(
                'job_title' => ucwords($this->input->post('job_title')),
                'job_spec' => ucwords($this->input->post('job_spec')),
                'emp_status' => $this->input->post('emp_status'),
                'job_category' => $this->input->post('job_category'),
                'joindate' => $this->input->post('joindate'),
                'job_location' => $this->input->post('job_location'),
				'shift' => $this->input->post('shift'),
                'startdate' => $this->input->post('startdate'),
                //'enddate' => $this->input->post('enddate'),
				'enddate' => "0000-00-00",
                'continue' => $this->input->post('continue'),
				'created' => date("Y-m-d H:i:s"),			
            );
		  }
		  else{
			$data = array(
                'job_title' => ucwords($this->input->post('job_title')),
                'job_spec' => ucwords($this->input->post('job_spec')),
                'emp_status' => $this->input->post('emp_status'),
                'job_category' => $this->input->post('job_category'),
                'joindate' => $this->input->post('joindate'),
                'job_location' => $this->input->post('job_location'),
				'shift' => $this->input->post('shift'),
                'startdate' => $this->input->post('startdate'),
                'enddate' => $this->input->post('enddate'),
                'continue' => $this->input->post('continue'),
				'created' => date("Y-m-d H:i:s"),			
            );  
			  
			  
		  }
        $current_empid = $this->session->userdata('emp_selected_card_no');
        $mydata = $this->emp_job_model->emp_job_add($data, $current_empid);
        echo json_encode(array("status" => $mydata));
    }	
	  public function emp_default_loading() {
      $data['job_category'] = $this->emp_job_model->emp_default_job_load();
      echo json_encode($data);
      }
	  public function emp_shift_loading() {
      $data['shift'] = $this->emp_job_model->emp_default_shift_load();
      echo json_encode($data);
      }
	  
      private function _validate() {
      $data = array();
      $data['error_string'] = array();
      $data['inputerror'] = array();
      $data['status'] = TRUE;

      /*if (strlen(trim($this->input->post('job_title'))) < 1) {
      $data['inputerror'][] = 'job_title';
      $data['error_string'][] = 'job title is required.';
      $data['status'] = FALSE;
      } */
	  /*if (strlen(trim($this->input->post('job_spec'))) < 1) {
      $data['inputerror'][] = 'job_spec';
      $data['error_string'][] = 'job specification is required.';
      $data['status'] = FALSE;
      } */
	  if (strlen(trim($this->input->post('emp_status'))) < 1) {
      $data['inputerror'][] = 'emp_status';
      $data['error_string'][] = 'employee status is required.';
      $data['status'] = FALSE;
      }
	  
	  if (strlen(trim($this->input->post('job_category'))) < 1) {
      $data['inputerror'][] = 'job_category';
      $data['error_string'][] = 'Job category is required.';
      $data['status'] = FALSE;
      }
      
      if (strlen(trim($this->input->post('joindate'))) < 1) {
      $data['inputerror'][] = 'joindate';
      $data['error_string'][] = 'joindate is required.';
      $data['status'] = FALSE;
      }
	 /* if (strlen(trim($this->input->post('job_location'))) < 1) {
      $data['inputerror'][] = 'job_location';
      $data['error_string'][] = 'Job location is required.';
      $data['status'] = FALSE;
      }
	  */
      if (strlen(trim($this->input->post('startdate'))) < 1) {
      $data['inputerror'][] = 'startdate';
      $data['error_string'][] = 'startdate field is required.';
      $data['status'] = FALSE;
      }    
	  //if continue=no,than enddate field is requied.
      /*if ($this->input->post('continue'))==0) {		  
		  if(empty(strtotime($this->input->post('enddate')))){
		  
			  $data['inputerror'][] = 'enddate';
			  $data['error_string'][] = 'enddate field is required.';
			  $data['status'] = FALSE;
		  }
      }    	*/  
      if ($data['status'] === FALSE) {
      echo json_encode($data);
      exit();
      }
      }
}
