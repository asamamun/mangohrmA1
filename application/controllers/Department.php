<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('department/department_model','department');
	}

	public function index()
	{
		$this->load->helper('url');
		$data['plants'] = $this->department->select_plant();
		$this->load->view('department/department_view', $data);
	}

	public function ajax_departmentlist()
	{
		$list = $this->department->get_datatables();
		$data = array();
		$no = $_POST['start'];
                $i=1;
		foreach ($list as $department) {
			$no++;
			$row = array();
			$row[] = $i++;
			$row[] = ucwords($department->deptname);
			$row[] = $department->deptdesc;
			$row[] = $department->plantid;
			//$row[] = $department->createdate;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_department('."'".$department->deptid."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_department('."'".$department->deptid."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->department->count_all_department(),
						"recordsFiltered" => $this->department->count_filtereddepartment(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_editdepartment($deptid)
	{
		$data = $this->department->get_departmentby_id($deptid);
		$data->createdate = ($data->createdate == '0000-00-00') ? '' : $data->createdate; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_adddepartment()
	{
		$this->_validatedepartment();
		$data = array(
				//'deptid' => $this->input->post('deptid'),
				'deptname' => ucwords($this->input->post('deptname')),
				'deptdesc' => $this->input->post('deptdesc'),
				'plantid' => $this->input->post('plantid'),
				'createdate' => $this->input->post('createdate'),
			);
		$insert = $this->department->save_department($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_updatedepartment()
	{
		$this->_validatedepartment();
		$data = array(
				'deptid' => $this->input->post('deptid'),
				'deptname' => $this->input->post('deptname'),
				'deptdesc' => $this->input->post('deptdesc'),
				'plantid' => $this->input->post('plantid'),
				'createdate' => $this->input->post('createdate'),
			);
		$this->department->update_department(array('deptid' => $this->input->post('deptid')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_deletedepartment($deptid)
	{
		$this->department->delete_departmentby_id($deptid);
		echo json_encode(array("status" => TRUE));
	}

	private function _validatedepartment()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		/*if($this->input->post('deptid') == '')
		{
			$data['inputerror'][] = 'deptid';
			$data['error_string'][] = 'Department id is required';
			$data['status'] = FALSE;
		}*/

		if($this->input->post('deptname') == '')
		{
			$data['inputerror'][] = 'deptname';
			$data['error_string'][] = 'Department name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('deptdesc') == '')
		{
			$data['inputerror'][] = 'deptdesc';
			$data['error_string'][] = 'Department description is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('plantid') == '')
		{
			$data['inputerror'][] = 'plantid';
			$data['error_string'][] = 'Plant ID is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('createdate') == '')
		{
			$data['inputerror'][] = 'createdate';
			$data['error_string'][] = 'Date of Establishment is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
