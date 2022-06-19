<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department_model extends CI_Model {

	var $table = 'department';
	var $column = array('deptid','deptname','deptdesc','plantid','createdate','deleted'); //set column field database for order and search
	var $order = array('deptid' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table)->where(array('deleted'=>0));

		$i = 0;
	
		foreach ($this->column as $item) // loop column 
		{
			if(isset($_POST['search']['value'])) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$column[$i] = $item; // set column array variable to order processing
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtereddepartment()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_department()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_departmentby_id($deptid)
	{
		$this->db->from($this->table);
		$this->db->where('deptid',$deptid);
		$query = $this->db->get();

		return $query->row();
	}

	public function save_department($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update_department($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_departmentby_id($deptid)
	{
		$this->db->where('deptid', $deptid);
		$this->db->update($this->table, array('deleted' => 1));
	}
	
	public function select_plant(){
		$query = $this->db->get('plant');
		return $query->result_array();

	}


}
