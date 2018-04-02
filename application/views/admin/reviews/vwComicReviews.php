<?php
$this->load->view('admin/vwHeader');
?>
<!--  
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->
<script src="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>tinymce/tinymce.min.js"></script>
<script>

    tinymce.init({selector: 'textarea',
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste jbimages"
        ],
        relative_urls: false,
         

    height: "300",
    width:900
    });
</script>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Reviews <small>Detail Page </small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/reviews/"><i class="icon-dashboard"></i> REVIEWS</a></li>
                <li class="active"><i class="icon-file-alt"></i> Detail Page</li>        


            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <div class="form-group" >
            <label for="title">Comic Title</label>
            <input type="text" name="comic_title" readonly="readonly" 
            value="<?php echo isset($reviews[0]['comic_title']) && !empty($reviews[0]['comic_title']) ? $reviews[0]['comic_title'] : '';?>" 
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="url">Review Title</label>
            <input type="text" name="review_title" value="<?php echo isset($reviews[0]['review_title']) 
            && !empty($reviews[0]['review_title']) ? $reviews[0]['review_title'] : '';?>" 
            readonly="readonly" class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="url">Review Title</label>
            <input type="text" name="review_title" value="<?php echo isset($reviews[0]['review_title']) 
            && !empty($reviews[0]['review_title']) ? $reviews[0]['review_title'] : '';?>" 
            readonly="readonly" class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="url">Review Content</label>
            <textarea name="description"><?php echo isset($reviews[0]['description']) 
            && !empty($reviews[0]['description']) ? $reviews[0]['description'] : '';?></textarea>
        </div>
        <div class="form-group">
            <label for="url">Rate</label>
            <input type="text" name="review_title" value="<?php echo isset($reviews[0]['rate']) 
            && !empty($reviews[0]['rate']) ? $reviews[0]['rate'] : '';?>" 
            readonly="readonly" class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="url">Review Date Added</label>
            <input type="text" name="review_title" value="<?php echo isset($reviews[0]['date_add']) 
            && !empty($reviews[0]['date_add']) ? $reviews[0]['date_add'] : '';?>" 
            readonly="readonly" class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="url">Review Added By</label>
            <input type="text" name="review_title" value="<?php echo isset($reviews[0]['nama']) 
            && !empty($reviews[0]['nama']) ? $reviews[0]['nama'] : '';?>" 
            readonly="readonly" class="form-control input-sm" >
        </div>
            <a href="<?php echo base_url(); ?>admin/reviews" class="btn btn-primary">Back to Reviews</a>
    </div>
    </div>      

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>