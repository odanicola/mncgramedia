<?php
$this->load->view('admin/vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->
<?php
    function isSerialized($str) {
        return ($str == serialize(false) || @unserialize($str) !== false);
    }
    if(isSerialized($slider[0]['slider_image'])){
        $image = unserialize($slider[0]['slider_image']);
    } else { $image = array($slider[0]['slider_image']);}
?>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>SLIDER <small>Edit Page </small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/slider/"><i class="icon-dashboard"></i> SLIDER</a></li>
                <li class="active"><i class="icon-file-alt"></i> Edit Page</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/control_panel/update_slider" role="form" enctype="multipart/form-data">
          <div class="form-group">
  					<label for="featured_image">Slider Image</label><br>
  					  <?php
  						$image_value = '';
  						if(isset($slider[0]['slider_image']) && !empty($slider[0]['slider_image'])) {?>
  						<img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $slider[0]['slider_image'];?>" class="thumbnail" height="200" style="margin-bottom: 20px">
  						<?php } else{ echo "No Slider Image"; } ?>
  					<input type="file" name="userfile" size="20" value="<?php echo $image_value;?>" />
  				</div>
            <input type="hidden" value="<?php echo isset($slider[0]['id']) && !empty($slider[0]['id']) ? $slider[0]['id'] : '';?>" name="pst_id">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Update">
        </form>
    </div>
    </div>

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
