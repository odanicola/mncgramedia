<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_Merchandise extends CI_Controller {
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
        $arr['page'] = 'cat_merchandise';

        $arr['category_merchandise'] = $this->getAllCategory();
        $this->load->view('admin/merchandise/vwManageCategoryMerchandise',$arr);
    }

    public function getAllCategory(){
        $qry ='Select * from tbl_merchandise_category'; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function add_new(){
      $this->load->view('admin/merchandise/vwAddCategoryMerchandise');
    }

    public function add_category_merchandise(){
      $title       = $_POST['title'];
      $sort        = $_POST['sort'];

      if(isset($title) && !empty($title) ){
        $title = mysql_real_escape_string($title);

        $sql = "insert into tbl_merchandise_category values ('', '$sort' , '$title')";
        $val = $this->db->query($sql);

        $arr['flash'] = 'Category was successfully added.';
        $arr['status'] = '0';
        $arr['category_merchandise'] = $this->getAllCategory();

        $this->session->set_flashdata('category_merchandise', array('message' => 'Data has been added.','class' => 'alert alert-success'));
        redirect('admin/category_merchandise/');

        //redirect('admin/category_merchandise/');
      }else{
        $this->session->set_flashdata('category_merchandise', array('message' => 'An error occured while adding the data.','class' => 'alert alert-danger'));
        redirect('admin/category_merchandise/');
      }
    }

    public function edit_category_merchandise($id='') {
      $arr['page'] = 'cat_merchandise';
      if($id!=''){
        $qry ='Select * from tbl_merchandise_category where id='.$id ; // select data from db
        $arr['category_merchandise'] = $this->db->query($qry)->result_array();

        $this->load->view('admin/merchandise/vwEditCategoryMerchandise',$arr);
      }else{
          redirect('admin/category_merchandise');
      }
    }

   public function update_category_merchandise() {

     $id          = $_POST['pst_id'];
     $title       = $_POST['title'];
     $sort        = $_POST['sort'];

     if(isset($id) && !empty($id) ){
       $title = mysql_real_escape_string($title);
       
       $sql = "update tbl_merchandise_category set `title`='".$title."', `sort`='".$sort."' where id=".$id;
       $val = $this->db->query($sql);
       $this->session->set_flashdata('edit_category_merchandise', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
       redirect('admin/category_merchandise/edit_category_merchandise/'.$id);
     }else{
       $this->session->set_flashdata('edit_category_merchandise', array('message' => 'An error occured while updating the data.','class' => 'alert alert-danger'));
       redirect('admin/category_merchandise/edit_category_merchandise/'.$id);
     }

    }


    public function delete_category_merchandise($id = ''){
        $arr['page'] = 'cat_merchandise';
        if($id!=''){
            $qry ='delete from tbl_merchandise_category where id='.$id ; // select data from db
            $this->db->query($qry);

            $this->session->set_flashdata('category_merchandise', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
            redirect('admin/category_merchandise/');

            //redirect('admin/category_merchandise');
        }else{
            $this->session->set_flashdata('category_merchandise', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
            redirect('admin/category_merchandise/');
        }
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
