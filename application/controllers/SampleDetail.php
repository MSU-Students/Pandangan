<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SampleDetail extends CI_Controller {


	public function index()
	{
      //$this->load->model('DetailModel','detail');
        $data['userArr'] = $this->DetailModel->userDetail();
        $this->load->view('detailView',$data);
    }
   
}
