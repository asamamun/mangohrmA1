<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Empgrade extends CI_Controller {
 
   public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('grade/empgrade_model','emgrade');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('grade/empgrade_view');
	}

	public function ajax_list()
	{
		$list = $this->emgrade->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $emgrade) {
			$no++;
			$row = array();
			
			$row[] = $emgrade->gradeid;
			$row[] = $emgrade->gradename;
			$row[] = $emgrade->basic;
			$row[] = $emgrade->houserent;
			$row[] = $emgrade->medical;
			$row[] = $emgrade->other;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="grade_edit('."'".$emgrade->id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="delete" onclick="grade_delete('."'".$emgrade->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->emgrade->count_all(),
						"recordsFiltered" => $this->emgrade->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->emgrade->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'gradeid' => $this->input->post('gradeid'),
				'gradename' => $this->input->post('gradename'),
				'basic' => $this->input->post('basic'),
				'houserent' => $this->input->post('houserent'),
				'medical' => $this->input->post('medical'),
				'other' => $this->input->post('other'),
				);
		$insert = $this->emgrade->save($data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'gradeid' => $this->input->post('gradeid'),
				'gradename' => $this->input->post('gradename'),
				'basic' => $this->input->post('basic'),
				'houserent' => $this->input->post('houserent'),
				'medical' => $this->input->post('medical'),
				'other' => $this->input->post('other'),
				);
		$this->emgrade->update(array('gradeid' => $this->input->post('gradeid')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->emgrade->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		
		
		
		if($this->input->post('gradeid') == '')
		{
			$data['inputerror'][] = 'gradeid';
			$data['error_string'][] = 'Grade id is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('gradename') == '')
		{
			$data['inputerror'][] = 'gradename';
			$data['error_string'][] = 'Grade name is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('basic') == '')
		{
			$data['inputerror'][] = 'basic';
			$data['error_string'][] = 'Basic is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('houserent') == '')
		{
			$data['inputerror'][] = 'houserent';
			$data['error_string'][] = 'Houserent is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('medical') == '')
		{
			$data['inputerror'][] = 'medical';
			$data['error_string'][] = 'Medical Al is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
