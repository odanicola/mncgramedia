<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blank extends CI_Controller {

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
    }

    public function index() {
        $arr['page'] ='404 page';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
        $arr['logo_gramedia'] = $this->getLogoGramedia();
        $arr['left_banner'] = $this->getLeftBanner();
    		$arr['right_banner'] = $this->getRightBanner();
        $arr['content'] = '';
        $this->load->view('vwHeader', $arr);
        $this->load->view('vw404override',$arr);
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
