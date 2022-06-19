<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Company_Setup extends CI_Controller {
 public function __construct() {
        parent::__construct();
        $this->load->model('companymodel/Com_set_model');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('url', 'form','html'));
    }
 public function index()
 {
  $data['data_get'] = $this->Com_set_model->view();
  //$this->load->view('header');
  //$this->load->view('leftnav');
  $this->load->view('companyview/company_setup_view', $data);
  $this->load->view('footer');
 }

 function edit() {
  $kd = $this->uri->segment(3);
  if ($kd == NULL) {
   redirect('Company_Setup');
  }
  $dt = $this->Com_set_model->edit($kd);
  $data['cn'] = $dt->companyname;
  $data['dsc'] = $dt->description;
  $data['ad1'] = $dt->companyaddress1;
  $data['ad2'] = $dt->companyaddress2;
  $data['teln'] = $dt->tel;
  $data['fxn'] = $dt->fax;
  $data['eman'] = $dt->email;
  $data['webadd'] = $dt->web;
  $data['tradelice'] = $dt->tradeli;
  $data['owna'] = $dt->ownername;
  $data['tnum'] = $dt->tin;
  $data['edate'] = $dt->establishmentdate;
  $data['alia'] = $dt->alias;
  $data['ctype'] = $dt->companytype;
  $data['id'] = $kd;
  //$this->load->view('header');
  $this->load->view('companyview/company_edit', $data);
  $this->load->view('footer');
 }
 
 
 function update() {
  if ($this->input->post('mit')) {
   $id = $this->input->post('id');
   $this->Com_set_model->update($id);
   redirect('Company_Setup');
  } else{
   redirect('Company_Setup/edit/'.$id);
  }
 }
}
 
