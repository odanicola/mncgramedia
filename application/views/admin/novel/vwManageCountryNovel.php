<?php
$this->load->view('admin/vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->

      <div id="page-wrapper">
        <?php
        if(!is_null($this->session->flashdata('country_novel'))){ $message = $this->session->flashdata('country_novel');?>
            <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
        <?php } else { echo '<div></div>';}?>

        <div class="row">
          <div class="col-lg-12">
            <h1>CMS <small>Country Novel </small><small><a href="<?php echo base_url();?>admin/country_novel/add_new"
            class="add-new" >Add New</a></small></h1>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url()?>admin/country_novel"><i class="icon-dashboard"></i> Country Novel</a></li>
              <li class="active"><i class="icon-file-alt"></i> Novel</li>

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
                    foreach($country_novel as $key => $val){
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
