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

        if(!empty($_GET['country'])){
          $country  = $_GET['country'];
          $arr['page'] = $country;
        }else{
          $country  = '';
        }

        if(!empty($_GET['genre'])){
          $genre    = $_GET['genre'];
          $genre    = rawurldecode($genre);
          $arr['page'] = $genre;

        }else{
          $genre    = '';
        }

        if(!empty($_GET['category'])){
          $category = $_GET['category'];
          $category = rawurldecode($category);

          if($category == 'Shounen') $category_title = 'Boys';
          else if ($category == 'Shoujo') $category_title = 'Girls';
          else if ($category == 'Seinen') $category_title = 'Mature';
          $arr['page'] = $category;

        }else{
          $category = '';
        }

        $this->session->set_userdata(array('country' => $country));
        $this->session->set_userdata(array('genre' => $genre));
        $this->session->set_userdata(array('category' => $category));

        //$arr['sidebar'] = $this->getSideBar();
        $totalRec = count($this->comic->getRowsEcomics(array('country' => $country, 'genre' => $genre, 'category' => $category)));

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
        $arr['ecomics'] = $this->comic->getRowsEcomics(array('limit'=>$this->perPage, 'country' => $country, 'genre' => $genre, 'category' => $category));

        $this->load->view('vwHeader',$arr);
        $this->load->view('vwEcomics',$arr);
    }

    function ajaxPaginationData(){
        $arr['page'] ='All Comics';
        $arr['image'] = $this->getImage();

        $country = $this->session->userdata('country');
        $genre = $this->session->userdata('genre');
        $category = $this->session->userdata('category');

        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $totalRec = count($this->comic->getRowsEcomics(array('country' => $country, 'genre' => $genre, 'category' => $category)));
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
        $arr['ecomics'] = $this->comic->getRowsEcomics(array('start'=>$page,'limit'=>$this->perPage, 'country' => $country, 'genre' => $genre, 'category' => $category));

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
