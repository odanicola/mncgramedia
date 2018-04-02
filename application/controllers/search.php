<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search extends CI_Controller {

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
        $this->load->model('cari');
        $this->load->library('Ajax_pagination');
        $this->perPage = 16;
    }

    public function index(){
        $this->all();
    }

    public function all(){
        $keyword = $_GET['q'];
        $this->session->set_userdata(array('keyword' => $keyword));

        $arr['page'] ='Search Comics';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
        $arr['logo_gramedia'] = $this->getLogoGramedia();
        $arr['coming_soon'] = $this->getComingSoon();
		    $arr['country'] = $this->getCountry();
		    $arr['left_banner'] = $this->getLeftBanner();
		    $arr['image'] = $this->getImage();
        $arr['content'] = '';
        $arr['keyword'] = $keyword;

        //$arr['sidebar'] = $this->getSideBar();
        $totalRec = count($this->cari->getRows(array('keyword' => $keyword)));

        $config = array();
        //pagination configuration

        $config['div']         = 'comicList'; //parent div tag id
        $config["base_url"]    = base_url().'search/ajaxPaginationData/';
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
        $arr['comic'] = $this->cari->getRows(array('limit'=>$this->perPage, 'keyword' => $keyword));

        $this->load->view('vwHeader',$arr);
        $this->load->view('vwComics',$arr);
    }

    public function ajaxPaginationData(){
        $arr['page'] ='Search Comics';
        $arr['image'] = $this->getImage();
        $keyword = $this->session->userdata('keyword');
        
        $arr['keyword'] = $keyword;
        $page = $this->input->post('page');

        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $totalRec = count($this->cari->getRows(array('keyword' => $keyword)));
        //pagination configuration

        $config['div']         = 'comicList'; //parent div tag id
        $config['base_url']    = base_url().'search/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->ajax_pagination->initialize($config);

        //get the posts data
        $arr['comic'] = $this->cari->getRows(array('start'=>$page,'limit'=>$this->perPage, 'keyword' => $keyword));

        //load the view
        $this->load->view('vwComicsPagination', $arr, false);
    }

    public function getImage(){
        $qry ="select a.comic_id, a.id, a.image, a.image_small, a.image_large, b.id from tbl_comic_image a LEFT JOIN tbl_comic b on a.comic_id = b.id ORDER BY a.id DESC"; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getImageSearch($id){
        $qry ="select a.comic_id, a.id, a.image, a.image_small, a.image_large, b.id from tbl_comic_image a LEFT JOIN tbl_comic b on a.comic_id = b.id WHERE comic_id = '".$id."' ORDER BY a.id DESC"; // select data from db
        $arr = $this->db->query($qry)->result_array();

        return $arr;
    }

    public function getCountry(){
        $qry ="select * from tbl_comic_country"; // select data from db
        $arr = $this->db->query($qry)->result_array();
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

	public function get_search(){
		//$this->load->model('search');
		//var_dump($this->load->model('search'));
		//die();
		if (isset($_GET['term'])){
		  $q = strtolower($_GET['term']);
		  $this->db->select('*')
			->like("title","$q")
			->or_like("author", "$q")
			->limit(5,0);
		  $query = $this->db->get('tbl_comic');
		  if($query->num_rows > 0){
			foreach ($query->result_array() as $row){
				$new_row['label']=htmlentities(stripslashes($row['title']));
				$new_row['value']=htmlentities(stripslashes($row['title']));
				if(!empty($row['image'])){
					$new_row['image']=htmlentities(stripslashes($row['image']));
				}else{
          $new_row['image_default'] = htmlentities(stripslashes('true'));
          $arr['imagesearch'] = $this->getImageSearch($row['id']);
          $imagesearch = $arr['imagesearch'];

          $new_row['image'] = htmlentities(stripslashes($imagesearch[0]['image_small']));
					//$new_row['image'] = htmlentities(stripslashes("komik4.jpg"));
				}
				$new_row['description']=htmlentities(stripslashes($row['summary']));
				//$new_row['description']=substr(strip_tags($new_row['author']), 0, 50);
        $new_row['description']=htmlentities(stripslashes($row['author']));
        $new_row['id']=htmlentities(stripslashes($row['id']));
				if(!empty($row['slug'])){
					$new_row['slug']=htmlentities(stripslashes($row['slug']));
				}else{
					$new_row['slug']=htmlentities(stripslashes($row['id']));
				}

				$row_set[] = $new_row; //build an array
			}
			echo json_encode($row_set); //format the array into json data
		  }
		  //$this->search->get_search($q);
		}
	}

    public function getLogoGramedia(){
        $qry ='select * from tbl_logo where id = 2'; // select data from db
        $arr['logo_gramedia'] = $this->db->query($qry)->result_array();
        return $arr;
    }

	public function getSosmed(){
        $qry ='select * from tbl_sosmed'; // select data from db
        $arr['sosmed'] = $this->db->query($qry)->result_array();
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

	public function getLogo(){
        $qry ='select * from tbl_logo'; // select data from db
        $arr['logo'] = $this->db->query($qry)->result_array();
        return $arr;
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

        $this->load->view('vwComics',$arr);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
