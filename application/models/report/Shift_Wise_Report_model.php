<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shift_Wise_Report_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_shift_info() {
        $query = $this->db->query("select id, shiftname from shift");
        return $query->result();
    }
    
function get_enum_values( $table, $field )
{
    $type = $this->db->query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" )->row( 0 )->Type;
    preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
    $enum = explode("','", $matches[1]);
    return $enum;
}    
    
    

    public function get_emp_info_filter_by_shiftid($id, $status) {
        if($id==0){
          $Criteria="";  
        } else {
          $Criteria="and emp_job.shift=$id";
        }
        
        
        $query = $this->db->query("
            select employee.`id`, employee.`empid`, department.`deptname`, section.`secname`, designation.`designame`, employee.`fname`, employee.`mname`, employee.`lname`, employee.`fathersname`, employee.`gender`,
    employee.`dob`, emp_job.`basic_salary`, emp_job.`shift`, emp_job.`emp_status`, emp_job.`startdate`from employee
    JOIN emp_job on emp_job.`id`=employee.id
    JOIN department on department.`deptid`=employee.`deptid`
    JOIN section on section.`secid`=employee.`secid`
    JOIN designation on designation.`desigid`=employee.`desigid` where employee.deleted=0 and emp_job.`emp_status`='$status' 
    $Criteria");
        return $query->result();
    }

}
