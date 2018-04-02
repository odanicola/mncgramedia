<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Check extends CI_Controller {

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

  	}

    public function username($username){
      $status = 0;
      $qry ="select * from tbl_reg where username = '".$username."'"; // select data from db
      $arr = $this->db->query($qry);

      if($arr->num_rows() > 0){
        $status = 1;
      }else{
        $status = 0;
      }
      echo json_encode($status);
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
