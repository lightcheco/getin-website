<?php

require('assets/phpmailer/class.smtp.php');
require('assets/phpmailer/class.phpmailer.php'); //Need phpmailer to send mails with file attachments
if(!$captcha){ //if form is answered but not the captcha.
          ob_clean();
          echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Something went wrong</strong> Please check the captcha.</div>';
        }

if(isset($_POST['g-recaptcha-response'])&& $_POST['g-recaptcha-response']){ //Si existe la caja de captcha y no está vacia
      //var_dump($_POST);
      $secret = "6Lfe3xkUAAAAAAUEj8dT8bKdylnO2zj47TQxawmk"; //Secret Key Captcha
      $ip = $_SERVER['REMOTE_ADDR'];
      $captcha = $_POST['g-recaptcha-response'];
      $rsp  = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip$ip"); //Pass parametrers and get answers
      //  var_dump($rsp);
      $arr = json_decode($rsp,TRUE);
      if($arr['success']){
          //echo 'Done';
          $mail = new PHPMailer();
          $mail->IsMAIL(); // enable SMTP
          $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
          $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
          $mail->Host = "smtp.gmail.com";
          $mail->Port = 465; // or 587
          $mail->SMTPAuth = true; // authentication enabled
          $mail->Username = "ivan@yogome.com"; //Provide Username
          $mail->Password = "secret6521";  //Provide Password
          $mail->CharSet = 'UTF-8';
          $mail->IsHTML(true);
          $mail->SetFrom("ivan@yogome.com");
          $mail->AddReplyTo($_POST["email"], $_POST["name"]);
          $mail->AddAddress("ivan@yogome.com");
          $mail->Subject = "New contact from homepage";
          $mail->WordWrap   = 80;
          $mail->Body .= "<br>Name: ";
          $mail->Body .= addslashes(trim($_POST['name']));
          $mail->Body .= "<br>Email: ";
          $mail->Body .= addslashes(trim($_POST['email']));
          $mail->Body .= "<br>Phone Number: ";
          $mail->Body .= addslashes(trim($_POST['phoneNumber']));
          $mail->Body .= "<br><br>End of post.";
          $mail->IsHTML(true);
          if(!$mail->Send()) {
            ob_clean();
          	echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Something went wrong</strong> Please write us at contacto@getin.mx and we will get back to you.</div>';
          } else {
            ob_clean();
          	echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Message Sent!</strong> We will review your submission and contact you shortly!</div>';
            echo '<script type="text/javascript">',
                 '$("#frmContact")[0].reset();',
                 '</script>';
          }
          if(!empty($targetPath)) {
          	unlink($targetPath);
          }

      }

  }﻿
?>
