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
  if(!is_null($this->session->flashdata('editcomic'))){ $message = $this->session->flashdata('editcomic');?>
      <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
  <?php } else { echo '<div></div>';}?>

    <div class="row">
        <div class="col-lg-12">
            <h1>COMIC <small>Edit Page</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/comic/"><i class="icon-dashboard"></i> COMIC</a></li>
                <li class="active"><i class="icon-file-alt"></i> Edit Page</li>
            </ol>
        </div>
    </div><!-- /.row -->
    <?php
        function isSerialized($str) {
            return ($str == serialize(false) || @unserialize($str) !== false);
        }
        if(isSerialized($comic[0]['category_id'])){
            $category_id = unserialize($comic[0]['category_id']);
        } else { $category_id = array($comic[0]['category_id']);}
        if(isSerialized($comic[0]['image_gallery'])){
            $image = unserialize($comic[0]['image_gallery']);
        } else { $image = array($comic[0]['image_gallery']);}

    ?>
    <div class="fld col-lg-12">
    <div class="col-lg-9">
        <form method="post" action="<?php echo base_url(); ?>admin/comic/update_comic_editorchoice" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="<?php echo isset($comic[0]['title']) && !empty($comic[0]['title']) ? $comic[0]['title'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" value="<?php echo isset($comic[0]['slug']) && !empty($comic[0]['slug']) ? $comic[0]['slug'] : '';?>"
            class="form-control input-sm" readonly>
        </div>
        <div class="form-group">
            <label for="summary">Summary</label>
            <textarea name="summary"><?php
            echo isset($comic[0]['summary']) && !empty($comic[0]['summary']) ? $comic[0]['summary'] : '';
            ?></textarea>
        </div>

        <div class="form-group">
            <label for="featured_image">Cover Image</label><br>
            <?php
                $image_value = '';
                if(isset($comic_image[0]['image']) && !empty($comic_image[0]['image'])) {?>
                <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $comic_image[0]['image'];?>" class="thumbnail" height="350" style="margin-bottom: 20px">
                <?php $image_value = $comic_image[0]['image'];?>
            <?php } elseif (isset($comic[0]['image']) && !empty($comic[0]['image'])){?>
                <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $comic[0]['image'];?>" height="350" class="thumbnail" style="margin-bottom: 20px">
                <?php $image_value = $comic[0]['image'];?>
            <?php }
            else{ echo "No Featured Image"; } ?>
            <input type="file" name="cover" size="20" value="<?php echo $image_value;?>" />
        </div>
        <hr size="30">
        <div class="form-group">
            <label for="featured_image">Front & Back Cover Image</label><br>
            <?php
                $image_value = '';
                if(isset($comic_image[0]['image_large']) && !empty($comic_image[0]['image_large'])) {?>
                <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $comic_image[0]['image_large'];?>" class="thumbnail" height="350" style="margin-bottom: 20px">
                <?php $image_value = $comic_image[0]['image_large'];?>
            <?php } elseif (isset($comic[0]['image_large']) && !empty($comic[0]['image_large'])){?>
                <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $comic[0]['image_large'];?>" height="350" class="thumbnail" style="margin-bottom: 20px">
                <?php $image_value = $comic[0]['image_large'];?>
            <?php }
            else{ echo "No Back Cover Image"; } ?>
            <input type="file" name="backcover" size="20" value="<?php echo $image_value;?>" />
        </div>
        <hr size="30">
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
            <label for="media_type">Media Type</label>
            <select name="media_type" class="form-control input-sm">

                <?php
                    foreach ($media_type as $key => $value) {?>
                        <option value="<?php echo $value['id']; ?>"
                        <?php
                            if($value['id'] == $comic[0]['id_media_type']) echo 'selected="selected"';
                        ?>
                        ><?php echo $value['name']; ?></option>
                <?php    }
                ?>
            </select>
        </div>
        <hr size="30">
        <div class="form-group">
            <label for="status">Status</label> <br/>
            <?php if($comic[0]['status'] == 'best-seller'): ?>
              <input type="radio" value="" name="status"> Normal <br/>
              <input type="radio" value="best-seller" name="status" checked="checked"> Best Seller <br/>
              <input type="radio" value="editor-choice" name="status"> Editor Choice
            <?php elseif($comic[0]['status'] == 'editor-choice'): ?>
              <input type="radio" value="" name="status"> Normal <br/>
              <input type="radio" value="best-seller" name="status" > Best Seller <br/>
              <input type="radio" value="editor-choice" name="status" checked="checked"> Editor Choice
            <?php else: ?>
              <input type="radio" value="" name="status"> Normal <br/>
              <input type="radio" value="best-seller" name="status"> Best Seller <br/>
              <input type="radio" value="editor-choice" name="status"> Editor Choice
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="url">URL</label>
            <input type="text" name="url" value="<?php echo isset($comic[0]['url']) && !empty($comic[0]['url']) ? $comic[0]['url'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" value="<?php echo isset($comic[0]['author']) && !empty($comic[0]['author']) ? $comic[0]['author'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" value="<?php echo isset($comic[0]['isbn']) && !empty($comic[0]['isbn']) ? $comic[0]['isbn'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="publish_date">Published Date</label>
            <input type="text" name="publish_date" class="form-control input-sm" required placeholder="Comic Publish Date" id="publish_date"
            value="<?php echo isset($comic[0]['published_date']) && !empty($comic[0]['published_date']) ? $comic[0]['published_date'] : '';?>">
        </div>
        <div class="form-group">
            <label for="isbn">Price</label>
            <input type="text" name="price" value="<?php echo isset($comic[0]['price']) && !empty($comic[0]['price']) ? $comic[0]['price'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="origin">Origin </label><br>
			<select name="origin" class="form-control input-sm">
			<option value="<?php echo $comic[0]['origin']?>"><?php echo $comic[0]['origin']?> (current)</option>
			<option>...</option>
            <?php
            foreach ($comic_country as $key => $value ) {?>
				<option value="<?php echo $comic_country[$key]['origin'];?>"><?php echo $comic_country[$key]['origin'];?></option>
            <?php } ?>
			</select>
        </div>
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" name="size" value="<?php echo isset($comic[0]['size']) && !empty($comic[0]['size']) ? $comic[0]['size'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="pages">Pages</label>
            <input type="text" name="pages" value="<?php echo isset($comic[0]['pages']) && !empty($comic[0]['pages']) ? $comic[0]['pages'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" name="tags" value="<?php echo isset($comic[0]['tags']) && !empty($comic[0]['tags']) ? $comic[0]['tags'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="rate">Jenis Rate</label>
            <select name="jenis_rate" required="required" class="form-control">
                <option value="<?php echo isset($comic[0]['jenis_rate']) && !empty($comic[0]['jenis_rate']) ? $comic[0]['jenis_rate'] : '';?>">
                  <?php echo isset($comic[0]['jenis_rate']) && !empty($comic[0]['jenis_rate']) ? $comic[0]['jenis_rate'] : '';?>
                </option>
                <option value="">-</option>
                <option value="R">R</option>
                <option value="SU">SU</option>
                <option value="D">D</option>
            </select>
        </div>
        <div class="form-group">
            <label for="link_download">Link Download</label>
            <input type="text" name="link_download" class="form-control input-sm" placeholder="Comic Link Download"
            value="<?php echo isset($comic[0]['link_download']) && !empty($comic[0]['link_download']) ? $comic[0]['link_download'] : '';?>">
        </div>
        <div class="form-group">
            <label for="link_full_version">Link Full Version</label>
            <input type="text" name="link_full_version" class="form-control input-sm" placeholder="Comic Link Full Version"
            value="<?php echo isset($comic[0]['link_full_version']) && !empty($comic[0]['link_full_version']) ? $comic[0]['link_full_version'] : '';?>">
        </div>
            <input type="hidden" value="<?php echo isset($comic[0]['id']) && !empty($comic[0]['id']) ? $comic[0]['id'] : '';?>" name="pst_id">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Update">

        </form>
    </div>
    </div>

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
