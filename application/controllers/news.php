<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
        $arr['sosmed'] = $this->getSosmed();
    		$arr['logo'] = $this->getLogo();
    		$arr['logo_gramedia'] = $this->getLogoGramedia();
    		$arr['latest_promo'] = $this->getLatestPromo();
    		$arr['latest_event'] = $this->getLatestEvent();
    		//$arr['publication_date'] = $this->getPublicationDate();
        $arr['publication_date'] = $this->getPublication();
    		$arr['youtube'] = $this->getYoutube();
    		$arr['twitter'] = $this->getTwitter();
    		$arr['left_banner'] = $this->getLeftBanner();
        $arr['page'] = 'News';
        $arr['content'] = '';
        $this->load->view('vwHeader',$arr);
    		$this->load->view('vwNews',$arr);
    }

    public function getPublication(){
      $category_id = $this->getCategoryIdByName('Publikasi');

      //$category_id = serialize($category_id);

      $qry ="select * from tbl_post where category_id='".$category_id."' ORDER BY post_id DESC limit 1"; // select data from db
      $arr = $this->db->query($qry)->result_array();
      return $arr;
    }

	  public function getLogoGramedia(){
        $qry ='select * from tbl_logo where id = 2'; // select data from db
        $arr['logo_gramedia'] = $this->db->query($qry)->result_array();
        return $arr;
    }

	public function getMidBanner(){
		$qry = "select*from tbl_banner where position='middle' order by id DESC limit 1";
		$arr['middle_banner'] = $this->db->query($qry)->result_array();
        return $arr;
	}

	public function getLeftBanner(){
		$qry = "select*from tbl_banner where position='left' order by id DESC limit 2";
		$arr['left_banner'] = $this->db->query($qry)->result_array();
        return $arr;
	}

	public function getRightBanner(){
		$qry = "select*from tbl_banner where position='right' order by id DESC limit 2";
		$arr['right_banner'] = $this->db->query($qry)->result_array();
        return $arr;
	}

	public function getOtherEvent(){
		$category_id = array('5');
        $category_id = serialize($category_id);
        $qry = "select * from tbl_post where category_id = '". $category_id . "' ORDER BY post_id DESC limit 5";
		$arr['other_event'] = $this->db->query($qry)->result_array();
		return $arr;
	}

    public function event_detail($slug){
        $arr['page'] ='single_promo';
        $qry = "select * from tbl_post where slug = '". $slug . "'";
        $arr['event_detail'] = $this->db->query($qry)->result_array();
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
        $arr['youtube'] = $this->getYoutube();
        $arr['twitter'] = $this->getTwitter();
    		$arr['middle_banner'] = $this->getMidBanner();
    		$arr['left_banner'] = $this->getLeftBanner();
    		$arr['right_banner'] = $this->getRightBanner();
    		$arr['other_event'] = $this->getOtherEvent();
        $this->load->view('vwEventDetail',$arr);
    }

    public function getSosmed(){
        $qry ='select * from tbl_sosmed'; // select data from db
        $arr['sosmed'] = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getLogo(){
        $qry ='select * from tbl_logo'; // select data from db
        $arr['logo'] = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getYoutube(){
        $qry ='select * from tbl_youtube'; // select data from db
        $arr['youtube'] = $this->db->query($qry)->result_array();
        return $arr;
    }
    public function getTwitter(){
        $qry ='select * from tbl_twitter'; // select data from db
        $arr['twitter'] = $this->db->query($qry)->result_array();
        return $arr;
    }

	public function getCategoryIdByName($title){
		$qry ="select id from tbl_post_category where title = '".$title."'"; // select data from db
		$arr = $this->db->query($qry)->result_array();

        return (string)$arr[0]['id'];
	}

	public function getLatestPromo(){
        $category_id = $this->getCategoryIdByName('Latest Promo');

        $qry ="select * from tbl_post where category_id='".$category_id."' ORDER BY post_id DESC limit 1"; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getLatestEvent(){
        $category_id = $this->getCategoryIdByName('Latest Event');

        $qry ="select * from tbl_post where category_id='".$category_id."' ORDER BY post_id DESC limit 1"; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getPublicationDate(){
        $qry ="select * from tbl_comic  ORDER BY id DESC limit 5"; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
