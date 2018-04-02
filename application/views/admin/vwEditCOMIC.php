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
        var_dump($image);
        die();
    ?>
    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/comic/update_comic" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="<?php echo isset($comic[0]['title']) && !empty($comic[0]['title']) ? $comic[0]['title'] : '';?>" 
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="summary">Summary</label>
            <textarea name="summary"><?php  
            echo isset($comic[0]['summary']) && !empty($comic[0]['summary']) ? $comic[0]['summary'] : '';     
            ?></textarea>
        </div>

        <div class="form-group">
            <label for="category">Category </label><br>
                <?php 
                foreach ($comic_category as $key => $value ) {?>
                    
                    <input type="checkbox" value="<?php echo $comic_category[$key]['id'];?>" 

                    <?php foreach ($category_id as $cat_key => $cat_value) {?>
                        <?php if ($category_id[$cat_key] ==  $comic_category[$key]['id']) { 
                        echo "checked";} ?>
                    <?php        
                        }
                    ?>

                    name="category[]">
                    <?php echo $comic_category[$key]['title'];?><br>
                <?php } ?>
                    
        </div>
        <div class="form-group">
            <label for="featured_image">Featured Image</label><br>
            <?php if(isset($comic_image[0]['image']) && !empty($comic_image[0]['image'])) {?><img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $comic_image[0]['image'];?>"
            height="350" style="margin-bottom: 20px"><?php }
            else{ echo "No Featured Image"; } ?>
            <input type="file" name="userfile" size="20" value="<?php echo $comic_image[0]['image'];?>" />
        </div>
        <div class="form-group">
            <label for="gallery_images">Gallery Images</label><br>
            <?php if(isset($image) && !empty($image) {?>
                <ul style="display:inline-block">
                <?php 
                    foreach ($image as $key => $value) { ?>
                       <li><img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $image;?>" height="30" style="margin-bottom: 20px"></li>
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
            <input type="text" name="publish_date" class="form-control input-sm" required placeholder="Comic Publish Date" 
            value="<?php echo isset($comic[0]['published_date']) && !empty($comic[0]['published_date']) ? $comic[0]['published_date'] : '';?>" id="publish_date">
        </div>
        <div class="form-group">
            <label for="isbn">Price</label>
            <input type="text" name="price" value="<?php echo isset($comic[0]['price']) && !empty($comic[0]['price']) ? $comic[0]['price'] : '';?>" 
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="origin">Origin</label>
            <input type="text" name="origin" value="<?php echo isset($comic[0]['origin']) && !empty($comic[0]['origin']) ? $comic[0]['origin'] : '';?>" 
            class="form-control input-sm" >
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
            <label for="rate">Rate</label>
            <input type="text" name="rate" value="<?php echo isset($comic[0]['rate']) && !empty($comic[0]['rate']) ? $comic[0]['rate'] : '';?>" 
            class="form-control input-sm" >
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
		<div class="form-group">
            <label for="status_publish">Status Publish</label>
			<select name="status_publish">
				<option value=""></option>
			</select>
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