</div><!-- /#wrapper -->
    <!--<script src="<?php echo HTTP_JS_PATH; ?>tablesorter/jquery.tablesorter.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>tablesorter/tables.js"></script> -->

    <script>
    	/*$(document).ready(function(){
		    $('#myTable').DataTable({
					"order": [[ 0, "desc" ]],
					retrieve: true,
    			paging: false
				}); *
		});*/
    $(document).ready(function (){
       var table = $('#myTable').DataTable({
          'columnDefs': [{
             'targets': 0,
             'searchable':false,
             'orderable':false,
             'className': 'dt-body-center'

          }],
          'order': [1, 'desc']
       });

       // Handle click on "Select all" control
       $('#example-select-all').on('click', function(){
          // Check/uncheck all checkboxes in the table
          var rows = table.rows({ 'search': 'applied' }).nodes();
          $('input[type="checkbox"]', rows).prop('checked', this.checked);
       });

       // Handle click on checkbox to set state of "Select all" control
       $('#myTable tbody').on('change', 'input[type="checkbox"]', function(){
          // If checkbox is not checked
          if(!this.checked){
             var el = $('#example-select-all').get(0);
             // If "Select all" control is checked and has 'indeterminate' property
             if(el && el.checked && ('indeterminate' in el)){
                // Set visual state of "Select all" control
                // as 'indeterminate'
                el.indeterminate = true;
             }
          }
       });

    });
    </script>
    <script>
	  $(function() {
	    $( "#publish_date" ).datepicker();
      $( "#begin_date" ).datepicker();
      $( "#end_date" ).datepicker();
	  });
	</script>
  </body>
</html>
