<?php
$this->load->view('admin/vwHeader');
?>
<!--  
Author      : Oda Nicola
Page        : Category Comic
Website     : http://nicolastudio.net
-->


<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Country Novel <small>Add New Page </small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/country_novel/"><i class="icon-dashboard"></i> Country Novel</a></li>
                <li class="active"><i class="icon-file-alt"></i> Add Country</li>        
            </ol>
        </div>
    </div><!-- /.row -->
    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/country_novel/add_country_novel" role="form">
        <div class="form-group">
            <label for="origin">Origin</label>
            <input type="text" name="origin" class="form-control input-sm" placeholder="Novel Origin">
        </div>
        <div class="form-group">
            <label for="sort">Sort</label>
            <input type="text" name="sort" class="form-control input-sm" placeholder="Sort">
        </div>
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Add Country">
        </form>
    </div>
    </div>      

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>