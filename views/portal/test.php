<?php
include("../../vendor/autoload.php");
use App\reg\reg;
session_start();

if (empty($_SESSION['user_id'])) {
    $_SESSION['Message'] ="Access Denied ! Login First ";
    header('location:../auth/login.php');
}
elseif($_SESSION['user_id']['User_type']!='USER'){
    header('location:../portal/Admin.php');
}
else {
    $obj = new reg();
    $user=$_SESSION['user_id']['User_name'];
    $obj->getallfiles($user);

    $mail=$obj->getMail($user);

    $sendTo=$mail['Reffer_email'];

  require("PHPMailer/class.phpmailer.php");

    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->Host = "localhost";
    $mail->SMTPAuth = true;
    $mail->Username = "e-token@lensfair.com";
    $mail->Password = "pakkna100";

    $mail->From = "e-token@lensfair.com";
    $mail->FromName = "IVAC SOFT";

    $mail->AddAddress($sendTo);

    $mail->WordWrap = 50;

    $mail->IsHTML(true);
    $mail->Subject = "Mr".$user;

    $mail->Body = "Mr $user Submitted <b> $obj->countfiles</b> Files <br><br> Please, Donload It From Portal";

    if (!$mail->Send()) {
        $_SESSION['mailerror'] ="Have An Error Contact With Admin";
        exit;
    }

    $_SESSION['mailsent']= "Files Submitted Successfully";
}
?>