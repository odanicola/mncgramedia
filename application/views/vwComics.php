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
        <p class="breadcum">Home / <a href="#">Comics </a></p>
      </div>
      <div class="col-md-8 no-padding">
      </div>
    </div>
  </div>
</div>
<!-- BEGIN SLIDER -->
<div class="fullwidth ">
<div class="container sidepanel">
  <div class="col-md-4 panel-left" >
    <div class="col-md-10">
      <h2 class="header-left">Search By Category:</h2>
      <div class="styled-select">
        <form id="search_form">
        <select class="form-control" class="category" id="category">
          <option value="all">All</option>
  			  <option value="Shounen">Boys</option>
  			  <option value="Shoujo">Girls</option>
  			  <option value="Seinen">Mature</option>
        </select>
        </form>
      </div>
      <h2 class="header-left">Search By Genre:</h2>
      <div class="styled-select">
	    <form id="search_form">
  			<select class="form-control" class="genre" id="genre">
  			  <option value="all">All</option>
          <option value="Action">Action</option>
          <option value="Romance">Romance</option>
          <option value="Drama">Drama</option>
          <option value="Horror">Horror</option>
          <option value="Mystery">Mystery</option>
          <option value="Comedy">Comedy</option>
          <option value="Sports">Sports</option>
          <option value="Fantasty">Fantasty</option>
          <option value="Adventure">Adventure</option>
          <option value="Psychological">Psychological</option>
          <option value="School Life">School Life</option>
          <option value="Slice of Lice">Sice of Lice</option>
          <option value="Historical">Historical</option>
  			</select>
		  </form>
      </div>
	    <h2 class="header-left">Search By Country:</h2>
      <div class="styled-select">
        <select class="form-control" id="country">
          <option value="all">All</option>
  		    <?php foreach($country as $value){?>
  				<option value="<?php echo $value['origin']; ?>" <?php if($value['origin'] == $page){echo 'selected';}?>><?php echo $value['origin'] ?></option>
  		    <?php	} ?>
        </select>
      </div>
      <!--<div class="col-md-12 panel-shadow margin-bottom-20 margin-top-10">
         <h3 class="header-left" style="font-size:16px;">Browse by Category</h3>
        <div class="checkbox-list">
          <label>
            <div class="checker"><span><input type="checkbox"></span></div> Comic Category
          </label>
          <label>
            <div class="checker"><span><input type="checkbox"></span></div> Comic Category
          </label>
          <label>
            <div class="checker"><span><input type="checkbox"></span></div> Comic Category
          </label>
          <label>
            <div class="checker"><span><input type="checkbox"></span></div> Comic Category
          </label>
          <label>
            <div class="checker"><span><input type="checkbox"></span></div> Comic Category
          </label>
          <label>
            <div class="checker disabled"><span><input type="checkbox" disabled=""></span></div> Comic Category
          </label>
          <button style="float:right;margin-top:10px;" type="button" class="btn red">Ok</button>
        </div>
      </div> -->
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
  <div class="col-md-8 panel-right ajax_result" >
    <div class="rows">
      <h2 class="header-left">Coming Soon</h2>
      <div class="rows margin-bottom-20">
        <ul class="liststyle-none our-clients2 coming-soon padding-nol margin-nol ">
          <?php
  		      $now	= strtotime(date('Y-m-d h:i:s'));
            foreach ($coming_soon as $key => $value) {
      	        $published_date = strtotime($value['published_date']);
      		      if($published_date > $now){
                $catalog_harga = "Rp ".number_format($value['price'],0,',','.');
          ?>
          <li class="client-item">
            <a href="<?php if(!empty($value['slug'])){ echo base_url() . 'comics/comic_detail/' . $value['slug']; } else { echo  base_url() . 'comics/comic_detail/' . $value['id'];} ?>">
              <div class="featured-image-events">
              <img src="<?php
          				$default = false;
          				if(!empty($value['image'])):
          					echo HTTP_IMAGE_UPLOADED_PATH . $value['image'];
          				else:
          					$gambar = '';
          					foreach($image as $key_image => $value_image):
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
              <h3 class="heading-comic2">
                  <?php echo $value['title'] ?>
              </h3>
			        <p><?php echo 'Publish: ' . date('d F Y', strtotime($value['published_date']));?></p>
              <span><?php echo $catalog_harga; ?></span>
            </a>
          </li>
        <?php }
		  } ?>
        </ul>
      </div>
    </div>
    <div class="red-line-bottom"></div>
    <div class="padding-top-20"  id="loading">
      <div class="loader"></div>
      <h2 class="header-left "><?php echo $page; ?></h2>
      <div id="comicList">
      <div class="rows margin-bottom-20 comic-list">
        <ul class="liststyle-none our-clients2 coming-soon padding-nol margin-nol">
          <?php
            if($comic):
            foreach ($comic as $value) {
            $comic_harga = "Rp ".number_format($value->price,0,',','.');
          ?>
          <li class="client-item" id="listcomic">
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
        			  ?>" class="img-responsive" alt="">
              <div class="zoom"><i class="fa fa-search fa-lg"></i></div>
              </div>
              <h3 class="heading-comic2">
                  <?php echo $value->title ?>
              </h3>
      			  <?php
      			  $published_date = strtotime($value->published_date);
      			  if($published_date > $now){?>
      					<p><?php echo 'Publish: ' . date('d F Y', $published_date );?></p>
      			  <?php } ?>
              <span><?php echo $comic_harga; ?></span>
            </a>
          </li>
        <?php } else: ?>
        <li><h2>Oops, we are sorry, there's no any available comic here.</h2></li>
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
    </div>
   </div>
  </div>
