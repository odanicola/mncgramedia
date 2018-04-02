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
    if(isSerialized($logo[0]['logo_image'])){
        $image = unserialize($logo[0]['logo_image']);
    } else { $image = array($logo[0]['logo_image']);}
?>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>LOGO <small>Edit Page </small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/logo/"><i class="icon-dashboard"></i> LOGO</a></li>
                <li class="active"><i class="icon-file-alt"></i> Edit Page</li>        


            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/control_panel/update_logo" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="logo">Logo Image</label><br>
            <?php 
                $image_value = '';
                if (isset($logo[0]['logo_image']) && !empty($logo[0]['logo_image'])){?>
                <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $logo[0]['logo_image'];?>" height="350" class="thumbnail" style="margin-bottom: 20px">
                <?php $image_value = $logo[0]['logo_image'];?>
            <?php }
            else{ echo "No Logo Image, Insert Your Logo"; } ?>
            <input type="file" name="userfile" size="20" value="<?php echo $image_value;?>" />
        </div>
            <input type="hidden" value="<?php echo isset($logo[0]['id']) && !empty($logo[0]['id']) ? $logo[0]['id'] : '';?>" name="pst_id">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Update">
        </form>
    </div>
    </div>      

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>