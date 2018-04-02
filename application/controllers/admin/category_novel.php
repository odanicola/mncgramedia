<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_Novel extends CI_Controller {
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
        $arr['page'] = 'cat_novel';

        $arr['category_novel'] = $this->getAllCategory();
        $this->load->view('admin/novel/vwManageCategoryNovel',$arr);
    }

    public function getAllCategory(){
        $qry ='Select * from tbl_novel_category'; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }
    public function add_new(){
      $qry ='Select * from tbl_media_type'; // select data from db
      $arr['media_type'] = $this->db->query($qry)->result_array();
      $this->load->view('admin/novel/vwAddCategoryNovel', $arr);
    }

    public function add_category_novel(){
      $title       = $_POST['title'];
      $sort        = $_POST['sort'];
      $media_type  = $_POST['media_type'];

      if(isset($title) && !empty($title) ){
        $title = mysql_real_escape_string($title);

        $sql = "insert into tbl_novel_category values ('', '$media_type' , '$sort' , '$title')";
        $val = $this->db->query($sql);

        $this->session->set_flashdata('category_novel', array('message' => 'Data has been added.','class' => 'alert alert-success'));
        redirect('admin/category_novel/');
      } else {
        $this->session->set_flashdata('category_novel', array('message' => 'An error occured while adding the data.','class' => 'alert alert-danger'));
        redirect('admin/category_novel/');
      }

    }

    public function edit_category_novel($id='') {
      $arr['page'] = 'cat_novel';
      if($id!=''){
        $qry ='Select * from tbl_novel_category where id='.$id ; // select data from db
        $arr['category_novel'] = $this->db->query($qry)->result_array();

        $this->load->view('admin/novel/vwEditCategoryNovel',$arr);
      }else{
          redirect('admin/category_novel');
      }
    }

   public function update_category_novel() {

     $id          = $_POST['pst_id'];
     $title       = $_POST['title'];
     $sort        = $_POST['sort'];

     if(isset($id) && !empty($id) ){
       $title = mysql_real_escape_string($title);
       
       $sql = "update tbl_novel_category set `title`='".$title."', `sort`='".$sort."' where id=".$id;
       $val = $this->db->query($sql);

       $this->session->set_flashdata('edit_category_novel', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
       redirect('admin/category_novel/edit_category_novel/'.$id);
     }else{
       $this->session->set_flashdata('edit_category_novel', array('message' => 'An error occured while updating the data.','class' => 'alert alert-danger'));
       redirect('admin/category_novel/edit_category_novel/'.$id);
     }

    }


    public function delete_category_novel($id = ''){
        $arr['page'] = 'cat_novel';
        if($id!=''){
            $qry ='delete from tbl_novel_category where id='.$id ; // select data from db
            $this->db->query($qry);

            $this->session->set_flashdata('category_novel', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
            redirect('admin/category_novel');
        }else{

          $this->session->set_flashdata('category_novel', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
          redirect('admin/category_novel/');
        }
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
