<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sosmed extends CI_Controller {
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
        $arr['page'] = 'sosmed';
        
        $qry ='Select * from tbl_sosmed'; // select data from db
        $arr['sosmed'] = $this->db->query($qry)->result_array();        
        $this->load->view('admin/sosmed/vwEditSosmed',$arr);
    }


    public function update_sosmed() {
       $facebook    = $_POST['Facebook'];
       $twitter     = $_POST['Twitter'];
       $youtube     = $_POST['Youtube'];
       $instagram   = $_POST['Instagram'];
       $tumblr      = $_POST['Tumblr'];

       $facebook_url      = $_POST['Facebook_url'];
       $twitter_url       = $_POST['Twitter_url'];
       $youtube_url       = $_POST['Youtube_url'];  
       $instagram_url     = $_POST['Instagram_url'];  
       $tumblr_url        = $_POST['Tumblr_url'];  
	   //var_dump($twitter_url);
	   //die();
		
       if(isset($facebook) && !empty($facebook)){
		   $sql = "update tbl_sosmed set `url`='".$facebook_url."' where `id`='".$facebook."'";
           $val = $this->db->query($sql);
	   } 
	   
	   if(isset($instagram) && !empty($instagram)){
		   $sql = "update tbl_sosmed set `url`='".$instagram_url."' where `id`='".$instagram."'";
           $val = $this->db->query($sql);
	   }
	   
	   if(isset($tumblr) && !empty($tumblr)){

		  $sql = "update tbl_sosmed set `url`='".$tumblr_url."' where `id`='".$tumblr."'";
          $val = $this->db->query($sql);

       }
	   
	   if(isset($twitter) && !empty($twitter)){
		   $sql = "update tbl_sosmed set `url`='".$twitter_url."' where `id`='".$twitter."'";
           $val = $this->db->query($sql);
	   } 
	   
	   if(isset($youtube) && !empty($youtube)){
		   $sql = "update tbl_sosmed set `url`='".$youtube_url."' where `id`='".$youtube."'";
           $val = $this->db->query($sql);
	   }
	   
	   redirect('admin/sosmed');
    }
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */