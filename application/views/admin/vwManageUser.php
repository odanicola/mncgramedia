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
              <a href="<?php echo base_url()?>admin/users/add_new" class="btn btn-primary" type="button" style="float:right;">Add New User</a>
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
                    <a href="<?php echo base_url(); ?>admin/users/edit_user/<?php echo $val['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
                    <a href="<?php echo base_url(); ?>admin/users/delete_user/<?php echo $val['id']; ?>" class="btn btn-danger btn-xs">Delete</a>
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