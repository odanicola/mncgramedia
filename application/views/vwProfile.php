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
        <p class="breadcum">Home / Update Profile </p>
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
        <?php
        if(!is_null($this->session->flashdata('profile'))){ $message = $this->session->flashdata('profile');?>
            <div class="<?php echo $message['class']?>" role="alert" style="margin-top: 20px;"><?php echo $message['message'];?></div>
        <?php } else { echo '<div></div>';}?>
        <h2 class="header-left">My Area</h2>
          <form method="post" action="<?php echo base_url(); ?>home/update_profile" role="form">
          <div class="rows col-md-12 no-padding bottom-solid margin-bottom-20">
            <h2 class="head-date">Personal Information</h2>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Name</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="input" class="form-control" name="first_name" value="<?php echo $profile[0]['nama']?>">
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Birthday</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="input" id="birthday" class="form-control" name="birthday" value="<?php echo $profile[0]['birthday']?>">
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Email</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="email" class="form-control" name="email" value="<?php echo $profile[0]['email']?>">
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Gender</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <div class="styled-select short1">
                  <select class="form-control" name="gender">
                    <?php $gender = ''; ?>
                    <?php if($profile[0]['gender'] == '1'){ $gender = 'Male'; } else { $gender = 'Female'; }?>
                    <option value="<?php echo $profile[0]['gender']; ?>"><?php echo $gender; ?></option>
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
                <input type="input" class="form-control" name="no_telp" value="<?php echo $profile[0]['no_tlp']?>">
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <div class="styled-select short3">
                  <select class="form-control" name="sosmed">
                    <option value="<?php echo $profile[0]['sosmed']; ?>"><?php echo $profile[0]['sosmed']; ?></option>
                    <option value="Facebook">Facebook</option>
                    <option value="Twitter">Twitter</option>
                    <option value="Instagram">Instagram</option>
                    <option value="Path">Path</option>
                  </select>
                </div>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="input" class="form-control" name="url_sosmed" value="<?php echo $profile[0]['url_sosmed']?>">
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Comic Favorite</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="input" class="form-control" id="comic_favorite" name="comic_favorite" value="<?php echo $profile[0]['comic_favorite']?>">
              </div>
            </div>
            <div class="rows col-md-12 no-padding margin-bottom-10">
              <div class="rows col-md-4 no-padding">
                <p class="inputLabel">Hobbies</p>
              </div>
              <div class="rows col-md-8 no-padding">
                <input type="input" class="form-control" name="hobbies" value="<?php echo $profile[0]['hobbies']?>">
              </div>
          </div>
          <div class="rows col-md-12 no-padding margin-bottom-10">
            <div class="rows col-md-12 no-padding">
              <input type="hidden" name="username" value="<?php echo $this->session->userdata('username');?>">
              <input type="submit" class="btn red" value="Update" style="float:right;">
            </div>
          </div>
          </form>
      </div>
      <div class="col-md-5 margin-top-20">

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
