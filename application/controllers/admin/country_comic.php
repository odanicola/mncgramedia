<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Country_Comic extends CI_Controller {
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

        $qry ='Select * from tbl_comic_country'; // select data from db
        $arr['country_comic'] = $this->db->query($qry)->result_array();
        $this->load->view('admin/comic/vwManageCountryComic',$arr);
    }

    public function add_new(){
      $this->load->view('admin/comic/vwAddCountryComic');
    }

    public function add_country_comic(){
      $origin       = $_POST['origin'];
      $sort        = $_POST['sort'];

      if(isset($origin) && !empty($origin) ){
        $origin = mysql_real_escape_string($origin);

        $sql = "insert into tbl_comic_country values ('$sort' , '$origin')";
        $val = $this->db->query($sql,array($new_content ,$origin ));

        redirect('admin/country_comic/');
      }

        $arr['page'] = 'country_comic';
        $this->load->view('admin/comic/vwEditCountryComic',$arr);
    }

    public function edit_country_comic($origin='') {
      if($origin!=''){
        $qry ="Select * from tbl_comic_country where origin='".$origin."'" ; // select data from db
        $arr['country_comic'] = $this->db->query($qry)->result_array();

        $this->load->view('admin/comic/vwEditCountryComic',$arr);
      }else{
          redirect('admin/country_comic');
      }
    }

   public function update_country_comic() {
     $origin      = $_POST['origin'];
     $sort        = $_POST['sort'];

     if(isset($origin) && !empty($origin) ){
       $origin = mysql_real_escape_string($origin);
       
       $sql = "update tbl_comic_country set `origin`='".$origin."', `sort`='".$sort."' where origin=".$origin;
       $val = $this->db->query($sql,array($new_content ,$id ));

       redirect('admin/country_comic/edit_country_comic/'.$id);
     }

        $arr['page'] = 'country_comic';
        $this->load->view('admin/comic/vwEditCountryComic',$arr);
    }

    public function delete_country_comic($origin = ''){
        if($origin!=''){
            $qry ="delete from tbl_comic_country where origin='".$origin."'" ; // select data from db
            $this->db->query($qry);

            redirect('admin/country_comic');
        }else{
            redirect('admin/country_comic');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
