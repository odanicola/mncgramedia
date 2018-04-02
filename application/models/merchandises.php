<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Merchandises extends CI_Model{

    function __construct() {

    }

    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbl_merchandise');
        $this->db->order_by('date_add', 'DESC');

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
