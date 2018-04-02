<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Childrenbooks extends CI_Controller {

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
        $this->load->model('novel');
        $this->load->library('Ajax_pagination');
        $this->perPage = 16;
    }

    public function index(){
        $this->all();
    }
    public function all() {
        $arr['page'] ='All Children Books';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
        $arr['logo_gramedia'] = $this->getLogoGramedia();
        $arr['coming_soon'] = $this->getComingSoon();
    		$arr['country'] = $this->getCountry();
    		$arr['left_banner'] = $this->getLeftBanner();
        $arr['content'] = '';
        $category_id = $this->getCategoryIdByName('Children Books');
		    //$arr['image'] = $this->getImage();

        $totalRec = count($this->novel->getRowsCbook(array('category'=>$category_id)));
        $config = array();
        //pagination configuration

        $config['div']         = 'comicList'; //parent div tag id
        $config["base_url"]    = base_url().'childrenbooks/ajaxPaginationData';
        $config["total_rows"]  = $totalRec;
        $config["per_page"]    = $this->perPage;
        $config["uri_segment"] = 1;
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = 3;
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        //$this->pagination->initialize($config);
        $this->ajax_pagination->initialize($config);

        $arr['novel'] = $this->novel->getRowsCbook(array('limit'=>$this->perPage,'category'=>$category_id));

        $this->load->view('vwHeader',$arr);
        $this->load->view('vwBooks',$arr);
    }

    function ajaxPaginationData(){
        $arr['page'] ='All Children Books';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
        $arr['logo_gramedia'] = $this->getLogoGramedia();
        $arr['coming_soon'] = $this->getComingSoon();
        $arr['country'] = $this->getCountry();
        $arr['left_banner'] = $this->getLeftBanner();
        $arr['content'] = '';
        $category_id = $this->getCategoryIdByName('Children Books');

        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $totalRec = count($this->novel->getRowsCbook(array('category'=>$category_id)));
        //pagination configuration

        $config['div']         = 'comicList'; //parent div tag id
        $config['base_url']    = base_url().'childrenbooks/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->ajax_pagination->initialize($config);

        //get the posts data
        $arr['novel'] = $this->novel->getRowsCbook(array('start'=>$offset,'limit'=>$this->perPage,'category'=>$category_id));

        //load the view
        $this->load->view('vwBooksPagination', $arr, false);
    }

    public function jnovel(){
        $arr['page'] = 'J-Novel';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
    		$arr['logo_gramedia'] = $this->getLogoGramedia();
    		$arr['left_banner'] = $this->getLeftBanner();
    		$arr['country'] = $this->getCountry();
        $arr['content'] = '';

        $totalRec = count($this->novel->getRowsJnovel());
        $config = array();
        //pagination configuration

        $config['div']         = 'comicList'; //parent div tag id
        $config["base_url"]    = base_url().'book/jnovel/ajaxPaginationData';
        $config["total_rows"]  = $totalRec;
        $config["per_page"]    = $this->perPage;
        $config["uri_segment"] = 3;
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = 3;
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);

        //$this->pagination->initialize($config);
        $this->ajax_pagination->initialize($config);
        $arr['novel'] = $this->novel->getRowsJnovel(array('limit'=>$this->perPage));

        $this->load->view('vwHeader',$arr);
        $this->load->view('vwBooks',$arr);
    }

	  public function getLogoGramedia(){
        $qry ='select * from tbl_logo where id = 2'; // select data from db
        $arr['logo_gramedia'] = $this->db->query($qry)->result_array();
        return $arr;
    }

  	public function getCountry(){
  		  $qry ="select * from tbl_novel_country"; // select data from db
  		  $arr = $this->db->query($qry)->result_array();
        return $arr;
  	}

	  public function filter($category) {
        $arr['page'] ='novel';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
        $arr['coming_soon'] = $this->getComingSoon();
    		$arr['country'] = $this->getCountry();
    		$arr['left_banner'] = $this->getLeftBanner();

    		if(isset($_GET['cat'])){
    			$category = $_GET['cat'];
    		}else{ $category = '11';}

		    $config = array();
        $config["base_url"] = base_url() . "book/filter/" . $category;
        $config["total_rows"] = $this->record_count_filter($category);
        $config["per_page"] = 16;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;
        $config['cur_tag_open'] = '<li><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
		    //$config['use_page_numbers'] = TRUE;

		    // Use pagination number for anchor URL.
		    //$config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        if($this->uri->segment(4)){
            $page = ($this->uri->segment(4)) ;
        }
        else{
            $page = 0;
        }

        $arr['novel'] = $this->fetch_novel_filter($config["per_page"], $page, $category);
        $str_links = $this->pagination->create_links();
        $arr["links"] = explode('&nbsp;',$str_links );

        $this->load->view('vwBooks',$arr);
    }

	  public function country($category = '') {
        $arr['page'] =$category;
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
        $arr['logo_gramedia'] = $this->getLogoGramedia();
        $arr['coming_soon'] = $this->getComingSoon();
		    $arr['country'] = $this->getCountry();
		    $arr['left_banner'] = $this->getLeftBanner();

		    $config = array();
		    $config["base_url"] = base_url() . "book/country/" . $category ."";

        $config["total_rows"] = $this->record_count_filter_country($category);
        $config["per_page"] = 16;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;
        $config['cur_tag_open'] = '<li><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
		    // Use pagination number for anchor URL.
		    $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        if($this->uri->segment(4)){
            $page = ($this->uri->segment(4)) ;
        }
        else{
            $page = 0;
        }

        $arr['novel'] = $this->fetch_novel_filter_country($config["per_page"], $page, $category);
        $str_links = $this->pagination->create_links();
        $arr["links"] = explode('&nbsp;',$str_links );
        //$arr["links"] = $str_links;

        $this->load->view('vwBooks',$arr);
    }

	  public function record_count_filter($category_id) {
		if($category_id == 'all'){
			$qry ="select count(id) from tbl_novel ORDER BY id DESC"; // select data from db
		}else{
			$qry ="select count(id) from tbl_novel where category_id='".$category_id."' ORDER BY id DESC"; // select data from db
		}

        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

	  public function record_count_filter_country($category_id) {
		if($category_id == 'all'){
			$qry ="select count(id) from tbl_novel ORDER BY id DESC"; // select data from db
		}else{
			$qry ="select count(id) from tbl_novel where origin='".$category_id."' ORDER BY id DESC"; // select data from db
		}

        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

    public function record_count() {
        $qry ="select count(id) from tbl_novel ORDER BY id DESC"; // select data from db
        if(!empty($limit)){
            $qry .= "limit ".$limit;
        }
        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

    public function record_count_jnovel() {
        $jnovel = $this->getCategoryIdByName('J-Novel');

        $qry = "select count(id) from tbl_novel where id_media_type = 1 and category_id = '" . $jnovel . "' ORDER BY id DESC";

        $arr = $this->db->query($qry)->result_array();
		if($arr){
			return (int) $arr[0]['count(id)'];
		}
        else{
			return false;
		}
    }

    public function record_count_knovel() {
        $category_id = $this->getCategoryIdByName('K-Novel');

        $qry = "select count(id) from tbl_novel where id_media_type = 1 and category_id = '" . $category_id . "' ORDER BY id DESC";

        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

    public function record_count_indo_novel() {
        $category_id = $this->getCategoryIdByName('Indonesian-Novel');

        $qry = "select count(id) from tbl_novel where id_media_type = 1 and category_id = '" . $category_id . "' ORDER BY id DESC";

        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

    public function record_count_child_book() {
        $category_id = $this->getCategoryIdByName('Children Books');

        $qry = "select count(id) from tbl_novel where id_media_type = 1 and category_id = '" . $category_id . "' ORDER BY id DESC";

        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

    public function fetch_novel($limit, $start) {
        $this->db->limit($limit, $start);
        if(empty($defaut)){ $default = ''; }
                 $this->db
                      ->select("*")
                      ->order_by('id', 'DESC');
        $query = $this->db->get('tbl_novel');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }

	public function fetch_novel_filter($limit, $start, $category_id) {
        $this->db->limit($limit, $start);
        if($category_id == 'all'){
			$this->db
                 ->select("*")
                 ->order_by('id', 'DESC');
        $query = $this->db->get('tbl_novel');

		}else{
			$this->db
                 ->select("*")
                 ->where("category_id","$category_id")
                 ->order_by('id', 'DESC');
        $query = $this->db->get('tbl_novel');
		}

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }

	  public function fetch_novel_filter_country($limit, $start, $category_id) {
        $this->db->limit($limit, $start);
        if($category_id == 'all'){
			$this->db
                 ->select("*")
                 ->order_by('id', 'DESC');
        $query = $this->db->get('tbl_novel');

		}else{
			$this->db
                 ->select("*")
                 ->where("origin","$category_id")
                 ->order_by('id', 'DESC');
        $query = $this->db->get('tbl_novel');
		}

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }

    public function fetch_jnovel($limit, $start) {
        $this->db->limit($limit, $start);
		    $category_id = $this->getCategoryIdByName('J-Novel');
        $where = array('id_media_type ' => '1', 'category_id' => $category_id);
		    $this->db
		      ->select("*")
		      ->where($where)
		      ->order_by('id', 'DESC');
		    $query = $this->db->get('tbl_novel');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function fetch_knovel($limit, $start) {
        $this->db->limit($limit, $start);
		    $category_id = $this->getCategoryIdByName('K-Novel');
        $where = array('id_media_type ' => '1', 'category_id' => $category_id);
		    $this->db
		      ->select("*")
		      ->where($where)
		      ->order_by('id', 'DESC');
		    $query = $this->db->get('tbl_novel');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function fetch_indo_novel($limit, $start) {
        $this->db->limit($limit, $start);
		    $category_id = $this->getCategoryIdByName('Indonesian-Novel');
        $where = array('id_media_type ' => '1', 'category_id' => $category_id);
    		$this->db
    		 ->select("*")
    		 ->where($where)
    		 ->order_by('id', 'DESC');
    		 $query = $this->db->get('tbl_novel');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function fetch_child_book($limit, $start) {
        $this->db->limit($limit, $start);
		    $category_id = $this->getCategoryIdByName('Children Books');
        $where = array('id_media_type ' => '1', 'category_id' => $category_id);
    		$this->db
    		 ->select("*")
    		 ->where($where)
    		 ->order_by('id', 'DESC');
    		 $query = $this->db->get('tbl_novel');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
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

    public function getComingSoon(){
        $category_id = array("1","2");
        $category_id = serialize($category_id);
        $category_id_des = '1';
		    $now		 = strtotime(date('Y:m:d'));
        //$qry = "select * from tbl_comic where category_id='".$category_id."' or category_id = '".$category_id_des."' ORDER BY id DESC limit 4"; // select data from db
        $qry = "SELECT * FROM tbl_novel ORDER BY id DESC limit 4";
		    $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getComicByCategory($category_id = array(), $default, $limit){
        $category_id = serialize($category_id);
        if(empty($defaut)){ $default = ''; }
        $qry ="select * from tbl_comic where category_id='".$category_id."' or category_id = '".$default."' ORDER BY id DESC"; // select data from db
        if(!empty($limit)){
            $qry .= "limit ".$limit;
        }
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

	public function getCategoryIdByName($title){
		$qry ="select id from tbl_novel_category where title = '".$title."'"; // select data from db
		$arr = $this->db->query($qry)->result_array();

        return (string)$arr[0]['id'];
	}

    public function getNovelById($id){
        $qry = "select * from tbl_novel where id = '". $id . "'";
        if($this->db->query($qry)->result_array()){
            return true;
        } else return false;
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
    public function novel_detail($slug){
        $arr['page'] ='single_comic';
        $id = $this->getNovelById($slug);
        if($id){
            $qry = "select * from tbl_novel where id = '". $slug . "'";
            $d = $this->db->query($qry)->result_array();
            if(!empty($d)){
                $arr['novel_detail'] = $this->db->query($qry)->result_array();
            }else{
                redirect('page404');
            }

        }else{
            $qry = "select * from tbl_novel where slug = '". $slug . "'";
            $d = $this->db->query($qry)->result_array();
            if(!empty($d)){
                $arr['novel_detail'] = $this->db->query($qry)->result_array();
            }else{
                redirect('page404');
            }
        }
        $qry = "select * from tbl_novel ORDER BY ID DESC limit 4";
        $arr['page'] = $arr['novel_detail'][0]['title'];
        $arr['content'] = substr($arr['novel_detail'][0]['summary'], 0, 450);
        $arr['other_volume'] = $this->db->query($qry)->result_array();
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
        $arr['logo_gramedia'] = $this->getLogoGramedia();
        $arr['youtube'] = $this->getYoutube();
        $arr['twitter'] = $this->getTwitter();
    		$arr['middle_banner'] = $this->getMidBanner();
    		$arr['left_banner'] = $this->getLeftBanner();
    		$arr['right_banner'] = $this->getRightBanner();

        $this->load->view('vwHeader', $arr);
        $this->load->view('vwNovelDetail',$arr);
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

    public function knovel(){
        $arr['page'] = 'K-Novel';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
    		$arr['logo_gramedia'] = $this->getLogoGramedia();
    		$arr['left_banner'] = $this->getLeftBanner();
    		$arr['country'] = $this->getCountry();
        $arr['content'] = '';

        $config = array();
        $config["base_url"] = site_url( "novel/knovel/" );
        $config["total_rows"] = $this->record_count_knovel();
        $config["per_page"] = 16;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);

        if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
        }
        else{
            $page = 0;
        }

        $arr['novel'] = $this->fetch_knovel($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $arr["links"] = explode('&nbsp;',$str_links );

        $this->load->view('vwHeader',$arr);
        $this->load->view('vwBooks', $arr);
    }

    public function indo_novel(){
        $arr['page'] = 'Indonesian Novel';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
    		$arr['logo_gramedia'] = $this->getLogoGramedia();
    		$arr['left_banner'] = $this->getLeftBanner();
    		$arr['country'] = $this->getCountry();
        $arr['content'] = '';

        $config = array();
        $config["base_url"] = site_url( "comics/indo_novel/" );
        $config["total_rows"] = $this->record_count_indo_novel();
        $config["per_page"] = 16;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);

        if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
        }
        else{
            $page = 0;
        }

        $arr['novel'] = $this->fetch_indo_novel($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $arr["links"] = explode('&nbsp;',$str_links );

        $this->load->view('vwHeader',$arr);
        $this->load->view('vwBooks', $arr);
    }

    public function child_book(){
        $arr['page'] = 'Children Books';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
    		$arr['logo_gramedia'] = $this->getLogoGramedia();
    		$arr['left_banner'] = $this->getLeftBanner();
    		$arr['country'] = $this->getCountry();
        $arr['content'] = '';

        $config = array();
        $config["base_url"] = site_url( "book/child_book/" );
        $config["total_rows"] = $this->record_count_child_book();
        $config["per_page"] = 16;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);

        if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
        }
        else{
            $page = 0;
        }

        $arr['novel'] = $this->fetch_child_book($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $arr["links"] = explode('&nbsp;',$str_links );

        $this->load->view('vwHeader',$arr);
        $this->load->view('vwBooks', $arr);
    }

    public function do_login() {

        if ($this->session->userdata('is_client_login')) {
            redirect('home/loggedin');
        } else {
            $user = $_POST['username'];
            $password = $_POST['password'];

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('login');
            } else {
                $sql = "SELECT * FROM users WHERE user_name = '" . $user . "' AND user_hash = '" . md5($password) . "'";
                $val = $this->db->query($sql);


                if ($val->num_rows) {
                    foreach ($val->result_array() as $recs => $res) {

                        $this->session->set_userdata(array(
                            'id' => $res['id'],
                            'user_name' => $res['user_name'],
                            'email' => $res['email'],
                            'is_client_login' => true
                                )
                        );
                    }
                    redirect('calls/call');
                } else {
                    $err['error'] = 'Username or Password incorrect';
                    $this->load->view('login', $err);
                }
            }
        }
           }


    public function logout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('title');
         $this->session->unset_userdata('ag_country');

        $this->session->unset_userdata('is_client_login');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('home', 'refresh');
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
