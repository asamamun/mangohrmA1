<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_upload extends CI_Model {

    public $table = "emp_attendance";
    public $intime_start = 900;      // (SHIFTSTART Time), The punching will be started before 15(900)minutes. else $STATU=Questionable
    public $intime_end = 900;        // (SHIFTSTART Time), The punching will be continues 15(900)minutes. else $STATU=Late/Absent
    public $outtime_start = 120;     // (SHIFTEND Time), The punching might be continue before max 2 minutes else $STATU=Questionable
    public $outtime_end = 1800;      // (SHIFTEND Time), The punching will be continues 30(1800)minutes since SHIFTEND Time else $status=Questionable;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save() {
        $attendData = file("assets/upload/attendence/temp/attendeance.txt");
        foreach ($attendData as $data) {
            list($plantid, $companyid, $eid, $datetime, $a_year, $a_month, $a_day, $a_hour, $a_min, $a_sec, $shiftid, $status, $in_out) = explode("#", $data);
            $date = date("Y-m-d h:i:s");
            $line = ['plantid' => $plantid, 'companyid' => $companyid, 'eid' => $eid, 'a_year' => $a_year, 'a_month' => $a_month, 'a_day' => $a_day, 'a_hour' => $a_hour, 'a_min' => $a_min, 'a_sec' => $a_sec, 'shiftid' => $shiftid, 'status' => $status, 'in_out' => trim($in_out), 'comment' => 'NA', 'created' => $date];

            if (($this->checkduplication($this->table, $line)) == 0) {
                $this->insert($this->table, $line);
            } else {
                $this->update($this->table, $line, $line);
            }
        }
        return true;
    }

    public function checkduplication($table, $info) {
        unset($info['a_hour']);
        unset($info['a_min']);
        unset($info['a_sec']);
        unset($info['status']);
        unset($info['comment']);
        unset($info['created']);

        $this->db->from($table);
        $this->db->where($info);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function select($table, $info) {
        $this->db->from($table);
        $this->db->where($info);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert($table, $line) {
        $this->db->insert($table, $line);
        return $this->db->insert_id();
    }

    public function update($table, $info, $line) {
        unset($info['a_hour']);
        unset($info['a_min']);
        unset($info['a_sec']);
        unset($info['status']);
        unset($info['comment']);
        unset($info['created']);

        $this->db->from($table);
        $this->db->where($info);
        $query = $this->db->get();
        $query = $query->result();
        $query = $query[0];
        $id = $query->id;

        if ($info['in_out'] == 'in') {

            $this->inUpdate($id, $table, $query, $line);
        } else {

            $this->outUpdate($id, $table, $query, $line);
        }
    }

    public function inUpdate($id, $table, $query, $line) {

        $shifttime = $this->get_shift_by_id($query->eid);

        $shiftStart = mktime($shifttime->starthour, $shifttime->startminuite, 0);
        $shiftStartWithintime_start = $shiftStart - $this->intime_start;

        $dbtime = mktime($query->a_hour, $query->a_min, $query->a_sec);
        $uploadtime = mktime($line['a_hour'], $line['a_min'], $line['a_sec']);

        if ($dbtime > $uploadtime) {
            ##ex- 7pm > 6pm
            $this->updateNow($id, $table, $line);
        } elseif ($dbtime < $uploadtime) {
            ##ex- 6pm < 7pm
            if ($shiftStartWithintime_start < $uploadtime) {
                ##ex- 5.45pm < 7pm    
                ## nothing to update        
            } else {
                ##ex- 7.30pm > 7.00pm 
                ## need to update
                $this->updateNow($id, $table, $line);
            }
        } else {
            ##ex- 7pm == 7pm
            ## Nothing to do
        }
        return true;
    }

    public function outUpdate($id, $table, $query, $line) {
        $shifttime = $this->get_shift_by_id($query->eid);
        $shiftEnd = mktime($shifttime->endhour, $shifttime->endminuite, 0);
        $shiftStartWithouttime_End = $shiftEnd - $this->outtime_start;

        $dbtime = mktime($query->a_hour, $query->a_min, $query->a_sec);
        $uploadtime = mktime($line['a_hour'], $line['a_min'], $line['a_sec']);

        if ($dbtime > $uploadtime) {
            ##ex- 7pm > 6pm
            // $this->updateNow($id, $table, $line);
        } elseif ($dbtime < $uploadtime) {
            ##ex- 6pm < 7pm
            $this->updateNow($id, $table, $line);
        } else {
            ##ex- 7pm == 7pm
            ## Nothing to do
        }
        return true;
    }

    public function delete_by_id($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function get_shift_by_id($id) {
        $query = $this->db->query("select emp_job.shift, shift.* from emp_job join shift on emp_job.shift=shift.id where emp_job.id=$id");
        if ($query->num_rows() == 1) {
            return $query->row();
        }
    }

    public function updateNow($id, $table, $line) {
        $this->db->where('id', $id);
        $this->db->update($table, $line);
        return $this->db->affected_rows();
    }

}
