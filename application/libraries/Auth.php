<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('Form', 'url'));
        $this->load->model('User_model');
        $this->load->model('Auth');
        $this->load->library(array('form_validation', 'session'));
        // $this->load->library('encryption');
        $this->load->database();
    }

    public function login() {
        $this->load->view('auth_view/login');
    }

    public function signin() {
        $this->form_validation->set_error_delimiters('<li style="color:yellow">', '</li>');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if ($userinfo = $this->Auth->login($email, $password)) {
                if ($userinfo->status == 0) {
                    return $this->LoginError("You are not an active user. Please contact with administrator");
                } elseif ($userinfo->is_deleted == 1) {
                    return $this->LoginError("You are not authorized user. Please contact with administrator");
                } elseif ($userinfo->is_banned == 1) {
                    return $this->LoginError("You are not banned user. Please contact with administrator");
                } else {
                    $this->session->set_userdata('name', $userinfo->name);
                    $this->session->set_userdata('rank_id', $userinfo->rank_id);
                    $this->session->set_userdata('email', $userinfo->email);
                    $this->session->set_userdata('thumbnil', $userinfo->thumbnil);
                    echo $userinfo->thumbnil;
                }
            } else {
                $info['message'] = "Email or password is wrong.";
            }
        } else {
            $this->load->view('auth_view/login');
        }
    }

    public function signup() {
        $this->load->view('auth_view/register');
    }

    protected function LoginError($message) {
        $info['message'] = $message;
        $this->load->view('auth_view/login', $info);
    }

    public function register() {
        $this->form_validation->set_error_delimiters('<li style="color:yellow">', '</li>');
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[80]');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('rpassword', 'Re-type Password', 'matches[password]');

        if ($this->form_validation->run()) {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $remark = $this->input->post('remark');

            $user_id = $this->authentication->create_user($name, $email, $password, $remark);
            print_r($user_id);
            exit();
            //redirect('dashboard/index');
        } else {
            $this->load->view('auth_view/register');
            //$this->load->view('equipment_view/add');
        }
    }

    public function index() {



        /*
          if ($this->account_model->logged_in() === TRUE) {
          $this->load->view('index');
          //$this->dashboard(TRUE);
          } else {
          $this->load->view('auth_view/login');
          } */
    }

//index end
}
