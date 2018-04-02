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
        <p class="breadcum">Home / <a href="#">News </a> / Promo / Promo Detail / <?php echo $promo_detail[0]['title']; ?></p>
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
      <div class="col-md-7 margin-bottom-20">
        <h2 class="header-left">Promo</h2>
        <h2 class="head-date"><?php echo $promo_detail[0]['title'];?></h2>
        <h3 class="head-subline-date">
          <?php
            if($promo_detail[0]['date_published'] != '0000-00-00 00:00:00'){
                echo date('d F Y', strtotime($promo_detail[0]['date_published']));
            }else{
                echo substr($promo_detail[0]['date_published'],0,10);
            }
          ?>
        </h3>
        <div class="col-md-12 no-padding margin-bottom-10">
          <div class="paragraph">
             <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $promo_detail[0]['image']; ?>" class="img-responsive width-full margin-bottom-20" alt="">
             <div class="col-md-12 marginTopBot-20 line-dashed">
             <?php
                 $fbslug = '';
                 $fburl  = '';
                 if(!empty($promo_detail[0]['slug'])){
                   $fbslug = $promo_detail[0]['slug'];
                   $fburl  = base_url() . 'promo/promo_detail/' . $fbslug;
                 }else{
                   $fbslug = $promo_detail[0]['id'];
                   $fburl  = base_url() . 'promo/promo_detail/' . $fbslug;
                 };
                 $titlefb=urlencode($promo_detail[0]['title']);
                 $urlfb=urlencode($fburl);
                 $summaryfb=urlencode($promo_detail[0]['content']);
                 $imagepath = '';
                 //if(!empty($image)){ $imagepath = HTTP_IMAGE_UPLOADED_PATH . $comic_detail[0]; } else { $imagepath =  HTTP_IMAGES_PATH . 'default.png';}
       		      if(!empty($promo_detail[0]['image'])){
       			         $imagepath = HTTP_IMAGE_UPLOADED_PATH . $promo_detail[0]['image'];
       		      }else{ $imagepath = HTTP_IMAGES_PATH . 'default.png'; }
                 $imagefb=urlencode($imagepath);
             ?>
             <ul class="list-unstyled footernav">
               <li style="float:left">Share On : </li>
               <li class="social-bottom2 fb-social2"><a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $titlefb;?>&amp;p[summary]=<?php echo $summaryfb;?>&amp;p[url]=<?php echo $urlfb; ?>&amp;p[images][0]=<?php echo $imagefb;?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)">Facebook</a></li>
               <li class="social-bottom2 twitter-social2"><a onClick="window.open('http://twitter.com/home?status=Currently reading <?php echo $urlfb; ?>','sharer','toolbar=0,status=0,width=548,height=325')" href="javascript: void(0)">Twitter</a></li>
             </ul>
            </div>
            <div class="col-md-12">
             <?php
              $content = $promo_detail[0]['content'];
              //$content = htmlspecialchars_decode($content);
              //$content = html_entity_decode($content);
              echo "$content";
            ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="col-md-12 margin-bottom-20">
          <h2 class="header-left">Other Promo</h2>
          <div class="col-md-12">
            <ul class="list-style-none list-comic-date">
			<?php
			//var_dump($other_promo); die();
			foreach($other_promo['other_promo'] as $key => $value){?>
				<li> <a href="<?php echo base_url() . 'promo/promo_detail/' . $value['slug']?>"><b><?php echo $value['title']; ?></b></a><br>
                  <?php
					$content = $value['content'];
					//$content = htmlspecialchars($content);
					//$content = html_entity_decode($content);
					$content = substr(strip_tags($content), 0, 50);
					echo "$content";
				  ?>
				</li>
			<?php } ?>
            </ul>
        </div>
        <div class="col-md-12  margin-bottom-20">
		  <h2 class="bg-head-bottom">
			Advertisement
		  </h2>
		  <span class="red-line"></span>
		  <ul class="list-style-none list-comic-date">
		  <?php
			  foreach ($right_banner['right_banner'] as $key => $value) { ?>
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
    </div>

  </div>
</div>
</div>
<?php
$this->load->view('vwFooter');
?>
