<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attend_upload extends CI_Controller {

    public $intime_start = 900;      // (SHIFTSTART Time), The punching will be started before 15(900)minutes. else $STATU=Questionable
    public $intime_end = 900;        // (SHIFTSTART Time), The punching will be continues 15(900)minutes. else $STATU=Late/Absent
    public $outtime_start = 120;     // (SHIFTEND Time), The punching might be continue before max 2 minutes else $STATU=Questionable
    public $outtime_end = 1800;      // (SHIFTEND Time), The punching will be continues 30(1800)minutes since SHIFTEND Time else $status=Questionable;
    public $checkingInOut = "";
    public $late_time_diff = 600;    // The Employee's $status will be late if the punch differ more then 10 minutes than SHIFTSTART.
    public $name;

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'file'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->database();
        $this->load->model('attendance/Attendance_model');
        $this->load->model('attendance/Attendance_upload');
        $this->load->model('Common_model');
    }

    public function set_attendance_punch_InTime_status($shift_time_start_after_before, $InTimeDiffer) {
        if ($shift_time_start_after_before == "STB") {
            if ($InTimeDiffer <= $this->intime_start) {
                return "P";
            } else {
                return "Q";
            }
        } else {

            if ($InTimeDiffer <= $this->intime_end) {
                if ($this->late_time_diff <= $InTimeDiffer) {
                    return "L";
                } else {
                    return "P";
                }
            } else {
                return "A";
            }
        }
    }

    public function set_attendance_punch_OutTime_status($shift_time_end, $datetime) {
        if ($shift_time_end > $datetime) {

            if (($shift_time_end - $this->outtime_start) >= $datetime) {
                return "Q";
            } else {
                return "P";
            }
        } else {

            if (($this->outtime_end + $shift_time_end) < $datetime) {
                return "Q";
            } else {
                return "P";
            }
        }
    }

    public function write_error_attend_punch($line, $mode) {

        $fh = fopen("assets/upload/attendence/temp/attend_error_data.txt", $mode);
        fwrite($fh, $line);
        fclose($fh);
    }

    public function read_error_attend_punch() {

        

        if(file_exists("assets/upload/attendence/temp/attend_error_data.txt")){
           $attendErrorData = file("assets/upload/attendence/temp/attend_error_data.txt"); 
        foreach ($attendErrorData as $line) {
            if (explode("-", htmlspecialchars($line))) {
                list($plant, $company, $eid, $datetime) = explode("-", htmlspecialchars($line));

                $empinfo = $this->Common_model->get_empdetails_by_emp_id_no($eid);
                $ErrorAttendReport[] = [
                    'punchdata' => $line,
                    'companyid' => $company,
                    'eid' => $eid,
                    'empid' => @$empinfo->empid,
                ];
            } else {

                $ErrorAttendReport[] = [
                    'punchdata' => $line,
                    'companyid' => "NA",
                    'eid' => "NA",
                    'empid' => "NA",
                ];
            }
        }
        }

        if(isset($ErrorAttendReport)){
            return $ErrorAttendReport;
        }
    }

    public function index() {

        $mydata['name'] = "Upload Form Index";
        $this->load->view('attendance/UploadAttendance.php', $mydata);
    }

    public function Upload() {


        $config['upload_path'] = "assets/upload/attendence/";
        $config['allowed_types'] = "txt";
        $config['max_size'] = '1000';
        $config['overwrite'] = TRUE;
        $date = date("m-d-Y");
        $config['file_name'] = "attendeance_" . $date . ".txt";

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $this->session->set_flashdata("uploadError", $this->upload->display_errors());
           // $this->load->view('Attendance/UploadAttendance.php');
        } else {

            $lines = file($config['upload_path'] . $config['file_name']);
            if ($lines) {
                if (file_exists('assets/upload/attendence/temp/attend_error_data.txt')) {
                    unlink('assets/upload/attendence/temp/attend_error_data.txt');
                }

                if (file_exists('assets/upload/attendence/temp/attendeance.txt')) {
                    unlink('assets/upload/attendence/temp/attendeance.txt');
                }
            }


            foreach ($lines as $line) {
                ##Checking Valid Punching                
                $regex = '/[0-9]{2}-[0-9]{2}-[a-zA-Z0-9]{5}-[0-9]{10}/';
                if (!preg_match($regex, $line)) {
                    //$this->write_error_attend_punch($line, 'at');
                    continue;
                }

                list($plant, $company, $eid, $datetime) = explode("-", htmlspecialchars($line));

                ##Seperating DateTime in Seperate Variables

                $DateTime = getdate((Int) $datetime);
                $ayear = $DateTime['year'];
                $amonth = $DateTime['mon'];
                $aday = $DateTime['mday'];
                $ahour = $DateTime['hours'];
                $amin = $DateTime['minutes'];
                $asec = $DateTime['seconds'];

                ##Get Shiftinfo
                if (!$this->Attendance_model->get_shift_by_id($eid)) {
                    $this->write_error_attend_punch($line, "at");
                    continue;
                }
                $shiftinfo = $this->Attendance_model->get_shift_by_id($eid);

## Set Status with various checking
                $status = "";

                ## START Checking InOutStatus
                $shift_time_start = mktime($shiftinfo->starthour, $shiftinfo->startminuite, 0, $DateTime['mon'], $DateTime['mday'], $DateTime['year']);
                $shift_time_end = mktime($shiftinfo->endhour, $shiftinfo->endminuite, 0, $DateTime['mon'], $DateTime['mday'], $DateTime['year']);

                $InTimeDiffer = abs($shift_time_start - $datetime);
                $OutTimeDiffer = abs($shift_time_end - $datetime);

                if ($InTimeDiffer < $OutTimeDiffer) {
                    $this->checkingInOut = 1;
                } else {
                    $this->checkingInOut = 2;
                }

                $timediff = $shift_time_start - $datetime;
                if ($this->checkingInOut === 1) {

                    ## Checking punching before shift start or shift end time;
                    $shift_time_start_after_before = "";
                    if ($timediff >= 0) {
                        $shift_time_start_after_before .="STB";
                    } else {
                        $shift_time_start_after_before .="STA";
                    }

## Set Status Now
######## InTime Status          
                    $status = $this->set_attendance_punch_InTime_status($shift_time_start_after_before, $InTimeDiffer);

                    unset($attend);
                    $attend[] = [
                        'plantid' => $plant,
                        'companyid' => $company,
                        'eid' => $eid,
                        'datetime' => trim($datetime),
                        'a_year' => $ayear,
                        'a_month' => $amonth,
                        'a_day' => $aday,
                        'a_hour' => $ahour,
                        'a_min' => $amin,
                        'a_sec' => $asec,
                        'shiftid' => $shiftinfo->shift,
                        'status' => $status,
                        'in_out' => "in"
                    ];
                    $this->write_attend_punch($attend);
                } else {

####### OutTime Status
## Checking punching before shift start or shift end time;
                    $status = $this->set_attendance_punch_OutTime_status($shift_time_end, $datetime);
                    unset($attend);
                    $attend[] = [
                        'plantid' => $plant,
                        'companyid' => $company,
                        'eid' => $eid,
                        'datetime' => trim($datetime),
                        'a_year' => $ayear,
                        'a_month' => $amonth,
                        'a_day' => $aday,
                        'a_hour' => $ahour,
                        'a_min' => $amin,
                        'a_sec' => $asec,
                        'shiftid' => $shiftinfo->shift,
                        'status' => $status,
                        'in_out' => "out"
                    ];
                    $this->write_attend_punch($attend);
                }
            }

            if (isset($attend)) {
                $uploadMessage = "ok";
            } else {
                $this->session->set_flashdata("uploadError", "<span class='text-danger'>No valid data found to prepared for uploading into database. Please select valid attendence file. Details are shown uploading report.</span>");
                $uploadMessage = "";
            }


            // print_r($this->read_error_attend_punch());
            $AttendErrorReport= $this->read_error_attend_punch();

            echo json_encode(array("message" => $uploadMessage, "attend_error_info" => $AttendErrorReport));
            /// $this->load->view('Attendance/UploadAttendance.php', $AttendErrorReport);
        }
    }


    public function write_attend_punch($attend) {
        $FinalAttend = implode("#", $attend[0]);
        $fh = fopen("assets/upload/attendence/temp/attendeance.txt", "at");
        fwrite($fh, $FinalAttend . "\r\n");
        fclose($fh);
    }

    public function Uploaddb() {
        if($this->Attendance_upload->save()){
          echo json_encode("ok");  
        };
    }

}
