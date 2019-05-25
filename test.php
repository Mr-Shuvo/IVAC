<?php
/**
 * Created by PhpStorm.
 * User: shuvo
 * Date: 08-Jan-18
 * Time: 11:28 PM
 */
header("Access-Control-Allow-Origin:*");

session_start();

if(isset($_SESSION)){

    unset($_SESSION);


    $name = $_POST['name'];
    $user_name = $_POST['User_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $pass = md5($_POST['Password']);
    $file_amount=5;

    include("connect.php");

    $sql = "INSERT INTO `user` (Full_name,User_name, Reffer_email,Mobile,Password,File_amount,User_type)
        VALUES ('$name','$user_name','$email','$mobile','$pass','$file_amount','USER')";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['logout']= "Registration Successfully ! Sign In.";;
        header('location:views/auth/login.php');
    }
    else{
        $_SESSION['Message'] = "Invalid Username And Password ! Try Again.";
        header('location:views/auth/login.php');
    }


}




?>