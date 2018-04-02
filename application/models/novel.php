<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Novel extends CI_Model{

    function __construct() {

    }

    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbl_novel');
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

    function getRowsJnovel($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbl_novel');
        $category_id = $params['category'];

        if(array_key_exists("category",$params)){
          $this->db->where('category_id',$category_id);
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

    function getRowsKnovel($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbl_novel');
        $category_id = $params['category'];

        if(array_key_exists("category",$params)){
          $this->db->where('category_id',$category_id);
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

    function getRowsInovel($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbl_novel');
        $category_id = $params['category'];

        if(array_key_exists("category",$params)){
          $this->db->where('category_id',$category_id);
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

    function getRowsCbook($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbl_novel');
        $category_id = $params['category'];

        if(array_key_exists("category",$params)){
          $this->db->where('category_id',$category_id);
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
