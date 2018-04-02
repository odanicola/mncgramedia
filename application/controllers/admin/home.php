<?php
/*
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
*/
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

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
         if ($this->session->userdata('is_admin_login')) {
            redirect('admin/dashboard');
        } else {
            $arr['page'] ='M&C Gramedia';
            $arr['sosmed'] = $this->getSosmed();
            $arr['logo'] = $this->getLogo();
            $arr['logo_gramedia'] = $this->getLogoGramedia();
            $arr['new_arrival'] = $this->getNewArrival();
            $arr['best_seller'] = $this->getBestSeller();
            $arr['coming_soon'] = $this->getComingSoon();
            $arr['editor_choice'] = $this->getEditorChoice();
            $arr['latest_promo'] = $this->getLatestPromo();
            $arr['latest_event'] = $this->getLatestEvent();
            $arr['cover'] = $this->getImage();
            $arr['slider'] = $this->getSlider();
            $arr['latest_promo'] = $this->getLatestPromo();
            $arr['latest_event'] = $this->getLatestEvent();
            $arr['publication_date'] = $this->getPublication();
            //$arr['publication_date'] = $this->getPublicationDate();
            $arr['youtube'] = $this->getYoutube();
            $arr['twitter'] = $this->getTwitter();
            $arr['content'] = '';
            $this->load->view('vwHeader', $arr);
            $this->load->view('vwHome',$arr);
        }
    }

    public function getImage(){
  		$qry ="select a.comic_id, a.id, a.image, a.image_small, a.image_large, b.id from tbl_comic_image a LEFT JOIN tbl_comic b on a.comic_id = b.id ORDER BY a.id DESC"; // select data from db
  		$arr = $this->db->query($qry)->result_array();

  		return $arr;
  	}

    public function getLogo(){
        $qry ='select * from tbl_logo'; // select data from db
        $arr['logo'] = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getSlider(){
        $qry ='select * from tbl_slider'; // select data from db
        $arr['slider'] = $this->db->query($qry)->result_array();
        return $arr;
    }
    public function getSosmed(){
        $qry ='select * from tbl_sosmed'; // select data from db
        $arr['sosmed'] = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getNewArrival(){
        $qry ='select * from tbl_comic ORDER BY id DESC limit 10'; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getBestSeller(){
        $category_id = array("11","12");
        $category_id = serialize($category_id);

        $category_id_des = '11';

        $qry ="select * from tbl_comic where category_id='".$category_id."' or category_id = '".$category_id_des."' ORDER BY id DESC limit 10"; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getComingSoon(){
        $category_id = array("11","12");
        $category_id = serialize($category_id);

        $category_id_des = '12';

        $qry ="select * from tbl_comic ORDER BY id DESC limit 10"; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getEditorChoice(){
        $category_id = array("11","12");
        $category_id = serialize($category_id);

        $category_id_des = '14';;
        $qry ="select * from tbl_comic where category_id='".$category_id."' or category_id = '".$category_id_des."' ORDER BY id DESC limit 10"; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getPublication(){
      $category_id = $this->getCategoryIdByName('Publikasi');

      //$category_id = serialize($category_id);

      $qry ="select * from tbl_post where category_id='".$category_id."' ORDER BY post_id DESC limit 1"; // select data from db
      $arr = $this->db->query($qry)->result_array();
      return $arr;
    }

    public function getLatestPromo(){
        //$category_id = array("4");
		    $category_id = $this->getCategoryIdByName('Latest Promo');

        //$category_id = serialize($category_id);

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

    public function getPublicationDate(){
        $qry ="select * from tbl_comic  ORDER BY id DESC limit 5"; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function register(){
        $arr['page'] = 'register';
        $this->load->view('vwRegister',$arr);
    }

     public function do_login() {

        if ($this->session->userdata('is_admin_login')) {
            redirect('admin/home/dashboard');
        } else {
            $user = $_POST['username'];
            $password = $_POST['password'];

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/vwLogin');
            } else {
                $salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
                $enc_pass  = md5($salt.$password);
                $sql = "SELECT * FROM tbl_admin_users WHERE username = ? AND password = ?";
                $val = $this->db->query($sql,array($user ,$enc_pass ));

                if ($val->num_rows) {
                    foreach ($val->result_array() as $recs => $res) {
                        $this->session->set_userdata(array(
                            'id' => $res['id'],
                            'username' => $res['username'],
                            'email' => $res['email'],
                            'is_admin_login' => true,
                            'user_type' => $res['user_type']
                                )
                        );
                    }
                    redirect('admin/dashboard');
                } else {
                    $err['error'] = '<strong>Access Denied</strong> Invalid Username/Password';
                    $this->load->view('admin/vwLogin', $err);
                }
            }
        }
           }


    public function logout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('is_admin_login');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('home', 'refresh');
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
