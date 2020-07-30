<?php
if (isset($_POST['address-submit'])) {
    session_start();
    require "conn.inc.php";

    $addressLine = $_POST['address'];
    $suburb = $_POST['suburb'];
    $country = $_POST['country'];
    $province = $_POST['province'];
    $zipcode = $_POST['zipcode'];
    $userID = $_SESSION['userID'];

    $sql = "INSERT INTO `location`(`address`,`suburb`,`province`,`zipcode`,`country`,`userID`) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../register.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "sssssi", $addressLine, $suburb, $province, $zipcode, $country, $userID);
        mysqli_stmt_execute($stmt);
        header("Location: ../viewprofile.php");        
        exit();
    }
}
