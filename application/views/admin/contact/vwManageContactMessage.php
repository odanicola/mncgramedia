<?php
$this->load->view('admin/vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->

      <div id="page-wrapper">

        <?php
        if(!is_null($this->session->flashdata('contactus'))){ $message = $this->session->flashdata('contactus');?>
            <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
        <?php } else { echo '<div></div>';}?>

        <div class="row">
          <div class="col-lg-12">
            <h1>CMS <small>Contact Data Module </small></h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="icon-dashboard"></i> Contact Data</a></li>
              <li class="active"><i class="icon-file-alt"></i> Contact Data</li>

            </ol>
          </div>
        </div><!-- /.row -->

            <div class="table-responsive">
              <form id="frm-example" action="<?php echo base_url(); ?>admin/contactus/delete_contact_all/" method="POST">
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
                    <th class="header">Full Name </th>
                    <th class="header">Email </th>
                    <th class="header">Message</th>
                    <th class="header" width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>

                    <?php
                    foreach($contact as $key => $val){
                    ?>

                  <tr>
                    <td><input name="msg[]" value="<?php echo $val['id']; ?>" type="checkbox" /></td>
                    <td><?php echo $val['id']; ?></td>
                    <td><?php echo $val['fullname']; ?></td>
                    <td><?php echo $val['email']; ?></td>
                    <td><?php echo $val['message']; ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>admin/contactus/detail_contact/<?php echo $val['id']; ?>" class="btn btn-primary btn-xs">Detail</a>

						<a href="#myModal<?php echo $val['id']; ?>" data-toggle="modal" class="btn btn-danger btn-xs">Delete</a>
						<!-- Modal -->
						<div class="modal fade" id="myModal<?php echo $val['id']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h3>Delete Contact Data - Confirmation Delete</h3>
									</div>
									<div class="modal-body">
										<p>Are you sure to delete this data with ID: <?php echo $val['id'];?> ?</p>
									</div>
									<div class="modal-footer">
										<a href="<?php echo base_url(); ?>admin/contactus/delete_contact/<?php echo $val['id']; ?>" class="btn btn-danger btn-xs">Yes</a>
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
