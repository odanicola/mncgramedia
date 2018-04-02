<?php
$this->load->view('admin/vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->

      <div id="page-wrapper">

        <?php
        if(!is_null($this->session->flashdata('reg_users'))){ $message = $this->session->flashdata('reg_users');?>
            <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
        <?php } else { echo '<div></div>';}?>

        <div class="row">
          <div class="col-lg-12">
            <h1>CMS <small>Registered Users Views Module </small></h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="icon-dashboard"></i> Registered Users Views</a></li>
              <li class="active"><i class="icon-file-alt"></i> Registered Users Views</li>

            </ol>
          </div>
        </div><!-- /.row -->

            <div class="table-responsive">
              <form id="frm-example" action="<?php echo base_url(); ?>admin/reg_users/delete_all/" method="POST">
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
                    <th class="header">Nama </th>
                    <th class="header">Email </th>
                    <th class="header">No Telp </th>
                    <th class="header">No KTP</th>
                    <th class="header">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      foreach($reg_users as $key => $val){
                    ?>

                  <tr>
                    <td><input name="msg[]" value="<?php echo $val['id']; ?>" type="checkbox" /></td>
                    <td><?php if ($val['nama'] != 0) echo $val['nama']; ?></td>
                    <td><?php echo $val['email']; ?></td>
                    <td><?php echo $val['no_tlp']; ?></td>
                    <td><?php echo $val['no_ktp']; ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>admin/reg_users/detail_user/<?php echo $val['id']; ?>" class="btn btn-primary btn-xs">Detail</a>
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
