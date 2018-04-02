<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_Comic extends CI_Controller {
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
        $arr['page'] = 'cat_comic';

        $arr['category_comic'] = $this->getAllCategory();
        $this->load->view('admin/comic/vwManageCategoryComic',$arr);
    }

    public function getAllCategory(){
        $qry ='Select * from tbl_comic_category'; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function add_new(){
      $qry ='Select * from tbl_media_type'; // select data from db
      $arr['media_type'] = $this->db->query($qry)->result_array();
      $this->load->view('admin/comic/vwAddCategoryComic', $arr);
    }

    public function add_category_comic(){
      $title       = $_POST['title'];
      $sort        = $_POST['sort'];
      $media_type  = $_POST['media_type'];

      if(isset($title) && !empty($title) ){
        $sql = "insert into tbl_comic_category values ('', '$media_type' , '$sort' , '$title')";
        $val = $this->db->query($sql);

        $arr['flash'] = 'Category was successfully added.';
        $arr['status'] = '0';
        $arr['category_comic'] = $this->getAllCategory();

        $this->load->view('admin/comic/vwManageCategoryComic',$arr);
        //redirect('admin/category_comic/');
      } else {

        $arr['flash'] = 'An error occured while saving the data.';
        $arr['status'] = '1';
        $arr['category_comic'] = $this->getAllCategory();

        $this->load->view('admin/comic/vwManageCategoryComic',$arr);

      }

    }

    public function edit_category_comic($id='') {
      $arr['page'] = 'cat_comic';
      if($id!=''){
        $qry ='Select * from tbl_comic_category where id='.$id ; // select data from db
        $arr['category_comic'] = $this->db->query($qry)->result_array();

        $this->load->view('admin/comic/vwManageCategoryComic',$arr);
      }else{
          redirect('admin/category_comic');
      }
    }

   public function update_category_comic() {

     $id          = $_POST['pst_id'];
     $title       = $_POST['title'];
     $sort        = $_POST['sort'];

     if(isset($id) && !empty($id) ){
       $sql = "update tbl_comic_category set `title`='".$title."', `sort`='".$sort."' where id=".$id;
       $val = $this->db->query($sql,array($new_content ,$id ));

       redirect('admin/category_comic/edit_category_comic/'.$id);
     }

        $arr['page'] = 'category_comic';
        $this->load->view('admin/comic/vwEditCategoryComic',$arr);
    }


    public function delete_category_comic($id = ''){
        $arr['page'] = 'cat_comic';
        if($id!=''){
            $qry ='delete from tbl_comic_category where id='.$id ; // select data from db
            $this->db->query($qry);

            $arr['flash'] = 'Category was successfully deleted.';
            $arr['status'] = '0';
            $arr['category_comic'] = $this->getAllCategory();

            $this->load->view('admin/comic/vwManageCategoryComic',$arr);

            //redirect('admin/category_comic');
        }else{
            $arr['flash'] = 'An error occured while deleting the data.';
            $arr['status'] = '1';
            $arr['category_comic'] = $this->getAllCategory();

            $this->load->view('admin/comic/vwManageCategoryComic',$arr);
            //redirect('admin/category_comic');
        }
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
