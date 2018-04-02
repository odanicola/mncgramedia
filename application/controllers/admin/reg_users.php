<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reg_Users extends CI_Controller {
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
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index() {
        $arr['page'] = 'reg_users';

        $qry ='select * from tbl_reg'; // select data from db
        $arr['reg_users'] = $this->db->query($qry)->result_array();

        $this->load->view('admin/reg_users/vwManageRegUsers',$arr);
    }

    public function detail_user($id = ''){
      $arr['page'] = 'reg_users';
      if($id!=''){
        $qry ='select * from tbl_reg where id='.$id; // select data from db

        $arr['reg_users'] = $this->db->query($qry)->result_array();

        $this->load->view('admin/reg_users/vwRegUsers',$arr);

      }else{
          redirect('admin/reg_users');
      }
    }

    public function delete_all(){
      $action = $_POST['action'];

        if($action == 'delete'){
          $msg    = !empty($_POST['msg']) ? $_POST['msg']: "";
          if($msg != ''):
          for ($i=0; $i < count($msg) ; $i++) {
    				$this->db->where('id', $msg[$i]);
      				if($this->db->delete('tbl_reg')){
                $this->session->set_flashdata('reg_users', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));

              }else{
                $this->session->set_flashdata('reg_users', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
                redirect('admin/reg_users');
              }
  			  }
          endif;
          redirect('admin/reg_users');
        }
        else{
          $this->session->set_flashdata('reg_users', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
          redirect('admin/reg_users');
      }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
