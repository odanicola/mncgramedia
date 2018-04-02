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
</div>
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
