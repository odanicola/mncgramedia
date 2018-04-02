<?php
//$this->load->view('vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->
<div class="main bg-red-mnc">
  <div class="container">
    <div class="toppanel-header">
      <div class="col-md-4 no-padding">
        <p class="breadcum">Home / Register </p>
      </div>
      <div class="col-md-8 no-padding">
      </div>
    </div>
  </div>
</div>
<!-- BEGIN SLIDER -->
<div class="fullwidth " style="">
<div class="container sidepanel">
  <div class="col-md-4 panel-left" >
     <div class="col-md-12  margin-bottom-20">
      <h2 class="bg-head-bottom">
        Advertisement
      </h2>
      <span class="red-line"></span>
	  <ul class="list-style-none list-comic-date">
	  <?php
		  foreach ($left_banner['left_banner'] as $key => $value) { ?>
			<a href="<?php echo $value['url'] ?>" target="_blank">
				<img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $value['banner_image'];?>" style="width:100%;" alt="" width="300"
				class="left_banner">
			</a>
			<?php
		  }
	  ?>
	  </ul>
    </div>
  </div>
  <div class="col-md-8 panel-right paddingL20">
    <div class="rows">
      <div class="col-md-7 margin-bottom-20">
      <?php if(!empty($error)){?>
          <div class="alert alert-danger" role="alert" style="margin-top: 20px;"><?php echo $error;?></div>
      <?php } ?>
        <h2 class="header-left">Login</h2>
          <form method="post" action="<?php echo base_url(); ?>home/do_login" role="form">
          <div class="rows col-md-12 no-padding bottom-solid margin-bottom-20">
            <h2 class="head-date">Please enter your username and password below:</h2>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Username</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="input" class="form-control" name="username" placeholder="Type your username">
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Password</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="password" class="form-control" name="password" placeholder="Type your password">
              </div>
            </div>
          </div>
          <div class="rows col-md-12 no-padding bottom-solid margin-bottom-20">

          <div class="rows col-md-12 no-padding margin-bottom-10">
            <div class="rows col-md-12 no-padding">
              <input type="submit" class="btn red" value="Login" >
            </div>
          </div>
          </div>
          </form>

      	<div class="col-md-5 margin-top-20">
	        <!-- <div class="col-md-12 margin-bottom-20">
	          <img src="images/twitter.jpg" width="95%" alt="">
	        </div>
	        <div class="col-md-12 margin-bottom-20">
	          <img width="95%" src="assets/frontend/layout/img/baner-right.png" class="img-responsive" alt="">
	        </div> -->
      	</div>
    </div>

  </div>
</div>
</div>

<script>
function registerRespond(){
  alert('Terima Kasih, Untuk Melanjutkan pendaftaran mohon klik tautan email yang kami kirim ke email anda');
}
</script>
<?php
$this->load->view('vwFooter');
?>
