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
            <h1>Category Novel <small>Add New Page </small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/category_novel/"><i class="icon-dashboard"></i> Category Novel</a></li>
                <li class="active"><i class="icon-file-alt"></i> Add Category</li>        


            </ol>
        </div>
    </div><!-- /.row -->
    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/category_novel/add_category_novel" role="form">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="sort">Sort</label>
            <input type="text" name="sort" class="form-control input-sm" >
        </div>
        <div class="form-group">
            <label for="sort">Media Type</label>
            <select name="media_type" class="form-control input-sm">
                <?php
                    foreach ($media_type as $key => $value) {?>
                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option> 
                <?php    }
                ?>
            </select>
           
        </div> 
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Add Category">
       
        </form>
    </div>
    </div>      

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>