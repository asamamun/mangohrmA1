<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*	
 *	@author 	: Md Nazrul Islam Bhuiyan
 *	date		: 15 May, 2016
 *	Human Resource Management System Pro
 *	url			:	http://bdcoder26.com/mangohrm
 *  Mobile		: +8801818685043
 */
class Emp_job_model extends CI_Model {
    public $table = 'emp_job';
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function emp_job_add($data, $empid) {
        $empquery = $this->db->get_where("employee", array('empid' => $empid));
        if ($empquery->num_rows() === 1) {
            $emp_row = $empquery->result_array();
            $emp_sl_id = $emp_row['0']['id'];
            $jobquery = $this->db->get_where($this->table, array('id' => $emp_sl_id));
            if ($jobquery->num_rows() === 1) {
                unset($data['id']);
                $this->db->where(array('id' => $emp_sl_id));
                $this->db->update($this->table, $data);
            } else {
                $data['id'] = $emp_sl_id;
                $this->db->insert($this->table, $data);
                unset($data['id']);
            }
            return TRUE;
        } else {

            return "The Employee may not exits in the database or You are logout. If you think it is a problem,please contact with software developers.";
        }
    }
    public function get_by_id($id) {
        $query = $this->db->get_where($this->table, array('id'=>$id));
        return $query->row();
    }
	public function emp_default_job_load() {
        $this->db->select('id,title');
        $query = $this->db->get("emp_job_category");
        return $query->result();
    }
	public function emp_default_shift_load(){
	$this->db->select('id,shiftname');
    $query = $this->db->get("shift");
    return $query->result();		
	}
}