<?php
$this->load->view('admin/vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->

      <div id="page-wrapper">
        <?php
        if(!is_null($this->session->flashdata('banner'))){ $message = $this->session->flashdata('banner');?>
            <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
        <?php } else { echo '<div></div>';}?>
        <div class="row">
          <div class="col-lg-12">
            <h1>Banner <small>Banner Module </small><small><a href="<?php echo base_url();?>admin/control_panel/add_banner_new"
            class="add-new" >Add New</a></small></h1>
            <ol class="breadcrumb">
              <li><a href="COMIC"><i class="icon-dashboard"></i> Banner</a></li>
              <li class="active"><i class="icon-file-alt"></i> Banner</li>
            </ol>
          </div>
        </div><!-- /.row -->
            <div class="table-responsive">
              <table class="table table-hover tablesorter" id="myTable">
                <thead>
                  <tr>
                    <th class="header">ID </th>
                    <th class="header">URL </th>
                    <th class="header">Position </th>
					<th class="header">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($banner as $key => $val){
                    ?>
                  <tr>
                    <td><?php echo $val['id']; ?></td>
                    <td><?php echo $val['url']; ?></td>
                    <td><?php echo $val['position']; ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>admin/control_panel/edit_banner/<?php echo $val['id']; ?>" class="btn btn-primary btn-xs">Edit</a>

						<a href="#myModal<?php echo $val['id']; ?>" data-toggle="modal" class="btn btn-danger btn-xs">Delete</a>
						<!-- Modal -->
						<div class="modal fade" id="myModal<?php echo $val['id']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h3>Delete Banner - Confirmation Delete</h3>
									</div>
									<div class="modal-body">
										<p>Are you sure to delete this banner with ID: <?php echo $val['id'];?> ?</p>
									</div>
									<div class="modal-footer">
										<a href="<?php echo base_url(); ?>admin/control_panel/delete_banner/<?php echo $val['id']; ?>" class="btn btn-danger btn-xs">Yes</a>
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
            </div>


      </div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
