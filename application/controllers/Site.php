<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

    public function __construct() {
        parent::__construct();
      
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('url', 'form', 'file'));
    }

	public function index()
	{
		$this->load->view("employee/site");
	}

	public function upload()
	{
            
		if ( ! empty($_FILES))
		{
			$config['upload_path'] = "./assets/uploads";
			$config['allowed_types'] = 'gif|jpg|png|mp4|ogv|zip';

			$this->load->library('upload', $config);
			if (! $this->upload->do_upload("file")) {
				echo "File cannot be uploaded";
			}
		}
		else {
			$this->listFiles();
		}
	}

	private function listFiles()
	{
		$this->load->helper('file');
		$files = get_filenames("./assets/uploads");
		echo json_encode($files);
	}

}