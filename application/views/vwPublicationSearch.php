<?php
$this->load->view('vwHeader');
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
      <div class="col-md-12">
        <h2 class="header-left">Publication Date</h2>
		<form method="post" action="<?php echo base_url(); ?>publication/search" role="form">
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
			<input type="submit" class="btn red" value="Search">
		</div>
		</form>
		</div>
		<div class="col-md-12">
		
		<h2><strong><?php echo "Search Result for : " . $time['month'] . " " . $time['year']; ?></strong></h2>
		<div class="col-md-12 no-padding margin-bottom-10">
		<ul>
		<?php
		foreach ($search as $key => $value) { ?>
			<li style="height: 25px;"><a href="<?php if(!empty($value['slug'])){ echo base_url() . 'comics/comic_detail/' . $value['slug']; } else { echo  base_url() . 'comics/comic_detail/' . $value['id'];} ?>">
			<?php echo $value['title'] . " - Publish Date : <b>" . date('d F Y', strtotime($value['published_date'])) . "</b>";?></a></li>
	    <?php } ?>
		</ul>
		</div>
		
      </div>    
  </div>
</div>
</div>
<?php
$this->load->view('vwFooter');
?>