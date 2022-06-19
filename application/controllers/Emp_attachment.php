<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_attachment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('url', 'form', 'file'));
        $this->load->database();
        $this->load->model('employee/Emp_attach_Model');
    }

    public function index() {

        // $data['empdata'] = $this->attach->ses_id($this->session->userdata('eid'));
        $this->load->view('employee/emp_attach_view', array('error' => ' '));
    }

    public function upload() {
        if (!empty($_FILES)) {
            $eid = $this->session->userdata('emp_selected_id_no');
            $emp_dir = 'assets/upload/attachment/' . $eid;
            if (!is_dir($emp_dir)) {
                mkdir($emp_dir, 0777);
            }
            $orgFilename = $_FILES['file']['name'];
            $ext = pathinfo($orgFilename, PATHINFO_EXTENSION);

            $title = $this->input->post('attachmenttitle');
            $filename = strtotime(date("Y-m-d H:i:s")) . rand(111, 999) . "." . $ext;
            $filedesc = $this->input->post('attachmentdesc');

            $Attchment_Array = array(
                'eid' => $eid,
                'title' => $title,
                'filename' => $filename,
                'filedesc' => $filedesc,
                'created' => date('Y-m-d H:i:s'),
            );

            $config['upload_path'] = $emp_dir;
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
            $config['max_size'] = '2048';
            $config['file_name'] = $filename;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload("file")) {
                $this->session->set_flashdata("AttachmentUploadError", $this->upload->display_errors());
            } else {
                $this->Emp_attach_Model->insertData($Attchment_Array);
                $this->session->set_flashdata("AttachmentUploadError", "Attachment is uploaded.");
                $message=1;
            }
        } else {
            $this->session->set_flashdata("AttachmentUploadError", "Select Attachment First");
            $message="error";
        }
        echo json_encode($message);
    }

    function LoadTableData() {

        $result = $this->Emp_attach_Model->LoadTableData($this->session->userdata('emp_selected_id_no'));
        // if($result){
        echo json_encode($result);

        //}
    }

    function deleteAttachment($id) {
        $filename = $this->Emp_attach_Model->delete_attachment($id);
        if ($filename) {
            $file = $filename->filename;
            $eid = $this->session->userdata('emp_selected_id_no');
            $emp_dir = 'assets/upload/attachment/' . $eid;
            $FileFullinfo = $emp_dir . "/" . $file;
            unlink($FileFullinfo);
            //if(!$empty($filename)){
            echo json_encode(array('status' => TRUE));
        }
    }

}
