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
        relative_urls: false,
         

    height: "300",
    width:900
    });
</script>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Registered User <small>Detail Page </small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/reviews/"><i class="icon-dashboard"></i> Registered User</a></li>
                <li class="active"><i class="icon-file-alt"></i> Detail Page</li>        
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <div class="form-group" >
            <label for="nama">Nama Pengguna</label>
            <input type="text" name="nama" readonly="readonly" 
            value="<?php echo isset($reg_users[0]['nama']) && !empty($reg_users[0]['nama']) ? $reg_users[0]['nama'] : '';?>" 
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" value="<?php echo isset($reg_users[0]['alamat']) 
            && !empty($reg_users[0]['alamat']) ? $reg_users[0]['alamat'] : '';?>" 
            readonly="readonly" class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="alamat">Email</label>
            <input type="text" name="email" value="<?php echo isset($reg_users[0]['email']) 
            && !empty($reg_users[0]['email']) ? $reg_users[0]['email'] : '';?>" 
            readonly="readonly" class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="url">No KTP</label>
            <input type="text" name="no_ktp" value="<?php echo isset($reg_users[0]['no_ktp']) 
            && !empty($reg_users[0]['no_ktp']) ? $reg_users[0]['no_ktp'] : '';?>" readonly="readonly" class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="url">No Telp</label>
            <input type="text" name="no_tlp" value="<?php echo isset($reg_users[0]['no_tlp']) 
            && !empty($reg_users[0]['no_tlp']) ? $reg_users[0]['no_tlp'] : '';?>" 
            readonly="readonly" class="form-control input-sm" >
        </div>
            <a href="<?php echo base_url(); ?>admin/reg_users" class="btn btn-primary">Back to Users</a>
    </div>
    </div>      

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>