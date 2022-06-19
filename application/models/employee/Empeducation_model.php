<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empeducation_model extends CI_Model {
 
 public $table = 'emp_education'; 
 var $column = array('id','eid','level', 'institute', 'board', 'major', 'year', 'score', 'start_date', 'end_date', 'created');
 var $order = array('id' => 'asc');
	public function __construct()
	{
		parent::__construct();
                $this->load->library(array('session'));
		$this->load->database();
	}
	
	public function count_empeducation(){
		
		return $this->db->count_all_results($this->table);
	}
	
	public function select_empeeducation($eid){
                //$eid =$this->session->userdata('emp_selected_card_no') ;
		$query = $this->db->get_where($this->table, array('eid' => $eid));
		return $query->result_array();
                //return $eid;
	}
	
	public function get_empeeducation_id($id){
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
		}
	
	public function save_empeeducation($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
		}
		
		public function update_empeeducation($where, $data){
			$this->db->update($this->table, $data, $where);
			return $this->db->affected_rows();
			}
			
			public function delete_empeducation_id($id){
				$this->db->where('id', $id);
				$this->db->delete($this->table);
				}


}
