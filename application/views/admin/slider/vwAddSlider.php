<?php
$this->load->view('admin/vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>SLIDER <small>Add Page </small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/slider/"><i class="icon-dashboard"></i> SLIDER</a></li>
                <li class="active"><i class="icon-file-alt"></i> Add Page</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/control_panel/add_slider" role="form" enctype="multipart/form-data">
          <div class="form-group">
  					<label for="featured_image">Slider Image</label><br>
  					<input type="file" name="userfile" size="20" value="" />
  				</div>
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Add Slider">
        </form>
    </div>
    </div>

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
