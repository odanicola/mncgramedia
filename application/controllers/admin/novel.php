<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Novel extends CI_Controller {
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
        $arr['novel'] = $this->getAllNovel();
        $arr['novel_category'] = $this->getAllNovelCategory();

        $this->load->view('admin/novel/vwManageNovel',$arr);
    }

    public function bestSeller(){
      $qry = "Select * from tbl_novel where status = 'best-seller'"; // select data from db
      $arr['novel'] = $this->db->query($qry)->result_array();
      $arr['novel_category'] = $this->getAllNovelCategory();

      $this->load->view('admin/novel/vwManageBestseller',$arr);

    }

    public function editorChoice(){
      $qry = "Select * from tbl_novel where status = 'editor-choice'"; // select data from db
      $arr['novel'] = $this->db->query($qry)->result_array();
      $arr['novel_category'] = $this->getAllNovelCategory();

      $this->load->view('admin/novel/vwManageEditorchoice',$arr);
    }

    public function getAllNovel(){
        $qry ='Select * from tbl_novel'; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getAllNovelCategory(){
        $qry ='Select * from tbl_novel_category'; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function edit_novel($id='') {
      if($id!=''){
      $qry ='Select * from tbl_novel where id='.$id ; // select data from db
      $arr['novel'] = $this->db->query($qry)->result_array();
      $qry_cat = 'select * from tbl_novel_category';
      $arr['novel_category'] = $this->db->query($qry_cat)->result_array();
          /*if(!empty($id)){
              $qry_img = 'select * from tbl_novel_image where comic_id='.$id;
              $arr['novel_image'] = $this->db->query($qry_img)->result_array();
          }else{
              $arr['novel_image'] = array('');
          }*/
      $qry_media_type = 'select * from tbl_media_type';
      $arr['media_type'] = $this->db->query($qry_media_type)->result_array();
	    $qry_ori = 'select * from tbl_novel_country';
      $arr['novel_country'] = $this->db->query($qry_ori)->result_array();

      $this->load->view('admin/novel/vwEditNovel',$arr);
      }else{
          redirect('admin/novel');
      }
    }

    public function edit_novel_bestseller($id='') {
      if($id!=''){
      $qry ='Select * from tbl_novel where id='.$id ; // select data from db
      $arr['novel'] = $this->db->query($qry)->result_array();
      $qry_cat = 'select * from tbl_novel_category';
      $arr['novel_category'] = $this->db->query($qry_cat)->result_array();
          /*if(!empty($id)){
              $qry_img = 'select * from tbl_novel_image where comic_id='.$id;
              $arr['novel_image'] = $this->db->query($qry_img)->result_array();
          }else{
              $arr['novel_image'] = array('');
          }*/
      $qry_media_type = 'select * from tbl_media_type';
      $arr['media_type'] = $this->db->query($qry_media_type)->result_array();
	    $qry_ori = 'select * from tbl_novel_country';
      $arr['novel_country'] = $this->db->query($qry_ori)->result_array();

      $this->load->view('admin/novel/vwEditNovelBestSeller',$arr);
      }else{
          redirect('admin/novel/bestseller');
      }
    }

    public function edit_novel_editorchoice($id='') {
      if($id!=''){
      $qry ='Select * from tbl_novel where id='.$id ; // select data from db
      $arr['novel'] = $this->db->query($qry)->result_array();
      $qry_cat = 'select * from tbl_novel_category';
      $arr['novel_category'] = $this->db->query($qry_cat)->result_array();
          /*if(!empty($id)){
              $qry_img = 'select * from tbl_novel_image where comic_id='.$id;
              $arr['novel_image'] = $this->db->query($qry_img)->result_array();
          }else{
              $arr['novel_image'] = array('');
          }*/
      $qry_media_type = 'select * from tbl_media_type';
      $arr['media_type'] = $this->db->query($qry_media_type)->result_array();
	    $qry_ori = 'select * from tbl_novel_country';
      $arr['novel_country'] = $this->db->query($qry_ori)->result_array();

      $this->load->view('admin/novel/vwEditNovelEditorChoice',$arr);
      }else{
          redirect('admin/novel/editorchoice');
      }
    }

    public function add_new(){
        $qry_media_type = 'select * from tbl_media_type';
        $arr['media_type'] = $this->db->query($qry_media_type)->result_array();
        $qry_cat = 'select * from tbl_novel_category';
        $arr['novel_category'] = $this->db->query($qry_cat)->result_array();
		    $qry_ori = 'select * from tbl_novel_country';
        $arr['novel_country'] = $this->db->query($qry_ori)->result_array();

        $this->load->view('admin/novel/vwAddNovel',$arr);
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
        $sql = "select slug from tbl_novel where slug = '".$slug."'";
        $val = $this->db->query($sql)->result_array();

        $count = "select count(slug) as slug_row from tbl_novel where slug = '".$slug."'";
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

    public function add_novel(){
        $publish_date       = $_POST['publish_date'];
        $publish_date       = explode('/',$publish_date);
            $tgl_publish_date       = $publish_date[1];
            $bulan_publish_date     = $publish_date[0];
            $tahun_publish_date     = $publish_date[2];
        $publish_date       = $tahun_publish_date."-".$bulan_publish_date."-".$tgl_publish_date;
        $title       = $_POST['title'];
        $url         = $_POST['url'];
        $author      = $_POST['author'];
        $isbn        = $_POST['isbn'];
        $price       = $_POST['price'];
        //$rate        = $_POST['rate'];
        $jenis_rate  = $_POST['jenis_rate'];
        $origin      = $_POST['origin'];
        $size        = $_POST['size'];
        $pages       = $_POST['pages'];
        $tags        = $_POST['tags'];
        $summary     = $_POST['summary'];
        $category    = $_POST['category'];

        if(!empty($_POST['status'])){
          $status = $_POST['status'];
        }else{
          $status = '';
        }

		    //$category	 = implode(",",$category);

        $media_type  = $_POST['media_type'];
        $link_download  = $_POST['link_download'];
        $link_full_version = $_POST['link_full_version'];
        //$category    = serialize($category);
        $date_add    = date('Y-m-d h:i:s');
        $slug        = $title;
        $slug = $this->format_uri( $slug, $separator = '-' );
        //$slug        = $this->setSlug($slug);
		    //$status_publish = $_POST['status_publish'];

         $config['upload_path']   =   "uploads/";
         $config['allowed_types'] =   "*";
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

         if(!$this->upload->do_upload('cover'))
         {
            // echo $this->upload->display_errors();
         }
         else
         {
             $finfo = $this->upload->data();
             $this->_createThumbnail(str_replace('','_', $finfo['file_name']));
             $data['uploadInfo'] = $finfo;
             $data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];

             $cover_image_name = str_replace('','_',$finfo['file_name']);
             $image_thumb = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
         }
         //$backcover_image_name = '';
         if(!$this->upload->do_upload('backcover'))
         {
             //echo $this->upload->display_errors();

         }
         else
         {
             $finfo = $this->upload->data();
             $this->_createThumbnail(str_replace('','_', $finfo['file_name']));
             $data['uploadInfo'] = $finfo;
             $data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];

             $backcover_image_name = str_replace('','_',$finfo['file_name']);
             $image_thumb = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
         }

         if(isset($title) && !empty($title) ){
           $title = mysql_real_escape_string($title);
           $summary = mysql_real_escape_string($summary);
           $author = mysql_real_escape_string($author);
           $tags = mysql_real_escape_string($tags);

           $sql = "insert into tbl_novel values ('', '$category', '$media_type', '$date_add', '$publish_date', '$title', '$url', '$link_download',
                  '$link_full_version', '$author', '$isbn', '$price', '', '$origin', '$size', '$pages', '$tags', '$summary', '$cover_image_name', '$image_thumb',
                  '$backcover_image_name', '0', '$status', '$image_gallery', '$slug', '$jenis_rate')";
           $val = $this->db->query($sql);

           $this->session->set_flashdata('novel', array('message' => 'Data has been added.','class' => 'alert alert-success'));
           redirect('admin/novel/');
           //redirect('admin/novel/');
         }else{
           $this->session->set_flashdata('novel', array('message' => 'An error occured while adding the data.','class' => 'alert alert-danger'));
           redirect('admin/novel/');
         }
   }


   public function update_novel() {
       $publish_date       = $_POST['publish_date'];
       if(strpos($publish_date, '/') !== false){
         $publish_date       = explode('/', $publish_date);
            $tgl_publish_date       = $publish_date[1];
            $bulan_publish_date     = $publish_date[0];
            $tahun_publish_date     = $publish_date[2];
         $publish_date= $tahun_publish_date."-".$bulan_publish_date."-".$tgl_publish_date;
       }

       $id          = $_POST['pst_id'];
       $title       = $_POST['title'];
       $url         = $_POST['url'];
       $author      = $_POST['author'];
       $isbn        = $_POST['isbn'];
       $price       = $_POST['price'];
       //$rate        = $_POST['rate'];
       $jenis_rate  = $_POST['jenis_rate'];
       $origin      = $_POST['origin'];
       $size        = $_POST['size'];
       $pages       = $_POST['pages'];
       $tags        = $_POST['tags'];
       $summary     = $_POST['summary'];
       $category    = $_POST['category'];
       $category    = $category[0];

       if(!empty($_POST['status'])){
         $status = $_POST['status'];
       }else{
         $status = '';
       }
	     //$category	 = implode(",",$category);
       $media_type  = $_POST['media_type'];
       $link_download  = $_POST['link_download'];
       $link_full_version = $_POST['link_full_version'];
       //$category    = serialize($category);
       $slug        = $_POST['title'];
       $slug = $this->format_uri( $slug, $separator = '-' );
  	   //$status_publish = $_POST['status_publish'];

       $cover = $_FILES['cover'];

       foreach ($cover as  $key => $value) {
         $gambar_cover[] = $key;
         $gambar_cover_val[] = $value;
       }

       $get_cover_image_val = $gambar_cover_val[0];

       $backcover = $_FILES['backcover'];

       foreach ($backcover as  $key => $value) {
         $gambar_backcover[] = $key;
         $gambar_backcover_val[] = $value;
       }

       $get_backcover_image_val = $gambar_backcover_val[0];

       $config['upload_path']   =   "uploads/";
       $config['allowed_types'] =   "*";
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

       $image_cover_name = '';
       $image_backcover_name = '';
       $image_thumb = '';

       if(!empty($get_cover_image_val)){
         if($this->upload->do_upload('cover')){
             $finfo = $this->upload->data();
             $this->_createThumbnail(str_replace('','_', $finfo['file_name']));
             $data['uploadInfo'] = $finfo;
             $data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
             $image_cover_name = str_replace('','_',$finfo['file_name']);
             $image_thumb = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
          }
       }

       if(!empty($get_backcover_image_val)){
         if($this->upload->do_upload('backcover')){
             $finfo = $this->upload->data();
             $this->_createThumbnail(str_replace('','_', $finfo['file_name']));
             $data['uploadInfo'] = $finfo;
             $data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
             $image_backcover_name = str_replace('','_',$finfo['file_name']);
             //$image_thumb = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
          }
       }

       if(isset($id) && !empty($id) ){
             $title = mysql_real_escape_string($title);
             $summary = mysql_real_escape_string($summary);
             $author = mysql_real_escape_string($author);
             $tags = mysql_real_escape_string($tags);

             $sql = "update tbl_novel set `published_date`='".$publish_date."',`title`='".$title."', `id_media_type`='".$media_type."', `url`='".$url."', `link_download`='".$link_download."',
             `link_full_version`='".$link_full_version."', `author`='".$author."', `isbn`='".$isbn."', `price`='".$price."',
             `origin`='".$origin."', `size`='".$size."', `pages`='".$pages."', `tags`='".$tags."', `summary`='".$summary."',
             `slug` ='".$slug."',`category_id`='".$category."',`jenis_rate`='".$jenis_rate."', `status`='$status'";

             if(!empty($get_cover_image_val)):
                 $sql .= ",`image`='".$image_cover_name."', `image_thumbnail`='".$image_thumb."'";
             endif;

             if(!empty($get_backcover_image_val)):
                 $sql .= ",`image_large`='".$image_backcover_name."', `sort`='0'";
             endif;

             if(!empty($get_gallery_val)):
                  $image_gallery = serialize($image_gallery);
                  $sql .= ",`image_gallery`='".$image_gallery."'";
             endif;
             $sql .= "where id=".$id;

             $val = $this->db->query($sql);

             //$this->session->set_flashdata('editnovel', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
             //redirect('admin/novel/edit_novel/'.$id);

             $this->session->set_flashdata('novel', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
             redirect('admin/novel/');

        }else{
           //$this->session->set_flashdata('editnovel', array('message' => 'An error occured while updating the data.','class' => 'alert alert-danger'));
           //redirect('admin/novel/edit_novel/'.$id);

           $this->session->set_flashdata('novel', array('message' => 'An error occured while updating the data.','class' => 'alert alert-danger'));
           redirect('admin/novel/');
        }
    }

    public function update_novel_bestseller() {
        $publish_date       = $_POST['publish_date'];
        if(strpos($publish_date, '/') !== false){
          $publish_date       = explode('/', $publish_date);
             $tgl_publish_date       = $publish_date[1];
             $bulan_publish_date     = $publish_date[0];
             $tahun_publish_date     = $publish_date[2];
          $publish_date= $tahun_publish_date."-".$bulan_publish_date."-".$tgl_publish_date;
        }

        $id          = $_POST['pst_id'];
        $title       = $_POST['title'];
        $url         = $_POST['url'];
        $author      = $_POST['author'];
        $isbn        = $_POST['isbn'];
        $price       = $_POST['price'];
        //$rate        = $_POST['rate'];
        $jenis_rate  = $_POST['jenis_rate'];
        $origin      = $_POST['origin'];
        $size        = $_POST['size'];
        $pages       = $_POST['pages'];
        $tags        = $_POST['tags'];
        $summary     = $_POST['summary'];
        $category    = $_POST['category'];
        $category    = $category[0];

        if(!empty($_POST['status'])){
          $status = $_POST['status'];
        }else{
          $status = '';
        }
 	   //$category	 = implode(",",$category);
        $media_type  = $_POST['media_type'];
        $link_download  = $_POST['link_download'];
        $link_full_version = $_POST['link_full_version'];
        //$category    = serialize($category);
        $slug        = $_POST['title'];
        $slug = $this->format_uri( $slug, $separator = '-' );
   	   //$status_publish = $_POST['status_publish'];

        $cover = $_FILES['cover'];

        foreach ($cover as  $key => $value) {
          $gambar_cover[] = $key;
          $gambar_cover_val[] = $value;
        }

        $get_cover_image_val = $gambar_cover_val[0];

        $backcover = $_FILES['backcover'];

        foreach ($backcover as  $key => $value) {
          $gambar_backcover[] = $key;
          $gambar_backcover_val[] = $value;
        }

        $get_backcover_image_val = $gambar_backcover_val[0];

        $config['upload_path']   =   "uploads/";
        $config['allowed_types'] =   "*";
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

        $image_cover_name = '';
        $image_backcover_name = '';
        $image_thumb = '';

        if(!empty($get_cover_image_val)){
          if($this->upload->do_upload('cover')){
              $finfo = $this->upload->data();
              $this->_createThumbnail(str_replace('','_', $finfo['file_name']));
              $data['uploadInfo'] = $finfo;
              $data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
              $image_cover_name = str_replace('','_',$finfo['file_name']);
              $image_thumb = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
           }
        }

        if(!empty($get_backcover_image_val)){
          if($this->upload->do_upload('backcover')){
              $finfo = $this->upload->data();
              $this->_createThumbnail(str_replace('','_', $finfo['file_name']));
              $data['uploadInfo'] = $finfo;
              $data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
              $image_backcover_name = str_replace('','_',$finfo['file_name']);
              //$image_thumb = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
           }
        }

        if(isset($id) && !empty($id) ){
              $title = mysql_real_escape_string($title);
              $summary = mysql_real_escape_string($summary);
              $author = mysql_real_escape_string($author);
              $tags = mysql_real_escape_string($tags);

              $sql = "update tbl_novel set `published_date`='".$publish_date."',`title`='".$title."', `id_media_type`='".$media_type."', `url`='".$url."', `link_download`='".$link_download."',
              `link_full_version`='".$link_full_version."', `author`='".$author."', `isbn`='".$isbn."', `price`='".$price."',
              `origin`='".$origin."', `size`='".$size."', `pages`='".$pages."', `tags`='".$tags."', `summary`='".$summary."',
              `slug` ='".$slug."',`category_id`='".$category."',`jenis_rate`='".$jenis_rate."', `status`='$status'";

              if(!empty($get_cover_image_val)):
                  $sql .= ",`image`='".$image_cover_name."', `image_thumbnail`='".$image_thumb."'";
              endif;

              if(!empty($get_backcover_image_val)):
                  $sql .= ",`image_large`='".$image_backcover_name."', `sort`='0'";
              endif;

              if(!empty($get_gallery_val)):
                   $image_gallery = serialize($image_gallery);
                   $sql .= ",`image_gallery`='".$image_gallery."'";
              endif;
              $sql .= "where id=".$id;

              $val = $this->db->query($sql);

              //$this->session->set_flashdata('editnovel', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
              //redirect('admin/novel/edit_novel/'.$id);

              $this->session->set_flashdata('novel', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
              redirect('admin/novel/bestseller');

         }else{
            //$this->session->set_flashdata('editnovel', array('message' => 'An error occured while updating the data.','class' => 'alert alert-danger'));
            //redirect('admin/novel/edit_novel/'.$id);

            $this->session->set_flashdata('novel', array('message' => 'An error occured while updating the data.','class' => 'alert alert-danger'));
            redirect('admin/novel/bestseller');
         }
     }

     public function update_novel_editorchoice() {
         $publish_date       = $_POST['publish_date'];
         if(strpos($publish_date, '/') !== false){
           $publish_date       = explode('/', $publish_date);
              $tgl_publish_date       = $publish_date[1];
              $bulan_publish_date     = $publish_date[0];
              $tahun_publish_date     = $publish_date[2];
           $publish_date= $tahun_publish_date."-".$bulan_publish_date."-".$tgl_publish_date;
         }

         $id          = $_POST['pst_id'];
         $title       = $_POST['title'];
         $url         = $_POST['url'];
         $author      = $_POST['author'];
         $isbn        = $_POST['isbn'];
         $price       = $_POST['price'];
         //$rate        = $_POST['rate'];
         $jenis_rate  = $_POST['jenis_rate'];
         $origin      = $_POST['origin'];
         $size        = $_POST['size'];
         $pages       = $_POST['pages'];
         $tags        = $_POST['tags'];
         $summary     = $_POST['summary'];
         $category    = $_POST['category'];
         $category    = $category[0];

         if(!empty($_POST['status'])){
           $status = $_POST['status'];
         }else{
           $status = '';
         }
  	   //$category	 = implode(",",$category);
         $media_type  = $_POST['media_type'];
         $link_download  = $_POST['link_download'];
         $link_full_version = $_POST['link_full_version'];
         //$category    = serialize($category);
         $slug        = $_POST['title'];
         $slug = $this->format_uri( $slug, $separator = '-' );
    	   //$status_publish = $_POST['status_publish'];

         $cover = $_FILES['cover'];

         foreach ($cover as  $key => $value) {
           $gambar_cover[] = $key;
           $gambar_cover_val[] = $value;
         }

         $get_cover_image_val = $gambar_cover_val[0];

         $backcover = $_FILES['backcover'];

         foreach ($backcover as  $key => $value) {
           $gambar_backcover[] = $key;
           $gambar_backcover_val[] = $value;
         }

         $get_backcover_image_val = $gambar_backcover_val[0];

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

         $image_cover_name = '';
         $image_backcover_name = '';
         $image_thumb = '';

         if(!empty($get_cover_image_val)){
           if($this->upload->do_upload('cover')){
               $finfo = $this->upload->data();
               $this->_createThumbnail(str_replace('','_', $finfo['file_name']));
               $data['uploadInfo'] = $finfo;
               $data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
               $image_cover_name = str_replace('','_',$finfo['file_name']);
               $image_thumb = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
            }
         }

         if(!empty($get_backcover_image_val)){
           if($this->upload->do_upload('backcover')){
               $finfo = $this->upload->data();
               $this->_createThumbnail(str_replace('','_', $finfo['file_name']));
               $data['uploadInfo'] = $finfo;
               $data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
               $image_backcover_name = str_replace('','_',$finfo['file_name']);
               //$image_thumb = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
            }
         }

         if(isset($id) && !empty($id) ){
               $title = mysql_real_escape_string($title);
               $summary = mysql_real_escape_string($summary);
               $author = mysql_real_escape_string($author);
               $tags = mysql_real_escape_string($tags);

               $sql = "update tbl_novel set `published_date`='".$publish_date."',`title`='".$title."', `id_media_type`='".$media_type."', `url`='".$url."', `link_download`='".$link_download."',
               `link_full_version`='".$link_full_version."', `author`='".$author."', `isbn`='".$isbn."', `price`='".$price."',
               `origin`='".$origin."', `size`='".$size."', `pages`='".$pages."', `tags`='".$tags."', `summary`='".$summary."',
               `slug` ='".$slug."',`category_id`='".$category."',`jenis_rate`='".$jenis_rate."', `status`='$status'";

               if(!empty($get_cover_image_val)):
                   $sql .= ",`image`='".$image_cover_name."', `image_thumbnail`='".$image_thumb."'";
               endif;

               if(!empty($get_backcover_image_val)):
                   $sql .= ",`image_large`='".$image_backcover_name."', `sort`='0'";
               endif;

               if(!empty($get_gallery_val)):
                    $image_gallery = serialize($image_gallery);
                    $sql .= ",`image_gallery`='".$image_gallery."'";
               endif;
               $sql .= "where id=".$id;

               $val = $this->db->query($sql);

               //$this->session->set_flashdata('editnovel', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
               //redirect('admin/novel/edit_novel/'.$id);

               $this->session->set_flashdata('novel', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
               redirect('admin/novel/editorchoice');

          }else{
             //$this->session->set_flashdata('editnovel', array('message' => 'An error occured while updating the data.','class' => 'alert alert-danger'));
             //redirect('admin/novel/edit_novel/'.$id);

             $this->session->set_flashdata('novel', array('message' => 'An error occured while updating the data.','class' => 'alert alert-danger'));
             redirect('admin/novel/editorchoice');
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

    public function delete_novel($id = ''){
        $arr['page'] = 'novel';
        if($id!=''){
            $qry ='delete from tbl_novel where id='.$id ; // select data from db
            $this->db->query($qry);

            $this->session->set_flashdata('novel', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
            redirect('admin/novel');
        }else{

           $this->session->set_flashdata('novel', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
           redirect('admin/novel');

            //redirect('admin/novel');
        }
    }

    public function delete_novel_bestseller($id = ''){
        $arr['page'] = 'novel';
        if($id!=''){
            $qry ='delete from tbl_novel where id='.$id ; // select data from db
            $this->db->query($qry);

            $this->session->set_flashdata('novel', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
            redirect('admin/novel/bestseller');
        }else{

           $this->session->set_flashdata('novel', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
           redirect('admin/novel/bestseller');

            //redirect('admin/novel');
        }
    }

    public function delete_novel_editorchoice($id = ''){
        $arr['page'] = 'novel';
        if($id!=''){
            $qry ='delete from tbl_novel where id='.$id ; // select data from db
            $this->db->query($qry);

            $this->session->set_flashdata('novel', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
            redirect('admin/novel/editorchoice');
        }else{

           $this->session->set_flashdata('novel', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
           redirect('admin/novel/editorchoice');

            //redirect('admin/novel');
        }
    }

    public function delete_novel_all(){
      $action = $_POST['action'];

        if($action == 'delete'){
          $msg    = !empty($_POST['msg']) ? $_POST['msg']: "";
          if($msg != ''):
          for ($i=0; $i < count($msg) ; $i++) {
    				$this->db->where('id', $msg[$i]);
      				if($this->db->delete('tbl_novel')){
                $this->session->set_flashdata('novel', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));

              }else{
                $this->session->set_flashdata('novel', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
                redirect('admin/novel');
              }
  			  }
          endif;
          redirect('admin/novel');

        }
        else{
        $this->session->set_flashdata('novel', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
        redirect('admin/novel');
      }
    }

    public function delete_novel_all_bestseller(){
      $action = $_POST['action'];

        if($action == 'delete'){
          $msg    = !empty($_POST['msg']) ? $_POST['msg']: "";
          if($msg != ''):
          for ($i=0; $i < count($msg) ; $i++) {
    				$this->db->where('id', $msg[$i]);
      				if($this->db->delete('tbl_novel')){
                $this->session->set_flashdata('novel', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));

              }else{
                $this->session->set_flashdata('novel', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
                redirect('admin/novel/bestseller');
              }
  			  }
          endif;
          redirect('admin/novel/bestseller');

        }
        else{
        $this->session->set_flashdata('novel', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
        redirect('admin/novel/bestseller');
      }
    }

    public function delete_novel_all_editorchoice(){
      $action = $_POST['action'];

        if($action == 'delete'){
          $msg    = !empty($_POST['msg']) ? $_POST['msg']: "";
          if($msg != ''):
          for ($i=0; $i < count($msg) ; $i++) {
    				$this->db->where('id', $msg[$i]);
      				if($this->db->delete('tbl_novel')){
                $this->session->set_flashdata('novel', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));

              }else{
                $this->session->set_flashdata('novel', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
                redirect('admin/novel/editorchoice');
              }
  			  }
          endif;
          redirect('admin/novel/editorchoice');

        }
        else{
        $this->session->set_flashdata('novel', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
        redirect('admin/novel/editorchoice');
      }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
