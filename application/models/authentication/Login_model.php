<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model {
     
     
    public function login($name, $password){
    $password = sha1($password);
        $this->db->where('username',$name);
        $this->db->where('userpass',$password);
        $query = $this->db->get('admin');
        if($query->num_rows()==1){
            foreach ($query->result() as $row){
                $data = array(
                            'username'=> $row->username,
                            'logged_in'=>TRUE
                        );
            }
            $this->session->set_userdata($data);
            return TRUE;
        }
        else{
            return FALSE;
      }    
    }
    public function isLoggedIn(){
            $is_logged_in = $this->session->userdata('logged_in');
            if(!isset($is_logged_in) || $is_logged_in!==TRUE)
            {
                redirect('/');
                exit;
            }
    }
     
}