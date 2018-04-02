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
            <h1>Users <small>Manage Users Module</small></h1>
            <ol class="breadcrumb">
              <li><a href="Users"><i class="icon-dashboard"></i> Users</a></li>
              <li class="active"><i class="icon-file-alt"></i> Users</li>
			  <?php if($this->session->userdata('user_type') == 'SA'):?>
				<a href="<?php echo base_url()?>admin/users/add_new" class="btn btn-primary" type="button" style="float:right;">Add New User</a>
			  <?php endif; ?>
              <div style="clear: both;"></div>
            </ol>
          </div>
        </div><!-- /.row -->
        <div class="table-responsive">
          <table class="table table-hover tablesorter">
            <thead>
              <tr>
                <th class="header">User ID <i class="fa fa-sort"></i></th>
                <th class="header">Username <i class="fa fa-sort"></i></th>
                <th class="header">Email <i class="fa fa-sort"></i></th>
              </tr>
            </thead>
            <tbody>

                <?php
                foreach($user as $key => $val){
                ?>
                
              <tr>
                <td><?php echo $val['id']; ?></td>
                <td><?php echo $val['username']; ?></td>
                <td><?php echo $val['email']; ?></td>
                <td>
					<?php if($this->session->userdata('user_type') == 'SA'):?>
						<a href="<?php echo base_url(); ?>admin/users/edit_user/<?php echo $val['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
					<?php elseif($val['id'] == $this->session->userdata('id')):?>
						<a href="<?php echo base_url(); ?>admin/users/edit_user/<?php echo $val['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
					<?php endif; ?>
					
					<?php if($val['user_type'] == 'SA'):?>
						<a href="<?php echo base_url(); ?>admin/users/delete_user/<?php echo $val['id']; ?>" class="btn btn-danger btn-xs" disabled>Delete</a>
					<?php elseif($this->session->userdata('user_type') == 'SA'): ?>
						<a href="#myModal<?php echo $val['id']; ?>" class="btn btn-danger btn-xs" data-toggle="modal" >Delete</a>
					<?php endif; ?>
					<div class="modal fade" id="myModal<?php echo $val['id']; ?>">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h3>Delete User - Confirmation Delete</h3>
								</div>
								<div class="modal-body">
									<p>Are you sure to delete this user with ID: <?php echo $val['id'];?> ?</p>
								</div>
								<div class="modal-footer">
									<a href="<?php echo base_url(); ?>admin/users/delete_user/<?php echo $val['id']; ?>" class="btn btn-danger btn-xs">Yes</a>
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