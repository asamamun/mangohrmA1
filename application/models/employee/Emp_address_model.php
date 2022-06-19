<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_address_model extends CI_Model {

    public $table = 'emp_address';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function emp_address_add($data, $empid) {
        //$this->db->select('id');
        $empquery = $this->db->get_where("employee", array('empid' => $empid));

        if ($empquery->num_rows() === 1) {
            $emp_row = $empquery->result_array();
            $emp_sl_id = $emp_row['0']['id'];

            $addrsssquery = $this->db->get_where($this->table, array('id' => $emp_sl_id));
            if ($addrsssquery->num_rows() === 1) {
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
        /*
          $emp_address_data = $this->db->get_where($this->table, array('id' => $emid));
          if ($emp_address_data->num_row() == 0) {
          $this->db->insert("emp_address", $data);
          return $this->db->insert_id();
          } else {
          $this->db->where(array('id'=>$emid));
          $this->db->insert("emp_address", $data);
          return $this->db->insert_id();
          } */
        /* }/*
          $this->db->insert("emp_address", $data);
          return $this->db->insert_id(); */
    }

    /*
      function get_datatables() {
      $this->_get_datatables_query();
      if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
      $this->db->where('deleted', 0);
      $query = $this->db->get();
      return $query->result();
      }

      function count_filtered() {
      $this->_get_datatables_query();
      $query = $this->db->get();
      return $query->num_rows();
      }

      public function count_all() {
      $this->db->from($this->table);
      return $this->db->count_all_results();
      }
     */

    public function get_by_id($id) {
        $query = $this->db->get_where($this->table, array('id'=>$id));

        return $query->row();
    }

    /*
      public function emp_save($data) {
      $this->db->insert($this->table, $data);

      return $this->db->insert_id();
      }

      public function emp_update($where, $data) {
      $this->db->update($this->table, $data, $where);
      return $this->db->affected_rows();
      }

      public function delete_by_id($id) {
      $this->db->where('empid', $id);
      $this->db->update($this->table, array('deleted' => '1'));
      }

      public function get_deptname($deptcode) {
      //$this->db->select('deptname');
      //$this->db->select('deptname');
      //$query = $this->db->get();
      //return $query->result();
      //$this->db->where('deptid', $deptcode);
      //$query=$this->db->get('department');
      $query = $this->db->query("select deptname from department where `deptid`= " . $deptcode);
      return $query->row();
      }

      public function load_dept() {
      $this->db->select('deptname, deptid');
      $query = $this->db->get_where("department", array('deleted' => 0));
      return $query->result();
      }

      public function get_desig($desigid) {
      $query = $this->db->query("select designame from designation where `desigid`= " . $desigid);
      return $query->row();
      }


      function getLastInserted() {
      $query=$this->db->query("SELECT MAX(empid) FROM employee");
      $row =$query->row();
      return $row; }
     */
}
