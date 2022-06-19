<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Admin extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->Model('authentication/Login_model');
			$this->load->database();
			$this->load->library(array('form_validation','session'));
			$this->load->helper(array('url', 'file'));
        }
        public function index(){
            //check user logged in or not
            $this->Login_model->isLoggedIn();
            $this->load->view('authentication/admin');
    }
         
         
         
}
