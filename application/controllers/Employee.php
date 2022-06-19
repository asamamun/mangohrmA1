<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('employee/Employee_model');
        $this->load->model('section/Section_model');
        $this->load->model('Common_model');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('url', 'form', 'file'));
        // $this->session->unset_userdata('emp_selected_card_no');
        // $this->session->unset_userdata('emp_selected_id_no');
    }

## Function for Seting session when click on edit btn of EMPLOYEE_LIST_VIEW

    public function set_emp_session_click_edit_btn_tbl($empid) {
        $id = $this->Common_model->get_id_by_empid($empid);
        $this->session->set_userdata('emp_selected_card_no', $empid);
        $this->session->set_userdata('emp_selected_id_no', $id);
    }

##(NOT IN USED) Function for Seting session when click on edit btn of EMPLOYEE_LIST_VIEW

    public function set_session_by_id($id) {
        $empid = $this->Common_model->get_empid_by_id($id);
        $this->session->set_userdata('emp_selected_card_no', $empid);
        $this->session->set_userdata('emp_selected_id_no', $id);
    }

## First Load value of EMPLOYEE_VIEW (It may not necessary)      

    public function index() {
        $this->load->helper('url');
        $data['dept'] = $this->Common_model->emp_default_dept_load();
        $data['sec'] = $this->Common_model->emp_default_sec_load();
        $data['desig'] = $this->Common_model->emp_default_desig_load();
        $this->load->view('employee/employee_view', $data);
    }

## Saving Data of EMPLOYEE_FIRST_GEN_VIEW on submit btn

    public function employee_gen_first_form_save() {
        $this->_validate_first_gen_form();
        $data = array(
            'empid' => strtoupper($this->input->post('gen_empid')),
            'fname' => ucwords($this->input->post('gen_fname')),
            'mname' => ucwords($this->input->post('gen_mname')),
            'lname' => ucwords($this->input->post('gen_lname')),
            'deptid' => $this->input->post('gen_deptid'),
            'secid' => $this->input->post('gen_secid'),
            'plantid' => "1",
            'desigid' => $this->input->post('gen_desigid'),
            'blood' => "NA",
            'deleted' => "0",
        );

        $insert = $this->Employee_model->emp_save($data);
        if ($insert) {
            $this->session->set_userdata('emp_selected_id_no', $insert);
            $this->session->set_userdata('emp_selected_card_no', strtoupper($this->input->post('gen_empid')));
        }
        echo json_encode(array("status" => $this->input->post('gen_empid')));
    }

## Loading Table Data when view is displied.    

    public function emp_table_load() {

        $this->load->view('employee/employee_list_view');
    }

