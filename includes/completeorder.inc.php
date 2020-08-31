<?php
if(isset($_POST['order-submit'])){
    require 'conn.inc.php';
    session_start();
    $address = $_POST['address'];
    $userID = $_SESSION['userID'];
    $status = "In Progress";
    $grandTotal = $_POST['total'];
    $order = "INSERT INTO `order`(`status`,`grandTotal`,`userID`,`locationID`) VALUES (?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(mysqli_stmt_prepare($stmt, $order)){
        mysqli_stmt_bind_param($stmt,"siii",$status,$grandTotal,$userID,$address);
        mysqli_stmt_execute($stmt);
        header("Location: ../viewprofile.php");
        exit();
    }else{
        header("Location: ../orderbooks.php?error=sqlerror");
        exit();
    }
}