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
  if(!is_null($this->session->flashdata('edit_category_novel'))){ $message = $this->session->flashdata('edit_category_novel');?>
      <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
  <?php } else { echo '<div></div>';}?>

    <div class="row">
        <div class="col-lg-12">
            <h1>Category Novel <small>Edit Page </small> <small><a href="<?php echo base_url();?>admin/category_novel/add_new"
            class="add-new" >Add New</a></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/category_novel/"><i class="icon-dashboard"></i> Category Novel</a></li>
                <li class="active"><i class="icon-file-alt"></i> Edit Page</li>
            </ol>
        </div>
    </div><!-- /.row -->
    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/category_novel/update_category_novel" role="form">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="<?php echo isset($category_novel[0]['title']) && !empty($category_novel[0]['title']) ? $category_novel[0]['title'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="sort">Sort</label>
            <input type="text" name="sort" value="<?php echo isset($category_novel[0]['sort']) && !empty($category_novel[0]['sort']) ? $category_novel[0]['sort'] : '';?>"
            class="form-control input-sm" >
        </div>
            <input type="hidden" value="<?php echo isset($category_novel[0]['id']) && !empty($category_novel[0]['id']) ? $category_novel[0]['id'] : '';?>" name="pst_id">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Update">

        </form>
    </div>
    </div>

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
