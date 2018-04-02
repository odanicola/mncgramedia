<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Country_NOvel extends CI_Controller {
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
        
        $qry ='Select * from tbl_novel_country'; // select data from db
        $arr['country_novel'] = $this->db->query($qry)->result_array();        
        $this->load->view('admin/novel/vwManageCountryNovel',$arr);
    }

    public function add_new(){
      $this->load->view('admin/novel/vwAddCountryNovel');
    }

    public function add_country_novel(){
      $origin       = $_POST['origin'];
      $sort        = $_POST['sort'];

      if(isset($origin) && !empty($origin) ){
        $sql = "insert into tbl_novel_country values ('$sort' , '$origin')";
        $val = $this->db->query($sql);

        redirect('admin/country_novel/');
      }
      
        $arr['page'] = 'country_novel';
        $this->load->view('admin/novel/vwEditCountryNovel',$arr);
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
       $sql = "update tbl_comic_country set `origin`='".$origin."', `sort`='".$sort."' where origin=".$origin;
       $val = $this->db->query($sql,array($new_content ,$id ));

       redirect('admin/country_comic/edit_country_comic/'.$id);
     }
      
        $arr['page'] = 'country_comic';
        $this->load->view('admin/comic/vwEditCountryComic',$arr);
    }

    public function delete_country_novel($origin = ''){
        if($origin!=''){
            $qry ="delete from tbl_novel_country where origin='".$origin."'" ; // select data from db
            $this->db->query($qry);
            
            redirect('admin/country_novel');
        }else{
            redirect('admin/country_novel');
        }
    }
   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */