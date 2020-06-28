<?php
    require "conn.php";
    $response = array();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $email = strip_tags(mysqli_real_escape_string($conn,trim($email)));
    $password = strip_tags(mysqli_real_escape_string($conn,trim($password)));
    
    $query = "SELECT * FROM clients WHERE email='".$email."'";
    $tbl = mysqli_query($conn,$query);
    if(mysqli_num_rows($tbl)>0){
        $row = mysqli_fetch_array($tbl);
        $password_hash = $row['password'];
        if(password_verify($password,$password_hash)){
            $response['message'] = "Successful login";
            $response['client_id'] = $row['client_id'];
            $response['firstname'] = $row['firstname'];
            $response['lastname'] = $row['lastname'];
            $response['dateOfBirth'] = $row['date_of_birth'];
            $response['cellphone'] = $row['cellphone'];
        }else{
            $response['message'] = "Incorrect Password";
        }
    }else{
        $response['message'] = "Email not found";
    }
    echo json_encode($response)
?>