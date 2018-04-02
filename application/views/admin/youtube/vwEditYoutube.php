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
            <h1>Youtube <small>Edit Page </small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/control_panel/youtube"><i class="icon-dashboard"></i> Youtube</a></li>
                <li class="active"><i class="icon-file-alt"></i> Edit Page</li>        
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/control_panel/update_youtube" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="channel_id">Channel ID</label>
            <input type="text" name="channel_id" value="<?php echo isset($youtube[0]['channel_id']) && !empty($youtube[0]['channel_id']) ? $youtube[0]['channel_id'] : '';?>" 
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="max_results">Max Results</label>
            <input type="text" name="max_results" value="<?php echo isset($youtube[0]['max_results']) && !empty($youtube[0]['max_results']) ? $youtube[0]['max_results'] : '';?>" 
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="api_key">API Key</label>
            <input type="text" name="api_key" value="<?php echo isset($youtube[0]['api_key']) && !empty($youtube[0]['api_key']) ? $youtube[0]['api_key'] : '';?>" 
            class="form-control input-sm" >
        </div>
            <input type="hidden" value="<?php echo isset($youtube[0]['id']) && !empty($youtube[0]['id']) ? $youtube[0]['id'] : '';?>" name="pst_id">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Update">
        </form>
    </div>
    </div>      

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>