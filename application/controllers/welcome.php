<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
       // $this->load->library('form_validation');
    }

    public function index() {
       /* if ($this->session->userdata('is_client_login') || $this->session->userdata('is_admin_login')) {
            $arr['page'] ='home';
            $arr['sosmed'] = $this->getSosmed();
            $arr['new_arrival'] = $this->getNewArrival();
            $arr['best_seller'] = $this->getBestSeller();
            $arr['coming_soon'] = $this->getComingSoon();
            $arr['editor_choice'] = $this->getEditorChoice();
            $arr['latest_promo'] = $this->getLatestPromo();
            $arr['latest_event'] = $this->getLatestEvent();
            $arr['slider'] = $this->getSlider();
            $arr['publication_date'] = $this->getPublicationDate();
            $this->load->view('vwHome',$arr);
        } else {*/
            $arr['page'] ='home';
           /* $arr['sosmed'] = $this->getSosmed();
            $arr['new_arrival'] = $this->getNewArrival();
            $arr['best_seller'] = $this->getBestSeller();
            $arr['coming_soon'] = $this->getComingSoon();
            $arr['editor_choice'] = $this->getEditorChoice();
            $arr['latest_promo'] = $this->getLatestPromo();
            $arr['latest_event'] = $this->getLatestEvent();
            $arr['slider'] = $this->getSlider();
            $arr['publication_date'] = $this->getPublicationDate();*/
            $this->load->view('vwHome');
	   // echo 'test';
        /*}*/
        
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
        
        $qry ="select * from tbl_comic where category_id='".$category_id."' or category_id = '".$category_id_des."' ORDER BY id DESC limit 10"; // select data from db
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

    public function getLatestPromo(){
        $category_id = array("4");
        $category_id = serialize($category_id);

        $qry ="select * from tbl_post where category_id='".$category_id."' ORDER BY post_id DESC limit 1"; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getLatestEvent(){
        $category_id = array("5");
        $category_id = serialize($category_id);

        $qry ="select * from tbl_post where category_id='".$category_id."' ORDER BY post_id DESC limit 1"; // select data from db
        $arr = $this->db->query($qry)->result_array();
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
    
    public function getUserId($username){
        if(!empty($username)){
            $sql = "select * from tbl_reg where username ='".$username."'";
            $arr = $this->db->query($sql)->result_array();
            return $arr[0]['id'];
        }else {
            return false;
        }
    }
    public function submit_review(){
        $arr['page']    = 'submit_review';
        $title          = $_POST['title'];
        $description    = $_POST['description'];
        $username       = $_POST['username'];
        $user_id        = $this->getUserId($username);
        $comic_id       = $_POST['comic_id'];
        $rate           = $_POST['rate'];
        $date_add       = date('Y-m-d');
        $slug           = $_POST['slug'];

        if(isset($username) && !empty($username) ){
           $sql = "insert into tbl_comic_review values ('', '$comic_id', '$user_id', '$title', '$description', '$rate' , '$date_add')"; 
           $val = $this->db->query($sql);
           if(!empty($slug)){
                $arr['success'] = 'Your review has been accepted for moderation.';
                $this->session->set_flashdata('item', array('message' => 'Your review has been accepted for moderation','class' => 'alert alert-success')); 
                redirect('comics/comic_detail/'. $slug .'', $arr);
           } else {
                $arr['success'] = 'Your review has been accepted for moderation.';
                $this->session->set_flashdata('item', array('message' => 'Your review has been accepted for moderation','class' => 'alert alert-success')); 
                redirect('comics/comic_detail/'. $comic_id .'', $arr);
           }
           
        }
    }

    public function edit_profile($username){
        $user_id = $this->getUserId($username);
        $qry ='Select * from tbl_reg where id='.$user_id;
        $arr['profile'] = $this->db->query($qry)->result_array();
        $arr['sosmed'] = $this->getSosmed();
        $arr['new_arrival'] = $this->getNewArrival();
        $arr['best_seller'] = $this->getBestSeller();
        $arr['coming_soon'] = $this->getComingSoon();
        $arr['editor_choice'] = $this->getEditorChoice();
        $arr['latest_promo'] = $this->getLatestPromo();
        $arr['latest_event'] = $this->getLatestEvent();
        $arr['slider'] = $this->getSlider();
        $arr['publication_date'] = $this->getPublicationDate();
        $this->load->view('vwProfile',$arr);
    }

    public function update_profile(){
        $arr['page']    = 'submit_register';
        $first_name     = $_POST['first_name'];
        $birthday       = $_POST['birthday'];
        $email          = $_POST['email'];
        $gender         = $_POST['gender'];
        $no_telp        = $_POST['no_telp'];
        $sosmed         = $_POST['sosmed'];
        $url_sosmed     = $_POST['url_sosmed'];
        $comic_favorite    = $_POST['comic_favorite'];
        $hobbies    = $_POST['hobbies'];
        $username       = $_POST['username'];
        //$subscribe  = $_POST['subscribe'];

        if(isset($username) && !empty($username) ){
           $sql = "update tbl_reg set `nama`='".$first_name."', `birthday`='".$birthday."', `email`='".$email."', `gender`='".$gender."',
                  `no_tlp`='".$no_telp."', `sosmed`='".$sosmed."', `url_sosmed`='".$url_sosmed."', `comic_favorite`='".$comic_favorite."',
                  `hobbies`='".$hobbies."' where username='".$username."'"; 
           $val = $this->db->query($sql);

           $arr['success'] = 'Your profile has been updated.';
           $this->session->set_flashdata('profile', array('message' => 'Your profile has been updated.','class' => 'alert alert-success')); 
           redirect('home/edit_profile/'. $username .'', $arr);
        }
    }

    public function login(){
        $arr['sosmed'] = $this->getSosmed();
        $arr['new_arrival'] = $this->getNewArrival();
        $arr['best_seller'] = $this->getBestSeller();
        $arr['coming_soon'] = $this->getComingSoon();
        $arr['editor_choice'] = $this->getEditorChoice();
        $arr['latest_promo'] = $this->getLatestPromo();
        $arr['latest_event'] = $this->getLatestEvent();
        $arr['slider'] = $this->getSlider();
        $arr['publication_date'] = $this->getPublicationDate();
        $arr['error'] = "";
        $this->load->view('vwLogin', $arr);
    }
    public function do_login() {
        if ($this->session->userdata('is_admin_login')) {
            redirect('admin/home/dashboard');
        } 
        elseif ($this->session->userdata('is_client_login')) {
            redirect('home');
        }
        else {
            $user = $_POST['username'];
            $password = $_POST['password'];

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $arr['sosmed'] = $this->getSosmed();
                $arr['new_arrival'] = $this->getNewArrival();
                $arr['best_seller'] = $this->getBestSeller();
                $arr['coming_soon'] = $this->getComingSoon();
                $arr['editor_choice'] = $this->getEditorChoice();
                $arr['latest_promo'] = $this->getLatestPromo();
                $arr['latest_event'] = $this->getLatestEvent();
                $arr['slider'] = $this->getSlider();
                $arr['publication_date'] = $this->getPublicationDate();
                $arr['error'] = "Please fill username and password!";
                $this->load->view('vwLogin', $arr);
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
                    $enc_pass = md5($password);
                    $sql = "SELECT * FROM tbl_reg WHERE username = ? AND password = ?";
                    $val = $this->db->query($sql, array($user, $enc_pass));

                    if($val->num_rows){
                        if ($val->num_rows) {
                            foreach ($val->result_array() as $recs => $res) {
                                    $this->session->set_userdata(array(
                                        'id' => $res['id'],
                                        'username' => $res['username'],
                                        'email' => $res['email'],                            
                                        'is_client_login' => true
                                            )
                                    );
                                }
                                redirect('home');
                            } else {
                                $err['error'] = 'Username or Password incorrect';
                                $this->load->view('home', $err);
                            }
                    } else{
                        $arr['sosmed'] = $this->getSosmed();
                        $arr['new_arrival'] = $this->getNewArrival();
                        $arr['best_seller'] = $this->getBestSeller();
                        $arr['coming_soon'] = $this->getComingSoon();
                        $arr['editor_choice'] = $this->getEditorChoice();
                        $arr['latest_promo'] = $this->getLatestPromo();
                        $arr['latest_event'] = $this->getLatestEvent();
                        $arr['slider'] = $this->getSlider();
                        $arr['publication_date'] = $this->getPublicationDate();
                        $arr['error'] = "<strong>Access Denied</strong> Invalid Username/Password";
                        $this->load->view('vwLogin', $arr);
                    }
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
