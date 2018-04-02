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
        <p class="breadcum">Home / <a href="#">News </a> / Event</p>
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
      <div class="col-md-12">
        <div class="loader"></div>
        <h2 class="header-left">Event</h2>
        <div id="comicList">
        <div class="rows margin-bottom-20 comic-list">
        <?php
        if($event):
        foreach ($event as $key => $value) { ?>
        <div class="col-md-12 no-padding margin-bottom-10">
          <div class="col-md-4">
          <div class="featured-image-events">
          <a href="<?php echo base_url() . 'event/event_detail/' . $value->slug;?>">
             <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $value->image; ?>" class="img-responsive" alt="">
          </a>
          <div class="zoom"><i class="fa fa-search fa-lg"></i></div>
          </div>
          </div>
          <div class="col-md-8 paragraph">
            <a href="<?php echo base_url() . 'event/event_detail/' . $value->slug; ?>">
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
            <p>
            <?php

              $content = $value->content;
              //$content = htmlspecialchars_decode($content);
              //$content = html_entity_decode($content);
              echo substr($content, 0, 450) . '...';
            ?>
            </p>
          </div>
          <h3 class="read-more-bottom">
            <a href="<?php echo base_url() . 'event/event_detail/' . $value->slug; ?>" class="read-more-link"></a>
          </h3>
          <span class="red-line-thin"></span>
        </div>
        <?php } else: ?>
        <h2>Oops, we are sorry, there's no any available event here.</h2>
  		  <?php endif; ?>

        </div><!-- Comic List  -->
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
      </div>
  </div>
</div>
</div>
<?php
$this->load->view('vwFooter');
?>
