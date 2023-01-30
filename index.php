<?php
require_once('./sendgrid-php/sendgrid-php.php');

$email = new \SendGrid\Mail\Mail();
$email->setFrom("fasem16135@bymercy.com", "Example User");

$sendgrid = new \SendGrid("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");

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