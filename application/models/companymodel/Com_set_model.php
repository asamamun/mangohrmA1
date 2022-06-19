<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
 
class Com_set_model extends CI_Model {
  public function __construct() {
        parent::__construct();
        $this->load->database();
    }
 
 function view() {
  $ambil = $this->db->get('companysetup');
  if ($ambil->num_rows() > 0) {
   foreach ($ambil->result() as $data) {
    $hasil[] = $data;
   }
   return $hasil;
  }
 }
 function edit($a) {
  $d = $this->db->get_where('companysetup', array('id' => $a))->row();
  return $d;
 }
 
 function update($id) {
  $cn = $this->input->post('cn');
  $dsc = $this->input->post('dsc');
  $ad1 = $this->input->post('ad1');
  $ad2 = $this->input->post('ad2');
  $teln = $this->input->post('teln');
  $fxn = $this->input->post('fxn');
  $eman = $this->input->post('eman');
  $webadd = $this->input->post('webadd');
  $tradelice = $this->input->post('tradelice');
  $owna = $this->input->post('owna');
  $tnum = $this->input->post('tnum');
  $edate = $this->input->post('edate');
  $alia = $this->input->post('alia');
  $ctype = $this->input->post('ctype');
  $data = array(
   'companyname' => $cn,
   'description' =>$dsc,
   'companyaddress1' => $ad1,
   'companyaddress2' =>$ad2,
    'tel' => $teln,
    'fax' => $fxn,
    'email' => $eman,
    'web' => $webadd,
    'tradeli' => $tradelice,
    'ownername' => $owna,
    'tin' =>  $tnum,
    'establishmentdate' => $edate,
    'alias' => $alia,
    'companytype' =>  $ctype,
     
  );
  $this->db->where('id', $id);
  $this->db->update('companysetup', $data);
 }
}

