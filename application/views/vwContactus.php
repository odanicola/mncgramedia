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
      <p class="breadcum">Home / Contact </p>
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
      <br/><br/>
      <?php if(!empty($flash) && $status == '0'){ ?>
        <div class="alert alert-success" role="alert"><?php echo $flash; ?></div>
      <?php }
      else if(!empty($flash) && $status == '1'){?>
        <div class="alert alert-danger" role="alert"><?php echo $flash; ?></div>
      <?php } ?>

      <div class="col-md-7 margin-bottom-20">
        <h2 class="header-left">Contact Us</h2>
        <div class="rows col-md-12 no-padding bottom-solid margin-bottom-40">
            <h2 class="head-date">Plese register and give star to your favourite books</h2>
            <form method="post" action="<?php echo base_url(); ?>contactus/send" role="form" enctype="multipart/form-data">
              <div class="rows col-md-12 no-padding margin-bottom-10">
                <div class="rows col-md-2 no-padding">
                  <p class="inputLabel">Name</p>
                </div>
                <div class="rows col-md-10 no-padding">
                  <input type="input" class="form-control" name="contact_nama" required="required" placeholder="Type your name">
                </div>
              </div>
              <div class="rows col-md-12 no-padding margin-bottom-10">
                <div class="rows col-md-2 no-padding">
                  <p class="inputLabel">Email</p>
                </div>
                <div class="rows col-md-10 no-padding">
                  <input type="email" class="form-control" name="contact_email" required="required" placeholder="Type your email">
                </div>
              </div>
              <div class="rows col-md-12 no-padding margin-bottom-10">
                <div class="rows col-md-2 no-padding">
                  <p class="inputLabel">Message</p>
                </div>
                <div class="rows col-md-10 no-padding">
                  <textarea rows=15 class="form-control" name="contact_message" required="required" placeholder="Type your message"></textarea>
                </div>
              </div>
              <div class="rows col-md-12 no-padding margin-bottom-30">
                <div class="rows col-md-2 no-padding"></div>
                <div class="rows col-md-10 no-padding">
                  <input type="submit" class="btn red" value="Submit">
                </div>
              </div>
            </form>
        </div>
        <div class="rows col-md-12 no-padding margin-bottom-10">
            <h2 class="head-date red">Not M&C Member</h2>
            <h2 class="head-date margin-bottom-30">Plese register and get all update or promo from M&C Comic</h2>
            <h2 class="head-date red">Plese click Register button below for member registration. Thank You.</h2>
            <a href="<?php echo base_url()?>register"><button type="button" class="btn red">Register</button></a>
        </div>
      </div>
    </div>

  </div>
</div>
</div>
<?php
$this->load->view('vwFooter');
?>
