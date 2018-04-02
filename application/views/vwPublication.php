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
        <p class="breadcum">Home / <a href="#">Publication </a></p>
      </div>
      <div class="col-md-8 no-padding">
      </div>
    </div>
  </div>
</div><!-- main bg red -->
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
    </div><!-- col 12 -->
  </div><!-- col 4 panel -->
  <div class="col-md-8 panel-right padding20">
    <div class="rows">
      <div class="col-md-12 ">
        <h2 class="header-left">Publication Date</h2>
    		<form method="post" action="<?php echo base_url(); ?>publication/download" role="form">
      		<div class="col-md-2">
      			<h4>Sort By:<h4>
      		</div>
      		<div class="col-md-3">
      			<div class="styled-select short1">
      			  <select class="form-control" name="month">
      				<option value="-">Month</option>
      				<?php foreach($monthlist as $key => $value){?>
      					 <option value="<?php echo $key; ?>"><?php echo $value;?></option>
      				<?php } ?>
      			  </select>
      			</div>
      		</div>
      		<div class="col-md-3">
      			<div class="styled-select short1">
      			  <select class="form-control" name="year">
      				<option value="-">Year</option>
      				<?php $now = date('Y');
      				$begin = '2000';
      				while($begin <= $now){?>
      					<option value="<?php echo $begin; ?>"><?php echo $begin; ?></option>
      				<?php
      				$begin++;
      					}
      				?>
      			  </select>
      			</div>
      		</div>
      		<div class="col-md-2">
      			<input type="submit" class="btn red" value="Download">
      		</div>
    		</form>
		</div>
    <div class="col-md-12">
      <div class="loader"></div>
          <h2 class="header-left">Publication</h2>
          <div id="comicList">
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
        </div>
      </div><!-- rows -->
    </div><!-- col 8 -->
  </div><!-- sidepanel -->
</div><!-- full width -->
<?php
$this->load->view('vwFooter');
?>
