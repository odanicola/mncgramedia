<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="abhishek@devzone.co.in">

     <title>MNC Panel Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="shortcut icon" href="<?php echo HTTP_IMAGES_PATH; ?>panel-icon.png">
    <!-- Add custom CSS here -->
    <link href="<?php echo HTTP_CSS_PATH; ?>arkadmin.css" rel="stylesheet">
      <!-- JavaScript -->
    <script src="<?php echo HTTP_JS_PATH; ?>jquery-1.10.2.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>bootstrap.js"></script>

    <script src="<?php echo HTTP_JS_PATH; ?>das.js"></script>
    <script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
    <!--

    Author : Oda Aditiya Nicola
    Downloaded from http://odanicola.com
    -->

  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>admin"><img src="<?php echo HTTP_IMAGES_PATH; ?>panel-icon.png"> MNC Admin Panel v1</a>
        </div>
 <?php
// Define a default Page
  $pg = isset($page) && $page != '' ?  $page :'dash'  ;
?>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Hi,<?php echo $this->session->userdata('username') ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <!-- <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li> -->
                <li><a href="<?php echo base_url(); ?>" target="_blank"><i class="fa fa-home"></i> Visit Site</a></li>
				        <li><a href="<?php echo base_url(); ?>admin/home/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
          <div id="MainMenu" class="nav navbar-nav side-nav">
          <div class="list-group panel">
            <a href="#post" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">Post <i class="fa fa-caret-down" style="float:right;"></i> </a>
            <div class="collapse" id="post">
              <a href="<?php echo base_url(); ?>admin/post" class="list-group-item" >All Posts</a>
              <a href="<?php echo base_url(); ?>admin/post/add_new" class="list-group-item"  >Add New</a>
              <a href="<?php echo base_url(); ?>admin/category_post" class="list-group-item" >Category Post</a>
            </div>
            <a href="#comic" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">Comic <i class="fa fa-caret-down" style="float:right;"></i> </a>
            <div class="collapse" id="comic">
              <a href="<?php echo base_url(); ?>admin/comic" class="list-group-item" >All Comics</a>
              <a href="<?php echo base_url(); ?>admin/comic/add_new" class="list-group-item"  >Add New</a>
              <!-- <a href="<?php //echo base_url(); ?>admin/category_comic" class="list-group-item" >Category Comic</a> -->
      			  <a href="<?php echo base_url(); ?>admin/country_comic" class="list-group-item" >Origin Comic</a>
              <a href="<?php echo base_url(); ?>admin/comic/bestseller" class="list-group-item" >Best Sellers</a>
              <a href="<?php echo base_url(); ?>admin/comic/editorchoice" class="list-group-item" >Editor Choice</a>
            </div>
      			<a href="#novel" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">Novel <i class="fa fa-caret-down" style="float:right;"></i> </a>
      			<div class="collapse" id="novel">
              <a href="<?php echo base_url(); ?>admin/novel" class="list-group-item" >All Novels</a>
              <a href="<?php echo base_url(); ?>admin/novel/add_new" class="list-group-item"  >Add New</a>
              <a href="<?php echo base_url(); ?>admin/category_novel" class="list-group-item" >Category Novel</a>
			        <a href="<?php echo base_url(); ?>admin/country_novel" class="list-group-item" >Origin Novel</a>
              <a href="<?php echo base_url(); ?>admin/novel/bestseller" class="list-group-item" >Best Sellers</a>
              <a href="<?php echo base_url(); ?>admin/novel/editorchoice" class="list-group-item" >Editor Choice</a>
            </div>
            <a href="#merchandise" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">Merchandise <i class="fa fa-caret-down" style="float:right;"></i> </a>
            <div class="collapse" id="merchandise">
              <a href="<?php echo base_url(); ?>admin/merchandise" class="list-group-item" >All Merchandises</a>
              <a href="<?php echo base_url(); ?>admin/merchandise/add_new" class="list-group-item"  >Add New</a>
              <a href="<?php echo base_url(); ?>admin/category_merchandise" class="list-group-item" >Category Merchandise</a>
            </div>
            <a href="#users" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">Users <i class="fa fa-caret-down" style="float:right;"></i>  </a>
            <div class="collapse" id="users">
              <a href="<?php echo base_url(); ?>admin/users" class="list-group-item" >Administrator</a>
              <a href="<?php echo base_url(); ?>admin/reg_users" class="list-group-item" >Registered Users </a>
            </div>
            <a href="<?php echo base_url(); ?>admin/reviews" class="list-group-item list-group-item-success" >User Reviews </a>
            <a href="<?php echo base_url(); ?>admin/contactus" class="list-group-item list-group-item-success" >Contact Data </a>
            <a href="#control_panel" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">Control Panel <i class="fa fa-caret-down" style="float:right;"></i> </a>
            <div class="collapse" id="control_panel">
                 <a href="<?php echo base_url(); ?>admin/control_panel/logo" class="list-group-item" >Logo</a>
			           <a href="<?php echo base_url(); ?>admin/control_panel/logo_gramedia" class="list-group-item" >Logo Gramedia</a>
                 <a href="<?php echo base_url(); ?>admin/control_panel/slider" class="list-group-item" >Slider</a>
                 <a href="<?php echo base_url(); ?>admin/sosmed" class="list-group-item" >Sosmed </a>
                 <a href="<?php echo base_url(); ?>admin/control_panel/youtube" class="list-group-item" >Youtube Widget </a>
                 <a href="<?php echo base_url(); ?>admin/control_panel/twitter" class="list-group-item" >Twitter Widget</a>
			           <a href="<?php echo base_url(); ?>admin/control_panel/banner" class="list-group-item" >Banner</a>
            </div>
            <a href="#export_import" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">Export / Import<i class="fa fa-caret-down" style="float:right;"></i> </a>
            <div class="collapse" id="export_import">
                <a href="<?php echo base_url(); ?>admin/exportimport/comic" class="list-group-item" >Comic</a>
                <a href="<?php echo base_url(); ?>admin/exportimport/novel" class="list-group-item" >Novel</a>
                <a href="<?php echo base_url(); ?>admin/exportimport/merchandise" class="list-group-item" >Merchandise</a>
            </a>
        </div><!-- /.navbar-collapse -->
      </nav>
