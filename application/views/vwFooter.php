    <!-- BEGIN FOOTER -->
    <div class="footer">
		<div class="container">
			<div class="col-md-12 col-sm-12 no-padding padding-10 padding-bottom-20">
				<div class="col-md-3 col-sm-3 no-padding">
					<ul class="list-unstyled footernav" >
						<li><a href="<?php echo base_url()?>register">Register</a></li>
						<li><a href="<?php echo base_url()?>contactus">Contact Us</a></li>
					</ul>
				</div>
				<div class="col-md-6 col-sm-6 no-padding">
				</div>
				<div class="col-md-3 col-sm-3 no-padding sosmed">
					<ul class="list-unstyled footernav">
					<li ><a href="#">Follow Us</a></li>
					<?php foreach ($sosmed as $key => $value) {?>
			        <?php $sosmed = $value;?>
			        <?php foreach ($sosmed as $key => $value) {?>

			          <?php if(!empty($value['url'])):?>
			              <li><a href="<?php echo $value['url']; ?>" target="_blank" class="fa
			              <?php if($value['sosmed'] == 'Facebook')echo 'fa-facebook-square fa-2x';
								else if($value['sosmed'] == 'Twitter') echo 'fa-twitter-square fa-2x';
								else if($value['sosmed'] == 'Instagram') echo 'fa-instagram fa-2x';
								else if($value['sosmed'] == 'Tumblr') echo 'fa-tumblr-square fa-2x';
								else if($value['sosmed'] == 'Youtube') echo 'fa-youtube-square fa-2x';
			              ?>"></a></li>
			          <?php endif; ?>
					<?php }
					} ?>

					</ul>
				</div>
			</div>
		</div>
		<div class="container">
			<span class="white-line-thin"></span>
			<div class="col-md-12 col-sm-12 padding-30">
				<div class="col-md-6 col-sm-6 no-padding">
					<div class="col-md-2 col-sm-12 no-padding footer-logo">
						<a href="<?php echo base_url()?>"><img src="<?php echo HTTP_IMAGES_PATH; ?>logo-mnc-outline.png" class="img-responsive" alt=""></a>
					</div>
					<div class="col-md-10 col-sm-12 no-padding address">
						<p class="adress-footer">
						Kompas Gramedia Building <br/>
            Unit I Lantai 3 <br/>
						Palmerah Barat 29-37 <br/>
						Jakarta, 10270 - Indonesia <br/>
            Telepon: (021) 53650110/ 111 ext 3651<br/>
            E-Mail <a href="mailto:redaksi@mncgramedia.id">redaksi@mncgramedia.id</a>
						</p>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 no-padding sponsor-footer">
					<a href="#"><img src="<?php echo HTTP_IMAGES_PATH; ?>logo_kg.png" class="img-responsive " alt="" height="51"> </a>
					<a href="http://gramediaonline.com"><img src="<?php echo HTTP_IMAGES_PATH . $logo_gramedia['logo_gramedia'][0]['logo_image'] ?>" class="img-responsive " alt="" height="51"> </a>
				</div>
			</div>
			<span class="white-line-thin"></span>
		</div>
		<div class="container">
			<!-- BEGIN COPYRIGHT -->
			<div class="col-md-12 col-sm-12 padding-top-20 text-align-center">
				Copyright 2016. M&C Kompas Gramedia. All Rights Reserved.
			</div>
			<!-- END COPYRIGHT -->
		</div>
    </div>
    <!-- END FOOTER -->

    </div> <!-- /container -->

    <!-- Placed at the end of the document so the pages load faster -->

	  <script src="<?php echo HTTP_JS_PATH; ?>jquery-ui.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>bootstrap.min.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>jquery.prettyPhoto.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>jquery-migrate.min.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>back-to-top.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>jquery.fancybox.pack.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>owl.carousel.min.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>jquery.themepunch.revolution.min.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>jquery.themepunch.tools.min.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>layout.js"></script>

  	<script>
  		//$(function(){
  		  $("#search").autocomplete({
  			source: "<?php echo base_url();?>search/get_search",
  			open: function(event, ui) {
  				$(this).autocomplete("widget").css({
  					"margin-top": 28
  				}).addClass('searchtop');
  			}
  		  }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            var image_path = '';
            console.log(item.image_default);
            console.log(item.image);
            if(item.image_default == 'false'){
               image_path = "<?php echo base_url()?>uploads/";
            }else{
               image_path = "<?php echo base_url()?>comic/small/";
            }
            console.log(image_path);
            var inner_html = '<a href="<?php echo base_url()?>comics/comic_detail/'+item.slug+'" class="list_item_search"><div class="list_item_container"><div class="image"><img height="50" src="'+ image_path + item.image + '"></div><div class="label">' + item.label + '</div><div class="description">' + item.description + '</div></div></a>';

  					return $( "<li></li>" )
  					.data( "item.autocomplete", item )
  					.append(inner_html)
  					.appendTo( ul );
  			};
  		//});
  	</script>
    <script>
  		//$(function(){
  		  $("#comic_favorite").autocomplete({
  			source: "<?php echo base_url();?>search/get_search",
  			open: function(event, ui) {
  				$(this).autocomplete("widget").css({
  					"margin-top": 5
  				}).addClass('comic_favorite');
  			}
  		  }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            var image_path = '';
            //console.log(item.image_default);
            if(item.image_default == 'false'){
               image_path = "<?php echo base_url()?>uploads/";
            }else{
               image_path = "<?php echo base_url()?>comic/small/";
            }

            var inner_html = '<div class="list_item_search"><div class="list_item_container"><div class="image"><img height="50" src="'+ image_path + item.image + '"></div><div class="label">' + item.label + '</div><div class="description">' + item.description + '</div></div></div>';

  					return $( "<li></li>" )
  					.data( "item.autocomplete", item )
            //.addClass('comic_favorite')
  					.append(inner_html)
  					.appendTo( ul );
  			};
  		//});
  	</script>
    <script>
        $('#comic_label').on('click',function(){
          var label = $('#comic_label').val();
          alert(label);
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
			Layout.init();
            Layout.initOWL();
            $("#searchSomething").keyup(function (e) {
				if (e.keyCode == 13) {
					location.href="search-result.html";
				}
			});
        });
    </script>
    <script>
    	  $(function() {
    	    $( "#birthday" ).datepicker({
            changeMonth: true,
            changeYear: true
          });
    	  });
	  </script>
    <script>
        $('#username').change(function(){
          var username = $('#username').val();
          console.log('changed');
          var url = '<?php echo base_url() ?>check/username/' + username;
          console.log(url);
          $.get(url).done(function(d){
            console.log(d);
            if(d == 1){
              $('#username').css({'border-color':'#C22228','color': '#C22228','margin-top':'10px'});
              $('#usernameSpan').empty();
              $('#usernameSpan').append('<p style="color: #C22228">Username already exists.</p>');
            }else{
              $('#username').css({'border-color':'#dbdbdb','color': '#000','margin-top':'10px'});
              $('#usernameSpan').empty();
              $('#usernameSpan').append('<p style="color: #4F8A10">Username is available.</p>');
            }
          });
        });

        $('#password').change(function(){
          var password = $('#password').val().length;
          $('#repassword').val('');

          if(password < 8){
            $('#password').css({'border-color':'#C22228','color': '#C22228','margin-top':'10px'});
            $('#passwordSpan').empty();
            $('#passwordSpan').append('<p style="color: #C22228">Minimum 8 characters.</p>');
          }else{
            $('#password').css({'border-color':'#dbdbdb','color': '#000','margin-top':'10px'});
            $('#passwordSpan').empty();
          }
          console.log(password);
        });

        $('#repassword').change(function(){
          var password = $('#password').val();
          var repassword = $('#repassword').val();
          if(repassword != password ){
            $('#repassword').css({'border-color':'#C22228','color': '#C22228','margin-top':'10px'});
            $('#repasswordSpan').empty();
            $('#repasswordSpan').append('<p style="color: #C22228">Password does not match.</p>');
          }else{
            $('#repassword').css({'border-color':'#dbdbdb','color': '#000','margin-top':'10px'});
            $('#repasswordSpan').empty();
          }

        });

        $("#registerUser").on("submit",function(e){
            e.preventDefault();
            var data = $(this).serialize();
            console.log(data);


            var username = $('#username').val();
            var url = '<?php echo base_url() ?>check/username/' + username;
            $.get(url).done(function(d){
              if(d == 1){
                return false;
              }else{
                if($('#agree').is(':checked')){
                  var url = '<?php echo base_url()?>register/submit_register';
                  console.log(url);

                  $.post(url,data).done(function(result){
                    console.log(result);
                    d = JSON.parse(result);
                    console.log(d.status);
                    if(d.status == 1){
                      $('#flashdata').html('<br/><div class="alert alert-success" role="alert">' + d.msg + '</div>');
                      setTimeout("location.reload()", 5000);
                    }else{
                      $('#flashdata').html('<br/><div class="alert alert-danger" role="alert">' + d.msg + '</div>');
                      setTimeout("location.reload()", 5000);
                    }
                  });
                }else{
                  $('#agreeSpan').empty();
                  $('#agreeSpan').append('<p style="color: #C22228">Please check our agreement.</p>');
                }
              }
            });
        });
    </script>
  </body>
</html>
