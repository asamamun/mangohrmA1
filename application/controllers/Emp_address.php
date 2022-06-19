<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_address extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('employee/emp_address_model');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('url', 'form'));
    }

    public function index() {
        $this->load->helper('url');
        $this->load->view('employee/emp_address_view');
    }

    /*   public function employee_gen_first_form_save() {
      $this->_validate_first_gen_form();
      $data = array(
      'empid' => strtoupper($this->input->post('gen_empid')),
      'fname' => ucwords($this->input->post('gen_fname')),
      'mname' => ucwords($this->input->post('gen_mname')),
      'lname' =>ucwords($this->input->post('gen_lname')),
      'deptid' => $this->input->post('gen_deptid'),
      'secid' => $this->input->post('gen_secid'),
      'plantid' => "1",
      'desigid' => $this->input->post('gen_desigid'),
      'blood' => "NA",
      'deleted' => "0",
      );

      $insert = $this->employee_model->emp_save($data);
      echo json_encode(array("status" => $this->input->post('gen_empid')));
      }

      public function emp_table_load() {

      $this->load->view('employee/employee_list_view');
      }

      public function emp_show_ajax_list() {
      $list = $this->employee_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $fields) {
      $no++;
      $row = array();
      $row[] = $fields->empid;
      $fullname = $fields->fname . " " . $fields->mname . " " . $fields->lname;
      $row[] = $fullname;
      $desig = $fields->desigid;
      $desg = $this->Common_model->get_desig($desig);
      $row[] = $desg->designame;

      $deptcode = $fields->deptid;
      $abc = $this->Common_model->get_deptname($deptcode);
      $row[] = $abc->deptname;

      //add html for action
      $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_employee(' . "'" . $fields->empid . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
      <a class="btn btn-sm btn-danger" href="javascript:void()" title="Delete" onclick="delete_person(' . "'" . $fields->empid . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';
      $data[] = $row;
      }

      $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->employee_model->count_all(),
      "recordsFiltered" => $this->employee_model->count_filtered(),
      "data" => $data,
      );
      //output to json format
      echo json_encode($output);
      }
*/
      public function load_emp_address_data_ajax($id) {
          $ids = $this->Common_model->get_emp_id_by_empid($id);
      $data = $this->emp_address_model->get_by_id($ids);
      echo json_encode($data);
      }
