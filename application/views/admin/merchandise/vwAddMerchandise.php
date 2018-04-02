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
            <h1>MERCHANDISE <small>Add Page</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/merchandise/"><i class="icon-dashboard"></i> MERCHANDISE</a></li>
                <li class="active"><i class="icon-file-alt"></i> Add Page</li>


            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/merchandise/add_merchandise" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control input-sm" required placeholder="Merchandise Title">
        </div>
        <div class="form-group">
            <label for="summary">Summary</label>
            <textarea name="summary"></textarea>
        </div>

        <div class="form-group">
            <label for="category">Category </label><br>
            <?php
            foreach ($merchandise_category as $key => $value ) {?>
			<input type='radio' name='category' value='<?php echo $merchandise_category[$key]['id'];?>'/>

            <?php echo $merchandise_category[$key]['title'];?><br>
            <?php } ?>
        </div>
        <div class="form-group">
            <label for="featured_image">Cover Image</label><br>
            <input type="file" name="userfile"  size="20"/>
        </div>
		<div class="form-group">
            <label for="featured_image">Preview Image</label><br>
            <input type="file" name="gallery[]"  multiple size="20"/>
        </div>
        <div class="form-group">
            <label for="merchandise_id">Merchandise ID</label>
            <input type="text" name="merchandise_id" class="form-control input-sm" required placeholder="Merchandise ID">
        </div>
        <div class="form-group">
            <label for="url">URL</label>
            <input type="text" name="url" class="form-control input-sm" required placeholder="Merchandise URL">
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" name="harga" class="form-control input-sm" required placeholder="Merchandise Harga">
        </div>
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Publish">
        </form>
    </div>
    </div>

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
