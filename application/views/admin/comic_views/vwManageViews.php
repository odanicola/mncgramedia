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
            <h1>CMS <small>Comic Views Module </small></h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="icon-dashboard"></i> COMIC Views</a></li>
              <li class="active"><i class="icon-file-alt"></i> COMIC Views</li>        
              
             
            </ol>
          </div>
        </div><!-- /.row -->

        
            
            <div class="table-responsive">
              <table class="table table-hover tablesorter" id="myTable">
                <thead>
                  <tr>
                    <th class="header">Comic Title </th>
                    <th class="header">Ip Address </th>
                    <th class="header">Date </th>
                  </tr>
                </thead>
                <tbody>

                    <?php
                   
                    foreach($comic_views as $key => $val){
                    ?>
                    
                  <tr>
                    <td><?php echo $val['title']; ?></td>
                    <td><?php echo $val['ip_address']; ?></td>
                    <td><?php echo $val['date_add']; ?></td>
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