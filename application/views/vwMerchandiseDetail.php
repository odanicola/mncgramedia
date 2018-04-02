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
        <p class="breadcum">Home / <a href="#">Merchandise </a> / Merchandise Detail / <?php echo $merchandise_detail[0]['title']; ?></p>
      </div>
      <div class="col-md-8 no-padding">
      </div>
    </div>
  </div>
</div>
<!-- BEGIN SLIDER -->
<div class="fullwidth " style="">
<div class="container">
  <div class="col-md-12">
    <h2 class="header-left">Merchandise Detail</h2>
    <div class="col-md-12 border-top-bottom-black padding20 margin-bottom-20">
      <div class="col-md-3 no-padding">
        <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $merchandise_detail[0]['image']; ?>" class="img-responsive img-article" alt="">
      </div>
      <div class="col-md-9 no-padding">
        <h2 class="red"><?php echo $merchandise_detail[0]['title']; ?></h2>
        <?php $merchandise_harga = "Rp ".number_format($merchandise_detail[0]['harga'],2,',','.');?>
        <h2 ><?php echo $merchandise_harga ?></h2>
        <p><?php echo $merchandise_detail[0]['merchandise_id']; ?></p>
        <h2 class="red">Description</h2>
        <?php
          $content = $merchandise_detail[0]['summary'];
          $content = htmlspecialchars_decode($content);
          $content = html_entity_decode($content);
          echo "$content";
        ?>
      </div>
    </div>
    <div class="col-md-12 margin-bottom-10">
      <h2 class="red margin-nol margin-bottom-5">Avaible on these Online Store</h2>
      <div class="col-md-2 list-preview">
        <img src="<?php echo HTTP_IMAGES_PATH; ?>logo_gramedia-online.png" class="img-responsive " alt="">
      </div>
      <div class="col-md-2 list-preview">
        <img src="<?php echo HTTP_IMAGES_PATH; ?>logo_lazada.png" class="img-responsive " alt="">
      </div>
      <div class="col-md-2 list-preview">
        <img src="<?php echo HTTP_IMAGES_PATH; ?>logo_olx.png" class="img-responsive " alt="">
      </div>
      <div class="col-md-2 list-preview">
        <img src="<?php echo HTTP_IMAGES_PATH; ?>logo_online-store-big.png" class="img-responsive " alt="">
      </div>
      <div class="col-md-2 list-preview">
        <img src="<?php echo HTTP_IMAGES_PATH; ?>logo_online-store-big.png" class="img-responsive " alt="">
      </div>
      <div class="col-md-2 list-preview">
        <img src="<?php echo HTTP_IMAGES_PATH; ?>logo_online-store-big.png" class="img-responsive " alt="">
      </div>
    </div>
    <div class="col-md-12 no-padding">
      <div class="red-line-bottom margin-nol padding-nol width100"></div>
    </div>
    <div class="col-md-12 padding-top-20 ">
      <h2 class="header-left ">Other Merchandise</h2>
      <ul class="merchand">
        <?php foreach ($merchandise as $key => $value) { ?>
        <?php $merchandise_harga = "Rp ".number_format($value['harga'],2,',','.');?>
        <li class="merchand-item">
          <div class="merchand-top">
            <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $value['image']; ?>" class="img-responsive" alt="">
            <p class="text15 red "><?php $value['title'];?></p>
            <p class="text14 "> <?php echo $merchandise_harga; ?> </p>
            <p><?php echo $value['harga'];?></p>
          </div>
          <div class="merchand-bottom">
            <a href="<?php echo base_url() . 'merchandise/merchandise_detail/' . $value['slug']; ?>">
              <div class="merchand-bottom-left">Detail
              <span><img style="width:8px;" src="<?php echo HTTP_IMAGES_PATH; ?>right_arrows.png"/ ></span>
              </div>
            </a>
            <a href="javascript:;">
              <div class="merchand-bottom-right"></div>
            </a>
          </div>
        </li>
        <?php } ?>
      </ul>
    </div>
    <div class="col-md-12 margin-bottom-20 width95">
      <h3 class="read-more-bottom">
        <a href="<?php echo base_url()?>merchandise/" class="read-more-link"></a>
      </h3>
      <span class="red-line-thin"></span>
    </div>
  </div>
</div>
</div>
<?php
$this->load->view('vwFooter');
?>
