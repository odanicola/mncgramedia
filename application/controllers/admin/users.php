<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {
/*
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
*/
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index() {
        $arr['page'] = 'user';
		if($this->session->userdata('user_type') == 'SA'){
			$qry ='select * from tbl_admin_users'; // select data from db
			$arr['user'] = $this->db->query($qry)->result_array();
		}else{
			$qry ="select * from tbl_admin_users where user_type = 'A'"; // select data from db
			$arr['user'] = $this->db->query($qry)->result_array();
		}
        
        $this->load->view('admin/users/vwManageUser',$arr);
    }

    public function add_new() {
        $arr['page'] = 'user';
        $this->load->view('admin/users/vwAddUser',$arr);
    }
	
	public function add_user(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email	  = $_POST['email'];
		//$retypepassword = $_POST['repassword'];
		$salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
		$password_hash = md5($salt.$password);
		
		$qry ="INSERT INTO tbl_admin_users values('','".$username."', '".$email."', '".$password_hash."', '', 'A')"; // select data from db
        $val = $this->db->query($qry);
		if($val){
			redirect('admin/users');
		}else{
			redirect('admin/users');
		}
		
	}
    public function edit_user($id) {
        $arr['page'] = 'user';
		$qry ="select * from tbl_admin_users where id = '".$id."'"; // select data from db
		$arr['user'] = $this->db->query($qry)->result_array();
        $this->load->view('admin/users/vwEditUser',$arr);
    }
    
	public function update_user(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email	  = $_POST['email'];
		$id		  = $_POST['id'];
		$salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
		$password_hash = md5($salt.$password);
		
		if(!empty($password)):
			$qry ="UPDATE tbl_admin_users set `username` = '".$username."', `email` = '".$email."', `password` = '".$password_hash."' WHERE id = ".$id.""; // select data from db
			$val = $this->db->query($qry);
		else:
			$qry ="UPDATE tbl_admin_users set `username` = '".$username."', `email` = '".$email."' WHERE id = ".$id.""; // select data from db
			$val = $this->db->query($qry);
		endif;
		if($val){
			redirect('admin/users/edit_user/' . $id);
		}else{
			redirect('admin/users/edit_user/' . $id);
		}
		$this->load->view('admin/users/vwEditUser',$arr);
	}
     public function block_user() {
        // Code goes here
    }
    
     public function delete_user() {
        // Code goes here
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */