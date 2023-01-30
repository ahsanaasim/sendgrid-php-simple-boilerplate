<?php
require_once('./sendgrid-php/sendgrid-php.php');
require_once('./cors.php');

$email = new \SendGrid\Mail\Mail();
$email->setFrom("fasem16135@bymercy.com", "Example User");

$sendgrid = new \SendGrid("API_KEY");

if(isset($_POST['toEmail']) && isset($_POST['subject']) && isset($_POST['message'])) {
  $to = $_POST['toEmail'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  // echo $message;

  $email->setSubject($subject);
  $email->addTo($to);
  $email->addContent("text/plain", $message);

  try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
  } catch (Exception $e) {
      echo 'Caught exception: '. $e->getMessage() ."\n";
  }
} else {
  echo 'Validation Error';
}


?>