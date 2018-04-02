<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Merchandise extends CI_Controller {
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
        $arr['page'] = 'merchandise';
        $arr['merchandise'] = $this->getAllMerchandise();
        $arr['merchandise_category'] = $this->getMerchandiseCategory();

        $this->load->view('admin/merchandise/vwManageMerchandise',$arr);
    }

    public function getAllMerchandise(){
        $qry ='Select * from tbl_merchandise'; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getMerchandiseCategory(){
        $qry ='Select * from tbl_merchandise_category'; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

     public function edit_merchandise($id='') {
        $arr['page'] = 'merchandise';
        if($id!=''){
          $qry ="Select * from tbl_merchandise where `merchandise_id`='$id'" ; // select data from db
        $arr['merchandise'] = $this->db->query($qry)->result_array();
        $qry_cat = 'select * from tbl_merchandise_category';
        $arr['merchandise_category'] = $this->db->query($qry_cat)->result_array();

        $this->load->view('admin/merchandise/vwEditMerchandise',$arr);
        }else{
            redirect('admin/merchandise');
        }
    }

    public function checkSlug($slug){
        $sql = "select slug from tbl_merchandise where slug = '".$slug."'";
        $val = $this->db->query($sql)->result_array();

        $count = "select count(slug) as slug_row from tbl_merchandise where slug = '".$slug."'";
        $slug_row = $this->db->query($count)->result_array();

        $value = array_merge($val, $slug_row);
        return $value;
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

    public function add_new(){
        $arr['page']    = 'add_merchandise';
        $qry_cat = 'select * from tbl_merchandise_category';
        $arr['merchandise_category'] = $this->db->query($qry_cat)->result_array();

        $this->load->view('admin/merchandise/vwAddMerchandise',$arr);
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

    public function add_merchandise(){
        $merchandise_id = $_POST['merchandise_id'];
        $title       = $_POST['title'];
        $url         = $_POST['url'];
        $harga       = $_POST['harga'];
        $summary     = $_POST['summary'];
        $category    = $_POST['category'];
        //$category    = serialize($category);
        $date_add    = date('Y-m-d h:i:s');
        $slug        = $_POST['title'];
        $slug = $this->format_uri( $slug, $separator = '-' );

         $config['upload_path']   =   "uploads/";
         $config['allowed_types'] =   "gif|jpg|jpeg|png";
         $config['max_size']      =   "5000";
         $config['max_width']     =   "3000";
         $config['max_height']    =   "3000";
         $this->load->library('upload',$config);

         if ($_FILES['gallery']) {
            $images= $this->_upload_files('gallery');
         }

         foreach ($images as $key => $value) {
           $image_gallery[] = str_replace('','_', $value['file_name']);
         }

         $image_gallery = serialize($image_gallery);

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
           $summary = mysql_real_escape_string($summary);

           $sql = "insert into tbl_merchandise values ('$merchandise_id', '$category', '$date_add', '$title', '$url',
                  '$harga', '$summary', '$image_name', '$image_thumb', '$image_name', '0', '$image_gallery', '$slug')";
           $val = $this->db->query($sql);
           $this->session->set_flashdata('merchandise', array('message' => 'Data has been added.','class' => 'alert alert-success'));
           redirect('admin/merchandise/');
          }else{
            $this->session->set_flashdata('merchandise', array('message' => 'An error occured while adding the data.','class' => 'alert alert-danger'));
            redirect('admin/merchandise/');
          }
  }


   public function update_merchandise() {
       $merchandise_id = $_POST['merchandise_id'];
       $id          = $_POST['pst_id'];
       $title       = $_POST['title'];
       $url         = $_POST['url'];
       $harga       = $_POST['harga'];
       $summary     = $_POST['summary'];
       $category    = $_POST['category'];
       //$category    = serialize($category);
       $date_add    = date('Y-m-d h:i:s');
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

       $gallery = $_FILES['gallery'];

       foreach ($gallery as  $key => $value) {
         $gallery_key[] = $key;
         $gallery_val[] = $value;
       }

       $get_gallery_val = $gallery_val[0];

       foreach ($get_gallery_val as $key => $value) {
         $get_gallery_val = $value;
       }

       if ($gallery) {
           $images= $this->_upload_files('gallery');
       }

       foreach ($images as $key => $value) {
           $image_gallery[] = str_replace('','_', $value['file_name']);
       }

       $image_name = '';
       $image_thumb = '';

       if(!empty($get_image_val)){
           if($this->upload->do_upload()){
             $finfo = $this->upload->data();
             $this->_createThumbnail(str_replace('','_', $finfo['file_name']));
             $data['uploadInfo'] = $finfo;
             $data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
             $image_name = str_replace('','_',$finfo['file_name']);
             $image_thumb = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
           }
         }

       if(isset($id) && !empty($id) ){
         $title = mysql_real_escape_string($title);
         $summary = mysql_real_escape_string($summary);

         $sql = "update tbl_merchandise set `title`='".$title."', `url`='".$url."', `harga`='".$harga."', `summary`='".$summary."',
         `slug` = '".$slug."', `category_id`='".$category."'";

         if(!empty($get_image_val)):
             $sql .= ",`image`='".$image_name."', `image_thumbnail`='".$image_thumb."', `image_large`='".$image_name."', `sort`='0'";
         endif;

         if(!empty($get_gallery_val)):
              $image_gallery = serialize($image_gallery);
              $sql .= ",`image_gallery`='".$image_gallery."'";
         endif;

         $sql .= "where merchandise_id='".$id."'";
         $val = $this->db->query($sql,array($new_content ,$id ));
         //$this->session->set_flashdata('editmerchandise', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
         //redirect('admin/merchandise/edit_merchandise/'.$id);
         $this->session->set_flashdata('merchandise', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
         redirect('admin/merchandise/');
       }else{
         //$this->session->set_flashdata('editmerchandise', array('message' => 'An error occured while updating the data.','class' => 'alert alert-danger'));
         //redirect('admin/merchandise/edit_merchandise/'.$id);
         $this->session->set_flashdata('merchandise', array('message' => 'An error occured while updating the data.','class' => 'alert alert-danger'));
         redirect('admin/merchandise/');
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
        $this->image_lib->initialize($config);

        if(!$this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
        }

        $this->image_lib->clear();
    }

    public function delete_merchandise($id = ''){
        $arr['page'] = 'merchandise';
        if($id!=''){
            $qry ="delete from tbl_merchandise where merchandise_id='$id'"; // select data from db
            $this->db->query($qry);

            $this->session->set_flashdata('merchandise', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
            redirect('admin/merchandise/');

            //redirect('admin/merchandise');
        }else{
            $this->session->set_flashdata('merchandise', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
            redirect('admin/merchandise/');
            //redirect('admin/merchandise');
        }
    }

    public function delete_merchandise_all(){
      $action = $_POST['action'];

        if($action == 'delete'){
          $msg    = !empty($_POST['msg']) ? $_POST['msg']: "";
          if($msg != ''):
          for ($i=0; $i < count($msg) ; $i++) {
    				$this->db->where('merchandise_id', $msg[$i]);
      				if($this->db->delete('tbl_merchandise')){
                $this->session->set_flashdata('merchandise', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
                redirect('admin/merchandise/');
              }else{
                $this->session->set_flashdata('merchandise', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
                redirect('admin/merchandise/');
              }
  			  }
          endif;
          //redirect('admin/post');

        }
        else{

          $this->session->set_flashdata('merchandise', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
          redirect('admin/merchandise/');
      }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
