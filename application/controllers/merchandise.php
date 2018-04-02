<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Merchandise extends CI_Controller {

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
        $this->load->model('merchandises');
        $this->load->library('Ajax_pagination');
        $this->perPage = 16;
    }

    public function index() {
        $arr['page'] ='merchandise';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
		    $arr['logo_gramedia'] = $this->getLogoGramedia();
        //$arr['merchandise'] = $this->getMerchandise();

        $totalRec = count($this->merchandises->getRows());

        $config = array();
        //pagination configuration

        $config['div']         = 'comicList'; //parent div tag id
        $config["base_url"]    = base_url().'merchandise/ajaxPaginationData/';
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
        $arr['merchandise'] = $this->merchandises->getRows(array('limit'=>$this->perPage));

        $arr['content'] = '';
        $this->load->view('vwHeader', $arr);
        $this->load->view('vwMerchandise',$arr);
    }

    function ajaxPaginationData(){
        $arr['page'] ='All Merchandise';

        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $totalRec = count($this->merchandises->getRows());
        //pagination configuration

        $config['div']         = 'comicList'; //parent div tag id
        $config['base_url']    = base_url().'merchandise/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->ajax_pagination->initialize($config);

        //get the posts data
        $arr['merchandise'] = $this->merchandises->getRows(array('start'=>$page,'limit'=>$this->perPage));

        //load the view
        $this->load->view('vwMerchandisePagination', $arr, false);
    }

	  public function getLogoGramedia(){
        $qry ='select * from tbl_logo where id = 2'; // select data from db
        $arr['logo_gramedia'] = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function record_count() {
        $qry = "select count(merchandise_id) from tbl_merchandise"; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return (int) $arr[0]['count(merchandise_id)'];
    }

    public function fetch_merchandise($limit, $start) {
        $this->db->limit($limit, $start);
                 $this->db
                      ->select("*");
        $query = $this->db->get("tbl_merchandise");

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

    public function getMerchandise(){
        $qry ="select * from tbl_merchandise ORDER BY merchandise_id DESC"; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function merchandise_detail($slug){
        $arr['page'] ='single_merchandise';
        $qry = "select * from tbl_merchandise where slug = '". $slug . "'";

        $d = $this->db->query($qry)->result_array();
        if(!empty($d)){
          $arr['merchandise_detail'] = $this->db->query($qry)->result_array();
        }else{
          redirect('page404');
        }

        $qry_all ='Select * from tbl_merchandise'; // select data from db
        $arr['merchandise'] = $this->db->query($qry)->result_array();
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
        $arr['page'] = $arr['merchandise_detail'][0]['title'];
        $arr['content'] = substr($arr['merchandise_detail'][0]['summary'], 0, 450);
        $this->load->view('vwHeader', $arr);

		    $arr['logo_gramedia'] = $this->getLogoGramedia();
        $this->load->view('vwMerchandiseDetail',$arr);
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
