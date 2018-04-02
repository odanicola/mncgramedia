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
            <h1>Twitter <small>Edit Page </small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/control_panel/twitter"><i class="icon-dashboard"></i> Twitter</a></li>
                <li class="active"><i class="icon-file-alt"></i> Edit Page</li>        
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/control_panel/update_twitter" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" rows="8"><?php  
            echo isset($twitter[0]['content']) && !empty($twitter[0]['content']) ? $twitter[0]['content'] : '';     
            ?></textarea>
        </div>
            <input type="hidden" value="<?php echo isset($twitter[0]['id']) && !empty($twitter[0]['id']) ? $twitter[0]['id'] : '';?>" name="pst_id">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Update">
        </form>
    </div>
    </div>      

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>