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
        <p class="breadcum">Home / Event / Event Detail / <?php echo $event_detail[0]['title']; ?></p>
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
        <h2 class="header-left">Event</h2>
        <h2 class="head-date"><?php echo $event_detail[0]['title'];?></h2>
        <h3 class="head-subline-date">
        <?php
            if($event_detail[0]['date_published'] != '0000-00-00 00:00:00'){
                echo date('d F Y', strtotime($event_detail[0]['date_published']));
            }else{
                echo substr($event_detail[0]['date_published'],0,10);
            }
        ?>
        </h3>
        <div class="col-md-12 no-padding margin-bottom-10">
          <div class="paragraph">
             <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $event_detail[0]['image']; ?>" class="img-responsive width-full margin-bottom-20" alt="">
             <?php
              $content = $event_detail[0]['content'];
              //$content = htmlspecialchars_decode($content);
              //$content = html_entity_decode($content);
              echo "$content";
            ?>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="col-md-12 margin-bottom-20">
          <h2 class="header-left">Other Event</h2>
          <div class="col-md-12">
            <ul class="list-style-none list-comic-date">
              <?php
        				foreach($other_event['other_event'] as $key => $value){?>
        				<li> <a href="<?php echo base_url() . 'event/event_detail/' . $value['slug']?>"><b><?php echo $value['title']; ?></b></a><br>
                          <?php
        					$content = $value['content'];
        					//$content = htmlspecialchars_decode($content);
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
