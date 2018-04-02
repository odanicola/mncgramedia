<div class="rows margin-bottom-20 comic-list">
<ul class="liststyle-none our-clients2 coming-soon padding-nol margin-nol">
<?php
  $now	= strtotime(date('Y-m-d h:i:s'));
  if($ecomics):
  foreach ($ecomics as $value) {
  $comic_harga = "Rp ".number_format($value->price,2,',','.');
?>
<li class="client-item">
  <a href="<?php if(!empty($value->slug)){ echo base_url() . 'comics/comic_detail/' . $value->slug; } else { echo  base_url() . 'comics/comic_detail/' . $value->id;} ?>">
    <div class="featured-image-events">
    <img src="<?php
      $default = false;
      if(!empty($value->image)):
        echo HTTP_IMAGE_UPLOADED_PATH . $value->image;
      else:
        $gambar = '';
        foreach($image as $key_image => $value_image):
          if($value->id == $value_image['comic_id'] && !empty($value_image['image_small'])){
            $gambar = HTTP_IMAGE_UPLOADED_PATH_DEFAULT_SMALL . $value_image['image_small'];
            $default = true;
            break;
          }
        endforeach;
        if($default){
          echo $gambar;
        }else{
          $gambar = HTTP_IMAGES_PATH . 'default.png';
          echo $gambar;
        }
      endif;
      ?>" class="img-responsive" alt="" width="123">
    <div class="zoom"><i class="fa fa-search fa-lg"></i></div>
    </div>
    <h3 class="heading-comic2">
        <?php echo $value->title ?>
    </h3>
      <?php
      $published_date = strtotime($value->published_date);
      if($published_date > $now){?>
        <p><?php echo 'Publish: ' . date('d F Y', strtotime($value['published_date']));?></p>
      <?php } ?>
    <span><?php echo $comic_harga; ?></span>
  </a>
</li>
<?php } else: ?>
<li><h2>Oops, we are sorry, there's no any available ecomics here.</h2></li>
<?php endif; ?>
<?php
  $links = $this->ajax_pagination->create_links();
  $links = explode('&nbsp;',$links );
?>
</ul>
</div>
<div class="rows margin-bottom-20">
  <ul class="pagination">
    <?php foreach ($links as $link) {
        echo "<li>". $link."</li>";
    } ?>
  </ul>
</div>
