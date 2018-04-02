<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Postpromo extends CI_Model{

    function __construct() {

    }

    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbl_post');
        $this->db->order_by('post_id', 'DESC');

        if(!empty($params['category'])){
          $category  = $params['category'];
          $this->db->where('category_id',$category);
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
