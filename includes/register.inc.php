<?php
if (isset($_POST['register-submit'])) {

  require "conn.inc.php";

  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm_password'];
  $firstname = $_POST['firstName'];
  $lastname = $_POST['lastname'];
  $number = $_POST['phoneNumber'];
  $dob = $_POST['dateOfBirth'];

  if (empty($email) || empty($password) || empty($confirmPassword) || empty($firstname) || empty($lastname) || empty($number) || empty($dob)) {
    header("Location: ../register.php?error=emptyfields&email=" . $email . "&name=" . $firstname . "&lastname=" . $lastname . "&number=" . $number . "&dob=" . $dob);
    exit();
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../register.php?error=invalidmail&name=" . $firstname . "&lastname=" . $lastname . "&number=" . $number . "&dob=" . $dob);
    exit();
  } else if (!preg_match("/^[A-Za-z]*$/", $firstname)) {
    header("Location: ../register.php?error=invalidname&email=" . $email . "&lastname=" . $lastname . "&number=" . $number . "&dob=" . $dob);
    exit();
  } else if (!preg_match("/^[A-Za-z]*$/", $lastname)) {
    header("Location: ../register.php?error=invalidlast&name=" . $firstname . "&email=" . $email . "&number=" . $number . "&dob=" . $dob);
    exit();
  } else if (!preg_match("/^[0-9]{10}$/", $number)) {
    header("Location: ../register.php?error=invalidnum&name=" . $firstname . "&lastname=" . $lastname . "&email=" . $email . "&dob=" . $dob);
    exit();
  } else if ($password !== $confirmPassword) {
    header("Location: ../register.php?error=passwordmatch&name=" . $firstname . "&lastname=" . $lastname . "&email=" . $email . "&dob=" . $dob);
    exit();
  } else {
    $sql = "SELECT `email` FROM user WHERE email=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../register.php?error=sqlerror");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCount = mysqli_stmt_num_rows($stmt);
      if ($resultCount > 0) {
        header("Location: ../register.php?error=emailreg&name=" . $firstname . "&lastname=" . $lastname . "&number=" . $number . "&dob=" . $dob);
        exit();
      } else {
        $sql = "INSERT INTO user(`email`,`password`,`firstname`,`lastname`,`phoneNumber`,`dateOfBirth`) VALUES (?,?,?,?,?,?)";        
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../register.php?error=sqlerror");
          exit();
        } else {
          $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "ssssss", $email, $hashedpassword, $firstname, $lastname, $number, $dob);
          mysqli_stmt_execute($stmt);
          $cart = "INSERT INTO cart(`cartTotal`,`userID`) VALUES (0,?)";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $cart)) {
            header("Location: ../register.php?error=sqlerror");
            exit();
          } else {
            $user = "SELECT `userID` FROM user WHERE `email` = '$email'";
            if($result = mysqli_query($conn,$user)){
              $row = mysqli_fetch_array($result);
              $userID = $row['userID'];
            }
            mysqli_stmt_bind_param($stmt, "i", $userID);
            mysqli_stmt_execute($stmt);            
            header("Location: ../register.php?register=success");
            exit();
          }
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($sonn);
} else {
  header("Location: ../register.php");
  exit();
}
