<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Login extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->Model('authentication/Login_model');
			$this->load->database();
			$this->load->library(array('form_validation','session'));
			$this->load->helper(array('url', 'file'));
        }
 
        public function index()
    {
            $this->load->view('authentication/login');
    }
         
        public function logout(){
            $this->session->sess_destroy();
            redirect('/' ,'refresh');
            exit;
        }
         
        public function login(){
            $username =  $this->input->post('username',TRUE);
            $password =  $this->input->post('password',TRUE);
             
            //call the model for auth
            if($this->Login_model->login($username, $password)){
            }
            else{
                echo'something went wrong';
            }
        }               
}
