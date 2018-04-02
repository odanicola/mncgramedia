<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event extends CI_Controller {

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
		    $this->load->library("pagination");
        $this->load->helper('url');
        $this->load->model('postpromo');
        $this->load->library('Ajax_pagination');
        $this->perPage = 5;
    }

	public function index() {
		$this->all();
	}

    public function all() {
        $arr['page'] ='Event';
        //$category_id = $this->getCategoryIdByName('Latest Event');
        //$qry = "select * from tbl_post where category_id = '". $category_id . "' ORDER BY post_id DESC";
        //$arr['event'] = $this->db->query($qry)->result_array();
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
		    $arr['logo_gramedia'] = $this->getLogoGramedia();
        $arr['youtube'] = $this->getYoutube();
        $arr['twitter'] = $this->getTwitter();
    		$arr['middle_banner'] = $this->getMidBanner();
    		$arr['left_banner'] = $this->getLeftBanner();
    		$arr['right_banner'] = $this->getRightBanner();

        $category = $this->getCategoryIdByName('Latest Event');

        $totalRec = count($this->postpromo->getRows(array('category' => $category)));

        $config = array();
        $config['div']         = 'comicList'; //parent div tag id
        $config["base_url"]    = base_url().'event/ajaxPaginationData/';
        $config["total_rows"]  = $totalRec;
        $config["per_page"]    = $this->perPage;
        $config["uri_segment"] = 3;
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = 3;
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        //$this->pagination->initialize($config);
        $this->ajax_pagination->initialize($config);

        //get the posts data
        $arr['event'] = $this->postpromo->getRows(array('limit'=>$this->perPage, 'category' => $category));

        $arr['content'] = '';
        $this->load->view('vwHeader',$arr);

        $this->load->view('vwEvent',$arr);
    }

    function ajaxPaginationData(){
        $arr['page'] ='All Comics';

        $category = $this->getCategoryIdByName('Latest Event');

        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $totalRec = count($this->postpromo->getRows(array('category' => $category)));
        //pagination configuration

        $config['div']         = 'comicList'; //parent div tag id
        $config['base_url']    = base_url().'event/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->ajax_pagination->initialize($config);

        //get the posts data
        $arr['event'] = $this->postpromo->getRows(array('start'=>$page,'limit'=>$this->perPage, 'category' => $category));

        //load the view
        $this->load->view('vwEventPagination', $arr, false);
    }

	  public function record_count() {
		    $category_id = $this->getCategoryIdByName('Latest Event');
        $qry ="select count(post_id) from tbl_post WHERE category_id = '".$category_id."' ORDER BY post_id DESC"; // select data from db
        if(!empty($limit)){
            $qry .= "limit ".$limit;
        }
        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(post_id)'];
    }

	  public function fetch($limit, $start) {
        $this->db->limit($limit, $start);
		    $category_id = $this->getCategoryIdByName('Latest Event');
        if(empty($defaut)){ $default = ''; }
                 $this->db
                      ->select("*")
					  ->where('category_id', $category_id)
                      ->order_by('post_id', 'DESC');
        $query = $this->db->get('tbl_post');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }

	  public function getMidBanner(){
		    $qry = "select*from tbl_banner where position='middle' order by id DESC limit 1";
		    $arr['middle_banner'] = $this->db->query($qry)->result_array();
        return $arr;
	  }

	  public function getCategoryIdByName($title){
		    $qry ="select id from tbl_post_category where title = '".$title."'"; // select data from db
		    $arr = $this->db->query($qry)->result_array();
        return (string)$arr[0]['id'];
	  }

	  public function getLogoGramedia(){
        $qry ='select * from tbl_logo where id = 2'; // select data from db
        $arr['logo_gramedia'] = $this->db->query($qry)->result_array();
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

        $qry = "select * from tbl_post where slug = '". $slug . "'";
        $arr['event_detail'] = $this->db->query($qry)->result_array();
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
		    $arr['logo_gramedia'] = $this->getLogoGramedia();
        $arr['youtube'] = $this->getYoutube();
        $arr['twitter'] = $this->getTwitter();
    		$arr['middle_banner'] = $this->getMidBanner();
    		$arr['left_banner'] = $this->getLeftBanner();
    		$arr['right_banner'] = $this->getRightBanner();
    		$arr['other_event'] = $this->getOtherEvent();

        $arr['page'] = $arr['event_detail'][0]['title'];
        $arr['content'] = substr($arr['event_detail'][0]['content'], 0, 450);
        $this->load->view('vwHeader',$arr);

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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
