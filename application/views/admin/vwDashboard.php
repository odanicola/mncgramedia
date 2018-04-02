<?php
$this->load->view('admin/vwHeader');
?>
<!--  
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->
<!--  PAge Code Starts here -->

    <!-- Page Specific Plugins -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
    <script src="<?php echo HTTP_JS_PATH; ?>morris/chart-data-morris.js"></script>
    
<div id="page-wrapper">
<div class="row">
  <div class="col-lg-12">
    <h1>Dashboard <small>M&C Gramedia</small></h1>
    <ol class="breadcrumb">
      <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
    </ol>
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      Welcome to M&C Admin Panel! 
    </div>
  </div>
</div><!-- /.row -->
</div><!-- /#page-wrapper -->


<!--  PAge Code Ends here -->
<?php
$this->load->view('admin/vwFooter');
?>