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
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
        relative_urls: false,


    height: "500",
    width:900
    });
</script>

<div id="page-wrapper">
  <?php
  if(!is_null($this->session->flashdata('editnovel'))){ $message = $this->session->flashdata('editnovel');?>
      <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
  <?php } else { echo '<div></div>';}?>

    <div class="row">
        <div class="col-lg-12">
            <h1>Novel <small>Edit Page</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/novel/"><i class="icon-dashboard"></i> Novel</a></li>
                <li class="active"><i class="icon-file-alt"></i> Edit Page</li>


            </ol>
        </div>
    </div><!-- /.row -->
    <?php
        function isSerialized($str) {
            return ($str == serialize(false) || @unserialize($str) !== false);
        }
        /*if(isSerialized($novel[0]['category_id'])){
            $category_id = unserialize($novel[0]['category_id']);
        } else { $category_id = array($novel[0]['category_id']);}*/
		$category_id = explode(",",$novel[0]['category_id']);

        if(isSerialized($novel[0]['image_gallery'])){
            $image = unserialize($novel[0]['image_gallery']);
        } else { $image = array($novel[0]['image_gallery']);}

    ?>
    <div class="fld col-lg-12">
    <div class="col-lg-9">
        <form method="post" action="<?php echo base_url(); ?>admin/novel/update_novel_bestseller" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="<?php echo isset($novel[0]['title']) && !empty($novel[0]['title']) ? $novel[0]['title'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" value="<?php echo isset($novel[0]['slug']) && !empty($novel[0]['slug']) ? $novel[0]['slug'] : '';?>"
            class="form-control input-sm" readonly>
        </div>
        <div class="form-group">
            <label for="summary">Summary</label>
            <textarea name="summary"><?php
            echo isset($novel[0]['summary']) && !empty($novel[0]['summary']) ? $novel[0]['summary'] : '';
            ?></textarea>
        </div>

        <div class="form-group">
            <label for="category">Category </label><br>
                <?php
                foreach ($novel_category as $key => $value ) {?>

                    <!-- <input type="checkbox" value="<?php //echo $novel_category[$key]['id'];?>" -->
					          <input type="radio" name="category[]" value="<?php echo $novel_category[$key]['id'];?>"

                    <?php foreach ($category_id as $cat_key => $cat_value) {?>
                        <?php if ($category_id[$cat_key] ==  $novel_category[$key]['id']) {
                        echo "checked";} ?>
                    <?php
                        }
                    ?>

                    name="category[]">
                    <?php echo $novel_category[$key]['title'];?><br>
                <?php } ?>

        </div>
        <div class="form-group">
            <label for="featured_image">Cover Image</label><br>
            <?php
                $image_value = '';
                if(isset($novel_image[0]['image']) && !empty($novel_image[0]['image'])) {?>
                <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $novel_image[0]['image'];?>" class="thumbnail" height="350" style="margin-bottom: 20px">
                <?php $image_value = $novel_image[0]['image'];?>
            <?php } elseif (isset($novel[0]['image']) && !empty($novel[0]['image'])){?>
                <img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $novel[0]['image'];?>" height="350" class="thumbnail" style="margin-bottom: 20px">
                <?php $image_value = $novel[0]['image'];?>
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
            <label for="media_type">Media Type</label>
            <select name="media_type" class="form-control input-sm">

                <?php
                    foreach ($media_type as $key => $value) {?>
                        <option value="<?php echo $value['id']; ?>"
                        <?php
                            if($value['id'] == $novel[0]['id_media_type']) echo 'selected="selected"';
                        ?>
                        ><?php echo $value['name']; ?></option>
                <?php    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status</label> <br/>
            <?php if($novel[0]['status'] == 'best-seller'): ?>
              <input type="radio" value="" name="status"> Normal <br/>
              <input type="radio" value="best-seller" name="status" checked="checked"> Best Seller <br/>
              <input type="radio" value="editor-choice" name="status"> Editor Choice
            <?php elseif($novel[0]['status'] == 'editor-choice'): ?>
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
            <input type="text" name="url" value="<?php echo isset($novel[0]['url']) && !empty($novel[0]['url']) ? $novel[0]['url'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" value="<?php echo isset($novel[0]['author']) && !empty($novel[0]['author']) ? $novel[0]['author'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" value="<?php echo isset($novel[0]['isbn']) && !empty($novel[0]['isbn']) ? $novel[0]['isbn'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="publish_date">Published Date</label>
            <input type="text" name="publish_date" class="form-control input-sm" required placeholder="Novel Publish Date" id="publish_date"
            value="<?php echo isset($novel[0]['published_date']) && !empty($novel[0]['published_date']) ? $novel[0]['published_date'] : '';?>">
        </div>
        <div class="form-group">
            <label for="isbn">Price</label>
            <input type="text" name="price" value="<?php echo isset($novel[0]['price']) && !empty($novel[0]['price']) ? $novel[0]['price'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="origin">Origin </label><br>
			<select name="origin" class="form-control input-sm">
			<option value="<?php echo $novel[0]['origin']?>"><?php echo $novel[0]['origin']?> (current)</option>
			<option>...</option>
            <?php
            foreach ($novel_country as $key => $value ) {?>
				<option value="<?php echo $novel_country[$key]['origin'];?>"><?php echo $novel_country[$key]['origin'];?></option>
            <?php } ?>
			</select>
        </div>
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" name="size" value="<?php echo isset($novel[0]['size']) && !empty($novel[0]['size']) ? $novel[0]['size'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="pages">Pages</label>
            <input type="text" name="pages" value="<?php echo isset($novel[0]['pages']) && !empty($novel[0]['pages']) ? $novel[0]['pages'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" name="tags" value="<?php echo isset($novel[0]['tags']) && !empty($novel[0]['tags']) ? $novel[0]['tags'] : '';?>"
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="rate">Jenis Rate</label>
            <select name="jenis_rate" required="required" class="form-control">
                <option value="<?php echo isset($novel[0]['jenis_rate']) && !empty($novel[0]['jenis_rate']) ? $novel[0]['jenis_rate'] : '';?>">
                  <?php echo isset($novel[0]['jenis_rate']) && !empty($novel[0]['jenis_rate']) ? $novel[0]['jenis_rate'] : '';?>
                </option>
                <option value="">-</option>
                <option value="R">R</option>
                <option value="S">S</option>
                <option value="DU">DU</option>
            </select>
        </div>
        <div class="form-group">
            <label for="link_download">Link Download</label>
            <input type="text" name="link_download" class="form-control input-sm" placeholder="Novel Link Download"
            value="<?php echo isset($novel[0]['link_download']) && !empty($novel[0]['link_download']) ? $novel[0]['link_download'] : '';?>">
        </div>
        <div class="form-group">
            <label for="link_full_version">Link Full Version</label>
            <input type="text" name="link_full_version" class="form-control input-sm" placeholder="Novel Link Full Version"
            value="<?php echo isset($novel[0]['link_full_version']) && !empty($novel[0]['link_full_version']) ? $novel[0]['link_full_version'] : '';?>">
        </div>
            <input type="hidden" value="<?php echo isset($novel[0]['id']) && !empty($novel[0]['id']) ? $novel[0]['id'] : '';?>" name="pst_id">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Update">

        </form>
    </div>
    </div>

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
