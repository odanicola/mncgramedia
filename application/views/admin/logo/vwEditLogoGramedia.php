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
            <h1>LOGO Gramedia<small> Edit Page </small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/logo_gramedia/"><i class="icon-dashboard"></i> Logo Gramedia</a></li>
                <li class="active"><i class="icon-file-alt"></i> Edit Page</li>        


            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/control_panel/update_logo_gramedia" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="logo">Logo Image</label><br>
			<ul>
			
				<li style="background-color:#999999; list-style:none; padding:15px; width: 350px; margin: 15px;">
					<input type="radio" value="<?php echo 'logo-gramedia-1.png'; ?>" 
					<?php if($logo[0]['logo_image'] == 'logo-gramedia-1.png') echo 'checked'; ?> name="logo_gramedia"> 
					<img src="<?php echo HTTP_IMAGES_PATH . 'logo-gramedia-1.png'; ?>">
				</li>
				<li style="background-color:#999999; list-style:none; padding:15px; width: 350px; margin: 15px;">
					<input type="radio" value="<?php echo 'logo-gramedia-2.png'; ?>" 
					<?php if($logo[0]['logo_image'] == 'logo-gramedia-2.png') echo 'checked'; ?> name="logo_gramedia"> 
					<img src="<?php echo HTTP_IMAGES_PATH . 'logo-gramedia-2.png'; ?>">
				</li>
				<li style="background-color:#999999; list-style:none; padding:15px; width: 350px; margin: 15px;">
					<input type="radio" value="<?php echo 'logo-gramedia-3.png'; ?>" 
					<?php if($logo[0]['logo_image'] == 'logo-gramedia-3.png') echo 'checked'; ?> name="logo_gramedia"> 
					<img src="<?php echo HTTP_IMAGES_PATH . 'logo-gramedia-3.png'; ?>">
				</li>
			</ul>
        </div>
            <input type="hidden" value="<?php echo '2'; ?>" name="pst_id">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Update">
        </form>
    </div>
    </div>      

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>