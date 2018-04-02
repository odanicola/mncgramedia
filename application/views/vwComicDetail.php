<?php
//$this->load->view('vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->
<?php
  function isSerialized($str) {
    return ($str == serialize(false) || @unserialize($str) !== false);
  }
  if(isSerialized($comic_detail[0]['category_id'])){
    $category_id = unserialize($comic_detail[0]['category_id']);
  } else { $category_id = array($comic_detail[0]['category_id']);}

  if(isSerialized($comic_detail[0]['image_gallery'])){
      $image = unserialize($comic_detail[0]['image_gallery']);
  } else {
	  $image = array($comic_detail[0]['image_gallery']);
  }

?>
<div class="main bg-red-mnc">
  <div class="container">
    <div class="toppanel-header">
      <div class="col-md-4 no-padding">
        <p class="breadcum">Home / <a href="#">Comics </a>/ Comic-details / <?php echo $comic_detail[0]['title'];?></p>
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
	  <?php
		  foreach ($left_banner['left_banner'] as $key => $value) { ?>
			<a href="<?php echo $value['url'] ?>" target="_blank">
				<img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $value['banner_image'];?>" style="width:100%;" alt="" width="300"
				class="left_banner">
			</a>
			<?php
		  }
	  ?>
      </div>
  </div>
  <div class="col-md-8 panel-right">
    <div class="col-md-12 no-padding">
      <?php
      if(!is_null($this->session->flashdata('item'))){ $message = $this->session->flashdata('item');?>
          <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
      <?php } else { echo '<div></div>';}?>
      <div class="col-md-7 no-padding">
        <h2 class="header-left">Comic</h2>
        <img src="<?php
		      if(!empty($comic_detail[0]['image'])){
			         echo HTTP_IMAGE_UPLOADED_PATH . $comic_detail[0]['image'];
		      }else if(!empty($single_image[0]['image_small'])){
			         if($comic_detail[0]['id'] == $single_image[0]['comic_id']){
				             echo HTTP_IMAGE_UPLOADED_PATH_DEFAULT . $single_image[0]['image_large'];
			         }
		      }else{ echo HTTP_IMAGES_PATH . 'default.png'; }

		?>" class="img-responsive img-article" alt="" style="height: 530px; padding: 10px; border: 1px solid #000;">
      </div>
      <div class="col-md-5 row no-padding margin-top-35 margin-left-15">
        <h3 class="font-size-17"><?php echo $comic_detail[0]['title'] ?></h3>
        <?php $comic_harga = "Rp ".number_format($comic_detail[0]['price'],0,',','.'); ?>
        <table class="table table-light table-hover width-auto comic-detail">
          <tbody>
            <tr><td>Author</td><td ><?php echo $comic_detail[0]['author'] ?></td></tr>
            <tr><td>Size</td><td ><?php echo $comic_detail[0]['size'] . " cm"; ?></td></tr>
            <tr>
      				<td>Rating</td>
      				<td><?php $rate = (int)$comic_detail[0]['rate']; ?>
      					<div class="rating col-md-9">
      					<?php for($i=1; $i<=$rate; $i++){ ?>
      						<input class="stars" type="radio" checked />
      						<label class = "full" for="star5" title="Awesome - 5 stars"></label>
      					<?php } ?>
      					</div>
      				</td>
      			</tr>
            <tr><td>Jenis Rate</td>
            <td>
              <?php
                if(!empty($comic_detail[0]['jenis_rate'])){
                    echo $comic_detail[0]['jenis_rate'];
                } else {
                  echo 'R';
                }
              ?>
            </td></tr>
            <tr><td>Tags</td><td><?php echo $comic_detail[0]['tags']?></td></tr>
            <tr><td>ISBN</td><td><?php echo $comic_detail[0]['isbn']?></td></tr>
            <tr><td>Harga</td><td ><?php echo $comic_harga;?></td></tr>
            <?php if($comic_detail[0]['published_date'] != '0000-00-00 00:00:00'){ ?>
            <tr><td>Published Date</td><td><?php echo date('d F Y', strtotime($comic_detail[0]['published_date']))?></td></tr>
            <?php }else{ ?>
            <tr><td>Publish Date</td><td><?php echo substr($comic_detail[0]['published_date'],0,10); ?></td></tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="col-md-12 no-padding">
          <h3 class="header-article">Synopsis</h3>
          <?php
          $content = $comic_detail[0]['summary'];
          //$content = htmlspecialchars_decode($content);
          //$content = html_entity_decode($content);
          echo $content;
        ?>
      </div>
    </div>
    <div class="col-md-12 marginTopBot-20 line-dashed">
      <ul class="list-unstyled footernav">
        <li style="float:left">Share On : </li>
        <?php
            $fbslug = '';
            $fburl  = '';
            if(!empty($comic_detail[0]['slug'])){
              $fbslug = $comic_detail[0]['slug'];
              $fburl  = base_url() . 'comics/comic_detail/' . $fbslug;
            }else{
              $fbslug = $comic_detail[0]['id'];
              $fburl  = base_url() . 'comics/comic_detail/' . $fbslug;
            };
            $titlefb=urlencode($comic_detail[0]['title']);
            $urlfb=urlencode($fburl);
            $summaryfb=urlencode($comic_detail[0]['summary']);
            $imagepath = '';
            //if(!empty($image)){ $imagepath = HTTP_IMAGE_UPLOADED_PATH . $comic_detail[0]; } else { $imagepath =  HTTP_IMAGES_PATH . 'default.png';}
  		      if(!empty($comic_detail[0]['image'])){
  			         $imagepath = HTTP_IMAGE_UPLOADED_PATH . $comic_detail[0]['image'];
  		      }else if(!empty($single_image[0]['image_small'])){
  			         if($comic_detail[0]['id'] == $single_image[0]['comic_id']){
  				             $imagepath = HTTP_IMAGE_UPLOADED_PATH_DEFAULT . $single_image[0]['image_large'];
  			        }
  		      }else{ $imagepath = HTTP_IMAGES_PATH . 'default.png'; }
            $imagefb=urlencode($imagepath);
        ?>
        <li class="social-bottom2 fb-social2"><a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $titlefb;?>&amp;p[summary]=<?php echo $summaryfb;?>&amp;p[url]=<?php echo $urlfb; ?>&amp;p[images][0]=<?php echo $imagefb;?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)">Facebook</a></li>
        <li class="social-bottom2 twitter-social2"><a onClick="window.open('http://twitter.com/home?status=Currently reading <?php echo $urlfb; ?>','sharer','toolbar=0,status=0,width=548,height=325')" href="javascript: void(0)">Twitter</a></li>
        <li class="separate-social" ></li>
        <li class="social-bottom2 shopIco"><a href="#">Shop</a></li>
        <li class="link-preview">
          <a href="<?php echo $comic_detail[0]['link_download']; ?>" target="_blank">
            <img src="<?php echo HTTP_IMAGES_PATH . 'preview_button.png'; ?>" height="50">
          </a>
        </li>
        <li class="link-view-full">
          <a href="<?php echo $comic_detail[0]['link_full_version']; ?>" target="_blank">
            <img src="<?php echo HTTP_IMAGES_PATH . 'view_full_version.png'; ?>" height="50">
          </a>
        </li>
      </ul>
    </div>
    <div class="rows padding-top-20 comic-preview">
      <h2 class="header-left color-333">Comic Preview</h2>
      <div class="rows margin-bottom-20">
        <ul class="liststyle-none our-clients2 coming-soon padding-nol margin-nol ">
          <?php
            //var_dump($image);
    			  if(!empty($image[0])){
                  foreach ($image as $key => $value) { ?>
                    <li class="client-item2">
                      <a href="<?php echo HTTP_IMAGE_UPLOADED_PATH . $value;?>" rel="prettyPhoto[pp_gal]" title="<?php echo $comic_detail[0]['title']; ?>">
                        <div class="featured-image-events">
                        <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $value;?>" class="img-responsive" alt="">
                        <div class="zoom"><i class="fa fa-search fa-lg"></i></div>
                        </div>
                      </a>
                    </li>
    		  <?php }
            } else{
              for ($i=1; $i<=5; $i++){
              ?>
              <li class="client-item2">
                <a href="<?php echo HTTP_IMAGES_PATH . 'default.png'; ?>" rel="prettyPhoto[pp_gal]" title="<?php echo $comic_detail[0]['title']; ?>">
                  <div class="featured-image-events">
                  <img src="<?php echo HTTP_IMAGES_PATH . 'default.png'; ?>" class="img-responsive" alt="">
                  <div class="zoom"><i class="fa fa-search fa-lg"></i></div>
                  </div>
                </a>
              </li>
            <?php }}?>
        </ul>
      </div>
    </div>
    <div class="col-md-12 col-sm-12 no-padding margin-bottom-10">
      <button type="button" class="btn red">Download (*.Zip)  <i class="fa fa-download"></i></button>
    </div>
    <?php if ($this->session->userdata('is_client_login') ){ ?>
    <div class="rows col-md-11 no-padding margin-bottom-10">
      <h2 class="header-left ">Review This Comic</h2>
    </div>
    <form method="post" action="<?php echo base_url(); ?>home/submit_review" role="form">
    <div class="rows col-md-12 no-padding margin-bottom-10">
      <div class="rows col-md-3 no-padding">
        <p class="inputLabel">Title of Review</p>
      </div>
      <div class="rows col-md-8 no-padding">
        <input type="input" class="form-control" name="title" placeholder="Title of Review" required>
      </div>
    </div>
    <div class="rows col-md-12 no-padding margin-bottom-10">
      <div class="rows col-md-3 no-padding">
        <p class="inputLabel">Your Review</p>
      </div>
      <div class="rows col-md-8 no-padding">
        <textarea class="form-control" name="description" style="height:250px;" placeholder="Your Review" required></textarea>
      </div>
    </div>
    <div class="rows col-md-12 no-padding margin-bottom-10">
      <div class="rows col-md-3 no-padding">
        <p class="inputLabel">Your Rate</p>
      </div>
      <div class="rows col-md-3 no-padding rating">
  		<input class="stars" type="radio" id="star5" name="rate" value="5" />
  		<label class = "full" for="star5" title="Awesome - 5 stars"></label>
  		<input class="stars" type="radio" id="star4" name="rate" value="4" />
  		<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
  		<input class="stars" type="radio" id="star3" name="rate" value="3" />
  		<label class = "full" for="star3" title="Meh - 3 stars"></label>
  		<input class="stars" type="radio" id="star2" name="rate" value="2" />
  		<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
  		<input class="stars" type="radio" id="star1" name="rate" value="1" />
  		<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
      </div>
    </div>
    <div class="rows col-md-11 no-padding" >
      <input type="hidden" value="<?php echo $this->session->userdata('username');?>" name="username">
      <input type="hidden" value="<?php echo $comic_detail[0]['id'] ?>" name="comic_id">
      <input type="hidden" value="<?php echo $comic_detail[0]['slug'] ?>" name="slug">
      <input type="submit" class="btn red" value="Submit" style="float:right">
    </div>
    </form>
    <?php } else {?>
      <div class="rows col-md-11 no-padding margin-bottom-10">
        <h2 class="header-left ">Review This Comic</h2>
      </div>
      <div class="rows col-md-11 no-padding margin-bottom-10">
        <p>Please do <a href="<?php echo base_url()?>home/login">login</a> to review this comic</p>
      </div>
    <?php } ?>
    <div class="red-line-bottom"></div>
    <div class="rows padding-top-20 ">
    <div class="banner-full">
      <a href="<?php echo $middle_banner['middle_banner'][0]['url'] ?>" target="_blank">
		<img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $middle_banner['middle_banner'][0]['banner_image']?>" style="width:100%;" alt="">
	  </a>
    </div>
      <h2 class="header-left ">Other Volume</h2>
      <div class="rows margin-bottom-20">
        <ul class="liststyle-none our-clients2 coming-soon padding-nol margin-nol ">
        <?php foreach ($other_volume as $key => $value) {
          $comic_harga = "Rp ".number_format($value['price'],2,',','.');
        ?>
          <li class="client-item">
            <a href="<?php if(!empty($value['slug'])){ echo base_url() . 'comics/comic_detail' . $value['slug']; } else { echo  base_url() . 'comics/comic_detail/' . $value['id'];} ?>">
              <div class="featured-image-events">
              <img src="<?php
				$default = false;
				if(!empty($value['image'])):
					echo HTTP_IMAGE_UPLOADED_PATH . $value['image'];
				else:
					$gambar = '';
					foreach($other_image as $key_image => $value_image):
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
				endif;
			  ?>" class="img-responsive" alt="" width="123">
              <div class="zoom"><i class="fa fa-search fa-lg"></i></div>
              </div>
              <h3 class="heading-comic2"><?php echo $value['title'] ?></h3>
              <span><?php echo $comic_harga; ?></span>
            </a>
          </li>
          <?php } ?>
        </ul>
      </div>
      <div class="rows margin-bottom-20 width95">
        <h3 class="read-more-bottom">
          <a href="<?php echo base_url();?>comics/" class="read-more-link"></a>
        </h3>
        <span class="red-line-thin"></span>
      </div>
    </div>
  </div>
</div>
</div>
<?php
$this->load->view('vwFooter');
?>