/*
      public function employee_ajax_add() {
      $this->_validate();
      $data = array(
      'empid' => strtoupper($this->input->post('empid')),
      'fname' => ucwords($this->input->post('fname')),
      'mname' => ucwords($this->input->post('mname')),
      'lname' => ucwords($this->input->post('lname')),
      'dln' => strtoupper($this->input->post('dln')),
      'dl_expdate' => $this->input->post('dl_expdate'),
      'gender' => $this->input->post('gender'),
      'dob' => $this->input->post('dob'),
      'maritalstatus' => $this->input->post('maritalstatus'),
      'phone' => $this->input->post('phone'),
      'homephone' => $this->input->post('homephone'),
      'email' => strtolower($this->input->post('email')),
      'blood' => $this->input->post('blood'),
      'tin' => strtoupper($this->input->post('tin')),
      'nid' => strtoupper($this->input->post('nid')),
      'fathersname' => ucwords($this->input->post('fathersname')),
      'mothersname' => ucwords($this->input->post('mothersname')),
      'bankname' => ucwords($this->input->post('bankname')),
      'bankaccno' => strtoupper($this->input->post('bankaccno')),
      'bankacctype' => $this->input->post('bankacctype'),
      'plantid' => "1",
      'deptid' => $this->input->post('deptid'),
      'secid' => $this->input->post('secid'),
      'desigid' => $this->input->post('desigid'),
      'deleted' => "0"
      );

      $insert = $this->employee_model->emp_save($data);
      echo json_encode(array("status" => TRUE));
      }
     */

    public function emp_address_ajax_update() {
          $this->_validate();
          $sameornot=strtolower($this->input->post('sameornot'));
        if ($sameornot == "no") {

            $data = array(
                'p_address1' => ucwords($this->input->post('p_address1')),
                'p_address2' => ucwords($this->input->post('p_address2')),
                'p_village' => ucwords($this->input->post('p_village')),
                'p_post_name' => ucwords($this->input->post('p_post_name')),
                'p_post_code' => strtoupper($this->input->post('p_post_code')),
                'p_upazila' => ucwords($this->input->post('p_upazila')),
                'p_dist' => ucwords($this->input->post('p_dist')),
                'p_country' => strtoupper($this->input->post('p_country')),
                'c_address1' => ucwords($this->input->post('c_address1')),
                'c_address2' => ucwords($this->input->post('c_address2')),
                'c_village' => ucwords($this->input->post('c_village')),
                'c_post_name' => ucwords($this->input->post('c_post_name')),
                'c_post_code' => strtoupper($this->input->post('c_post_code')),
                'c_upazila' => ucwords($this->input->post('c_upazila')),
                'c_dist' => ucwords($this->input->post('c_dist')),
                'c_country' => strtoupper($this->input->post('c_country')),
                'sameornot'=>$sameornot
            );
        }
        if ($sameornot == "yes") {
            $data = array(
                'p_address1' => ucwords($this->input->post('c_address1')),
                'p_address2' => ucwords($this->input->post('c_address2')),
                'p_village' => ucwords($this->input->post('c_village')),
                'p_post_name' => ucwords($this->input->post('c_post_name')),
                'p_post_code' => strtoupper($this->input->post('c_post_code')),
                'p_upazila' => ucwords($this->input->post('c_upazila')),
                'p_dist' => ucwords($this->input->post('c_dist')),
                'p_country' => strtoupper($this->input->post('c_country')),
                'c_address1' => ucwords($this->input->post('c_address1')),
                'c_address2' => ucwords($this->input->post('c_address2')),
                'c_village' => ucwords($this->input->post('c_village')),
                'c_post_name' => ucwords($this->input->post('c_post_name')),
                'c_post_code' => strtoupper($this->input->post('c_post_code')),
                'c_upazila' => ucwords($this->input->post('c_upazila')),
                'c_dist' => ucwords($this->input->post('c_dist')),
                'c_country' => strtoupper($this->input->post('c_country')),
                'sameornot'=>$sameornot
            );
        }
        $current_empid = $this->session->userdata('emp_selected_card_no');
        $mydata = $this->emp_address_model->emp_address_add($data, $current_empid);
        echo json_encode(array("status" => $mydata));
    }

    
      public function emp_default_loading() {
      $data['country'] = $this->Common_model->emp_default_country_load();
      //$data['sec'] = $this->Common_model->emp_default_sec_load();
      //$data['desig'] = $this->Common_model->emp_default_desig_load();
      echo json_encode($data);
      }
      
      private function _validate() {
      $data = array();
      $data['error_string'] = array();
      $data['inputerror'] = array();
      $data['status'] = TRUE;

      if (strlen(trim($this->input->post('c_address1'))) < 1) {
      $data['inputerror'][] = 'c_address1';
      $data['error_string'][] = 'Address 1 is required.';
      $data['status'] = FALSE;
      }

      if (!is_numeric($this->input->post('c_post_code'))) {
      $data['inputerror'][] = 'c_post_code';
      $data['error_string'][] = 'Post code must be numeric.';
      $data['status'] = FALSE;
      }
      
      if (strlen(trim($this->input->post('c_post_code'))) < 1) {
      $data['inputerror'][] = 'c_post_code';
      $data['error_string'][] = 'Post code is required.';
      $data['status'] = FALSE;
      }
      
      if (strlen(trim($this->input->post('c_upazila'))) < 1) {
      $data['inputerror'][] = 'c_upazila';
      $data['error_string'][] = 'Upazila field is required.';
      $data['status'] = FALSE;
      }      
      
       if (strlen(trim($this->input->post('c_dist'))) < 1) {
      $data['inputerror'][] = 'c_dist';
      $data['error_string'][] = 'District field is required.';
      $data['status'] = FALSE;
      }       
      
        if (strlen(trim($this->input->post('c_country'))) < 1) {
      $data['inputerror'][] = 'c_country';
      $data['error_string'][] = 'Country field is required.';
      $data['status'] = FALSE;
      }
      
         if (strlen(trim($this->input->post('c_country'))) > 2) {
      $data['inputerror'][] = 'c_country';
      $data['error_string'][] = 'You are permitted to edit the field.';
      $data['status'] = FALSE;
      }
      
         if (is_numeric(trim($this->input->post('c_country')))) {
      $data['inputerror'][] = 'c_country';
      $data['error_string'][] = 'You are permitted to edit the field.';
      $data['status'] = FALSE;
      }
      
      if ($data['status'] === FALSE) {
      echo json_encode($data);
      exit();
      }
      }
      
      /*

      private function _validate_first_gen_form() {
      $data = array();
      $data['error_string'] = array();
      $data['inputerror'] = array();
      $data['status'] = TRUE;

      if (strlen(trim($this->input->post('gen_empid'))) < 4) {
      $data['inputerror'][] = 'gen_empid';
      $data['error_string'][] = 'Employee Card Number must be at least 4 chars.';
      $data['status'] = FALSE;
      }

      if (strlen(trim($this->input->post('gen_fname'))) < 2) {
      $data['inputerror'][] = 'gen_fname';
      $data['error_string'][] = 'Required Field.';
      $data['status'] = FALSE;
      }

      if (strlen(trim($this->input->post('gen_lname'))) < 2) {
      echo "<script>alert('Hello')</script>";
      $data['inputerror'][] = 'gen_lname';
      $data['error_string'][] = 'Required Field.';
      $data['status'] = FALSE;
      }

      if (!is_numeric($this->input->post('gen_deptid'))) {
      $data['inputerror'][] = 'gen_deptid';
      $data['error_string'][] = 'Department is required';
      $data['status'] = FALSE;
      }

      if (!is_numeric($this->input->post('gen_secid'))) {
      $data['inputerror'][] = 'gen_secid';
      $data['error_string'][] = 'Section is required';
      $data['status'] = FALSE;
      }

      if (!is_numeric($this->input->post('gen_desigid'))) {
      $data['inputerror'][] = 'gen_desigid';
      $data['error_string'][] = 'Designation is required';
      $data['status'] = FALSE;
      }


      if ($data['status'] === FALSE) {
      echo json_encode($data);
      exit();
      }
      }

      public function add_emp_gen_info() {
      $this->form_validation->set_error_delimiters('<div style="color:MediumVioletRed !important">', '</div>');
      $this->form_validation->set_rules('gen_empid', 'Emplyee Card No', 'required|min_length[4]|is_unique[employee.empid]');
      $this->form_validation->set_rules('gen_fname', 'First Name', 'required|min_length[2]');
      $this->form_validation->set_rules('gen_mname', 'Middle Name', '');
      $this->form_validation->set_rules('gen_lname', 'Last Name', 'required|callback_check_empty');
      $this->form_validation->set_rules('gen_deptid', 'Department', 'required|callback_check_empty');
      $this->form_validation->set_rules('gen_secid', 'Section', 'required|callback_check_empty');
      $this->form_validation->set_rules('gen_desigid', 'Designation', 'required|callback_check_empty');


      if ($this->form_validation->run() == FALSE) {
      $data['dept'] = $this->Common_model->emp_default_dept_load();
      $data['sec'] = $this->Common_model->emp_default_sec_load();
      $data['desig'] = $this->Common_model->emp_default_desig_load();
      $data['lastinsert'] = "Hello";

      $this->load->view('employee/employee_first_gen_view', $data);
      } else {
      $empid = $this->input->post('gen_empid');
      $data = array(
      'empid' => $this->input->post('gen_empid'),
      'fname' => $this->input->post('gen_fname'),
      'mname' => $this->input->post('gen_mname'),
      'lname' => $this->input->post('gen_lname'),
      'deptid' => $this->input->post('gen_deptid'),
      'secid' => $this->input->post('gen_secid'),
      'blood' => "NA",
      'plantid' => "1",
      'desigid' => $this->input->post('gen_desigid'),
      'deleted' => "0",
      );
      $insert = $this->employee_model->emp_save($data);
      if ($insert) {
      $this->session->unset_userdata('emp_selected_card_no');
      $this->session->set_userdata('emp_selected_card_no', $empid);
      redirect('employee/index');
      }
      }
      }

      // To Check empty entry of roll
      public function check_empty($r) {
      if (empty($r)) {
      //error message should be set to function name
      $this->form_validation->set_message('check_empty', '{field} is required!!');
      return FALSE;
      } else
      return TRUE;
      }

      // Employee Photo Upload

      public function do_upload() {
      $empid = $this->session->userdata('emp_selected_card_no');
      $config['upload_path'] = "assets/upload/emp_photo";
      $config['allowed_types'] = "jpg|jpeg|gif|png";
      //$config['max_size'] = '2000';
      $config['overwrite'] = TRUE;
      $config['file_name'] = $empid . ".jpg";

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('file')) {
      $error = $this->upload->display_errors();
      //$this->load_form($error);
      }

      redirect('employee/index');
      } */
}