## Ajax Autoload of table data of EMPLOYEE_LIST_VIEW      

    public function emp_show_ajax_list() {
        $list = $this->Employee_model->get_datatables();
        $data = array();
        $no = $_POST['start'];

        //add html for action
        $siteurllink = site_url() . "Emp_Manage/index";
        foreach ($list as $fields) {
            $no++;
            $row = array();
            $row[] = "<a href='$siteurllink'" . 'onclick="edit_employee(' . "'" . $fields->empid . "'" . ')">' . str_pad($fields->empid, 8, "0", STR_PAD_LEFT);
            $fullname = $fields->fname . " " . $fields->mname . " " . $fields->lname;
            $row[] = "<a href='$siteurllink'" . 'onclick="edit_employee(' . "'" . $fields->empid . "'" . ')">' . $fullname;
            $desig = $fields->desigid;
            $desg = $this->Common_model->get_desig($desig);
            $row[] = $desg->designame;

            /*
              $fh = fopen("desig_data", "at");
              fwrite($fh, $fields->desigid. "\n");
              fclose($fh);

             */

            $deptcode = $fields->deptid;
            $abc = $this->Common_model->get_deptname($deptcode);
            $row[] = $abc->deptname;


            $row[] = '<a class="btn btn-sm btn-primary" id="EditEmpInfo"  href="' . $siteurllink . '" title="Edit" onclick="edit_employee(' . "'" . $fields->empid . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
                      <a class="btn btn-sm btn-danger" href="javascript:void()" title="Delete" onclick="delete_person(' . "'" . $fields->empid . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>
					  <a class="btn btn-sm btn-success" href="' . site_url() . 'Card_Print/IndividualCard/' . $fields->id . '" title="ID Card"><i class="glyphicon glyphicon-user"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Employee_model->count_all(),
            "recordsFiltered" => $this->Employee_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

## Run the function when click on edit btn and Load

    public function employee_ajax_edit($id) {
        $data = $this->Employee_model->get_by_id($id);
        echo json_encode($data);
    }

    /*    public function employee_ajax_add() {
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

      $insert = $this->Employee_model->emp_save($data);
      echo json_encode(array("status" => TRUE));
      }
     */

## Updating employee data when click on UPDATE btn of EMPLOYEE_VIEW form.    

    public function employee_ajax_update() {
        $this->_validate();

        $data = array(
            //$UpEmpid=preg_replace('/\s+/', '', $UpEmpid);
            'empid' => preg_replace('/\s+/', '', strtoupper($this->input->post('empid'))),
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

        $this->Employee_model->emp_update(array('id' => $this->session->userdata('emp_selected_id_no')), $data);
        echo json_encode(array("status" => TRUE));
    }

## Set Employee Deleted=1 of EMPLOYEE_LIST_VIEW    

    public function employee_ajax_delete($id) {
        $this->Employee_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

## Retriving Dropdown value for EMPLOYEE_VIEW    

    public function emp_default_loading() {
        $data['dept'] = $this->Common_model->emp_default_dept_load();
        //$data['sec'] = $this->Common_model->emp_default_sec_load();
        $data['sec'] = $this->Common_model->dept_wise_sec($this->session->userdata('emp_selected_card_no'));
        $data['desig'] = $this->Common_model->emp_default_desig_load();
        echo json_encode($data);
    }

## Validation function for Employee_View    

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;


        $UpEmpid = $this->input->post('empid');
        $UpEmpid = preg_replace('/\s+/', '', $UpEmpid);
        if ($this->session->userdata('emp_selected_card_no') != $UpEmpid) {
            $checkresult = $this->Common_model->chcking_empid_unique($UpEmpid);
            if ($checkresult) {
                $data['inputerror'][] = 'empid';
                $data['error_string'][] = 'The Employee Card is already exists!!';
                $data['status'] = FALSE;
            }
        }

        if (!preg_match("/^([a-zA-Z0-9]+)$/", $UpEmpid)) {
            $data['inputerror'][] = 'empid';
            $data['error_string'][] = 'Only Allow a-z, A-Z, 0-9 chars!!.';
            $data['status'] = FALSE;
        }

        if (!is_numeric($this->input->post('deptid'))) {
            $data['inputerror'][] = 'deptid';
            $data['error_string'][] = 'Department is required';
            $data['status'] = FALSE;
        }

        if (!is_numeric($this->input->post('secid'))) {
            $data['inputerror'][] = 'secid';
            $data['error_string'][] = 'Section is required';
            $data['status'] = FALSE;
        }

        if (!is_numeric($this->input->post('desigid'))) {
            $data['inputerror'][] = 'desigid';
            $data['error_string'][] = 'Designation is required';
            $data['status'] = FALSE;
        }

        if (strlen(trim($this->input->post('fname'))) < 2) {
            $data['inputerror'][] = 'fname';
            $data['error_string'][] = 'Required Field.';
            $data['status'] = FALSE;
        }

        if (strlen(trim($this->input->post('lname'))) < 2) {
            $data['inputerror'][] = 'lname';
            $data['error_string'][] = 'Required Field.';
            $data['status'] = FALSE;
        }

        if ($this->input->post('dob') == '') {
            $data['inputerror'][] = 'dob';
            $data['error_string'][] = 'Required Field.';
            $data['status'] = FALSE;
        }

        if (strlen(trim($this->input->post('fathersname'))) < 2) {
            $data['inputerror'][] = 'fathersname';
            $data['error_string'][] = 'Required Field.';
            $data['status'] = FALSE;
        }

        if (strlen(trim($this->input->post('mothersname'))) < 2) {
            $data['inputerror'][] = 'mothersname';
            $data['error_string'][] = 'Required Field.';
            $data['status'] = FALSE;
        }

        if (strlen(trim($this->input->post('dln'))) > 4) {
            if (strlen(trim($this->input->post('dl_expdate'))) < 6) {
                $data['inputerror'][] = 'dl_expdate';
                $data['error_string'][] = 'Required Field when driving license is exists.';
                $data['status'] = FALSE;
            }
        }

        if (strlen(trim($this->input->post('bankname'))) > 4 || strlen(trim($this->input->post('bankaccno'))) > 4 || strlen(trim($this->input->post('bankname'))) > 0) {
            if (strlen(trim($this->input->post('bankname'))) < 4) {
                $data['inputerror'][] = 'bankname';
                $data['error_string'][] = 'Required Field when Bank account info is exists.';
                $data['status'] = FALSE;
            }
            if (strlen(trim($this->input->post('bankaccno'))) < 4) {
                $data['inputerror'][] = 'bankaccno';
                $data['error_string'][] = 'Required Field when Bank account info is exists.';
                $data['status'] = FALSE;
            }
            if (strlen(trim($this->input->post('bankname'))) < 4) {
                $data['inputerror'][] = 'bankname';
                $data['error_string'][] = 'Required Field when Bank account info is exists.';
                $data['status'] = FALSE;
            }
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

## Validation function for Employee_first_gen_view    

    private function _validate_first_gen_form() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $emplyeeid = trim($this->input->post('gen_empid'));
        $emplyeeid = preg_replace('/\s+/', '', $emplyeeid);
        $empidresult = $this->Common_model->chcking_empid_unique($emplyeeid);
        if ($empidresult) {
            $data['inputerror'][] = 'gen_empid';
            $data['error_string'][] = 'The Employee Card is already exists!!';
            $data['status'] = FALSE;
        }


        if (!preg_match("/^([a-zA-Z0-9]+)$/", $emplyeeid)) {
            $data['inputerror'][] = 'gen_empid';
            $data['error_string'][] = 'Only Allow a-z, A-Z, 0-9 chars!!.';
            $data['status'] = FALSE;
        }

        if (strlen(trim($this->input->post('gen_empid'))) > 8) {
            $data['inputerror'][] = 'gen_empid';
            $data['error_string'][] = 'Employee Card Number should not be greater than 8 chars.';
            $data['status'] = FALSE;
        }

        if (strlen(trim($this->input->post('gen_fname'))) < 2) {
            $data['inputerror'][] = 'gen_fname';
            $data['error_string'][] = 'Required Field.';
            $data['status'] = FALSE;
        }

        if (strlen(trim($this->input->post('gen_lname'))) < 2) {
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

    ## First View of EMPLYEE_FIRST_GEN_VIEW     

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
            $insert = $this->Employee_model->emp_save($data);
            //$this->session->set_userdata('emp_selected_id_no', $insert);
            //$this->session->set_userdata('emp_selected_check', "HELLO");
            if ($insert) {
                //$this->session->unset_userdata('emp_selected_card_no');
                //$this->session->set_userdata('emp_selected_id_no', $insert);
                $this->session->set_userdata('emp_selected_card_no', $empid);
                redirect('Employee/index');
            }
        }
    }

    /*
      ##To Check empty entry of roll
      public function check_empty($r) {
      if (empty($r)) {
      //error message should be set to function name
      $this->form_validation->set_message('check_empty', '{field} is required!!');
      return FALSE;
      } else
      return TRUE;
      }
     */


##Employee Photograph Upload at Employee_view

    public function do_upload() {
        $empid = $this->session->userdata('emp_selected_card_no');
        $config['upload_path'] = "assets/upload/emp_photo";
        $config['allowed_types'] = "jpg|jpeg|gif|png";
        //$config['max_size'] = '2000';
        $config['overwrite'] = TRUE;
        $config['file_name'] = $empid . ".jpg";

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('ProfileImage')) {
            $error = $this->upload->display_errors();
            //$this->load_form($error);
        }

        redirect('Emp_Manage/index');
    }

## Retril Section ID and Name by passing Department ID for EMP_ADDRESS    

    public function get_section_by_dept_id($deptid) {
        $data = $this->Common_model->get_sec_by_dept_id($deptid);
        if ($data) {
            echo json_encode($data);
        }
    }

## Set Session Value if we update employee card no.

    public function set_session_val_of_new_updated_empid($newempid) {
        $newinsert = preg_replace('/\s+/', '', strtoupper($newempid));
        $secempid = $this->session->userdata('emp_selected_card_no');
        if ($secempid != $newinsert) {
            $id = $this->Common_model->get_id_by_empid($newinsert);
            $this->session->set_userdata('emp_selected_card_no', $newinsert);
            $this->session->set_userdata('emp_selected_id_no', $id);
            //return TRUE;
            // redirect(site_url() . "Emp_Manage/index");
            // return "Both are not same";
            echo json_encode(array('status' => "Both are not same"));
        } else {
            echo json_encode(array('status' => "Both are same"));
        }
    }

}
