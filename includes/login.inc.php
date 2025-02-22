<?php
if (isset($_POST['login-submit'])) {
  require "conn.inc.php";
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($email) || empty($password)) {
    header("Location: ../login.php?error=emptyfields");
    exit();
  } else {
    $sql = "SELECT * FROM user WHERE email=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../login.php?error=sqlerror");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $passwordCheck = password_verify($password, $row['password']);
        if ($passwordCheck == false) {
          header("Location: ../login.php?error=wrongdetails");
          exit();
        } else if ($passwordCheck == true) {
          session_start();
          $_SESSION['userID'] = $row['userID'];
          $_SESSION['email'] = $row['email'];
          $_SESSION['firstname'] = $row['firstname'];
          $_SESSION['lastname'] = $row['lastname'];
          $_SESSION['phoneNumber'] = $row['phoneNumber'];
          $_SESSION['dateOfBirth'] = $row['dateOfBirth'];
          if (isset($_POST['redirect'])) {
            header("Location: ../".$_POST['redirect']);
            exit();
          } else {
            header("Location: ../index.php?login=success");
            exit();
          }
        }
      } else {
        header("Location: ../login.php?error=nouser");
        exit();
      }
    }
  }
} else {
  header("Location: ../login.php");
  exit();
}
