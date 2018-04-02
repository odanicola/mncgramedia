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
            <h1>Category Merchandise <small>Add New Page </small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/category_merchandise/"><i class="icon-dashboard"></i> Category Merchandise</a></li>
                <li class="active"><i class="icon-file-alt"></i> Add Category</li>        


            </ol>
        </div>
    </div><!-- /.row -->
    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/category_merchandise/add_category_merchandise" role="form">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="sort">Sort</label>
            <input type="text" name="sort" class="form-control input-sm" >
        </div>
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Add Category">
        </form>
    </div>
    </div>      

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>