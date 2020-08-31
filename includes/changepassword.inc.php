<?php
if (isset($_POST['changepass-submit'])) {
    session_start();
    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];
    $userID = $_SESSION['userID'];
    require "conn.inc.php";
    $sql = "SELECT password FROM user WHERE userID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $userID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $passwordCheck = password_verify($current_pass, $row['password']);
            if ($passwordCheck == true) {
                $passwordCheck = password_verify($new_pass, $row['password']);
                if (!$passwordCheck) {
                    $hashedpassword = password_hash($new_pass, PASSWORD_DEFAULT);
                    $sql = "UPDATE user SET password=? WHERE userID=?";
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        mysqli_stmt_bind_param($stmt, "si", $hashedpassword, $userID);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_store_result($stmt);
                        if ($result) {
                            session_destroy();
                            header("Location: ../login.php");
                        } else {
                            header("Location: ../changepassword.php");
                        }
                    }
                }else{
                    header("Location: ../changepassword.php?error=passwordsame");
                }
            } else if ($passwordCheck == false) {
                echo "password mismatched";
            }
        }
    }
}
