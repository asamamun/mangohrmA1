<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*	
 *	@author 	: Md Nazrul Islam Bhuiyan
 *	date		: 15 May, 2016
 *	Human Resource Management System Pro
 *	url			:	http://bdcoder26.com/mangohrm
 *  Mobile		: +8801818685043
 */
class Designations extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('designations/designations_model','designations');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('designations/designations_view');
	}

	public function ajax_list()
	{
		$list = $this->designations->get_datatables();
		$data = array();
		$no = $_POST['start'];
                $i=1;
		foreach ($list as $designations) {
			$no++;
			$row = array();
                        $row[] = $i++;
			$row[] = ucwords($designations->designame);
			$row[] = $designations->desigdesc;
			$row[] = $designations->grade;
			//$row[] = $designations->deleted;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_designations('."'".$designations->desigid."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="delete" onclick="delete_designations('."'".$designations->desigid."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->designations->count_all(),
						"recordsFiltered" => $this->designations->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($desigid)
	{
		$data = $this->designations->get_by_id($desigid);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'designame' => ucwords($this->input->post('designame')),
				'desigdesc' => $this->input->post('desigdesc'),
				'grade' => $this->input->post('grade'),
				'createdate' => date("Y-m-d"),
				//'deleted' => $this->input->post('deleted'),
				'deleted' => 0,
				
				
			);
		$insert = $this->designations->save($data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'designame' => $this->input->post('designame'),
				'desigdesc' => $this->input->post('desigdesc'),
				'grade' => $this->input->post('grade'),
				//'deleted' => $this->input->post('deleted'),

			);
		$this->designations->update(array('desigid' => $this->input->post('desigid')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($desigid)
	{
		$this->designations->delete_by_id($desigid);
		echo json_encode(array("status" => TRUE));
	}
	public function emp_grade_loading() {
      $data['emp_grade'] = $this->designations->emp_grade_load();
      echo json_encode($data);
      }
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('designame') == '')
		{
			$data['inputerror'][] = 'designame';
			$data['error_string'][] = 'Designation name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('desigdesc') == '')
		{
			$data['inputerror'][] = 'desigdesc';
			$data['error_string'][] = 'descriptive is required';
			$data['status'] = FALSE;
		}

	
		if($this->input->post('grade') == '')
		{
			$data['inputerror'][] = 'grade';
			$data['error_string'][] = 'Please select grade';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
