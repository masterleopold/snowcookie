<?php

/* SETTINGS */
$recipient = "yoichiro@snowcookiesports.com";
$subject = "コンタクトフォームからの送信";

if($_POST){

  /* DATA FROM HTML FORM */
  $name = $_POST['名前'];
  $email = $_POST['メールアドレス'];
  $message = $_POST['メッセージ'];
//$phone = $_POST['phone'];


  /* SUBJECT */
  $emailSubject = $subject . " by " . $name;

  /* HEADERS */
  $headers = "From: $name <$email>\r\n" .
             "Reply-To: $name <$email>\r\n" . 
             "Subject: $emailSubject\r\n" .
             "Content-type: text/plain; charset=UTF-8\r\n" .
             "MIME-Version: 1.0\r\n" . 
             "X-Mailer: PHP/" . phpversion() . "\r\n";
 
  /* PREVENT EMAIL INJECTION */
  if ( preg_match("/[\r\n]/", $name) || preg_match("/[\r\n]/", $email) ) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    die("500 Internal Server Error");
  }

  /* MESSAGE TEMPLATE */
  $mailBody = "名前: $name \n\r" .
              "メールアドレス:  $email \n\r" .
              "タイトル:  $subject \n\r" .
//            "Phone:  $phone \n\r" .
              "メッセージ本文: $message";

  /* SEND EMAIL */
  mail($recipient, $emailSubject, $mailBody, $headers);
}
?>