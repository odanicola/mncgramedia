<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post extends CI_Controller {
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
        $arr['page'] = 'post';
        $arr['post'] = $this->getAllPost();
		    $arr['post_category'] = $this->getCategory();

        $this->load->view('admin/post/vwManagePost', $arr);
    }

    public function getAllPost(){
      $qry ='Select * from tbl_post order by post_id DESC'; // select data from db
      $arr = $this->db->query($qry)->result_array();
      return $arr;
    }

    public function getCategory(){
      $qry_cat = 'select * from tbl_post_category';
      $arr = $this->db->query($qry_cat)->result_array();
      return $arr;
    }

     public function edit_post($id='') {
        $arr['page'] = 'post';
        if($id!=''){
          $qry ='Select * from tbl_post where post_id='.$id ; // select data from db
        $arr['post'] = $this->db->query($qry)->result_array();
        $qry_cat = 'select * from tbl_post_category';
        $arr['post_category'] = $this->db->query($qry_cat)->result_array();

        $this->load->view('admin/post/vwEditPost',$arr);
        }else{
            redirect('admin/post');
        }
    }

    public function add_new(){
        $arr['page']    = 'add_post';
        $qry_cat = 'select * from tbl_post_category';
        $arr['post_category'] = $this->db->query($qry_cat)->result_array();

        $this->load->view('admin/post/vwAddPost',$arr);
    }

    private function _upload_files($field='userfile'){
        $files = array();
        foreach( $_FILES[$field] as $key => $all )
            foreach( $all as $i => $val )
                $files[$i][$key] = $val;

        $files_uploaded = array();
        for ($i=0; $i < count($files); $i++) {
            $_FILES[$field] = $files[$i];
            if ($this->upload->do_upload($field))
                $files_uploaded[$i] = $this->upload->data($files);
            else
                $files_uploaded[$i] = null;
        }
        return $files_uploaded;
    }


    public function checkSlug($slug){
        $sql = "select slug from tbl_post where slug = '".$slug."'";
        $val = $this->db->query($sql)->result_array();

        $count = "select count(slug) as slug_row from tbl_post where slug = '".$slug."'";
        $slug_row = $this->db->query($count)->result_array();

        $value = array_merge($val, $slug_row);
        return $value;
    }

    public function cekSlug($slug){
        $count = "select count(slug) as slug_row from tbl_post where slug = '".$slug."'";
        $slug_row = $this->db->query($count)->result_array();
        if($slug_row[0]['slug_row'] > 0){
          return true;
        } else {
          return false;
        }
    }

    public function setSlug($slug){
        $slug = $this->checkSlug($slug);
        foreach ($slug as $key => $value) {
           $slug_key = $key;
           $slug_val = $value;

           foreach ($slug_val as $key => $value) {
              $slugval[$key] = $value;
           }
        }

        $no_of_slug = $slugval['slug_row'] + 1;
        $final_slug = $slugval['slug'] . "-" . $no_of_slug;

        return $final_slug;
    }

    public function format_uri( $string, $separator = '-' )
    {
        $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
        $special_cases = array( '&' => 'and', "'" => '');
        $string = mb_strtolower( trim( $string ), 'UTF-8' );
        $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
        $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
        $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
        $string = preg_replace("/[$separator]+/u", "$separator", $string);
        return $string;
    }

    public function add_post(){

        $title       = $_POST['title'];
        $content     = $_POST['content'];
          //$content   = htmlentities($content, ENT_QUOTES);
          //$content   = htmlspecialchars($content, ENT_QUOTES);
        $tags        = $_POST['tags'];
        $category    = $_POST['category'];
        //$category    = serialize($category);
        $date_add    = date('Y-m-d h:i:s');
        $slug        = $_POST['title'];
        $slug = $this->format_uri( $slug, $separator = '-' );

        /*if($this->cekSlug($slug)){
          $slug      = $this->setSlug($slug);
        }*/
         //$finfo = '';
         $config['upload_path']   =   "uploads/";
         $config['allowed_types'] =   "gif|jpg|jpeg|png";
         $config['max_size']      =   "5000";
         $config['max_width']     =   "3000";
         $config['max_height']    =   "3000";
         $this->load->library('upload',$config);

         $image_name = '';
         $image_thumb = '';

         if(!$this->upload->do_upload())
         {
             //echo $this->upload->display_errors();
         }
         else
         {
             $finfo = $this->upload->data();
             $this->_createThumbnail(str_replace('','_', $finfo['file_name']));
             $data['uploadInfo'] = $finfo;
             $data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];

             $image_name = str_replace('','_',$finfo['file_name']);
             $image_thumb = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
         }

         if(isset($title) && !empty($title) ){
           $title = mysql_real_escape_string($title);
           $content = mysql_real_escape_string($content);
           $tags = mysql_real_escape_string($tags);

           $sql = "insert into tbl_post values ('', '$category', '$date_add', '$date_add', '$title', '$content',
                  '$tags', '$image_name', '$image_thumb',
                  '$image_name', '$slug')";
           $val = $this->db->query($sql);
           //redirect('admin/post/');
           $this->session->set_flashdata('post', array('message' => 'Data has been added.','class' => 'alert alert-success'));
           redirect('admin/post/');
         } else {
           $this->session->set_flashdata('post', array('message' => 'An error occured while adding the data.','class' => 'alert alert-danger'));
           redirect('admin/post/');
        }
  }


   public function update_post() {
       $id          = $_POST['pst_id'];
       $title       = $_POST['title'];
       $content     = $_POST['content'];
          //$content   = htmlentities($content, ENT_QUOTES);
          //$content   = htmlspecialchars($content, ENT_QUOTES);
       $tags        = $_POST['tags'];
       $category    = $_POST['category'];
       $date_modified    = date('Y-m-d h:i:s');
       //$category    = serialize($category);
       $slug        = $_POST['title'];
       $slug = $this->format_uri( $slug, $separator = '-' );

       $userfile = $_FILES['userfile'];

       foreach ($userfile as  $key => $value) {
         $gambar[] = $key;
         $gambar_val[] = $value;
       }

       $get_image_val = $gambar_val[0];

       $config['upload_path']   =   "uploads/";
       $config['allowed_types'] =   "gif|jpg|jpeg|png";
       $config['max_size']      =   "5000";
       $config['max_width']     =   "3000";
       $config['max_height']    =   "3000";
       $this->load->library('upload',$config);

       $image_name = '';
       $image_thumb = '';

       if(!$this->upload->do_upload())
       {
           //echo $this->upload->display_errors();
       }
       else
       {
         $finfo = $this->upload->data();
         $this->_createThumbnail(str_replace('','_', $finfo['file_name']));
         $data['uploadInfo'] = $finfo;
         $data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];

         $image_name = str_replace('','_',$finfo['file_name']);
         $image_thumb = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
       }

       if(isset($id) && !empty($id) ){
         $title = mysql_real_escape_string($title);
         $content = mysql_real_escape_string($content);
         $tags = mysql_real_escape_string($tags);

         if(!empty($get_image_val)){

           $sql = "update tbl_post set `date_modified`='".$date_modified."',`title`='".$title."',
           `content`='".$content."', `tags`='".$tags."', `slug` = '".$slug."',
           `category_id`='".$category."', `image`='".$image_name."', `image_thumbnail`='".$image_thumb."', `image_large`='".$image_name."' where post_id=".$id;
           $val = $this->db->query($sql);
          } else {
            $sql = "update tbl_post set `date_modified`='".$date_modified."',`title`='".$title."',
           `content`='".$content."', `tags`='".$tags."', `slug` = '".$slug."',
           `category_id`='".$category."' where post_id=".$id;
           $val = $this->db->query($sql);
          }
         //$this->session->set_flashdata('editpost', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
         //redirect('admin/post/edit_post/'.$id);

         $this->session->set_flashdata('post', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
         redirect('admin/post/');

       }else{
         //$this->session->set_flashdata('addcomic', array('message' => 'An error occured while updating the data.','class' => 'alert alert-danger'));
         //redirect('admin/post/edit_post/'.$id);

         $this->session->set_flashdata('post', array('message' => 'An error occured while updating the data.','class' => 'alert alert-danger'));
         redirect('admin/post/');
       }
    }

    public function _createThumbnail($filename)
    {
        $config['image_library']    = "gd2";
        $config['source_image']     = "uploads/" .$filename;
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['width'] = "80";
        $config['height'] = "80";
        $this->load->library('image_lib',$config);
        if(!$this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
        }
    }

    public function delete_post($id = ''){
        $arr['page'] = 'post';
        if($id!=''){
            $qry ='delete from tbl_post where post_id='.$id ; // select data from db
            $this->db->query($qry);

            $this->session->set_flashdata('post', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
            redirect('admin/post/');
          } else {
            $this->session->set_flashdata('post', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
            redirect('admin/post/');
         }
    }

    public function delete_post_all(){
      $action = $_POST['action'];

        if($action == 'delete'){
          $msg    = !empty($_POST['msg']) ? $_POST['msg']: "";
          if($msg != ''):
          for ($i=0; $i < count($msg) ; $i++) {
    				$this->db->where('post_id', $msg[$i]);
      				if($this->db->delete('tbl_post')){
                $this->session->set_flashdata('post', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
              }else{
                $this->session->set_flashdata('post', array('message' => 'Data has been deleted.','class' => 'alert alert-danger'));
              }
  			  }
          endif;
          redirect('admin/post/');
        }
        else{
        redirect('admin/post/');
      }
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
