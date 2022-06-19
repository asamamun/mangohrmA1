<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Empexperience extends CI_Controller {

    public function __construct() {
        parent::__construct();
       // $this->output->enable_profiler(TRUE);
        $this->load->helper('url');
        $this->load->library(array('session'));
        $this->load->model('employee/Empexperience_model', 'empexperience');
    }

    public function index() {
        /* echo $this->session->userdata('emp_selected_card_no');
          echo "<hr>";
          echo $this->session->userdata('emp_selected_id_no');
          echo "<hr>";
          echo $this->session->userdata('emp_selected_check');
          echo "<hr>"; */
        $data['empexperience'] = $this->empexperience->select_empexperience($this->session->userdata('emp_selected_id_no'));
        //var_dump($data);
        $this->load->view('employee/empexperience_view', $data);
    }
	
	public function showEmployeeExp(){
	$data['empexperience'] = $this->empexperience->select_empexperience($this->session->userdata('emp_selected_id_no'));
	echo $this->load->view('employee/_emexperienceInTable', $data, TRUE);
	}

    public function ajax_selectempexperience() {

        $data = $this->empexperience->select_empexperience('sadf');
        echo json_encode($data);
    }

    public function ajax_editempexperience($id) {
        $data = $this->empexperience->get_empexperienceby_id($id);
        $data->created = ($data->created == '0000-00-00') ? '' : $data->created;
        echo json_encode($data);
    }

    public function ajax_addempexperience() {
        $this->_validateempexperience();
        $data = array(
            'eid' => $this->session->userdata('emp_selected_id_no'),
            'company' => $this->input->post('company'),
            'occupation' => $this->input->post('occupation'),
            'exp_from' => $this->input->post('exp_from'),
            'exp_to' => $this->input->post('exp_to'),
            'comment' => $this->input->post('comment'),
            'created' => date('Y-m-d H:i:s'),
        );
        //$fh = fopen("data","at");
        //fwrite($fh,json_encode($data));
        //fclose($fh);
        //print_r($data);exit;
        $insert = $this->empexperience->save_empexperience($data);
        //echo $insert;
        echo json_encode(array('status' => TRUE));
    }

    public function ajax_updateempexperience() {
        $this->_validateempexperience();
        $data = array(
            'id' => $this->input->post('id'),
            'eid' => $this->session->userdata('emp_selected_id_no'),
            'company' => $this->input->post('company'),
            'occupation' => $this->input->post('occupation'),
            'exp_from' => $this->input->post('exp_from'),
            'exp_to' => $this->input->post('exp_to'),
            'comment' => $this->input->post('comment'),
            'created' => date('Y-m-d H:i:s'),
        );
        $this->empexperience->update_empexperience(array('id' => $this->input->post('id')), $data);
        echo json_encode(array('status' => TRUE));
    }

    public function ajax_deleteempexperience($id) {
        $this->empexperience->delete_empexperienceby_id($id);
        echo json_encode(array('status' => TRUE));
    }

    private function _validateempexperience() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        /* if($this->input->post('eid') == ''){
          $data['inputerror'][] = 'empid';
          $data['error_string'][] = 'Employee id is required';
          $data['status'] = FALSE;
          } */

        if ($this->input->post('company') == '') {
            $data['inputerror'][] = 'company';
            $data['error_string'][] = 'Company name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('occupation') == '') {
            $data['inputerror'][] = 'occupation';
            $data['error_string'][] = 'Occupation is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('exp_from') == '') {
            $data['inputerror'][] = 'exp_from';
            $data['error_string'][] = 'Experience from date is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('exp_to') == '') {
            $data['inputerror'][] = 'exp_to';
            $data['error_string'][] = 'Experience to date is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('comment') == '') {
            $data['inputerror'][] = 'comment';
            $data['error_string'][] = 'Comment is required';
            $data['status'] = FALSE;
        }
        /*
          if($this->input->post('created') == ''){
          $data['inputerror'][] = 'created';
          $data['error_string'][] = 'Creation date is required';
          $data['status'] = FALSE;
          }
         */
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
