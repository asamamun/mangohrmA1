<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empexperience_model extends CI_Model {
 
 public $table = 'emp_experience'; 
 var $column = array('id','eid','company','occupation','exp_from','exp_to','comment','created');
 var $order = array('id' => 'asc');
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function count_empexperience(){
		
		return $this->db->count_all_results($this->table);
	}
	
	public function select_empexperience($eid){
	
		//$query = $this->db->get($this->table);
		$query = $this->db->get_where($this->table, array('eid' => $eid));
		return $query->result_array();
	}
	
	public function get_empexperienceby_id($id){
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
		}
	
	public function save_empexperience($data){
					//$fh = fopen("data","w");
				//fwrite($fh,json_encode($data)."\n");
				//fclose($fh);
				//$this->db->last_query()
		$this->db->insert($this->table, $data);
		//$fh = fopen("model_data","at");
		//fwrite($fh,$this->db->last_query()."\n");
				//fwrite($fh,$this->db->insert_id()."\n");
			//	fclose($fh);
		return $this->db->insert_id();
		}
		
		public function update_empexperience($where, $data){
			$this->db->update($this->table, $data, $where);
			return $this->db->affected_rows();
			}
			
			public function delete_empexperienceby_id($id){
				$this->db->where('id', $id);
				$this->db->delete($this->table);
				}


}
