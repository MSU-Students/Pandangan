<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NurjModel extends CI_Model {


	public function firstName()
	{
        $lastName = $this->lastName();
        return 'Nurjadein '.$lastName;
    }
    private function lastName()
	{
        return 'Abdulmorid';
    }
}
