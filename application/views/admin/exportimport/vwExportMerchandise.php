<?php
$this->load->view('admin/vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->

<div id="page-wrapper">
  <?php
  if(!is_null($this->session->flashdata('exportmerchandise'))){ $message = $this->session->flashdata('exportmerchandise');?>
      <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
  <?php } else { echo '<div></div>';}?>

    <div class="row">
        <div class="col-lg-12">
            <h1>Export <small>Merchandise</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/export/merchandise/"><i class="icon-dashboard"></i> Export</a></li>
                <li class="active"><i class="icon-file-alt"></i> Export Merchandise Page</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/exportimport/export_merchandise" role="form" enctype="multipart/form-data">
        <div class="form-group">
              <label for="begin_date">Date Range</label>
              <input type="text" name="begin_date" class="form-control input-sm"  placeholder="From" id="begin_date">
        </div>

        <div class="form-group">
              <input type="text" name="end_date" class="form-control input-sm"  placeholder="To" id="end_date">
        </div>

        <div class="form-group">
          <label for="from">Price Range</label>
          <input style="float:left; margin-bottom: 20px;" type="text" name="begin_price" class="form-control input-sm"  placeholder="From">
        </div>
        <div class="form-group">
          <input style="float:right; margin-bottom: 20px;" type="text" name="end_price" class="form-control input-sm"  placeholder="To">
        </div>

        <div class="form-group">
            <label for="category">Category </label><br>
            <select class="form-control" name="category">
            <option value="">-</option>
            <?php
            foreach ($merchandise_category as $key => $value ) {?>
            <option value="<?php echo $merchandise_category[$key]['id'];?>">
              <?php echo $merchandise_category[$key]['title'];?>
            </option>
            <!-- <input type="checkbox" value="" name="category[]"> -->
            <?php } ?>
            </select>
        </div>
        <input type="submit" name="btn_submit" class="btn btn-primary" value="Export">
        </form>
    </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1>Import <small>Merchandise</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/exportimport/merchandise/"><i class="icon-dashboard"></i> Import</a></li>
                <li class="active"><i class="icon-file-alt"></i> Import Merchandise Page</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
      <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/exportimport/import_merchandise" role="form" enctype="multipart/form-data">
          <div class="form-group">
              <label for="import_file">Insert CSV File</label><br>
              <input type="file" name="userfile"  size="20"/>
          </div>
          <input type="submit" name="btn_submit" class="btn btn-primary" value="Import">
        </form>
      </div>
    </div>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
