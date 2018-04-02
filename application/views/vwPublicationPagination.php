<div class="rows margin-bottom-20 comic-list">
<?php
if($publication):
foreach ($publication as $key => $value): ?>
<div class="col-md-12 no-padding margin-bottom-10 ">
  <div class="paragraph col-md-12">
      <a href="<?php echo base_url() . 'publication/publication_detail/' . $value->slug?>">
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
        //echo substr($content, 0, 450) . '...';
        print_r(substr(strip_tags($content), 0, 450) . '...');
      ?>

  </div>
  <h3 class="read-more-bottom">
    <a href="<?php echo base_url() . 'publication/publication_detail/' . $value->slug?>" class="read-more-link"></a>
  </h3>
  <span class="red-line-thin"></span>
</div><!-- col 12 -->
<?php endforeach; ?>
<?php else: ?>
  <p><h2>Oops, we are sorry, there's no any available promo here.</h2></p>
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
