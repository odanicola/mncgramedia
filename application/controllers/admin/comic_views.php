<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comic_Views extends CI_Controller {
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
        $arr['page'] = 'comic_views';
        
        $qry ='select tbl_comic_view.id, tbl_comic_view.comic_id, tbl_comic_view.ip_address, tbl_comic_view.date_add from tbl_comic_view'; // select data from db
        $arr['comic_views'] = $this->db->query($qry)->result_array();     

        $this->load->view('admin/comic_views/vwManageViews',$arr);
    }    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */