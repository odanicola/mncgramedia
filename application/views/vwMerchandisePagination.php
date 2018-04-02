<div class="col-md-12 comic-list">
  <ul class="merchand">
  <?php
      if($merchandise):
      foreach ($merchandise as $value) {
      $merchandise_harga = "Rp ".number_format($value->harga,2,',','.');
    ?>
    <li class="merchand-item">
      <a href="<?php echo base_url() . 'merchandise/merchandise_detail/' . $value->slug; ?>">
      <div class="merchand-top">
        <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $value->image;?>" class="img-responsive" alt="">
        <p class="text15 red "><?php $value->title ?></p>
        <p class="text14 "> <?php echo $merchandise_harga ?> </p>
        <p>ID <?php  echo $value->merchandise_id?></p>
      </div>
      </a>
      <div class="merchand-bottom">
        <a href="<?php echo base_url() . 'merchandise/merchandise_detail/' . $value->slug; ?>">
          <div class="merchand-bottom-left">Detail
            <span><img style="width:8px;" src="<?php echo HTTP_IMAGES_PATH; ?>right_arrows.png"/ ></span>
          </div>
        </a>
        <a href="javascript:;">
          <div class="merchand-bottom-right"></div>
        </a>
      </div>
    </li>
    <?php }else: ?>
    <li><h2>Oops, we are sorry, there's no any available merchandise here.</h2></li>
    <?php endif; ?>
  </ul>
</div>
<div class="rows margin-bottom-20">
  <?php
    $links = $this->ajax_pagination->create_links();
    $links = explode('&nbsp;',$links );
  ?>
  <ul class="pagination">
    <?php foreach ($links as $link) {
        echo "<li>". $link."</li>";
    } ?>
  </ul>
</div>