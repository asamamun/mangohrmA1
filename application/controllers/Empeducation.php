<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empeducation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(array('session'));
        $this->load->model('employee/Empeducation_model', 'empedu_model');
    }

    public function index() {
        $data['empdata'] = $this->empedu_model->select_empeeducation($this->session->userdata('emp_selected_id_no'));
        //var_dump($data);
        $this->load->view('employee/empeducation_view', $data);
    }
	
	public function showEmployeeEducation(){
	$data['empdata'] = $this->empedu_model->select_empeeducation($this->session->userdata('emp_selected_id_no'));
	echo $this->load->view('employee/_empeducationTable', $data, TRUE);
        //var_dump($data);
	}

    public function ajax_selectempeeducation() {

        $data = $this->empedu_model->select_empeeducation('sadf');
        echo json_encode($data);
    }

    public function ajax_editempeeducation($id) {
        $data = $this->empedu_model->get_empeeducation_id($id);
        $data->created = ($data->created == '0000-00-00') ? '' : $data->created;
        echo json_encode($data);
    }

    public function ajax_addempeeducation() {
        $this->_validateempeeducation();
        $data = array(
            'eid' => $this->session->userdata('emp_selected_id_no'),
            'level' => $this->input->post('level'),
            'institute' => $this->input->post('institute'),
            'board' => $this->input->post('board'),
            'major' => $this->input->post('major'),
            'year' => $this->input->post('year'),
            'score' => $this->input->post('score'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'created' => date("Y-m-d H:i:s"),
        );
        $insert = $this->empedu_model->save_empeeducation($data);
        echo json_encode(array('status' => TRUE));
    }

    public function ajax_updateempeducation() {
        $this->_validateempeeducation();
        $data = array(
            'id' => $this->input->post('id'),
            'eid' => $this->session->userdata('emp_selected_id_no'),
            'level' => $this->input->post('level'),
            'institute' => $this->input->post('institute'),
            'board' => $this->input->post('board'),
            'major' => $this->input->post('major'),
            'year' => $this->input->post('year'),
            'score' => $this->input->post('score'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'created' => date("Y-m-d H:i:s"),
        );
        $this->empedu_model->update_empeeducation(array('id' => $this->input->post('id')), $data);
        echo json_encode(array('status' => TRUE));
    }

    public function ajax_deleteempeducation($id) {
        $this->empedu_model->delete_empeducation_id($id);
        echo json_encode(array('status' => TRUE));
    }

    private function _validateempeeducation() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('level') == '') {
            $data['inputerror'][] = 'level';
            $data['error_string'][] = 'Level is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('institute') == '') {
            $data['inputerror'][] = 'institute';
            $data['error_string'][] = 'institute Description is required';
            $data['status'] = FALSE;
        }


        if ($this->input->post('board') == '') {
            $data['inputerror'][] = 'board';
            $data['error_string'][] = 'Please select Education Board';
            $data['status'] = FALSE;
        }

        if ($this->input->post('major') == '') {
            $data['inputerror'][] = 'major';
            $data['error_string'][] = 'Subject Major Is Required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('year') == '') {
            $data['inputerror'][] = 'year';
            $data['error_string'][] = 'Year is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('score') == '') {
            $data['inputerror'][] = 'score';
            $data['error_string'][] = 'Score Is Required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('start_date') == '') {
            $data['inputerror'][] = 'start_date';
            $data['error_string'][] = 'start date Is Required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('end_date') == '') {
            $data['inputerror'][] = 'end_date';
            $data['error_string'][] = 'end date Is Required';
            $data['status'] = FALSE;
        }
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
