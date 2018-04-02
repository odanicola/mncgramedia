<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Control_panel extends CI_Controller {
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

    public function slider() {
        $arr['page'] = 'slider';

        $qry ='Select * from tbl_slider'; // select data from db
        $arr['slider'] = $this->db->query($qry)->result_array();
        $this->load->view('admin/slider/vwManageSlider',$arr);
    }

    public function edit_slider($id){
  		$qry = "select * from tbl_slider where id=" . $id;
  		$arr['slider'] = $this->db->query($qry)->result_array();
  		$this->load->view('admin/slider/vwEditSlider',$arr);
  	}

    public function add_slider_new(){
      $this->load->view('admin/slider/vwAddSlider');
    }

    public function add_slider(){
       $config['upload_path']   =   "uploads/";
       $config['allowed_types'] =   "gif|jpg|jpeg|png";
       $config['max_size']      =   "5000";
       $config['max_width']     =   "3000";
       $config['max_height']    =   "3000";
       $this->load->library('upload',$config);

       $userfile = $_FILES['userfile'];

       foreach ($userfile as  $key => $value) {
         $gambar[] = $key;
         $gambar_val[] = $value;
       }

       $get_image_val = $gambar_val[0];

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

       if(!empty($get_image_val)):
       $sql = "insert into tbl_slider values('','".$image_name."')";
       $val = $this->db->query($sql);

       $this->session->set_flashdata('slider', array('message' => 'Data has been added.','class' => 'alert alert-success'));
       redirect('admin/control_panel/slider');
  	     //redirect('admin/control_panel/edit_banner/'.$id);
  	   else:
         $this->session->set_flashdata('slider', array('message' => 'An error occured while adding the data.','class' => 'alert alert-danger'));
         redirect('admin/control_panel/slider');
       endif;

    }

    public function update_slider() {
       $id      = $_POST['pst_id'];

       $config['upload_path']   =   "uploads/";
       $config['allowed_types'] =   "gif|jpg|jpeg|png";
       $config['max_size']      =   "5000";
       $config['max_width']     =   "3000";
       $config['max_height']    =   "3000";
       $this->load->library('upload',$config);

       $userfile = $_FILES['userfile'];

       foreach ($userfile as  $key => $value) {
         $gambar[] = $key;
         $gambar_val[] = $value;
       }

       $get_image_val = $gambar_val[0];

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
         if(!empty($get_image_val)):
           $sql = "update tbl_slider set `slider_image` = '".$image_name."'";
           $sql .= "where id=".$id;
         endif;
         $val = $this->db->query($sql);
         $this->session->set_flashdata('slider', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
         redirect('admin/control_panel/slider');
  	     //redirect('admin/control_panel/edit_banner/'.$id);
  	   }else{
         $this->session->set_flashdata('slider', array('message' => 'An error occured while updating the data.','class' => 'alert alert-danger'));
         redirect('admin/control_panel/slider');
       }

    }

    public function delete_slider($id = ''){
  		if($id!=''){
        $qry ='delete from tbl_slider where id='.$id ; // select data from db
        $this->db->query($qry);
        $this->session->set_flashdata('slider', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
        redirect('admin/control_panel/slider');
      }else{
        $this->session->set_flashdata('slider', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
        redirect('admin/control_panel/slider');
      }
  	}

    public function logo() {
        $arr['page'] = 'logo';

        $qry ='select * from tbl_logo'; // select data from db
        $arr['logo'] = $this->db->query($qry)->result_array();
        $this->load->view('admin/logo/vwEditLogo',$arr);
    }

	  public function logo_gramedia() {
        $arr['page'] = 'logo';
        $qry ='select * from tbl_logo where id = 2'; // select data from db
        $arr['logo'] = $this->db->query($qry)->result_array();
        $this->load->view('admin/logo/vwEditLogoGramedia',$arr);
    }

	  public function banner() {
        $arr['page'] = 'banner';
		$qry ="select * from tbl_banner"; // select data from db
		$arr['banner'] = $this->db->query($qry)->result_array();
        $this->load->view('admin/banner/vwManageBanner',$arr);
    }

    public function edit_banner($id){
    	$qry = "select * from tbl_banner where id=" . $id;
    	$arr['banner'] = $this->db->query($qry)->result_array();
    	$this->load->view('admin/banner/vwEditBanner',$arr);
    }

  	public function delete_banner($id = ''){
  		if($id!=''){
        $qry ='delete from tbl_banner where id='.$id ; // select data from db
        $this->db->query($qry);
        $this->session->set_flashdata('banner', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
        redirect('admin/control_panel/banner');
        //redirect('admin/control_panel/banner/');
      }else{
        $this->session->set_flashdata('banner', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
        redirect('admin/control_panel/banner');
        //redirect('admin/control_panel/banner/');
      }
  	}

	  public function add_banner_new(){
        $this->load->view('admin/banner/vwAddBanner');
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

	  public function add_banner() {
	     $position	              = $_POST['position'];
	     $url 		                = $_POST['url'];
       $config['upload_path']   =   "uploads/";
       $config['allowed_types'] =   "gif|jpg|jpeg|png";
       $config['max_size']      =   "5000";
       $config['max_width']     =   "3000";
       $config['max_height']    =   "3000";
       $this->load->library('upload',$config);

       $userfile = $_FILES['userfile'];

       foreach ($userfile as  $key => $value) {
         $gambar[] = $key;
         $gambar_val[] = $value;
       }

       $get_image_val = $gambar_val[0];

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

       if(!empty($get_image_val)){
          $sql = "insert into tbl_banner values('','".$image_name."','".$position."','".$url."')";
          $val = $this->db->query($sql);
          redirect('admin/control_panel/banner/');
       }
    }

  	public function update_banner() {
         $id      	= $_POST['pst_id'];
  	     $position	= $_POST['position'];
  	     $url 		= $_POST['url'];
         $config['upload_path']   =   "uploads/";
         $config['allowed_types'] =   "gif|jpg|jpeg|png";
         $config['max_size']      =   "5000";
         $config['max_width']     =   "3000";
         $config['max_height']    =   "3000";
         $this->load->library('upload',$config);

         $userfile = $_FILES['userfile'];

         foreach ($userfile as  $key => $value) {
           $gambar[] = $key;
           $gambar_val[] = $value;
         }

         $get_image_val = $gambar_val[0];

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
               $sql = "update tbl_banner set `url` = '".$url."', `position` ='".$position."'";
               if(!empty($get_image_val)):
                   $sql .= ",`banner_image`='".$image_name."'";
               endif;
  			 $sql .= "where id=".$id;
               $val = $this->db->query($sql);
         $this->session->set_flashdata('banner', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
         redirect('admin/control_panel/banner');
  	   }else{
         $this->session->set_flashdata('banner', array('message' => 'An error occured while updating the data.','class' => 'alert alert-danger'));
         redirect('admin/control_panel/banner');
       }
         //$arr['page'] = 'banner';
         //$this->load->view('admin/banner/vwEditBanner',$arr);
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

	public function update_logo_gramedia(){
		$id = $_POST['pst_id'];
		$logo_gramedia = $_POST['logo_gramedia'];

		$sql = "UPDATE tbl_logo set `logo_image` = '".$logo_gramedia."' WHERE id ='".$id."'";
        $val = $this->db->query($sql);

        redirect('admin/control_panel/logo_gramedia');

        $arr['page'] = 'logo_gramedia';
        $this->load->view('admin/logo/vwEditLogoGramedia',$arr);
	}

    public function update_logo() {
       $id      = $_POST['pst_id'];
       $config['upload_path']   =   "uploads/";
       $config['allowed_types'] =   "gif|jpg|jpeg|png";
       $config['max_size']      =   "5000";
       $config['max_width']     =   "3000";
       $config['max_height']    =   "3000";
       $this->load->library('upload',$config);

       $userfile = $_FILES['userfile'];

       foreach ($userfile as  $key => $value) {
         $gambar[] = $key;
         $gambar_val[] = $value;
       }

       $get_image_val = $gambar_val[0];

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

       if(!empty($get_image_val)):
          $sql = "update tbl_logo set `logo_image`='".$image_name."' where id=". $id;

       $val = $this->db->query($sql);
       redirect('admin/control_panel/logo/');
       else:
        redirect('admin/control_panel/logo/');
       endif;
       $arr['page'] = 'logo';
       $this->load->view('admin/logo/vwEditLogo',$arr);

    }

    public function youtube(){
        $arr['page'] = 'youtube';

        $qry ='Select * from tbl_youtube'; // select data from db
        $arr['youtube'] = $this->db->query($qry)->result_array();
        $this->load->view('admin/youtube/vwEditYoutube',$arr);
    }

    public function update_youtube(){
        $channel_id = $_POST['channel_id'];
        $max_results = $_POST['max_results'];
        $api_key = $_POST['api_key'];
        $id = $_POST['pst_id'];

        if(!empty($id)){
          $sql = "update tbl_youtube set `channel_id` ='". $channel_id ."', `max_results` = '" . $max_results . "', api_key='" . $api_key . "'
          where id=" . $id;
        }

        $val = $this->db->query($sql);
        redirect('admin/control_panel/youtube');

        $arr['page'] = 'youtube';
        $this->load->view('admin/youtube/vwEditSlider',$arr);
    }

    public function twitter(){
        $arr['page'] = 'twitter';

        $qry ='Select * from tbl_twitter'; // select data from db
        $arr['twitter'] = $this->db->query($qry)->result_array();
        $this->load->view('admin/twitter/vwEditTwitter',$arr);
    }

    public function update_twitter(){
        $arr['page'] = 'twitter';

        $id = $_POST['pst_id'];
        $content = $_POST['content'];

        $content = mysql_real_escape_string($content);
        //var_dump($content);
        //die();

        if(!empty($id)){
          $sql = "update tbl_twitter set `content` ='". $content ."' where id=" . $id;
        }

        $val = $this->db->query($sql);
        redirect('admin/control_panel/twitter');

        $arr['page'] = 'twitter';
        $this->load->view('admin/twitter/vwEditTwitter',$arr);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
