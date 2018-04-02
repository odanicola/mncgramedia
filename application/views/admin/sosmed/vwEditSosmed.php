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
            <h1>SOSMED <small>Edit Page </small><small><a href="<?php echo base_url();?>admin/post/add_new" 
            class="add-new" >Add New</a></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/sosmed/"><i class="icon-dashboard"></i> SOSMED</a></li>
                <li class="active"><i class="icon-file-alt"></i> Edit Page</li>        


            </ol>
        </div>
    </div><!-- /.row -->
	<?php //var_dump($sosmed); die(); ?>
    <div class="fld col-lg-12">
    <div class="col-lg-10">
        <form method="post" action="<?php echo base_url(); ?>admin/sosmed/update_sosmed" role="form" enctype="multipart/form-data">
		<?php foreach($sosmed as $key => $value):?>
        <div class="form-group" >
            <div class="col-md-6" style="margin-bottom: 20px;">
                <label for="title">Sosmed Name</label>
                <input type="text" name="title" readonly="readonly" 
                value="<?php echo isset($value['sosmed']) && !empty($value['sosmed']) ? $value['sosmed'] : '';?>" 
                class="form-control input-sm" >
            </div>
            <div class="col-md-6" style="margin-bottom: 20px;">
                <label for="url">Url Sosmed</label>
                <input type="text" name="<?php echo $value['sosmed'] . '_url'; ?>" value="<?php echo isset($value['url']) && !empty($value['url']) ? $value['url'] : '';?>" 
                placeholder="Insert <?php echo $value['sosmed']; ?> Page URL" class="form-control input-sm" >
            </div>
        </div>
            <input type="hidden" value="<?php echo isset($value['id']) && !empty($value['id']) ? $value['id'] : '';?>" name="<?php echo $value['sosmed'] ?>">
        <?php 
			
			endforeach;
		?>
			<input type="submit" name="btn_submit" class="btn btn-primary" value="Update">
        </form>
    </div>
    </div>      

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>