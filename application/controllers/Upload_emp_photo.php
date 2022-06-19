<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_emp_photo extends CI_controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
    }

    /*
      private function load_form($error){
      $this->load->view('header');
      $this->load->view('upload_form', array('error'=>$error));
      $this->load->view('footer');
      }

      public function index(){
      $this->load_form("");
      } */

    public function do_upload() {
        $config['upload_path'] = "assets/upload/emp_photo";
        $config['allowed_types'] = "jpg|jpeg|gif|png";
        $config['max_size'] = '1024';
$config['file_name'] = '1024';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $error = $this->upload->display_errors();
            $this->load_form($error);
        } else {

            //* Image Manipulation
            $config['image_library'] = 'gd2';
            $config['source_image'] = $this->upload->data('full_path');
            $config['create_thumb'] = $data = array('data' => $this->upload->data());

        }
    }

}
