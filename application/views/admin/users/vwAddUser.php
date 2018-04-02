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
            <h1>Administrator  <small>Add Page</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/users/"><i class="icon-dashboard"></i> Administrator</a></li>
                <li class="active"><i class="icon-file-alt"></i> Add Page</li>        


            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/users/add_user" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control input-sm" required placeholder="Username">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control input-sm" required placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control input-sm" required placeholder="Password" id="password">
        </div>
        <div class="form-group">
            <label for="repassword">Retype Password</label>
            <input type="password" name="repassword" class="form-control input-sm" required placeholder="Retype Password" id="confirm_password">
        </div>
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Submit User">
        </form>
    </div>
    </div>      

</div><!-- /#page-wrapper -->
<script>
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
<?php
$this->load->view('admin/vwFooter');
?>