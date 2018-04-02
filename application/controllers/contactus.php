<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contactus extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        //$this->load->library('phpmailerautoload');

    }

    public function index() {
        $arr['page'] ='Contact Us';
        $arr['sosmed'] = $this->getSosmed();
        $arr['logo'] = $this->getLogo();
		    $arr['logo_gramedia'] = $this->getLogoGramedia();
        $arr['youtube'] = $this->getYoutube();
        $arr['twitter'] = $this->getTwitter();
		    $arr['middle_banner'] = $this->getMidBanner();
		    $arr['left_banner'] = $this->getLeftBanner();
		    $arr['right_banner'] = $this->getRightBanner();
      
        $arr['content'] = '';
        $this->load->view('vwHeader',$arr);
        $this->load->view('vwContactus',$arr);
    }

	public function getLogoGramedia(){
        $qry ='select * from tbl_logo where id = 2'; // select data from db
        $arr['logo_gramedia'] = $this->db->query($qry)->result_array();
        return $arr;
    }

	public function getMidBanner(){
		    $qry = "select*from tbl_banner where position='middle' order by id DESC limit 1";
		    $arr['middle_banner'] = $this->db->query($qry)->result_array();
        return $arr;
	}

	public function getLeftBanner(){
		    $qry = "select*from tbl_banner where position='left' order by id DESC limit 2";
		    $arr['left_banner'] = $this->db->query($qry)->result_array();
        return $arr;
	}

	public function getRightBanner(){
		    $qry = "select*from tbl_banner where position='right' order by id DESC limit 2";
		    $arr['right_banner'] = $this->db->query($qry)->result_array();
        return $arr;
	}

    public function getSosmed(){
        $qry ='select * from tbl_sosmed'; // select data from db
        $arr['sosmed'] = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function send(){
        $nama        = $_POST['contact_nama'];
        $email       = $_POST['contact_email'];
        $message     = $_POST['contact_message'];
        $date_add    = date('Y-m-d');
        $time_sent   = time('h:i:s');

        if(isset($nama) && !empty($nama) ){
           $sql = "insert into tbl_contact_data values ('', '$nama', '$message', '$email', '', '$date_add', '$time_sent')";
           $val = $this->db->query($sql);

           /*$config['protocol']     = 'smtp';
           $config['smtp_host']    = 'mail.halhalal.com';
           $config['smtp_port']    = '465';
           $config['smtp_user']    = 'blast@halhalal.com';
           $config['smtp_pass']    = 'l4t1g1dz0y4';
           $config['mailtype'] = 'text'; // or html

           $this->email->initialize($config);*/

           require('/var/zpanel/hostdata/zadmin/public_html/mncgramedia_id/application/libraries/phpmailerautoload.php');

           $mail = new PHPMailer;

           //$mail->SMTPDebug = 3;                               // Enable verbose debug output

           $mail->isSMTP();                                      // Set mailer to use SMTP
           $mail->Host = 'mail.halhalal.com';                            // Specify main and backup SMTP servers
           $mail->SMTPAuth = true;                               // Enable SMTP authentication
           $mail->Username = 'blast@halhalal.com';                 // SMTP username
           $mail->Password = 'l4t1g1dz0y4';                           // SMTP password
           $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
           $mail->Port = 465;                                    // TCP port to connect to

           $mail->setFrom($email, $nama);
           $mail->addAddress('redaksi@mncgramedia.id');     // Add a recipient
           $mail->addReplyTo($email, $nama);

           //$mail->addAttachment($pathtosave);           // Add attachments
           $mail->isHTML(true);                                  // Set email format to HTML

           $mail->Subject = 'M&C Contact Us dari ' . $email;
           $mail->Body    = $message;
           //$mail->AltBody = 'Selamat Anda mendapatkan tiket tukar nonton Fashion Show Shafira IFW 2016';

           if(!$mail->send()) {

               $arr['flash'] = 'Mailer Error: ' . $mail->ErrorInfo;
               $arr['status'] = '1';

           } else {
               //echo 'Message has been sent';
               //header("Location: http://mncgramedia.id");
               $arr['sosmed'] = $this->getSosmed();
               $arr['logo'] = $this->getLogo();
       		     $arr['logo_gramedia'] = $this->getLogoGramedia();
               $arr['youtube'] = $this->getYoutube();
               $arr['twitter'] = $this->getTwitter();
       		     $arr['middle_banner'] = $this->getMidBanner();
       		     $arr['left_banner'] = $this->getLeftBanner();
       		     $arr['right_banner'] = $this->getRightBanner();
               $arr['flash'] = 'Your data has been submitted.';
               $arr['status'] = '0';
               $this->load->view('vwContactus',$arr);

               //exit();
           }

           //echo $this->email->print_debugger();
           //redirect('contactus/');
         }
    }

    public function getYoutube(){
        $qry ='select * from tbl_youtube'; // select data from db
        $arr['youtube'] = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getLogo(){
        $qry ='select * from tbl_logo'; // select data from db
        $arr['logo'] = $this->db->query($qry)->result_array();
        return $arr;
    }

    public function getTwitter(){
        $qry ='select * from tbl_twitter'; // select data from db
        $arr['twitter'] = $this->db->query($qry)->result_array();
        return $arr;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
