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
            <h1>Contact Message <small>Detail Page</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/contactus/"><i class="icon-dashboard"></i> Contact</a></li>
                <li class="active"><i class="icon-file-alt"></i> Detail Page</li>        


            </ol>
        </div>
    </div><!-- /.row -->
    
    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" value="<?php echo isset($contact[0]['fullname']) && !empty($contact[0]['fullname']) ? $contact[0]['fullname'] : '';?>" 
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="summary">Message</label>
            <textarea name="summary"><?php  
            echo isset($contact[0]['message']) && !empty($contact[0]['message']) ? $contact[0]['message'] : '';     
            ?></textarea>
        </div>
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" name="id" class="form-control input-sm" required readonly="readonly"
            value="<?php echo isset($contact[0]['id']) && !empty($contact[0]['id']) ? $contact[0]['id'] : '';?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" required 
            value="<?php echo isset($contact[0]['email']) && !empty($contact[0]['email']) ? $contact[0]['email'] : '';?>" 
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="date_sent">Date Sent</label>
            <input type="text" name="date_sent" required 
            value="<?php echo isset($contact[0]['date_sent']) && !empty($contact[0]['date_sent']) ? $contact[0]['date_sent'] : '';?>" 
            class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="date_sent">Time Sent</label>
            <input type="text" name="date_sent" required 
            value="<?php echo isset($contact[0]['time_sent']) && !empty($contact[0]['time_sent']) ? $contact[0]['time_sent'] : '';?>" 
            class="form-control input-sm" >
        </div>
            <input type="hidden" value="<?php echo isset($contact[0]['id']) && !empty($contact[0]['id']) ? $contact[0]['id'] : '';?>" name="pst_id"> 
            <a href="<?php echo base_url()?>admin/contactus" class="btn btn-primary" value="Back to Contact Page">
    </div>
    </div>      

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>