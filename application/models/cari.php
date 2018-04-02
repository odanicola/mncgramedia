<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cari extends CI_Model{
  function __construct() {
    parent::__construct();

  }

  function getRows($params = array()){
      $this->db->select('*');
      $this->db->from('tbl_comic');
      $keyword = $params['keyword'];

      if(array_key_exists("keyword",$params)){
        $this->db->like('title',$keyword);
        $this->db->or_like('author',$keyword);
      }
      $this->db->order_by('id', 'DESC');

      if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
          $this->db->limit($params['limit'],$params['start']);
      }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
          $this->db->limit($params['limit']);
      }

      $query = $this->db->get();

      return ($query->num_rows() > 0)?$query->result():FALSE;
  }
}
?>
