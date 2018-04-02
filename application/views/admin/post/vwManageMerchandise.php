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
            <h1>CMS <small>Merchandise Module </small><small><a href="<?php echo base_url();?>admin/merchandise/add_new" 
            class="add-new" >Add New</a></small></h1>
            <ol class="breadcrumb">
              <li><a href="COMIC"><i class="icon-dashboard"></i> Merchandise</a></li>
              <li class="active"><i class="icon-file-alt"></i> Merchandise</li>        
              
             
            </ol>
          </div>
        </div><!-- /.row -->

        
            
            <div class="table-responsive">
              <table class="table table-hover tablesorter" id="myTable">
                <thead>
                  <tr>
                    <th class="header">ID </th>
                    <th class="header">Title </th>
                    <th class="header" width="25%">Harga </th>
                    <th class="header">URL</th>
                    <th class="header" width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>

                    <?php
                    foreach($merchandise as $key => $val){
                    ?>
                    
                  <tr>
                    <td><?php echo $val['merchandise_id']; ?></td>
                    <td><?php echo $val['title']; ?></td>
                    <td><?php echo $val['harga']; ?></td>
                    <td><?php echo $val['url']; ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>admin/merchandise/edit_merchandise/<?php echo $val['merchandise_id']; ?>" class="btn btn-primary btn-xs">Edit</a>
                        <a href="<?php echo base_url(); ?>admin/merchandise/delete_merchandise/<?php echo $val['merchandise_id']; ?>" class="btn btn-danger btn-xs">Delete</a>
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