</div>
</div>
<script type="text/javascript">
//Search By Category
//
$('#comicList').on('change',function(e){
  $('#loading').html('<h1 style="color:#C22228;"><img src="<?php echo HTTP_IMAGES_PATH; ?>ajax-loader-mnc.gif"> loading...</h1>');
});

$(document).on('change','#category',function(){
   var cat = $('#category').val();
   $('#loading').html('<h1 style="color:#C22228;"><img src="<?php echo HTTP_IMAGES_PATH; ?>ajax-loader-mnc.gif"> loading...</h1>');
   if(cat == 'all'){
	   //window.location.reload();
	   var url = window.location = "<?php echo base_url()?>comics";
   } else {
	   var url = window.location = "<?php echo base_url()?>comics/?category="+cat;
   }

   $.ajax({
        type: "POST",
        url: url,
        success: function (d) {
            // replace div's content with returned data
            $('#loading').delay(800).html(d);

        }
    });

});

//Search By Genre
$(document).on('change','#genre',function(){
   var cat = $('#genre').val();
   $('#loading').html('<h1 style="color:#C22228;"><img src="<?php echo HTTP_IMAGES_PATH; ?>ajax-loader-mnc.gif"> loading...</h1>');
   if(cat == 'all'){
	   //window.location.reload();
	   var url = window.location = "<?php echo base_url()?>comics";
   } else {
	   var url = window.location = "<?php echo base_url()?>comics/?genre="+cat;
   }

   $.ajax({
        type: "POST",
        url: url,
        success: function (d) {
            // replace div's content with returned data
            $('#loading').delay(800).html(d);

        }
    });

});

$(document).on('change','#country',function(){
   var country = $('#country').val();
   $('#loading').html('<h1 style="color:#C22228;"><img src="<?php echo HTTP_IMAGES_PATH; ?>ajax-loader-mnc.gif"> loading...</h1>');
   if(country == 'all'){
	   //window.location.reload();
	   var url = window.location = "<?php echo base_url()?>comics";
   } else {
	   var url = window.location = "<?php echo base_url()?>comics/?country="+country;
   }
   $.ajax({
        type: "POST",
        url: url,
        success: function (d) {
            // replace div's content with returned data
            $('#loading').delay(800).html(d);

        }
    });
});
</script>
<?php
$this->load->view('vwFooter');
?>
