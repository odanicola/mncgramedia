<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reviews extends CI_Controller {
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
        $arr['page'] = 'reviews';

        $arr['reviews'] = $this->getAllReviews();
        $arr['comic'] = $this->getAllReviews();

        $this->load->view('admin/reviews/vwManageReviews',$arr);
    }

    public function getAllReviews(){
        $qry ='select tbl_comic_review.id as review_id, tbl_comic_review.comic_id, tbl_comic_review.user_id, tbl_comic_review.title as review_title, tbl_comic_review.description,
             tbl_comic_review.rate, tbl_comic_review.date_add, tbl_comic.id, tbl_comic.title as comic_title, tbl_reg.id, tbl_reg.nama from tbl_comic_review inner join
             tbl_comic on tbl_comic_review.comic_id = tbl_comic.id inner join tbl_reg on tbl_comic_review.user_id = tbl_reg.id'; // select data from db
        $arr = $this->db->query($qry)->result_array();

        return $arr;
    }

    public function review_detail($id='') {
      $arr['page'] = 'reviews_detail';
      if($id!=''){
        $qry ='select tbl_comic_review.id as review_id, tbl_comic_review.comic_id, tbl_comic_review.user_id, tbl_comic_review.title as review_title, tbl_comic_review.description,
               tbl_comic_review.rate, tbl_comic_review.date_add, tbl_comic.id, tbl_comic.title as comic_title, tbl_reg.id, tbl_reg.nama from tbl_comic_review inner join
               tbl_comic on tbl_comic_review.comic_id = tbl_comic.id inner join tbl_reg on tbl_comic_review.user_id = tbl_reg.id where tbl_comic_review.id='.$id; // select data from db

        $arr['reviews'] = $this->db->query($qry)->result_array();

        $this->load->view('admin/reviews/vwComicReviews',$arr);

      }else{
          redirect('admin/reviews');
      }
    }

    public function delete_review($id = ''){
        $arr['page'] = 'reviews_detail';
        if($id!=''){
            $qry ='delete from tbl_comic_review where id='.$id ; // select data from db
            $this->db->query($qry);
            $this->session->set_flashdata('reviews', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
            redirect('admin/reviews');
        }else{
            $this->session->set_flashdata('reviews', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
            redirect('admin/reviews');
        }
    }

    public function delete_review_all(){
      $action = $_POST['action'];

        if($action == 'delete'){
          $msg    = !empty($_POST['msg']) ? $_POST['msg']: "";
          if($msg != ''):
          for ($i=0; $i < count($msg) ; $i++) {
    				$this->db->where('id', $msg[$i]);
      				if($this->db->delete('tbl_comic_review')){
                $this->session->set_flashdata('reviews', array('message' => 'Data has been deleted.','class' => 'alert alert-success'));
              }else{
                $this->session->set_flashdata('reviews', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
                redirect('admin/reviews');
              }
  			  }
          endif;
          redirect('admin/reviews');
        }
        else{
          $this->session->set_flashdata('reviews', array('message' => 'An error occured while deleting the data.','class' => 'alert alert-danger'));
          redirect('admin/reviews');
      }
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
