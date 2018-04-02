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

    <div class="row">
        <div class="col-lg-12">
            <h1>Novel <small>Add Page</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/novel/"><i class="icon-dashboard"></i> Novel</a></li>
                <li class="active"><i class="icon-file-alt"></i> Add Page</li>


            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/novel/add_novel" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control input-sm" required placeholder="Novel Title">
        </div>
        <!-- <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control input-sm" required placeholder="Novel Slug">
        </div> -->
        <div class="form-group">
            <label for="summary">Summary</label>
            <textarea name="summary"></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label> <br/>
            <input type="radio" value="best-seller" name="status"> Best Seller <br/>
            <input type="radio" value="editor-choice" name="status"> Editor Choice
        </div>

        <div class="form-group">
            <label for="category">Category </label><br>
            <?php
            foreach ($novel_category as $key => $value ) {?>
            <!-- <input type="checkbox" value="" name="category[]"> -->
			      <input type='radio' name='category' value='<?php echo $novel_category[$key]['id'];?>'/>
            <?php echo $novel_category[$key]['title'];?><br>
            <?php } ?>
        </div>
        <hr size="30">
        <div class="form-group">
            <label for="featured_image">Cover Image</label><br>
            <input type="file" name="cover"  size="20"/>
        </div>
        <hr size="30">
        <div class="form-group">
            <label for="backcover_image">Front & Back Cover Image</label><br>
            <input type="file" name="backcover"  size="20"/>
        </div>
        <hr size="30">
        <div class="form-group">
            <label for="featured_image">Preview Image</label><br>
            <input type="file" name="gallery[]"  multiple size="20"/>
        </div>
        <hr size="30">
        <div class="form-group">
            <label for="media_type">Media Type</label>
            <select name="media_type" class="form-control input-sm">
                <?php
                    foreach ($media_type as $key => $value) {?>
                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                <?php    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="url">URL</label>
            <input type="text" name="url" class="form-control input-sm" required placeholder="Novel URL">
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" class="form-control input-sm" required placeholder="Novel Author">
        </div>
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" class="form-control input-sm" required placeholder="Novel ISBN">
        </div>
        <div class="form-group">
            <label for="publish_date">Published Date</label>
            <input type="text" name="publish_date" class="form-control input-sm" required placeholder="Novel Publish Date" id="publish_date">
        </div>
        <div class="form-group">
            <label for="isbn">Price</label>
            <input type="text" name="price" class="form-control input-sm" required placeholder="Novel Price">
        </div>
		<div class="form-group">
            <label for="origin">Origin </label><br>
			<select name="origin" class="form-control input-sm">
            <?php
            foreach ($novel_country as $key => $value ) {?>
				<option value="<?php echo $novel_country[$key]['origin'];?>"><?php echo $novel_country[$key]['origin'];?></option>
            <?php } ?>
			</select>
        </div>
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" name="size" class="form-control input-sm" required placeholder="Novel Size">
        </div>
        <div class="form-group">
            <label for="pages">Pages</label>
            <input type="text" name="pages" class="form-control input-sm" required placeholder="Novel Pages">
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" name="tags" class="form-control input-sm" required placeholder="Novel Tags">
        </div>
        <!-- <div class="form-group">
            <label for="rate">Rate</label>
            <input type="text" name="rate" class="form-control input-sm" required placeholder="Novel Rate">
        </div> -->
        <div class="form-group">
            <label for="rate">Jenis Rate</label>
            <select name="jenis_rate" class="form-control" required="required">
                <option value="">-</option>
                <option value="R">R</option>
                <option value="S">S</option>
                <option value="DU">DU</option>
            </select>
        </div>
        <div class="form-group">
            <label for="link_download">Link Download</label>
            <input type="text" name="link_download" class="form-control input-sm" placeholder="Novel Link Download">
        </div>
        <div class="form-group">
            <label for="link_full_version">Link Full Version</label>
            <input type="text" name="link_full_version" class="form-control input-sm" placeholder="Novel Link Full Version">
        </div>
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Update">
        </form>
    </div>
    </div>

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
