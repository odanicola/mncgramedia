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
			  <option value="all">General</option>
			</select>
		  </form>
      </div>
	    <h2 class="header-left">Search By Country:</h2>
      <div class="styled-select">
        <select class="form-control" id="country">
          <option value="all">All</option>
		  <?php foreach($country as $value){?>
				<option value="<?php echo $value['origin']; ?>" <?php if($value['origin'] == $page){echo 'selected';}?>><?php echo $value['origin'] ?></option>
		  <?php	}
		  ?>
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