<?php
$this->load->view('admin/vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->
      <div id="page-wrapper">
        <?php
        if(!is_null($this->session->flashdata('category_post'))){ $message = $this->session->flashdata('category_post');?>
            <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
        <?php } else { echo '<div></div>';}?>
        <div class="row">
          <div class="col-lg-12">
            <h1>CMS <small>Category Post </small><small><a href="<?php echo base_url();?>admin/category_post/add_new"
            class="add-new" >Add New</a></small></h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="icon-dashboard"></i> Category Post</a></li>
              <li class="active"><i class="icon-file-alt"></i> Post</li>

            </ol>
          </div>
        </div><!-- /.row -->



            <div class="table-responsive">
              <table class="table table-hover tablesorter" id="myTable">
                <thead>
                  <tr>
                    <th class="header">ID </th>
                    <th class="header">Title </th>
                    <th class="header">Sort</th>
                    <th class="header" width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      foreach($category_post as $key => $val){
                    ?>
                  <tr>
                    <td><?php echo $val['id']; ?></td>
                    <td><?php echo $val['title']; ?></td>
                    <td><?php echo $val['sort']; ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>admin/category_post/edit_category_post/<?php echo $val['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
                        <a href="#myModal<?php echo $val['id']; ?>" data-toggle="modal" class="btn btn-danger btn-xs">Delete</a>

                        <!-- Modal -->
            						<div class="modal fade" id="myModal<?php echo $val['id']; ?>">
            							<div class="modal-dialog">
            								<div class="modal-content">
            									<div class="modal-header">
            										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            										<h3>Delete Category - Confirmation Delete</h3>
            									</div>
            									<div class="modal-body">
            										<p>Are you sure to delete this category with ID: <?php echo $val['id'];?> ?</p>
            									</div>
            									<div class="modal-footer">
            										<a href="<?php echo base_url(); ?>admin/category_post/delete_category_post/<?php echo $val['id']; ?>" class="btn btn-danger btn-xs">Yes</a>
            										<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">No</button>
            									</div>
            								</div>
            							</div>
            						</div>
                        <!-- End Modal -->
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
      </div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
