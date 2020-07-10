<?php
if (filter_has_var(INPUT_POST, "submit")) {
  $resultMsg = "";
  $resultClass = "";
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  if (!empty($name) && !empty($email) && !empty($message)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $toEmail = "support@pearsonbookstore.co.za";
      $subject = "Support Request From " . $name;
      $body = "<h2>Support Request</h2>
                <h4>Name: </h4><p>.$name</p>
                <h4>Email: </h4><p>.$email</p>
                <h4>Message: </h4><p>.$message</p>";
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";
      $headers .= "From: " . $name . "<" . $email . ">" . "\r\n";      
      $resultMsg = "Email Sent !";
      $resultClass = "success-msg";
    } else {
      $resultMsg = "Please enter a valid email";
      $resultClass = "error-msg";
    }
  } else {
    $resultMsg = "Please fill in all fields";
    $resultClass = "error-msg";
  }
}
