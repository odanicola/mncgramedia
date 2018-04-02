<?php
//$this->load->view('vwHeader');
?>
<!--
Author : Oda Aditiya Nicola
Downloaded from http://odanicola.com
-->
<div class="main bg-red-mnc">
  <div class="container">
    <div class="toppanel-header">
      <div class="col-md-4 no-padding">
        <p class="breadcum">Home / Register </p>
      </div>
      <div class="col-md-8 no-padding">
      </div>
    </div>
  </div>
</div>
<!-- BEGIN SLIDER -->
<div class="fullwidth " style="">
<div class="container sidepanel">
  <div class="col-md-4 panel-left" >
    <div class="col-md-12  margin-bottom-20">
      <h2 class="bg-head-bottom">
        Advertisement
      </h2>
      <span class="red-line"></span>
	  <ul class="list-style-none list-comic-date">
	  <?php
		  foreach ($left_banner['left_banner'] as $key => $value) { ?>
			<a href="<?php echo $value['url'] ?>" target="_blank">
				<img src="<?php echo HTTP_IMAGE_UPLOADED_PATH . $value['banner_image'];?>" style="width:100%;" alt="" width="300"
				class="left_banner">
			</a>
			<?php
		  }
	  ?>
	  </ul>
    </div>
  </div>
  <div class="col-md-8 panel-right paddingL20">
    <div class="rows">
      <div class="col-md-7 margin-bottom-20">
        <div id="flashdata"></div>
        <h2 class="header-left">Registration</h2>
          <form id="registerUser" name="registerUser" method="post" action="/">
          <div class="rows col-md-12 no-padding bottom-solid margin-bottom-20">
            <h2 class="head-date">Login Information</h2>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Username</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="input" id="username" class="form-control" name="username" placeholder="Type your username" required="required">
                <span id="usernameSpan"></span>
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Password</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="password" id="password" class="form-control" name="password" placeholder="Type your password" required="required">
                <span id="passwordSpan"></span>
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-20">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Re-type Password</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Type your confirm password" required="required">
                <span id="repasswordSpan"></span>
              </div>
            </div>
          </div>
          <div class="rows col-md-12 no-padding bottom-solid margin-bottom-20">
            <h2 class="head-date">Personal Information</h2>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Name</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="input" class="form-control" name="first_name" placeholder="Type your first name" required="required">
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Birthday</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="input" class="form-control" id="birthday" name="birthday" placeholder="Type your birthday" required="required">
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Email</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="email" class="form-control" name="email" placeholder="Type your email" required="required">
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Gender</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <div class="styled-select short1">
                  <select class="form-control" name="gender">
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Phone</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="input" class="form-control" name="no_telp" placeholder="Type your phone number" required="required">
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <div class="styled-select short3">
                  <select class="form-control" name="sosmed">
                    <option>Facebook</option>
                    <option>Twitter</option>
                    <option>Instagram</option>
                    <option>Path</option>
                  </select>
                </div>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="input" class="form-control" name="url_sosmed" required="required" placeholder="Type your account url">
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Comic Favorite</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="input" class="form-control" id="comic_favorite" name="comic_favorite" required="required" placeholder="Type your favourite comic">
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Hobbies</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="input" class="form-control" name="hobbies" required="required" placeholder="Type your hobbies">
              </div>
          </div>
          <div class="rows col-md-12 no-padding margin-bottom-10">
              <h2 class="head-date">Term & Condition</h2>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="paragraph">Lorem ipsum doler sit amet Lorem ipsum doler sit amet Lorem ipsum doler sit amet Lorem ipsum doler sit amet Lorem ipsum doler sit amet </div>
            </div>
            <div class="rows col-md-12 no-padding">
              <label class="font12"><span class="checker"><input type="checkbox" id="agree"></span> I Agree
                <span id="agreeSpan"></span>
              </label>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <label class="font12"><span class="checker"><input type="checkbox" value="1" checked name="subscribe"></span> Please send me email update from M&C Comic </label>
            </div>
            <div class="rows col-md-12 no-padding">
              <button class="btn red">Register</button>
            </div>
          </div>
          </form>
      </div>
    </div>

  </div>
</div>
</div>

<script>
function registerRespond(){
  alert('Terima Kasih, Untuk Melanjutkan pendaftaran mohon klik tautan email yang kami kirim ke email anda');
}
</script>
<?php
$this->load->view('vwFooter');
?>
