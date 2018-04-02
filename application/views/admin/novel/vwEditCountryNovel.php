<?php
$this->load->view('admin/vwHeader');
?>
<!--
Author      : Oda Nicola
Page        : Category Comic
Website     : http://nicolastudio.net
-->
<div id="page-wrapper">
  <?php
  if(!is_null($this->session->flashdata('edit_country_novel'))){ $message = $this->session->flashdata('edit_country_novel');?>
      <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
  <?php } else { echo '<div></div>';}?>

    <div class="row">
        <div class="col-lg-12">
            <h1>Country Comic <small>Edit Page </small> <small><a href="<?php echo base_url();?>admin/country_comic/add_new"
            class="add-new" >Add New</a></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/country_comic/"><i class="icon-dashboard"></i> Country Comic</a></li>
                <li class="active"><i class="icon-file-alt"></i> Edit Page</li>
            </ol>
        </div>
    </div><!-- /.row -->
    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/country_comic/update_category_comic" role="form">
        <div class="form-group">
            <label for="title">Origin</label>
            <input type="text" name="title" value="<?php echo isset($country_comic[0]['origin']) && !empty($country_comic[0]['origin']) ? $country_comic[0]['origin'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="sort">Sort</label>
            <input type="text" name="sort" value="<?php echo isset($country_comic[0]['sort']) && !empty($country_comic[0]['sort']) ? $country_comic[0]['sort'] : '';?>"
            class="form-control input-sm" >
        </div>
            <input type="hidden" value="<?php echo isset($country_comic[0]['origin']) && !empty($country_comic[0]['origin']) ? $country_comic[0]['origin'] : '';?>" name="pst_id">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Update">
        </form>
    </div>
    </div>
</div><!-- /#page-wrapper -->
<?php
$this->load->view('admin/vwFooter');
?>
