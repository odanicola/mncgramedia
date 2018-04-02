<?php
$this->load->view('admin/vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->
      <div id="page-wrapper">

        <?php
        if(!is_null($this->session->flashdata('post'))){ $message = $this->session->flashdata('post');?>
            <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
        <?php } else { echo '<div></div>';}?>

        <div class="row">
          <div class="col-lg-12">
            <h1>CMS <small>Post Module </small><small><a href="<?php echo base_url();?>admin/post/add_new"
            class="add-new" >Add New</a></small></h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="icon-dashboard"></i> Post</a></li>
              <li class="active"><i class="icon-file-alt"></i> Post</li>
            </ol>
          </div>
        </div><!-- /.row -->

            <div class="table-responsive">
              <form id="frm-example" action="<?php echo base_url(); ?>admin/post/delete_post_all/" method="POST">
              <select name="action">
          			<option value="null">Bulk Action</option>
          			<option value="delete">Delete</option>
          		</select>
              <input type="submit" name="submit" value="Delete">
              <br/><br/>
              <table class="table table-hover tablesorter" id="myTable">
                <thead>
                  <tr>
                    <th class="header">
                      <input name="select_all" value="1" id="example-select-all" type="checkbox" />
                    </th>
                    <th class="header">ID </th>
                    <th class="header">Title </th>
					          <th class="header" width="25%">Category </th>
                    <th class="header" width="25%">Tags </th>
                    <th class="header">Date Published</th>
                    <th class="header" width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach($post as $key => $val){
                  ?>
                  <tr>
                    <td><input name="msg[]" value="<?php echo $val['post_id']; ?>" type="checkbox" /></td>
                    <td><?php echo $val['post_id']; ?></td>
                    <td><?php echo $val['title']; ?></td>
					          <td>
      						  <?php
      							foreach($post_category as $cat => $value){
      								if($val['category_id'] == $value['id']){
      									echo $value['title'];
      								}
      							}
      						  ?>
					          </td>
                    <td><?php echo $val['tags']; ?></td>
                    <td><?php echo $val['date_published']; ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>admin/post/edit_post/<?php echo $val['post_id']; ?>" class="btn btn-primary btn-xs">Edit</a>
                        <a href="#myModal<?php echo $val['post_id']; ?>" data-toggle="modal" class="btn btn-danger btn-xs">Delete</a>
            						<!-- Modal -->
            						<div class="modal fade" id="myModal<?php echo $val['post_id']; ?>">
            							<div class="modal-dialog">
            								<div class="modal-content">
            									<div class="modal-header">
            										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            										<h3>Delete Post - Confirmation Delete</h3>
            									</div>
            									<div class="modal-body">
            										<p>Are you sure to delete this post with ID: <?php echo $val['post_id'];?> ?</p>
            									</div>
            									<div class="modal-footer">
            										<a href="<?php echo base_url(); ?>admin/post/delete_post/<?php echo $val['post_id']; ?>" class="btn btn-danger btn-xs">Yes</a>
            										<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">No</button>
            									</div>
            								</div>
            							</div>
            						</div>
                    </td>
                  </tr>
                 <?php
                         }
                 ?>
                </tbody>
              </table>
            </form>
            </div>


      </div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
