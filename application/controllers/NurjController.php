<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NurjController extends CI_Controller {


	public function index()
	{
        
		$this->load->view('nurjView');
    }
    public function test(){
        $this->load->model('NurjModel','model');
        $firstName = $this->model->firstName();
        echo $firstName;
       
    }
}
