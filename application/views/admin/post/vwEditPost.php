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
  if(!is_null($this->session->flashdata('editpost'))){ $message = $this->session->flashdata('editpost');?>
      <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
  <?php } else { echo '<div></div>';}?>

    <div class="row">
        <div class="col-lg-12">
            <h1>POST <small>Edit Page </small><small><a href="<?php echo base_url();?>admin/post/add_new"
            class="add-new" >Add New</a></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/post/"><i class="icon-dashboard"></i> POST</a></li>
                <li class="active"><i class="icon-file-alt"></i> Edit Page</li>


            </ol>
        </div>
    </div><!-- /.row -->
    <?php
        function isSerialized($str) {
            return ($str == serialize(false) || @unserialize($str) !== false);
        }
        if(isSerialized($post[0]['category_id'])){
            $category_id = unserialize($post[0]['category_id']);
        } else { $category_id = array($post[0]['category_id']);}

    ?>
    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/post/update_post" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="<?php echo isset($post[0]['title']) && !empty($post[0]['title']) ? $post[0]['title'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" value="<?php echo isset($post[0]['slug']) && !empty($post[0]['slug']) ? $post[0]['slug'] : '';?>"
            class="form-control input-sm" readonly >
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content"><?php
            echo isset($post[0]['content']) && !empty($post[0]['content']) ? htmlspecialchars_decode($post[0]['content']) : '';
            ?></textarea>
        </div>

        <div class="form-group">
            <label for="category">Category </label><br>
                <?php
                foreach ($post_category as $key => $value ) {?>
                    <input type="radio" value="<?php echo $post_category[$key]['id'];?>"


                    <?php foreach ($category_id as $cat_key => $cat_value) {?>
                        <?php if ($category_id[$cat_key] ==  $post_category[$key]['id']) {
                        echo "checked";} ?>
                    <?php
                        }
                    ?>
                    name="category">
                    <?php echo $post_category[$key]['title'];?><br>
                <?php } ?>

        </div>
        <div class="form-group">
            <label for="featured_image">Featured Image</label><br>
            <?php
                $image_value = '';
            ?>
            <?php if (isset($post[0]['image']) && !empty($post[0]['image'])){?>
                <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $post[0]['image'];?>" height="350" class="thumbnail" style="margin-bottom: 20px">
                <?php $image_value = $post[0]['image'];?>
            <?php }
            else{ echo "No Featured Image"; } ?>
            <input type="file" name="userfile" size="20" value="<?php echo $image_value;?>" />
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" name="tags" class="form-control input-sm" required placeholder="Tags Post"
            value="<?php echo isset($post[0]['tags']) && !empty($post[0]['tags']) ? $post[0]['tags'] : '';?>">
        </div>
            <input type="hidden" value="<?php echo isset($post[0]['post_id']) && !empty($post[0]['post_id']) ? $post[0]['post_id'] : '';?>" name="pst_id">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Update">
        </form>
    </div>
    </div>

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
