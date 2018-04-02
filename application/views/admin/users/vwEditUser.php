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
            <h1>Administrator  <small>Edit Page</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/users/"><i class="icon-dashboard"></i> Administrator</a></li>
                <li class="active"><i class="icon-file-alt"></i> Edit Page</li>        


            </ol>
        </div>
    </div><!-- /.row -->
	<?php //var_dump($user); die(); ?>
    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/users/update_user" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo $user[0]['username']?>" 
			class="form-control input-sm" required placeholder="Username">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $user[0]['email']?>"
			class="form-control input-sm" required placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control input-sm"  placeholder="Password" id="password">
        </div>
        <div class="form-group">
            <label for="repassword">Retype Password</label>
            <input type="password" name="repassword" class="form-control input-sm"  placeholder="Retype Password" id="confirm_password">
        </div>
			<input type="hidden" name="id" value="<?php echo $user[0]['id']?>"
			class="form-control input-sm">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Submit User">
        </form>
    </div>
    </div>      

</div><!-- /#page-wrapper -->
<?php
$this->load->view('admin/vwFooter');
?>