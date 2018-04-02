<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller {

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
        //$this->load->library('form_validation');
    }

    public function index() {
        $arr['page'] = 'Register';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
    		$arr['middle_banner'] = $this->getMidBanner();
    		$arr['left_banner'] = $this->getLeftBanner();
    		$arr['right_banner'] = $this->getRightBanner();
    		$arr['logo_gramedia'] = $this->getLogoGramedia();
        $arr['content'] = '';
        $this->load->view('vwHeader',$arr);
        $this->load->view('vwRegister',$arr);
    }

    public function submit_register(){
        $arr['page'] = 'submit_register';

        $username    = $_POST['username'];
        $password    = md5($_POST['password']);
        $repassword    = md5($_POST['repassword']);
        $first_name    = $_POST['first_name'];
        $birthday    = $_POST['birthday'];
        $email    = $_POST['email'];
        $gender    = $_POST['gender'];
        $no_telp    = $_POST['no_telp'];
        $sosmed    = $_POST['sosmed'];
        $url_sosmed    = $_POST['url_sosmed'];
        $comic_favorite    = $_POST['comic_favorite'];
        $hobbies    = $_POST['hobbies'];
        $subscribe  = $_POST['subscribe'];

        $data = array();
        $data['status'] = 0;
        $data['msg']    = 'An error occured while saving the data, please try again later.';
        $data['first_name'] = $first_name;

        $qry = "SELECT id FROM tbl_comic WHERE title = '".$comic_favorite."'";
        $comicid = $this->db->query($qry)->result_array();
        $comic_id = $comicid[0]['id'];

        if(isset($username) && !empty($username) ){
           $sql = "insert into tbl_reg values ('', '$first_name', '', '$email', '', '$no_telp', '$comic_id', '',
                  '$password', '$birthday', '$gender', '$sosmed', '$url_sosmed', '$comic_favorite', '$hobbies', '$subscribe', '$username')";
           $val = $this->db->query($sql);

           $data['status'] = 1;
           $data['msg']    = 'Thank you for joining us, please check your email for credential login.';

           //redirect('register');
        }
        header("Content-Type: Application/JSON");
        echo json_encode($data);
        die();
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
