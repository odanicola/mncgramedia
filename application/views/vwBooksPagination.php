<div class="rows margin-bottom-20 comic-list">
<ul class="liststyle-none our-clients2 coming-soon padding-nol margin-nol">
<?php
  $now	= strtotime(date('Y-m-d h:i:s'));
  if($novel):
  foreach ($novel as $value) {
  $novel_harga = "Rp ".number_format($value->price,2,',','.');
?>
<li class="client-item">
  <a href="<?php if(!empty($value->slug)){ echo base_url() . 'book/novel_detail/' . $value->slug; } else { echo  base_url() . 'book/novel_detail/' . $value->id;} ?>">
    <div class="featured-image-events">
    <img src="<?php
      if(!empty($value->image)){
        echo HTTP_IMAGE_UPLOADED_PATH . $value->image;
      } else{
        echo HTTP_IMAGES_PATH . 'default.png';
      } ?>" class="img-responsive" alt="" width="123">
    <div class="zoom"><i class="fa fa-search fa-lg"></i></div>
    </div>
    <h3 class="heading-comic2">
        <?php echo $value->title; ?>
    </h3>
    <?php
    $published_date = strtotime($value->published_date);
    if($published_date > $now){?>
      <p><?php echo 'Publish: ' . date('d F Y', $published_date );?></p>
    <?php } ?>
    <span><?php echo $novel_harga; ?></span>
  </a>
</li>
<?php } ?>
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
