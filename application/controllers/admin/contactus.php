<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ContactUs extends CI_Controller {
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
        $arr['page'] = 'contact';
        $qry ='Select * from tbl_contact_data ORDER BY id DESC'; // select data from db
        $arr['contact'] = $this->db->query($qry)->result_array();
        $this->load->view('admin/contact/vwManageContactMessage',$arr);
    }

    public function detail_contact($id='') {
        $qry ='Select * from tbl_contact_data where id='.$id; // select data from db
        $arr['contact'] = $this->db->query($qry)->result_array();
        $this->load->view('admin/contact/vwDetailContactMessage',$arr);
    }

    public function delete_contact($id = ''){
        $arr['page'] = 'delete_contact';
        if($id!=''){
            $qry ='delete from tbl_contact_data where id='.$id ; // select data from db
            $this->db->query($qry);
            $this->session->set_flashdata('contactus', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
            redirect('admin/contactus');
        }else{
            $this->session->set_flashdata('contactus', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
            redirect('admin/contactus');
        }
    }

    public function delete_contact_all(){
      $action = $_POST['action'];

        if($action == 'delete'){
          $msg    = !empty($_POST['msg']) ? $_POST['msg']: "";
          if($msg != ''):
          for ($i=0; $i < count($msg) ; $i++) {
    				$this->db->where('id', $msg[$i]);
      				if($this->db->delete('tbl_contact_data')){
                $this->session->set_flashdata('contactus', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
              }else{
                $this->session->set_flashdata('contactus', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
                redirect('admin/contactus');
              }
  			  }
          endif;
          redirect('admin/contactus');
        }
        else{
          $this->session->set_flashdata('contactus', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
          redirect('admin/contactus');
      }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
