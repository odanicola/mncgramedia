<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comic extends CI_Model{

    function __construct() {

    }

    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbl_comic');
        $this->db->order_by('id', 'DESC');

        if(!empty($params['country'])){
          $country  = $params['country'];
          $this->db->where('origin',$country);
        }

        if(!empty($params['genre'])){
          $genre    = $params['genre'];
          $this->db->like('tags',$genre);
        }

        if(!empty($params['category'])){
          $category = $params['category'];
          $this->db->like('tags',$category);
        }

        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }

        $query = $this->db->get();

        return ($query->num_rows() > 0)?$query->result():FALSE;
    }

    function getRowsEcomics($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbl_comic');
        $this->db->where('id_media_type','2');
        $this->db->order_by('id', 'DESC');

        if(!empty($params['country'])){
          $country  = $params['country'];
          $this->db->where('origin',$country);
        }

        if(!empty($params['genre'])){
          $genre    = $params['genre'];
          $this->db->like('tags',$genre);
        }

        if(!empty($params['category'])){
          $category = $params['category'];
          $this->db->like('tags',$category);
        }
        
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
