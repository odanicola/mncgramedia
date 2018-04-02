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
            <h1>Banner <small>Add Page </small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/control_panel/banner"><i class="icon-dashboard"></i> Banner</a></li>
                <li class="active"><i class="icon-file-alt"></i> Add Page</li>        


            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
    <div class="col-lg-10">
		<h3>Banner Ads 250x250</h3>
        <form method="post" action="<?php echo base_url(); ?>admin/control_panel/add_banner" role="form" enctype="multipart/form-data">
		<div id="left_banner" class="col-lg-10 left_banner">
			<div class="col-lg-5">
				<div class="form-group">
					<label for="featured_image">Banner Image</label><br>
					<input type="file" name="userfile" size="20" />
				</div>
			</div>
			<div class="col-lg-5">
				<div class="form-group">
					<label for="url">Banner URL</label><br>
					<input type="text" name="url" class="form-control input-sm">
				</div>
				<div class="form-group">
					<label for="url">Banner Position</label><br>
					<select name="position" class="form-control input-sm">
						<option value="left">Left</option>
						<option value="right">Right</option>
						<option value="middle">Middle</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-lg-10">
			<input type="submit" name="btn_submit" class="btn btn-primary" value="Update">
		</div>
		</form>
		
    </div>
    </div>      

</div><!-- /#page-wrapper -->
<script>
$(document).ready(function(){
    $("#left_banner_btn_plus").click(function(){
		//console.log(key);
		i = 1;
		$("div#left_banner").clone().addClass("left_add_"+i).insertAfter($("#left_banner")).append('<button id="left_banner_btn_minus"><span class="glyphicon glyphicon-minus"><span></button>');
		i++;
	});
	$("#left_banner_btn_minus").on("click",function(){
		//$("#left_banner").removeClass();
		alert('test');
	});
});

</script>
<?php
$this->load->view('admin/vwFooter');
?>