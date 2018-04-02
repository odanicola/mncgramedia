<?php
//$this->load->view('vwHeader');
?>
<!--
Load Page Specific CSS and JS here
Author : Abhishek R. Kaushik
Downloaded from http://devzone.co.in
-->
<div class="main bg-red-mnc">
  <div class="container">
    <div class="toppanel-header">
      <div class="col-md-4 no-padding">
        <p class="breadcum">Home / <a href="#">Promo </a></p>
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
  <div class="col-md-8 panel-right paddingL20" id="loading">
    <div class="rows">
      <div class="col-md-12">
        <div class="loader"></div>
        <h2 class="header-left">Promo</h2>
        <div id="comicList">
        <div class="rows margin-bottom-20 comic-list">
        <?php
        if($promo):
        foreach ($promo as $key => $value) { ?>
        <div class="col-md-12 no-padding margin-bottom-10">
          <div class="paragraph">
            <div class="featured-image-events">
            <a href="<?php echo base_url() . 'promo/promo_detail/' . $value->slug?>">
            <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $value->image; ?>" class="img-responsive width-full" alt="">
            </a>
            <div class="zoom"><i class="fa fa-search fa-lg"></i></div>
            </div>
            <a href="<?php echo base_url() . 'promo/promo_detail/' . $value->slug?>">
            <h2 class="head-date"><?php echo $value->title; ?></h2>
            </a>
            <h3 class="head-subline-date">
            <?php
            if($value->date_published != '0000-00-00 00:00:00'){
              echo date('d F Y', strtotime($value->date_published));
            }else{
              echo substr($value->date_published,0,10);
            }
            ?>
            </h3>
            <?php
                $content = $value->content;
                echo substr($content, 0, 450) . '...';
              ?>
          </div>
          <h3 class="read-more-bottom">
            <a href="<?php echo base_url() . 'promo/promo_detail/' . $value->slug?>" class="read-more-link"></a>
          </h3>
          <span class="red-line-thin"></span>
        </div>
        <?php } else: ?>
        <h2>Oops, we are sorry, there's no any available promo here.</h2>
  		  <?php endif; ?>
        <div class="rows margin-bottom-20">
	      <ul class="pagination">
          <!-- Show pagination links -->
          <?php
            $links = $this->ajax_pagination->create_links();
            $links = explode('&nbsp;',$links );
          ?>
          <?php foreach ($links as $link) {
              echo "<li>". $link."</li>";
          } ?>
        </ul>
        </div>
        </div>
      </div><!-- Comic List  -->
    </div>
  </div>
</div>
</div>
<?php
$this->load->view('vwFooter');
?>
