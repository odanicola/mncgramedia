<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ExportImport extends CI_Controller {
/*
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
*/
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
        $this->load->model('csv_model');
        $this->load->library('csvimport');
    }

    public function index(){
      $arr['monthlist'] = $this->getMonthList();
      $this->load->view('admin/exportimport/vwExportImport', $arr);
    }

    public function format_uri( $string, $separator = '-' ){
        $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
        $special_cases = array( '&' => 'and', "'" => '');
        $string = mb_strtolower( trim( $string ), 'UTF-8' );
        $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
        $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
        $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
        $string = preg_replace("/[$separator]+/u", "$separator", $string);
        return $string;
    }


    public function comic(){
      $arr['monthlist'] = $this->getMonthList();
      $arr['comic_category'] = $this->getAllComicsCategory();
      $this->load->view('admin/exportimport/vwExportComic', $arr);
    }

    public function getAllComicsCategory(){
        $qry ='Select * from tbl_comic_category'; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function novel(){
      $arr['monthlist'] = $this->getMonthList();
      $arr['novel_category'] = $this->getAllNovelsCategory();
      $this->load->view('admin/exportimport/vwExportNovel', $arr);
    }

    public function getAllNovelsCategory(){
        $qry ='Select * from tbl_novel_category'; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function merchandise(){
      $arr['monthlist'] = $this->getMonthList();
      $arr['merchandise_category'] = $this->getAllMerchandisesCategory();
      $this->load->view('admin/exportimport/vwExportMerchandise', $arr);
    }

    public function getAllMerchandisesCategory(){
        $qry ='Select * from tbl_merchandise_category'; // select data from db
        $arr = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getMonthList(){
  		$arr = array(
  			'01' => 'January',
  			'02' => 'February',
  			'03' => 'March',
  			'04' => 'April',
  			'05' => 'May',
  			'06' => 'June',
  			'07' => 'July',
  			'08' => 'August',
  			'09' => 'September',
  			'10' => 'October',
  			'11' => 'November',
  			'12' => 'December'
  		);
  		return $arr;
  	}

    public function export_comic() {
       /*$begin_date       = $_POST['begin_date'];
       if(!empty($begin_date)):
       $begin_date       = explode('/',$begin_date);
          $tgl_begin_date       = $begin_date[1];
          $bulan_begin_date     = $begin_date[0];
          $tahun_begin_date     = $begin_date[2];
       $begin_date       = $tahun_begin_date."-".$bulan_begin_date."-".$tgl_begin_date;
       endif;

       $end_date       = $_POST['end_date'];
       if(!empty($end_date)):
       $end_date       = explode('/',$end_date);
          $tgl_end_date       = $end_date[1];
          $bulan_end_date     = $end_date[0];
          $tahun_end_date     = $end_date[2];
       $end_date       = $tahun_end_date."-".$bulan_end_date."-".$tgl_end_date;
       endif;

       $category    = $_POST['category'];*/
       $begin_price = $_POST['begin_price'];
       $end_price   = $_POST['end_price'];

       $this->load->dbutil();
       $this->load->helper('file');
       $this->load->helper('download');
       $delimiter = ",";
       $newline = "\r\n";

       $filename = date('Y-m-d h:i:s') . "_comics_" . ".csv";
       $query = "SELECT id, published_date, title, isbn, price FROM tbl_comic WHERE 1=1 ";
       /*if(!empty($_POST['begin_date']) && !empty($_POST['end_date'])){
          $query .= "AND published_date between '$begin_date' and '$end_date' ";
       }*/
       if(!empty($_POST['begin_price']) && !empty($_POST['end_price'])){
          $query .= "AND price between '$begin_price' and '$end_price' ";
       }
       /*if(!empty($_POST['category'])){
          $query .= "AND category_id like '%$category%' ";
       }*/
       //echo $query;
       //die();
       $result = $this->db->query($query);
       $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
       force_download($filename, $data);

    }

    public function export_novel() {
       $begin_date       = $_POST['begin_date'];
       if(!empty($begin_date)):
       $begin_date       = explode('/',$begin_date);
          $tgl_begin_date       = $begin_date[1];
          $bulan_begin_date     = $begin_date[0];
          $tahun_begin_date     = $begin_date[2];
       $begin_date       = $tahun_begin_date."-".$bulan_begin_date."-".$tgl_begin_date;
       endif;

       $end_date       = $_POST['end_date'];
       if(!empty($end_date)):
       $end_date       = explode('/',$end_date);
          $tgl_end_date       = $end_date[1];
          $bulan_end_date     = $end_date[0];
          $tahun_end_date     = $end_date[2];
       $end_date       = $tahun_end_date."-".$bulan_end_date."-".$tgl_end_date;
       endif;

       $category    = $_POST['category'];
       $begin_price = $_POST['begin_price'];
       $end_price   = $_POST['end_price'];

       $this->load->dbutil();
       $this->load->helper('file');
       $this->load->helper('download');
       $delimiter = ",";
       $newline = "\r\n";

       $filename = date('Y-m-d h:i:s') . "_novels_" . ".csv";
       $query = "SELECT id, published_date, title, isbn, price FROM tbl_novel WHERE 1=1 ";
       if(!empty($_POST['begin_date']) && !empty($_POST['end_date'])){
          $query .= "AND published_date between '$begin_date' and '$end_date' ";
       }
       if(!empty($_POST['begin_price']) && !empty($_POST['end_price'])){
          $query .= "AND price between '$begin_price' and '$end_price' ";
       }
       if(!empty($_POST['category'])){
          $query .= "AND category_id like '%$category%' ";
       }

       $result = $this->db->query($query);
       $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
       force_download($filename, $data);

    }

    public function export_merchandise() {
       $begin_date       = $_POST['begin_date'];
       if(!empty($begin_date)):
       $begin_date       = explode('/',$begin_date);
          $tgl_begin_date       = $begin_date[1];
          $bulan_begin_date     = $begin_date[0];
          $tahun_begin_date     = $begin_date[2];
       $begin_date       = $tahun_begin_date."-".$bulan_begin_date."-".$tgl_begin_date;
       endif;

       $end_date       = $_POST['end_date'];
       if(!empty($end_date)):
       $end_date       = explode('/',$end_date);
          $tgl_end_date       = $end_date[1];
          $bulan_end_date     = $end_date[0];
          $tahun_end_date     = $end_date[2];
       $end_date       = $tahun_end_date."-".$bulan_end_date."-".$tgl_end_date;
       endif;

       $category    = $_POST['category'];
       $begin_price = $_POST['begin_price'];
       $end_price   = $_POST['end_price'];

       $this->load->dbutil();
       $this->load->helper('file');
       $this->load->helper('download');
       $delimiter = ",";
       $newline = "\r\n";

       $filename = date('Y-m-d h:i:s') . "_merchandise_" . ".csv";
       $query = "SELECT merchandise_id, title, url, harga FROM tbl_merchandise WHERE 1=1 ";
       if(!empty($_POST['begin_date']) && !empty($_POST['end_date'])){
          $query .= "AND date_add between '$begin_date' and '$end_date' ";
       }
       if(!empty($_POST['begin_price']) && !empty($_POST['end_price'])){
          $query .= "AND harga between '$begin_price' and '$end_price' ";
       }
       if(!empty($_POST['category'])){
          $query .= "AND category_id like '%$category%' ";
       }
       //echo $query;
       //die();
       $result = $this->db->query($query);
       $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
       force_download($filename, $data);

    }

    public function import_comic_price(){
      $config['upload_path'] = './uploads/csv/';
      $config['allowed_types'] = '*';
      $config['max_size'] = '1000';

      $this->load->library('upload', $config);

      // If upload failed, display error
      if (!$this->upload->do_upload()) {
          $err = $this->upload->display_errors();
          $this->session->set_flashdata('exportcomic', array('message' => $err ,'class' => 'alert alert-danger'));
          redirect('admin/exportimport/comic/');
      } else {
          $file_data = $this->upload->data();
          $file_path =  './uploads/csv/'.$file_data['file_name'];
          //var_dump($this->csvimport->get_array($file_path));
          //die();

          if ($this->csvimport->get_array($file_path)) {
              $csv_array = $this->csvimport->get_array($file_path);

              foreach ($csv_array as $row) {
                  $insert_data = array(
                      //'id'=>$row['id'],
                      'published_date'=>$row['published_date'],
                      'title'=>$row['title'],
                      'price'=>$row['price'],
                  );
                  $this->csv_model->update_comic($row['id'], $insert_data);

              }

              /*$arr['flash'] = 'Comics were successfully updated.';
              $arr['status'] = '0';
              $arr['monthlist'] = $this->getMonthList();
              $arr['comic_category'] = $this->getAllComicsCategory();
              $this->load->view('admin/exportimport/vwExportComic', $arr);*/

              $this->session->set_flashdata('exportcomic', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
              redirect('admin/exportimport/comic/');

          } else {
              /*$arr['flash'] = 'An error occured while importing the data.';
              $arr['status'] = '1';
              $arr['monthlist'] = $this->getMonthList();
              $arr['comic_category'] = $this->getAllComicsCategory();
              $this->load->view('admin/exportimport/vwExportComic', $arr);*/
              $this->session->set_flashdata('exportcomic', array('message' => 'An error occured while importing the data.','class' => 'alert alert-success'));
              redirect('admin/exportimport/comic/');
          }

      }
    }

    public function import_comic(){
      $config['upload_path'] = './uploads/csv/';
      $config['allowed_types'] = '*';
      $config['max_size'] = '1000';

      $this->load->library('upload', $config);

      // If upload failed, display error
      if (!$this->upload->do_upload()) {
          $err = $this->upload->display_errors();
          $this->session->set_flashdata('exportcomic', array('message' => $err ,'class' => 'alert alert-danger'));
          redirect('admin/exportimport/comic/');

      } else {
          $file_data = $this->upload->data();
          $file_path =  './uploads/csv/'.$file_data['file_name'];
          //var_dump($this->csvimport->get_array($file_path));
          //die();

          if ($this->csvimport->get_array($file_path)) {
              $csv_array = $this->csvimport->get_array($file_path);

              foreach ($csv_array as $row) {
                  $image_preview = array(
                    $row['image_preview_1'],
                    $row['image_preview_2'],
                    $row['image_preview_3'],
                    $row['image_preview_4'],
                    $row['image_preview_5']
                  );
                  $preview = serialize($image_preview);
                  $slug = $this->format_uri( $row['title'], $separator = '-' );
                  $insert_data = array(
                      'id'=>$row['id'],
                      'category_id' => '',
                      'id_media_type' => $row['id_media_type'],
                      'date_add' => date('Y-m-d h:i:s'),
                      'published_date'=>$row['published_date'],
                      'title'=>$row['title'],
                      'url' => $row['url'],
                      'link_download' => $row['link_download'],
                      'link_full_version' => $row['link_full_version'],
                      'author' => $row['author'],
                      'isbn' => $row['isbn'],
                      'price'=> $row['price'],
                      'rate' => $row['rate'],
                      'jenis_rate' => $row['jenis_rate'],
                      'origin' => $row['origin'],
                      'size' => $row['size'],
                      'pages' => $row['page'],
                      'tags' => $row['tags'],
                      'summary' => $row['summary'],
                      'status' => $row['status'],
                      'image' => $row['image'],
                      'image_large' => $row['image_large'],
                      'image_gallery' => $preview,
                      'slug' => $slug,
                  );
                  //echo json_encode($insert_data);
                  //die();
                  if($this->csv_model->check_id($row['id'])){
                      $this->csv_model->update_comic($row['id'], $insert_data);
                  }else{
                      $this->csv_model->insert_data($insert_data);
                  }
              }

              $this->session->set_flashdata('exportcomic', array('message' => 'Data has been updated.','class' => 'alert alert-success'));
              redirect('admin/exportimport/comic/');

          } else {

              $this->session->set_flashdata('exportcomic', array('message' => 'An error occured while importing the data.','class' => 'alert alert-danger'));
              redirect('admin/exportimport/comic/');
          }

      }
    }

    public function import_novel(){
      $config['upload_path'] = './uploads/csv/';
      $config['allowed_types'] = '*';
      $config['max_size'] = '1000';

      $this->load->library('upload', $config);

      // If upload failed, display error
      if (!$this->upload->do_upload()) {
          $err = $this->upload->display_errors();
          $this->session->set_flashdata('exportnovel', array('message' => $err ,'class' => 'alert alert-danger'));
          redirect('admin/exportimport/novel/');
      } else {
          $file_data = $this->upload->data();
          $file_path =  './uploads/csv/'.$file_data['file_name'];

          if ($this->csvimport->get_array($file_path)) {
              $csv_array = $this->csvimport->get_array($file_path);

              foreach ($csv_array as $row) {
                  $insert_data = array(
                      //'id'=>$row['id'],
                      'published_date'=>$row['published_date'],
                      'title'=>$row['title'],
                      'price'=>$row['price'],
                  );
                  $this->csv_model->update_novel($row['id'], $insert_data);

              }

              $this->session->set_flashdata('exportnovel', array('message' => 'Data has been imported.' ,'class' => 'alert alert-success'));
              redirect('admin/exportimport/novel/');

          } else {
              $this->session->set_flashdata('exportnovel', array('message' => 'An error occured while importing the data.' ,'class' => 'alert alert-danger'));
              redirect('admin/exportimport/novel/');
          }

      }
    }

    public function import_merchandise(){
      $config['upload_path'] = './uploads/csv/';
      $config['allowed_types'] = '*';
      $config['max_size'] = '1000';

      $this->load->library('upload', $config);

      // If upload failed, display error
      if (!$this->upload->do_upload()) {
          $err = $this->upload->display_errors();
          $this->session->set_flashdata('exportmerchandise', array('message' => $err ,'class' => 'alert alert-danger'));
          redirect('admin/exportimport/merchandise/');
      } else {
          $file_data = $this->upload->data();
          $file_path =  './uploads/csv/'.$file_data['file_name'];

          if ($this->csvimport->get_array($file_path)) {
              $csv_array = $this->csvimport->get_array($file_path);

              foreach ($csv_array as $row) {
                  $insert_data = array(
                      //'id'=>$row['id'],
                      'date_add'=>$row['date_add'],
                      'title'=>$row['title'],
                      'harga'=>$row['harga'],
                  );
                  $this->csv_model->update_merchandise($row['merchandise_id'], $insert_data);

              }

              $this->session->set_flashdata('exportmerchandise', array('message' => 'Data has been imported.' ,'class' => 'alert alert-success'));
              redirect('admin/exportimport/merchandise/');

          } else {
            $this->session->set_flashdata('exportmerchandise', array('message' => 'An error occured while importing the data.' ,'class' => 'alert alert-danger'));
            redirect('admin/exportimport/merchandise/');
          }

      }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
