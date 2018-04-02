<?php
$this->load->view('admin/vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->

<div id="page-wrapper">

  <?php
  if(!is_null($this->session->flashdata('exportcomic'))){ $message = $this->session->flashdata('exportcomic');?>
      <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
  <?php } else { echo '<div></div>';}?>

    <div class="row">
        <div class="col-lg-12">
            <h1>Export <small>Comic Price</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/export/"><i class="icon-dashboard"></i> Export</a></li>
                <li class="active"><i class="icon-file-alt"></i> Export Comic Price Page</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/exportimport/export_comic" role="form" enctype="multipart/form-data">
        <!-- <div class="form-group">
              <label for="begin_date">Date Range</label>
              <input type="text" name="begin_date" class="form-control input-sm"  placeholder="From" id="begin_date">
        </div>

        <div class="form-group">
              <input type="text" name="end_date" class="form-control input-sm"  placeholder="To" id="end_date">
        </div>-->

        <div class="form-group">
          <label for="from">Price Range</label>
          <input style="float:left; margin-bottom: 20px;" type="text" name="begin_price" class="form-control input-sm"  placeholder="From">
        </div>
        <div class="form-group">
          <input style="float:right; margin-bottom: 20px;" type="text" name="end_price" class="form-control input-sm"  placeholder="To">
        </div>

        <input type="submit" name="btn_submit" class="btn btn-primary" value="Export">
        </form>
    </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1>Import <small>Comic Price</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/exportimport/comic/"><i class="icon-dashboard"></i> Import</a></li>
                <li class="active"><i class="icon-file-alt"></i> Import Comic Price Page</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
      <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/exportimport/import_comic_price" role="form" enctype="multipart/form-data">
          <div class="form-group">
              <label for="import_file">Insert CSV File</label><br>
              <input type="file" name="userfile"  size="20"/>
          </div>
          <input type="submit" name="btn_submit" class="btn btn-primary" value="Import">
        </form>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1>Import <small>Comic</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/exportimport/comic/"><i class="icon-dashboard"></i> Import</a></li>
                <li class="active"><i class="icon-file-alt"></i> Import Comic Page</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
      <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/exportimport/import_comic" role="form" enctype="multipart/form-data">
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
