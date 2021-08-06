
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailModel extends CI_Model {


	// public function userDetail()
	// {
    //     return ['girl'=>'Janifah','lover'=>'Nurjadein'];
    // }
    // public function userDetail(){
    //     $this->load->database();
    //     $query = $this->db->query('SELECT * FROM users');
    //     return $query->result();
    // }
    public function userDetail(){
        // $this->load->database();
        // $query = $this->db->get('users');
        // $this->load->library('libName');
        // $this->libName ->methodName();
        // $this->load->helper['helperName'];
        // method();
        // $this->load->helper('custom_helper');
        // echo display();
        
        $this->db->select('*');
        $this->db->from('users');
         $this->db->where(array('id'=>'1','girl'=>'Janifah'));
         $query =$this->db->get();
        return $query->row();
    }
}
