<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('url', 'form', 'date'));
        $this->load->model('leave/Leave_model');
        $this->load->model('Common_model');
    }

    public function index() {
        // $data['emp_leave'] = $this->Leave_model->gel_all_value();
        $data['leavetype'] = $this->Leave_model->get_leavetype();
        $this->load->view('leave/leave_view', $data);
    }

    public function LoadDefaultLaveTable() {
        $data['emp_leave'] = $this->Leave_model->gel_all_value();
        echo json_encode($data);
    }

    public function add_leave() {
        $stdate = $this->input->post('stdate');
        $endate = $this->input->post('endate');
        //echo $endate;
        //exit;

        $data = array(
            'eid' => $this->input->post('emprealid'),
            'leave_id' => $this->input->post('leavetype'),
            'leave_from' => $stdate,
            'leave_to' => $endate,
            'leave_days' => ((strtotime($endate) - strtotime($stdate)) / 60/60/24),
            'approved_by' => $this->input->post('approvedby'),
            'approved' => $this->input->post('approved'),
            'comments' => $this->input->post('comments'),
            'created' => date("Y-m-d H:i:s")
        );
        $insert = $this->Leave_model->add_leave($data);
        echo json_encode(array('status' => TRUE));
    }

    public function update_leave() {
        $stdate = $this->input->post('stdate');
        $endate = $this->input->post('endate');
       /* $eid = $this->input->post('emprealid');
        $leave_id = $this->input->post('leavetype');       
         $leave_days = ((strtotime($endate) - strtotime($stdate)) / 60/60/24);
        $approved_by = $this->input->post('approvedby');
        $approved = $this->input->post('approved');
        $comments = $this->input->post('comments');
        $created = date("Y-m-d H:i:s");*/
       
        $data = array(
            'eid' => $this->input->post('emprealid'),
            'leave_id' => $this->input->post('leavetype'),
            'leave_from' => $stdate, // $this->input->post('stdate'),
            'leave_to' => $endate, //$this->input->post('endate'),
            'leave_days' =>((strtotime($endate) - strtotime($stdate)) /60/60/24),
            'approved_by' =>$this->input->post('approvedby'),
            'approved' => $this->input->post('approved'),
            'comments' =>$this->input->post('comments'),
            'created' =>date("Y-m-d H:i:s")
        );
        $id = $this->input->post('emp_leaveid');
        $this->Leave_model->update_leave_table($id, $data);
        //$this->Leave_model->update_leave_table($id);
        echo json_encode(array('status' => TRUE));
        
    }

    public function leave_edit($id) {
        $data = $this->Leave_model->get_by_leave_id($id);
        echo json_encode($data);
    }

    public function delete_leave($id) {
        $this->Leave_model->delete_leave($id);
        echo json_encode(array('status' => TRUE));
    }

    public function empid_check($id) {
        $data = $this->Leave_model->empid_check($id);
        $data->deptname = $this->Common_model->get_emp_sec_emp_dept_id($data->deptid);
        $data->secname = $this->Common_model->get_emp_sec_emp_sec_id($data->secid);
        $data->designame = $this->Common_model->get_emp_sec_emp_desig_id($data->desigid);

        if ($data) {
            echo json_encode($data);
        } else {
            return FALSE;
        }
    }

    public function approver_check($id) {
        $data = $this->Leave_model->empid_check($id);
        if ($data) {
            echo json_encode($data);
        } else {
            return FALSE;
        }
    }

}
