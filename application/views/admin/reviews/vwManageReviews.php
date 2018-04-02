<?php
$this->load->view('admin/vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->

      <div id="page-wrapper">

        <?php
        if(!is_null($this->session->flashdata('reviews'))){ $message = $this->session->flashdata('reviews');?>
            <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
        <?php } else { echo '<div></div>';}?>

        <div class="row">
          <div class="col-lg-12">
            <h1>CMS <small>Comic Reviews Module </small></h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="icon-dashboard"></i> COMIC Reviews</a></li>
              <li class="active"><i class="icon-file-alt"></i> COMIC Reviews</li>


            </ol>
          </div>
        </div><!-- /.row -->



            <div class="table-responsive">
              <form id="frm-example" action="<?php echo base_url(); ?>admin/reviews/delete_review_all/" method="POST">
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
                    <th class="header">Comic Title </th>
                    <th class="header">Reviews Title </th>
                    <th class="header">Rate </th>
                    <th class="header">Date </th>
                    <th class="header">User </th>
                    <th class="header" width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>

                    <?php
                    foreach($reviews as $key => $val){
                    ?>

                  <tr>
                    <td><input name="msg[]" value="<?php echo $val['review_id']; ?>" type="checkbox" /></td>
                    <td><?php echo $val['comic_title']; ?></td>
                    <td><?php echo $val['review_title']; ?></td>
                    <td><?php echo $val['rate']; ?></td>
                    <td><?php echo $val['date_add']; ?></td>
                    <td><?php echo $val['nama']; ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>admin/reviews/review_detail/<?php echo $val['review_id']; ?>" class="btn btn-primary btn-xs">Detail</a>
                        <a href="<?php echo base_url(); ?>admin/reviews/delete_review/<?php echo $val['review_id']; ?>" class="btn btn-danger btn-xs">Delete</a>
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
