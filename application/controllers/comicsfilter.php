<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ComicsFilter extends CI_Controller {

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
    }
	
	public function index(){
		echo 'hi';
	}
	
	public function all() {
        redirect('comics','refresh');
    }
	
	public function record_count() {
        $qry ="select count(id) from tbl_comic ORDER BY id DESC"; // select data from db
        if(!empty($limit)){
            $qry .= "limit ".$limit;
        }
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
	
    public function filter(){
		$config = array();
		$arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
		$arr['coming_soon'] = $this->getComingSoon();
		
		if(isset($_GET['category'])){
			$category = $_GET['category'];
		}else{ $category = 'all';}
		
        $config["base_url"] = base_url() . "comicsfilter/filter/";
        $config["total_rows"] = $this->record_count_filter($category);
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
		
        $arr['comic'] = $this->fetch_comics_filter($config["per_page"], $page, $category);
        $str_links = $this->pagination->create_links();
        $arr["links"] = explode('&nbsp;',$str_links );
		if($page > 11){
			$this->load->view('vwComicsFilterPage',$arr);
		}elseif($page <= 11){
			$this->load->view('vwComicsFilter',$arr);
		}
		
	}
	
	public function record_count_filter($category_id) {
		if($category_id == 'all'){
			$qry ="select count(id) from tbl_comic ORDER BY id DESC"; // select data from db
		}else{
			$qry ="select count(id) from tbl_comic where category_id='".$category_id."' ORDER BY id DESC"; // select data from db
		}
 
        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(id)'];
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
                 ->where("category_id","$category_id")
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
        $category_id = array("11","12");
        $category_id = serialize($category_id);
        $category_id_des = '12';
		$now		 = strtotime(date('Y:m:d'));
        //$qry = "select * from tbl_comic where category_id='".$category_id."' or category_id = '".$category_id_des."' ORDER BY id DESC limit 4"; // select data from db
        $qry = "SELECT * FROM tbl_comic ORDER BY id DESC limit 4";
		$arr = $this->db->query($qry)->result_array();
        return $arr;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */