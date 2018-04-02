<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Csv_model extends CI_Model {

    function __construct() {
        parent::__construct();

    }

    function check_id($id){
      $query = $this->db->query('SELECT * FROM tbl_comic WHERE id = "'.$id.'"');
      //var_dump($query->num_rows());
      //die();
      if ($query->num_rows() > 0)
        {
           return true;
        }
      else
      {
          return false;
      }
    }

    function insert_data($data){
      $this->db->insert('tbl_comic', $data);
    }

    function update_comic($id,$data) {

      $this->db->where('id', $id);
      $this->db->update('tbl_comic', $data);

    }

    function update_novel($id,$data) {
      $this->db->where('id', $id);
      $this->db->update('tbl_novel', $data);
    }

    function update_merchandise($id,$data) {
      $this->db->where('merchandise_id', $id);
      $this->db->update('tbl_merchandise', $data);
    }
}
/*END OF FILE*/



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
