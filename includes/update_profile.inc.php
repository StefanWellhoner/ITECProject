<?php
if (isset($_POST['submit-update'])) {
    session_start();
    require "conn.inc.php";
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $number = $_POST['number'];
    $dob = $_POST['dob'];
    if (empty($firstname) || empty($lastname) || empty($number) || empty($dob)) {
        header("Location: ../viewprofile.php?error=emptyfields&email=" . $email . "&name=" . $firstname . "&lastname=" . $lastname . "&number=" . $number . "&dob=" . $dob);
        exit();
    } else if (!preg_match("/^[A-Za-z]*$/", $firstname)) {
        header("Location: ../viewprofile.php?error=invalidname&email=" . $email . "&lastname=" . $lastname . "&number=" . $number . "&dob=" . $dob);
        exit();
    } else if (!preg_match("/^[A-Za-z]*$/", $lastname)) {
        header("Location: ../viewprofile.php?error=invalidlast&name=" . $firstname . "&email=" . $email . "&number=" . $number . "&dob=" . $dob);
        exit();
    } else if (!preg_match("/^[0-9]{10}$/", $number)) {
        header("Location: ../viewprofile.php?error=invalidnum&name=" . $firstname . "&lastname=" . $lastname . "&email=" . $email . "&dob=" . $dob);
        exit();
    } else {
        echo "Hello";
        $sql = "UPDATE user SET firstname = ?, lastname = ?, phoneNumber = ?, dateOfBirth = ? WHERE userID = " . $_SESSION['userID'] . "";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../viewprofile.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $number, $dob);
            mysqli_stmt_execute($stmt);
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['phoneNumber'] = $number;
            $_SESSION['dateOfBirth'] = $dob;
            header("Location: ../viewprofile.php?update=success");
            exit();
        }
    }
}
