<?php 
class Search extends CI_Model{
  function get_search($q){
    $this->db->select('*')
			->like("title","$q")
			->or_like("author", "$q");
    $query = $this->db->get('tbl_comic');
    if($query->num_rows > 0){
      foreach ($query->result_array() as $row){
        $row_set[] = htmlentities(stripslashes($row['tbl_comic'])); //build an array
      }
      echo json_encode($row_set); //format the array into json data
    }
  }
}
?>