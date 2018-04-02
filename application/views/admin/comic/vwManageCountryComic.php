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
            <h1>CMS <small>Country Comic </small><small><a href="<?php echo base_url();?>admin/country_comic/add_new" 
            class="add-new" >Add New</a></small></h1>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url()?>admin/country_comic"><i class="icon-dashboard"></i> Country Comic</a></li>
              <li class="active"><i class="icon-file-alt"></i> COMIC</li>       
             
            </ol>
          </div>
        </div><!-- /.row -->            
            <div class="table-responsive">
              <table class="table table-hover tablesorter" id="myTable">
                <thead>
                  <tr>
                    <th class="header">Origin </th>
                    <th class="header">Sort</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($country_comic as $key => $val){
                    ?>
                  <tr>
                    <td><?php echo $val['origin']; ?></td>
                    <td><?php echo $val['sort']; ?></td>
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