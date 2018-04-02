<?php
//$this->load->view('vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->
<!-- BEGIN SLIDER -->
<div class="fullwidth " style="">
<div class="carousel slide" data-ride="carousel" id="testimonials-block">

<?php
    function isSerialized($str) {
        return ($str == serialize(false) || @unserialize($str) !== false);
    }

    $default = false;
?>
  <ul>
  <?php foreach ($slider['slider'] as $key => $value) {?>
    <!-- SLIDE  -->
    <li data-transition="fade" data-slotamount="7" data-masterspeed="1000" >
      <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $value['slider_image']; ?>"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
    </li>
  <?php } ?>
  </ul>
</div>
</div>
<!-- END SLIDER -->
<div class="main bg-red-mnc">
  <div class="container">
    <!-- BEGIN CLIENTS -->
      <div class="margin-top-bottom-40 our-clients">
        <div class="col-md-1 no-padding"></div>
        <div class="col-md-10 no-padding">
          <div class="panel-top">
            <img src="<?php echo HTTP_IMAGES_PATH; ?>ribbon-new-release.png" class="" alt="">
          </div>
          <ul class="liststyle-none owl-carousel owlPlay best-seller">
          <?php foreach ($new_arrival as $key => $value) {?>
          <?php $comic_price = "Rp ".number_format($value['price'],0,',','.'); ?>
            <li class="client-item">
              <a href="<?php if(!empty($value['slug'])){ echo base_url() . 'comics/comic_detail/' . $value['slug']; } else { echo  base_url() . 'comics/comic_detail/' . $value['id'];} ?>">
                <div class="featured-image-events">
                <img src="<?php
        				if(!empty($value['image'])):
        					echo HTTP_IMAGE_UPLOADED_PATH . $value['image'];
                else:
                  $gambar = '';

                  foreach($cover as $key_image => $value_image):
                    if($value['id'] == $value_image['comic_id'] && !empty($value_image['image_small'])){
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
                endif; ?>" class="img-responsive" alt="" width="123">

                <div class="zoom"><i class="fa fa-search fa-lg"></i></div>
                </div>
                <h3 class="heading-comic color-fff">
                    <?php echo $value['title']?><br/> <?php echo $comic_price?> <br/>
                </h3>
              </a>
            </li>
          <?php }?>
          </ul>
        </div>
        <div class="col-md-1 no-padding"></div>
      </div>
    </div>
      <!-- END CLIENTS -->
  </div>

<div class="main bg-abuabu">
  <div class="container">
    <!-- BEGIN CLIENTS -->
      <div class="margin-top-bottom-40 our-clients">
        <div class="col-md-1 no-padding"></div>
        <div class="col-md-10 no-padding">
          <div >
            <div class="panel-top">
              <img src="<?php echo HTTP_IMAGES_PATH; ?>ribbon-best-seller.png" class="" alt="">
            </div>
            <ul class="liststyle-none owl-carousel owlPlay coming-soon ">
            <?php foreach ($best_seller as $key => $value) {?>
            <?php $comic_price = "Rp ".number_format($value['price'],0,',','.'); ?>
              <li class="client-item">
                <a href="<?php if(!empty($value['slug'])){ echo base_url() . 'comics/comic_detail/' . $value['slug']; } else { echo  base_url() . 'comics/comic_detail/' . $value['id'];} ?>">
                  <div class="featured-image-events">
                  <img src="<?php
          				if(!empty($value['image'])):
          					echo HTTP_IMAGE_UPLOADED_PATH . $value['image'];
                  else:
                    $gambar = '';

                    foreach($cover as $key_image => $value_image):
                      if($value['id'] == $value_image['comic_id'] && !empty($value_image['image_small'])){
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
                  endif; ?>" class="img-responsive" alt="" width="123">
                  <div class="zoom"><i class="fa fa-search fa-lg"></i></div>
                  </div>
                  <h3 class="heading-comic">
                      <?php echo $value['title']?><br/> <?php echo $comic_price?> <br/>
                  </h3>
                </a>
              </li>
            <?php }?>
            </ul>
          </div>
        </div>
        <div class="col-md-1 no-padding"></div>
      </div>
    </div>
      <!-- END CLIENTS -->
  </div>
<?php
  $now	= strtotime(date('Y-m-d h:i:s'));
  $publisheddata = strtotime($coming_soon[0]['published_date']);
  //var_dump($coming_soon);
?>
<?php if(!empty($coming_soon) && $publisheddata > $now): ?>
<div class="main bg-fff">
  <div class="container">
    <!-- BEGIN CLIENTS -->
      <div class="margin-top-bottom-40 our-clients">
        <div class="col-md-1 no-padding"></div>
        <div class="col-md-10 no-padding">

            <div >
            <div class="panel-top">
              <img src="<?php echo HTTP_IMAGES_PATH; ?>ribbon-coming-soon.png" class="" alt="">
            </div>
            <ul class="liststyle-none owl-carousel owlStop coming-soon ">

              <?php foreach ($coming_soon as $key => $value) {
      				$published_date = strtotime($value['published_date']);
      				if($published_date > $now){
      			  ?>
              <?php $comic_price = "Rp ".number_format($value['price'],0,',','.'); ?>
                <li class="client-item">
                  <a href="<?php if(!empty($value['slug'])){ echo base_url() . 'comics/comic_detail/' . $value['slug']; } else { echo  base_url() . 'comics/comic_detail/' . $value['id'];} ?>">
                    <div class="featured-image-events">
                    <img src="<?php
            				if(!empty($value['image'])):
            					echo HTTP_IMAGE_UPLOADED_PATH . $value['image'];
                    else:
                      $gambar = '';

                      foreach($cover as $key_image => $value_image):
                        if($value['id'] == $value_image['comic_id'] && !empty($value_image['image_small'])){
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
                    endif; ?>" class="img-responsive" alt="" width="123">
                    <div class="zoom"><i class="fa fa-search fa-lg"></i></div>
                    </div>
                    <h3 class="heading-comic">
                        <?php echo $value['title']?><br/> <?php echo $comic_price?> <br/>
                    </h3>
					          <p><?php echo 'Publish: ' . date('d F Y', strtotime($value['published_date']));?></p>
                  </a>
                </li>
    				<?php }
    				} ?>
            </ul>

          </div>

        </div>
        <div class="col-md-1 no-padding"></div>
      </div>
    </div>
    <?php endif;?>
      <!-- END CLIENTS -->
  </div>
<div class="main bg-abuabu">
    <div class="container">
      <!-- BEGIN CLIENTS -->
        <div class="margin-top-bottom-40 our-clients">
          <div class="col-md-1 no-padding"></div>
          <div class="col-md-10 no-padding">
            <div >
              <div class="panel-top">
                <img src="<?php echo HTTP_IMAGES_PATH; ?>ribbon-editors-choice.png" class="" alt="">
              </div>
              <ul class="liststyle-none owl-carousel owlStop coming-soon ">
              <?php foreach ($editor_choice as $key => $value) {?>
              <?php $comic_price = "Rp ".number_format($value['price'],0,',','.'); ?>
                <li class="client-item">
                  <a href="<?php if(!empty($value['slug'])){ echo base_url() . 'comics/comic_detail/' . $value['slug']; } else { echo  base_url() . 'comics/comic_detail/' . $value['id'];} ?>">
                    <div class="featured-image-events">
                      <img src="<?php
              				if(!empty($value['image'])):
              					echo HTTP_IMAGE_UPLOADED_PATH . $value['image'];
                      else:
                        $gambar = '';

                        foreach($cover as $key_image => $value_image):
                          if($value['id'] == $value_image['comic_id'] && !empty($value_image['image_small'])){
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
                      endif; ?>" class="img-responsive" alt="" width="123">
                      <div class="zoom"><i class="fa fa-search fa-lg"></i></div>
                    </div>
                    <h3 class="heading-comic">
                        <?php echo $value['title']?><br/> <?php echo $comic_price?> <br/>
                    </h3>
                  </a>
                </li>
              <?php } ?>
              </ul>
            </div>
          </div>
          <div class="col-md-1 no-padding"></div>
        </div>
      </div>
        <!-- END CLIENTS -->
    </div>
<div class="main bg-fff">
    <div class="container padding-50">
      <div class="col-md-8 ">
        <div class="col-md-12 margin-bottom-20">
          <h2 class="bg-head-bottom">
            Publication Date
          </h2>
          <span class="red-line"></span>
          <?php if(!empty($publication_date[0]['title'])):?>
          <div class="padding-top-20 paragraph">
            <a href="<?php echo base_url() . 'publication/publication_detail/' . $publication_date[0]['slug']?>">
              <h2 class="head-date"><?php echo $publication_date[0]['title']; ?></h2>
            </a>
            <h3 class="head-subline-date"><?php echo date('d F Y', strtotime($publication_date[0]['date_published'])); ?></h3>
            <p>
              <?php
                $content = $publication_date[0]['content'];
                //$content = htmlspecialchars_decode($content);
                //$content = html_entity_decode($content);
                $content = preg_replace("/<\/?div[^>]*\>/i", "", $content);
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
        <h2>Oops, we are sorry, there's no any available publications here.</h2>
        <?php endif;?>
        </div>
        <div class="col-md-12  margin-bottom-20">
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
            <h3 class="head-subline-date"><?php echo date('d F Y', strtotime($latest_promo[0]['date_published'])); ?></h3>
            <p>
              <?php
                $content = $latest_promo[0]['content'];
                //$content = htmlspecialchars_decode($content);
                //$content = html_entity_decode($content);
                $content = preg_replace("/<\/?div[^>]*\>/i", "", $content);
				        echo substr($content, 0, 450) . '...';
                //echo "$content";
              ?>
            </p>
          </div>
          <h3 class="read-more-bottom">
            <a href="<?php echo base_url() . 'promo/promo_detail/' .$latest_promo[0]['slug']?>" class="read-more-link"></a>
          </h3>
          <span class="red-line-thin"></span>
        <?php else: ?>
        <h2>Oops, we are sorry, there's no any available event here.</h2>
        <?php endif;?>
        </div>
        <div class="col-md-12  margin-bottom-20">
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
            <h3 class="head-subline-date"><?php echo date('d F Y', strtotime($latest_event[0]['date_published'])); ?></h3>
            <p>
            <?php

                $content = $latest_event[0]['content'];
                //$content = htmlspecialchars_decode($content);
                //$content = html_entity_decode($content);
                $content = preg_replace("/<\/?div[^>]*\>/i", "", $content);
                echo substr($content, 0, 450) . '...';
            ?>
            </p>
          </div>
          <h3 class="read-more-bottom">
            <a href="<?php echo base_url() . 'event/event_detail/' . $latest_event[0]['slug']?>" class="read-more-link"></a>
          </h3>
          <span class="red-line-thin"></span>
        <?php else: ?>
        <h2>Oops, we are sorry, there's no any available event here.</h2>
        <?php endif;?>
        </div>
      </div>
      <div class="col-md-4 ">
        <div class="col-md-12  margin-bottom-20">
          <h2 class="bg-head-bottom">
            We are on Youtube
          </h2>
          <span class="red-line"></span>
          <?php
          $channelId = $youtube['youtube'][0]['channel_id'];
          $maxResults = $youtube['youtube'][0]['max_results'];
          $API_key = $youtube['youtube'][0]['api_key'];

          $video_list = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelId.'&maxResults='.$maxResults.'&key='.$API_key.''));
          ?>
          <ul class="col-sm-12 ul-youtube">
          <?php
          foreach($video_list->items as $item)
          {
              //Embed video
              if(isset($item->id->videoId)){
              echo '<li id="'. $item->id->videoId .'" class="li-youtube">
                    <div class="col-sm-5" style="padding: 0; margin: 0;">
                    <a href="http://youtube.com/watch?v='. $item->id->videoId .'" title="'. $item->snippet->title .'" target="_blank">
                    <div class="featured-image-events">
                    <img src="'. $item->snippet->thumbnails->high->url .'" alt="'. $item->snippet->title .'" class="img-youtube" />
                    </div>
                    <span class="fa fa-play-circle fa-3x"></span>

                    </a>
                    </div>
                    <div class="col-sm-7">
                    <a href="http://youtube.com/watch?v='. $item->id->videoId .'" title="'. $item->snippet->title .'" target="_blank">
                    <h2>'. $item->snippet->title .'</h2>
                    <p>'. substr(strip_tags($item->snippet->description), 0, 50) .'</p>
                    </a>
                    </div>
                    </li>';
              }
              //Embed playlist
              else if(isset($item->id->playlistId)){
                    echo '<li id="'. $item->id->playlistId .'" class="li-youtube">
                    <div class="col-sm-5" style="padding: 0; margin: 0;">
                    <a href="http://youtube.com/watch?v='. $item->id->playlistId .'" title="'. $item->snippet->title .'" target="_blank">
                    <img src="'. $item->snippet->thumbnails->high->url .'" alt="'. $item->snippet->title .'" class="img-youtube" />
                    <span class="fa fa-play-circle"></span>
                    </a>
                    </div>
                    <div class="col-sm-7">
                    <a href="http://youtube.com/watch?v='. $item->id->playlistId .'" title="'. $item->snippet->title .'" target="_blank">
                    <h2>'. $item->snippet->title .'</h2>
                    <p>'. substr(strip_tags($item->snippet->description), 0, 50) . '</p>
                    </a>
                    </div>
                    </li>';
              }
          }
          ?>
          </ul>
        </div>
        <div class="col-md-12  margin-bottom-20">
          <h2 class="bg-head-bottom">
            Follow Us on Twitter
          </h2>
          <span class="red-line"></span>
          <?php echo $twitter['twitter'][0]['content'];?>
        </div>
        <div class="col-md-12  margin-bottom-20">

        </div>
      </div>
    </div>
    </div>
<?php
$this->load->view('vwFooter');
?>
