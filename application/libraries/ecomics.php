<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ecomics extends CI_Controller {

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
        $this->load->model('comic');
        $this->load->library('Ajax_pagination');
        $this->perPage = 16;
    }

    public function index(){
        $this->all();
    }
    public function all() {
        $arr['page'] ='All E-Comics';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
        $arr['logo_gramedia'] = $this->getLogoGramedia();
        $arr['coming_soon'] = $this->getComingSoon();
		    $arr['country'] = $this->getCountry();
		    $arr['left_banner'] = $this->getLeftBanner();
		    $arr['image'] = $this->getImage();
        $arr['tags'] = $this->getComicTags();
        $arr['content'] = '';

        //$arr['sidebar'] = $this->getSideBar();
        $totalRec = count($this->comic->getRowsEcomics());

        $config = array();
        //pagination configuration

        $config['div']         = 'comicList'; //parent div tag id
        $config["base_url"]    = base_url().'ecomics/ajaxPaginationData';
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
        $arr['ecomics'] = $this->comic->getRowsEcomics(array('limit'=>$this->perPage));

        $this->load->view('vwHeader',$arr);
        $this->load->view('vwEComics',$arr);
    }

    function ajaxPaginationData(){
        $arr['page'] ='All Comics';
        $arr['image'] = $this->getImage();

        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $totalRec = count($this->comic->getRowsEcomics());
        //pagination configuration

        $config['div']         = 'comicList'; //parent div tag id
        $config['base_url']    = base_url().'ecomics/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->ajax_pagination->initialize($config);

        //get the posts data
        $arr['ecomics'] = $this->comic->getRowsEcomics(array('start'=>$offset,'limit'=>$this->perPage));

        //load the view
        $this->load->view('vwEComicsPagination', $arr, false);
    }

	  public function getLogoGramedia(){
        $qry ='select * from tbl_logo where id = 2'; // select data from db
        $arr['logo_gramedia'] = $this->db->query($qry)->result_array();
        return $arr;
    }

	  public function getImage(){
		    $qry ="select a.comic_id, a.id, a.image, a.image_small, a.image_large, b.id from tbl_comic_image a LEFT JOIN tbl_comic b on a.comic_id = b.id ORDER BY a.id DESC"; // select data from db
		    $arr = $this->db->query($qry)->result_array();

		    return $arr;
	  }

	  public function getCountry(){
		    $qry ="select * from tbl_comic_country"; // select data from db
		    $arr = $this->db->query($qry)->result_array();
        return $arr;
	  }

    public function getSideBar(){
        $arr['sidebar'] = $this;
        $this->load->view('vwSidebar', $arr);
    }

    public function filter($category) {
        $category = rawurldecode($category);
        if($category == 'Shounen') $category_title = 'Boys';
        else if ($category == 'Shoujo') $category_title = 'Girls';
        else if ($category == 'Seinen') $category_title = 'Mature';
        else $category_title = 'All';

        $arr['page'] = $category;
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
		    $arr['logo_gramedia'] = $this->getLogoGramedia();
        $arr['coming_soon'] = $this->getComingSoon();
		    $arr['country'] = $this->getCountry();
		    $arr['left_banner'] = $this->getLeftBanner();
		    $arr['image'] = $this->getImage();

		    if(isset($_GET['cat'])){
			       $category = $_GET['cat'];
		    }

		    $config = array();
        $config["base_url"] = base_url() . "comics/filter/" . $category;
        $config["total_rows"] = $this->record_count_filter($category);
        $config["per_page"] = 16;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;
        $config['cur_tag_open'] = '<li><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);

        if($this->uri->segment(4)){
            $page = ($this->uri->segment(4)) ;
        }
        else{
            $page = 0;
        }

        $arr['comic'] = $this->fetch_comics_filter($config["per_page"], $page, $category);

        //var_dump($category);
        //die();

        $str_links = $this->pagination->create_links();
        $arr["links"] = explode('&nbsp;',$str_links );
        $arr['content'] = '';
        $this->load->view('vwHeader', $arr);
        $this->load->view('vwComics',$arr);
    }

	  public function country($category = '') {
        $arr['page'] = $category;
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
		    $arr['logo_gramedia'] = $this->getLogoGramedia();
        $arr['coming_soon'] = $this->getComingSoon();
		    $arr['country'] = $this->getCountry();
		    $arr['left_banner'] = $this->getLeftBanner();
		    $arr['image'] = $this->getImage();

		    $config = array();
		    $config["base_url"] = base_url() . "comics/country/" . $category ."";

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

        $arr['comic'] = $this->fetch_comics_filter_country($config["per_page"], $page, $category);
        $str_links = $this->pagination->create_links();
        $arr["links"] = explode('&nbsp;',$str_links );
        //$arr["links"] = $str_links;
        $arr['content'] = '';
        $this->load->view('vwHeader', $arr);

        $this->load->view('vwComics',$arr);
    }

	  public function record_count_filter($category_id) {
    		if($category_id == 'all'){
    			$qry ="select count(id) from tbl_comic ORDER BY id DESC"; // select data from db
    		}else{
    			$qry ="select count(id) from tbl_comic where tags like '%".$category_id."%' ORDER BY id DESC"; // select data from db
    		}

        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

	  public function record_count_filter_country($category_id) {
    		if($category_id == 'all'){
    			$qry ="select count(id) from tbl_comic ORDER BY id DESC"; // select data from db
    		}else{
    			$qry ="select count(id) from tbl_comic where origin='".$category_id."' ORDER BY id DESC"; // select data from db
    		}

        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

    public function record_count() {
        $qry ="select count(id) from tbl_comic ORDER BY id DESC"; // select data from db
        if(!empty($limit)){
            $qry .= "limit ".$limit;
        }
        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

    public function record_count_ecomics() {
        $qry = "select count(id) from tbl_comic where id_media_type = 2 ORDER BY id DESC"; // select data from db
        if(!empty($limit)){
            $qry .= "limit ".$limit;
        }
        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

    public function record_count_books() {
        $jnovel = '11';
        $knovel = '12';
        $indonovel = '13';
        $childbook = '14';

        $qry = "select count(id) from tbl_comic where id_media_type = 1 ORDER BY id DESC";

        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

    public function record_count_jnovel() {
        $jnovel = '11';
        $knovel = '12';
        $indonovel = '13';
        $childbook = '14';

        $qry = "select count(id) from tbl_comic where id_media_type = 1 and category_id ='" . serialize($jnovel) .
            "' or category_id =" . $jnovel . " ORDER BY id DESC";

        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

    public function record_count_knovel() {
        $jnovel = '11';
        $knovel = '12';
        $indonovel = '13';
        $childbook = '14';

        $qry = "select count(id) from tbl_comic where id_media_type = 1 and category_id ='" . serialize($knovel) .
            "' or category_id =" . $knovel . " ORDER BY id DESC";

        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

    public function record_count_indo_novel() {
        $jnovel = '11';
        $knovel = '12';
        $indonovel = '13';
        $childbook = '14';

        $qry = "select count(id) from tbl_comic where id_media_type = 1 and category_id ='" . serialize($indonovel) .
            "' or category_id =" . $indonovel . " ORDER BY id DESC";

        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

    public function record_count_child_book() {
        $jnovel = '11';
        $knovel = '12';
        $indonovel = '13';
        $childbook = '14';

        $qry = "select count(id) from tbl_comic where id_media_type = 1 and category_id ='" . serialize($childbook) .
            "' or category_id =" . $childbook . " ORDER BY id DESC";

        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
    }

    public function fetch_comics($limit, $start) {
        $this->db->limit($limit, $start);
        if(empty($defaut)){ $default = ''; }
                 $this->db
                      ->select("*")
                      ->order_by('id', 'DESC');
        $query = $this->db->get('tbl_comic');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }

	public function fetch_comics_filter($limit, $start, $category_id) {
        $this->db->limit($limit, $start);
        if($category_id == 'all'){
  			      $this->db
                   ->select("*")
                   ->order_by('id', 'DESC');
        $query = $this->db->get('tbl_comic');

    		}else{
    			$this->db
                     ->select("*")
                     ->like("tags", $category_id)
                     ->order_by('id', 'DESC');
            $query = $this->db->get('tbl_comic');
    		}

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }

	public function fetch_comics_filter_country($limit, $start, $category_id) {
        $this->db->limit($limit, $start);
        if($category_id == 'all'){
			      $this->db
                 ->select("*")
                 ->order_by('id', 'DESC');
        $query = $this->db->get('tbl_comic');

    		}else{
    			  $this->db
                 ->select("*")
                 ->where("origin","$category_id")
                 ->order_by('id', 'DESC');
            $query = $this->db->get('tbl_comic');
    		}

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }

    public function fetch_ecomics($limit, $start) {
        $this->db->limit($limit, $start);
                 $this->db
                      ->select("*")
                      ->where("id_media_type","2")
                      ->order_by('id', 'DESC');
        $query = $this->db->get('tbl_comic');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function fetch_books($limit, $start) {
        $this->db->limit($limit, $start);

        $jnovel = '11';
        $knovel = '12';
        $indonovel = '13';
        $childbook = '14';

        $where = array('id_media_type ' => '1');
            $this->db
             ->select("*")
             ->where($where)
             ->or_where("category_id", $jnovel)
             ->order_by('id', 'DESC');
             $query = $this->db->get('tbl_comic');

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

        $jnovel = '11';
        $knovel = '12';
        $indonovel = '13';
        $childbook = '14';

        $where = array('id_media_type ' => '1' , 'category_id ' => serialize($jnovel));
            $this->db
             ->select("*")
             ->where($where)
             ->or_where("category_id", $jnovel)
             ->order_by('id', 'DESC');
             $query = $this->db->get('tbl_comic');

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

        $jnovel = '11';
        $knovel = '12';
        $indonovel = '13';
        $childbook = '14';

        $where = array('id_media_type ' => '1' , 'category_id ' => serialize($knovel));
            $this->db
             ->select("*")
             ->where($where)
             ->or_where("category_id", $knovel)
             ->order_by('id', 'DESC');
             $query = $this->db->get('tbl_comic');

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

        $jnovel = '11';
        $knovel = '12';
        $indonovel = '13';
        $childbook = '14';

        $where = array('id_media_type ' => '1' , 'category_id ' => serialize($indonovel));
            $this->db
             ->select("*")
             ->where($where)
             ->or_where("category_id", $indonovel)
             ->order_by('id', 'DESC');
             $query = $this->db->get('tbl_comic');

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

        $jnovel = '11';
        $knovel = '12';
        $indonovel = '13';
        $childbook = '14';

        $where = array('id_media_type ' => '1' , 'category_id ' => serialize($childbook));
            $this->db
             ->select("*")
             ->where($where)
             ->or_where("category_id", $childbook)
             ->order_by('id', 'DESC');
             $query = $this->db->get('tbl_comic');

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
		$arr['image'] = $this->getImage();
		$now		 = strtotime(date('Y:m:d'));
        //$qry = "select * from tbl_comic where category_id='".$category_id."' or category_id = '".$category_id_des."' ORDER BY id DESC limit 4"; // select data from db
        $qry = "SELECT * FROM tbl_comic ORDER BY id DESC limit 4";
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

    public function getComicById($id){
        $qry = "select * from tbl_comic where id = '". $id . "'";
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

  	public function getSingleImage($id){
  		//$id = 2722;
  		$qry ="select a.comic_id, a.id, a.image, a.image_small, a.image_large, b.id , b.slug from tbl_comic_image a LEFT JOIN tbl_comic b
  		on a.comic_id = b.id WHERE a.comic_id = '".$id."' OR b.slug = '".$id."' ORDER BY b.id DESC"; // select data from db
  		$arr = $this->db->query($qry)->result_array();
  		//var_dump($arr);
  		return $arr;
  	}

    public function getOtherVolume($slug){
        $qry = 'select * from tbl_comic where title LIKE "'.$slug.'%" OR author LIKE "'.$slug.'%" limit 4';
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function comic_detail($slug){
        $id = $this->getComicById($slug);
		    //var_dump($id);
        if($id){
            $qry = "select * from tbl_comic where id = '". $slug . "'";
            if(!empty($this->db->query($qry)->result_array())){
              $arr['comic_detail'] = $this->db->query($qry)->result_array();
            }else{
              redirect('page404');
            }
            $title = $arr['comic_detail'][0]['author'];
            $arr['other_volume'] = $this->getOtherVolume($title);

        }else{
            $qry = "select * from tbl_comic where slug = '". $slug . "'";
            if(!empty($this->db->query($qry)->result_array())){
              $arr['comic_detail'] = $this->db->query($qry)->result_array();
            }else{
              redirect('page404');
            }
            $title = $arr['comic_detail'][0]['author'];
            $arr['other_volume'] = $this->getOtherVolume($title);
        }
        $qry = "select * from tbl_comic ORDER BY ID DESC limit 4";
        //$arr['other_volume'] = $this->db->query($qry)->result_array();
        $arr['page'] = $arr['comic_detail'][0]['title'];
        $arr['content'] = substr($arr['comic_detail'][0]['summary'], 0, 450);
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
		    $arr['logo_gramedia'] = $this->getLogoGramedia();
        $arr['youtube'] = $this->getYoutube();
        $arr['twitter'] = $this->getTwitter();
		    $arr['middle_banner'] = $this->getMidBanner();
		    $arr['left_banner'] = $this->getLeftBanner();
		    $arr['right_banner'] = $this->getRightBanner();
		    $arr['single_image'] = $this->getSingleImage($slug);
		    $arr['other_image'] = $this->getImage();

	      //var_dump($arr['single_image']);

        $this->load->view('vwHeader', $arr);
        $this->load->view('vwComicDetail',$arr);
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

    public function books(){
        $arr['page'] = 'single_books';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();

        $config = array();
        $config["base_url"] = site_url( "comics/books/" );
        $config["total_rows"] = $this->record_count_books();
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
            $page = 1;
        }

        $arr['books'] = $this->fetch_books($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $arr["links"] = explode('&nbsp;',$str_links );

        $this->load->view('vwBooks', $arr);
    }

    public function jnovel(){
        $arr['page'] = 'single_books';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();

        $config = array();
        $config["base_url"] = site_url( "comics/jnovel/" );
        $config["total_rows"] = $this->record_count_jnovel();
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
            $page = 1;
        }

        $arr['books'] = $this->fetch_jnovel($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $arr["links"] = explode('&nbsp;',$str_links );

        $this->load->view('vwBooks', $arr);
    }

    public function knovel(){
        $arr['page'] = 'single_books';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();

        $config = array();
        $config["base_url"] = site_url( "comics/knovel/" );
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
            $page = 1;
        }

        $arr['books'] = $this->fetch_knovel($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $arr["links"] = explode('&nbsp;',$str_links );

        $this->load->view('vwBooks', $arr);
    }

    public function indo_novel(){
        $arr['page'] = 'single_books';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();

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
            $page = 1;
        }

        $arr['books'] = $this->fetch_indo_novel($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $arr["links"] = explode('&nbsp;',$str_links );

        $this->load->view('vwBooks', $arr);
    }

    public function child_book(){
        $arr['page'] = 'single_books';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();

        $config = array();
        $config["base_url"] = site_url( "comics/child_book/" );
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
            $page = 1;
        }

        $arr['books'] = $this->fetch_child_book($config["per_page"], $page);

        $str_links = $this->pagination->create_links();
        $arr["links"] = explode('&nbsp;',$str_links );

        $this->load->view('vwBooks', $arr);
    }

    public function getComicTags(){
      $qry ='select tags from tbl_comic limit 1'; // select data from db
      $arr['tags'] = $this->db->query($qry)->result_array();
      return $arr;
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
        /*
         * Code By Abhishek R. Kaushik
         * Sr. Software Developer
         */
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
