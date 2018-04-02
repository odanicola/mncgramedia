<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo HTTP_IMAGES_PATH; ?>panel-icon.png">
    <title><?php echo $page; ?> | M&C </title>

    <meta name="Description" content="<?php echo strip_tags($content); ?>" />
    <meta name="language" content="Indonesia, English" />
    <meta name="organization" content="Publisher Group of Kompas Gramedia" />
    <meta name="copyright" content="" />
    <meta name="audience" content="" />
    <meta name="classification" content="Indonesia, English, Company Profile, Company Spirit" />
    <meta name="rating" content="general" />
    <meta name="page-topic" content="" />
    <meta name="robots" content="index,follow" />
    <meta name="revisit-after" content="7 days" />

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
    <link href="<?php echo HTTP_CSS_PATH; ?>prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo HTTP_CSS_PATH; ?>jquery.fancybox.css" rel="stylesheet">
    <link href="<?php echo HTTP_CSS_PATH; ?>owl.carousel.css" rel="stylesheet">
    <link href="<?php echo HTTP_CSS_PATH; ?>settings.css" rel="stylesheet">
    <link href="<?php echo HTTP_CSS_PATH; ?>components.css" rel="stylesheet">
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="<?php echo HTTP_CSS_PATH; ?>style.css" rel="stylesheet">
    <link href="<?php echo HTTP_CSS_PATH; ?>style-responsive.css" rel="stylesheet">
    <link href="<?php echo HTTP_CSS_PATH; ?>custom.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php //echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php //echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
	<script src="<?php echo HTTP_JS_PATH; ?>das.js"></script>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

  <script src="<?php echo HTTP_JS_PATH; ?>script.js"></script>
  <script type="text/javascript" charset="utf-8">
      $(document).ready(function(){
          $("a[rel^='prettyPhoto']").prettyPhoto();
      });
  </script>
	<!-- Analytics Code -->
  <script>
    (function(I,s,o,g,r,a,m){I['GoogleAnalyticsObject']=r;I[r]=I[r]||function(){
    (i[r].q=I[r].q||[]).push(arguments)},I[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.Google-analytics.com/analytics.js','Ga');

    ga('create', 'UA-44324378-1', 'auto');
    ga('send', 'pageview');
  </script>

  </head>
<body>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <?php
    $pg = isset($page) && $page != '' ?  $page :'home'  ;
    ?>

    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
          <!-- BEGIN TOP BAR MENU -->
          <?php if ($this->session->userdata('is_client_login') ){ ?>
              <div class="col-md-12 col-sm-12 additional-nav ">
              <ul class="nav navbar-nav navbar-right navbar-user">
                  <li class="dropdown user-dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                          <i class="fa fa-user"></i>Hi, <?php echo $this->session->userdata('username');?><b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                          <li><a href="<?php echo base_url()?>home/edit_profile/<?php echo $this->session->userdata('username');?>">My Area</a></li>
                          <li><a href="<?php echo base_url(); ?>home/logout">Logout</a></li>
                      </ul>
                  </li>
              </ul>
              </div>
            <?php } elseif($this->session->userdata('is_admin_login')){?>
              <div class="col-md-12 col-sm-12 additional-nav ">
              <ul class="nav navbar-nav navbar-right navbar-user">
                  <li class="dropdown user-dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                          <i class="fa fa-user"></i>Hi, <?php echo $this->session->userdata('username');?><b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                          <li><a href="<?php echo base_url()?>admin/home">My Admin Area</a></li>
                          <li><a href="<?php echo base_url(); ?>home/logout">Logout</a></li>
                      </ul>
                  </li>
              </ul>
              </div>
            <?php }else{ ?>
            <div class="col-md-12 col-sm-12 additional-nav ">
              <ul class="list-unstyled list-inline pull-right">
                  <li><a href="<?php echo base_url()?>register">Register</a></li>
                  <li><a href="javascript:;" id="loginButton" >Log In</a></li>
              </ul>
            <div class="login-box">
            <form action="<?php echo base_url()?>home/do_login" method="post">
              <div class="col-md-12">
                <p class="text15">Username</p>
                <input type="input" class="form-control" placeholder="Username" name="username">
              </div>
              <div class="col-md-12">
                <p class="text15">Password</p>
                <input type="password" class="form-control" placeholder="Password" name="password">
              </div>
              <div class="col-md-12 margin-top-10">
                <input type="submit" class="btn red" value="Login">
              </div>
            </form>
            </div>
          </div>
          <?php } ?>
          <!-- END TOP BAR MENU -->
        </div>
    </div>
    <!-- END TOP BAR -->
    <!-- BEGIN HEADER -->
    <div class="header">
    <div class="container">
      <div class="col-md-2 no-padding">
        <a class="site-logo" href="<?php echo base_url();?>"><img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $logo['logo'][0]['logo_image']; ?>" alt="Comic MNC"></a>
        <!--<a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a> -->
      <!-- BEGIN NAVIGATION -->
      </div>
      <div class="col-md-8">
        <div class="header-navigation pull-right font-transform-inherit" id="cssmenu">
          <ul id="menuUl">
          <li id="index" ><a href="<?php echo base_url();?>">Home</a></li>
          <li id="comic" ><a href="<?php echo base_url(); ?>comics" >Comics</a></li>
          <li id="e-comic" ><a href="<?php echo base_url(); ?>ecomics">e-Comics</a></li>
          <li id="book" class="dropdown" ><a href="<?php echo base_url(); ?>book">Books</a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url(); ?>jnovel">J-Novel</a></li>
              <li><a href="<?php echo base_url(); ?>knovel">K-Novel</a></li>
              <li><a href="<?php echo base_url(); ?>indonesiannovel">Indonesian-Novel</a></li>
              <li><a href="<?php echo base_url(); ?>childrenbooks">Children Books</a></li>
            </ul>
          </li>
          <li id="merchandise" ><a href="<?php echo base_url(); ?>merchandise">Merchandise</a></li>
          <li id="news" class="dropdown"><a href="<?php echo base_url(); ?>news">News</a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url(); ?>publication">Publication</a></li>
              <li><a href="<?php echo base_url(); ?>promo">Promo</a></li>
              <li><a href="<?php echo base_url(); ?>event">Event</a></li>
            </ul>
          </li>
          <li id="contact"><a href="<?php echo base_url(); ?>contactus">Contact Us</a></li>
          <li><a href="javascript:;" class="fa fa-search  search-btn"></a>
            <div class="search-box" >
                 <form method="get" action="<?php echo base_url(); ?>search" role="form" >
                   <input type="input" class="form-control" placeholder="Search Title or Author"  name="q" id="search">
                 </form>
            </div>
          </li>
          <!-- END TOP SEARCH -->
          </ul>
        </div>

      </div>
      <div class="col-md-2">
      <div class="header-navigation pull-right font-transform-inherit" >
        <ul>

          <!-- BEGIN TOP SEARCH -->
          <?php foreach ($sosmed as $key => $value) {?>
                <?php $sosmed = $value;?>
                <?php foreach ($sosmed as $key => $value) {?>

                  <?php if(!empty($value['url'])):?>
                      <li><a href="<?php echo $value['url']; ?>" target="_blank" class="fa
                      <?php if($value['sosmed'] == 'Facebook')echo 'fa-facebook-square fa-lg';
                      else if($value['sosmed'] == 'Twitter') echo 'fa-twitter-square fa-lg';
                      else if($value['sosmed'] == 'Instagram') echo 'fa-instagram fa-lg';
                      else if($value['sosmed'] == 'Tumblr') echo 'fa-tumblr-square fa-lg';
                      else if($value['sosmed'] == 'Youtube') echo 'fa-youtube-square fa-lg';
                      ?>"></a></li>
                  <?php endif; ?>
          <?php }
          } ?>

        </ul>
      </div>
    </div>
      <!-- END NAVIGATION -->
    </div>
    </div>
    <!-- Header END -->
