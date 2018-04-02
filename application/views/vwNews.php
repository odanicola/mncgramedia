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
        <p class="breadcum">Home / <a href="#">Publication </a></p>
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
        <h2 class="bg-head-bottom">
            Publication Date
          </h2>
          <span class="red-line"></span>
          <?php if(!empty($publication_date[0]['title'])):?>
          <div class="padding-top-20">
            <a href="<?php echo base_url() . 'publication/publication_detail/' . $publication_date[0]['slug']?>">
              <h2 class="head-date"><?php echo $publication_date[0]['title']; ?></h2>
            </a>
            <h3 class="head-subline-date">
              <?php
                  if($publication_date[0]['date_published'] != '0000-00-00 00:00:00'){
                      echo date('d F Y', strtotime($publication_date[0]['date_published']));
                  }else{
                      echo substr($publication_date[0]['date_published'],0,10);
                  }
              ?>
            </h3>
            <p>
              <?php
                $content = $publication_date[0]['content'];
                //$content = htmlspecialchars_decode($content);
                $content = html_entity_decode($content);
				        echo substr($content, 0, 450) . '...';
                //echo "$content";
              ?>
            </p>
          </div>

          <h3 class="read-more-bottom">
            <a href="<?php echo base_url() . 'publication/publication_detail/' .$publication_date[0]['slug']?>" class="read-more-link"></a>
          </h3>
          <span class="red-line-thin"></span>
        <?php else: ?>
        <h2>Oops, we are sorry, there's no any available publication here.</h2>
        <?php endif; ?>
      </div>
    </div>
	  <div class="rows">
      <div class="col-md-12">
        <h2 class="bg-head-bottom">
            Lates Promo
          </h2>
          <span class="red-line"></span>
          <?php if(!empty($latest_promo[0]['title'])):?>
          <div class="padding-top-20 paragraph">
            <div class="featured-image">
            <a href="<?php echo base_url() . 'promo/promo_detail/' . $latest_promo[0]['slug']?>">
            <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $latest_promo[0]['image'] ?>" class="img-responsive width-full margin-bottom20" alt="">
            </a>
            <div class="zoom-post"><i class="fa fa-search fa-3x"></i></div>
            </div>
            <a href="<?php echo base_url() . 'promo/promo_detail/' . $latest_promo[0]['slug']?>">
              <h2 class="head-date"><?php echo $latest_promo[0]['title']; ?></h2>

            </a>
            <h3 class="head-subline-date">
              <?php
                  if($latest_promo[0]['date_published'] != '0000-00-00 00:00:00'){
                    echo date('d F Y', strtotime($latest_promo[0]['date_published']));
                  }else{
                    echo substr($latest_promo[0]['date_published'],0,10);
                  }
              ?>
            </h3>
              <?php
                $content = $latest_promo[0]['content'];
                //$content = htmlspecialchars_decode($content);
                //$content = html_entity_decode($content);
				        echo substr(strip_tags($content), 0, 450) . '...';
                //echo "$content";
              ?>
          </div>
          <h3 class="read-more-bottom">
            <a href="<?php echo base_url() . 'promo/promo_detail/' .$latest_promo[0]['slug']?>" class="read-more-link"></a>
          </h3>
          <span class="red-line-thin"></span>
        <?php else: ?>
        <h2>Oops, we are sorry, there's no any available promo here.</h2>
        <?php endif; ?>
      </div>
    </div>
	<div class="rows">
      <div class="col-md-12">
        <h2 class="bg-head-bottom">
            Lates Events
          </h2>
          <span class="red-line"></span>
          <?php if(!empty($latest_event[0]['title'])): ?>
            <div class="padding-top-20 paragraph">
            <div class="featured-image">
            <a href="<?php echo base_url() . 'event/event_detail/' . $latest_event[0]['slug']?>">
            <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $latest_event[0]['image'] ?>" class="img-responsive width-full margin-bottom20" alt="">
            </a>
            <div class="zoom-post"><i class="fa fa-search fa-3x"></i></div>
            </div>

            <a href="<?php echo base_url() . 'event/event_detail/' . $latest_event[0]['slug']?>">
              <h2 class="head-date"><?php echo $latest_event[0]['title'] ?></h2>
            </a>
            <h3 class="head-subline-date">
              <?php
                if($latest_event[0]['date_published'] != '0000-00-00 00:00:00'){
                    echo date('d F Y', strtotime($latest_event[0]['date_published']));
                }else{
                    echo substr($latest_event[0]['date_published'],0,10);
                }
              ?>
            </h3>
            <?php
                $content = $latest_event[0]['content'];
                //$content = htmlspecialchars_decode($content);
                //$content = html_entity_decode($content);
                echo substr(strip_tags($content), 0, 450) . '...';
            ?>

          </div>
          <h3 class="read-more-bottom">
            <a href="<?php echo base_url() . 'event/event_detail/' . $latest_event[0]['slug']?>" class="read-more-link"></a>
          </h3>
          <span class="red-line-thin"></span>
          <?php else: ?>
          <h2>Oops, we are sorry, there's no any available event here.</h2>
          <?php endif; ?>
      </div>
    </div>
</div>
</div>
<?php
$this->load->view('vwFooter');
?>
