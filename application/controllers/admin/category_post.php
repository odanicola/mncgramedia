<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_Post extends CI_Controller {
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
        $arr['page'] = 'cat_post';
        $arr['category_post'] = $this->getAllCategory();

        $this->load->view('admin/post/vwManageCategoryPost',$arr);
    }

    public function getAllCategory(){
        $qry = 'Select * from tbl_post_category'; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function add_new(){
      $this->load->view('admin/post/vwAddCategoryPost');
    }

    public function add_category_post(){
      $title       = $_POST['title'];
      $sort        = $_POST['sort'];

      if(isset($title) && !empty($title) ){
        $title = mysql_real_escape_string($title);

        $sql = "insert into tbl_post_category values ('', '$title' , '$sort')";
        $val = $this->db->query($sql);

        $this->session->set_flashdata('category_post', array('message' => 'Data has been added.','class' => 'alert alert-success'));
        redirect('admin/category_post/');
      } else {
        $this->session->set_flashdata('category_post', array('message' => 'An error occured while adding the data.','class' => 'alert alert-danger'));
        redirect('admin/category_post/');
     }

    }

    public function edit_category_post($id='') {
      $arr['page'] = 'cat_post';
      if($id!=''){
        $qry ='Select * from tbl_post_category where id='.$id ; // select data from db
        $arr['category_post'] = $this->db->query($qry)->result_array();

        $this->load->view('admin/post/vwEditCategoryPost',$arr);
      }else{
          redirect('admin/category_post');
      }
    }

   public function update_category_post() {

     $id          = $_POST['pst_id'];
     $title       = $_POST['title'];
     $sort        = $_POST['sort'];

     if(isset($id) && !empty($id) ){
       $title = mysql_real_escape_string($title);
       
       $sql = "update tbl_post_category set `title`='".$title."', `sort`='".$sort."' where id=".$id;
       $val = $this->db->query($sql,array($new_content ,$id ));

       $this->session->set_flashdata('edit_category_post', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
       //redirect('admin/category_post/');
       redirect('admin/category_post/edit_category_post/'.$id);
     }else{
       $this->session->set_flashdata('edit_category_post', array('message' => 'An error occured while adding the data.','class' => 'alert alert-danger'));
       redirect('admin/category_post/edit_category_post/'.$id);
     }

    }


    public function delete_category_post($id = ''){
        $arr['page'] = 'cat_post';
        if($id!=''){
            $qry ='delete from tbl_post_category where id='.$id ; // select data from db
            $this->db->query($qry);
            $this->session->set_flashdata('category_post', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
            redirect('admin/category_post/');
            //redirect('admin/category_post');
        }else{
          $this->session->set_flashdata('category_post', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
          redirect('admin/category_post/');
        }
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
