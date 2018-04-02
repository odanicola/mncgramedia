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
      selector: 'textarea',
      height: 500,
      theme: 'modern',
      plugins: [
      'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime media nonbreaking save table contextmenu directionality',
      'emoticons template paste textcolor colorpicker textpattern imagetools'
      ],
      toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
      toolbar2: 'print preview media | forecolor backcolor emoticons',
      image_advtab: true,
      templates: [
      { title: 'Test template 1', content: 'Test 1' },
      { title: 'Test template 2', content: 'Test 2' }
      ],
      content_css: [
      '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
      '//www.tinymce.com/css/codepen.min.css'
      ]
});
</script>

<div id="page-wrapper">

  <?php
  if(!is_null($this->session->flashdata('editmerchandise'))){ $message = $this->session->flashdata('editmerchandise');?>
      <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
  <?php } else { echo '<div></div>';}?>

    <div class="row">
        <div class="col-lg-12">
            <h1>MERCHANDISE <small>Edit Page</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/merchandise/"><i class="icon-dashboard"></i> MERCHANDISE</a></li>
                <li class="active"><i class="icon-file-alt"></i> Edit Page</li>


            </ol>
        </div>
    </div><!-- /.row -->
    <?php
        function isSerialized($str) {
            return ($str == serialize(false) || @unserialize($str) !== false);
        }
        if(isSerialized($merchandise[0]['category_id'])){
            $category_id = unserialize($merchandise[0]['category_id']);
        } else { $category_id = array($merchandise[0]['category_id']);}

        if(isSerialized($merchandise[0]['image_gallery'])){
            $image = unserialize($merchandise[0]['image_gallery']);
        } else { $image = array($merchandise[0]['image_gallery']);}

    ?>
    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/merchandise/update_merchandise" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="<?php echo isset($merchandise[0]['title']) && !empty($merchandise[0]['title']) ? $merchandise[0]['title'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" value="<?php echo isset($merchandise[0]['slug']) && !empty($merchandise[0]['slug']) ? $merchandise[0]['slug'] : '';?>"
            class="form-control input-sm" readonly>
        </div>
        <div class="form-group">
            <label for="summary">Summary</label>
            <textarea name="summary"><?php
            echo isset($merchandise[0]['summary']) && !empty($merchandise[0]['summary']) ? $merchandise[0]['summary'] : '';
            ?></textarea>
        </div>

        <div class="form-group">
            <label for="category">Category </label><br>
                <?php
                foreach ($merchandise_category as $key => $value ) {?>

                    <input type='radio' name='category' value='<?php echo $merchandise_category[$key]['id'];?>'

                    <?php foreach ($category_id as $cat_key => $cat_value) {?>
                        <?php if ($category_id[$cat_key] ==  $merchandise_category[$key]['id']) {
                        echo "checked";} ?>
                    <?php
                        }
                    ?>
                    name="category[]">
                    <?php echo $merchandise_category[$key]['title'];?><br>
                <?php } ?>

        </div>
        <div class="form-group">
            <label for="featured_image">Cover Image</label><br>
            <?php
                $image_value = '';
            ?>
            <?php if (isset($merchandise[0]['image']) && !empty($merchandise[0]['image'])){?>
                <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $merchandise[0]['image'];?>" height="350" class="thumbnail" style="margin-bottom: 20px">
                <?php $image_value = $merchandise[0]['image'];?>
            <?php }
            else{ echo "No Featured Image"; } ?>
            <input type="file" name="userfile" size="20" value="<?php echo $image_value;?>" />
        </div>
        <div class="form-group">
            <label for="gallery_images">Preview Images</label><br>
            <?php if(isset($image) && !empty($image)) {?>
                <ul style="list-style:none;" class="col-lg-9">
                <?php
                    foreach ($image as $key => $value) { ?>
                       <li class="col-md-3"><img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $value;?>" height="120" style="margin-bottom: 20px" class="thumbnail"></li>
                <?php }
                ?>
                </ul>
            <?php }
            else{ echo "No Featured Image"; } ?>
            <input type="file" name="gallery[]" multiple size="20" />
        </div>
        <div class="form-group">
            <label for="merchandise_id">Merchandise ID</label>
            <input type="text" name="merchandise_id" class="form-control input-sm" required placeholder="Merchandise ID" readonly="readonly"
            value="<?php echo isset($merchandise[0]['merchandise_id']) && !empty($merchandise[0]['merchandise_id']) ? $merchandise[0]['merchandise_id'] : '';?>">
        </div>
        <div class="form-group">
            <label for="url">URL</label>
            <input type="text" name="url" required placeholder="Merchandise URL"
            value="<?php echo isset($merchandise[0]['url']) && !empty($merchandise[0]['url']) ? $merchandise[0]['url'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" name="harga" required placeholder="Merchandise Harga"
            value="<?php echo isset($merchandise[0]['harga']) && !empty($merchandise[0]['harga']) ? $merchandise[0]['harga'] : '';?>"
            class="form-control input-sm" >
        </div>
            <input type="hidden" value="<?php echo isset($merchandise[0]['merchandise_id']) && !empty($merchandise[0]['merchandise_id']) ? $merchandise[0]['merchandise_id'] : '';?>" name="pst_id">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Update">
        </form>
    </div>
    </div>

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
