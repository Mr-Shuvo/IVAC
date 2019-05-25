<?php

include("../../vendor/autoload.php");
use App\reg\reg;
session_start();
$obj = new reg();


if(!empty($_GET['user'])){
    $user=$_GET['user'];
    $allfiles=$obj->getallfiles($user);

    foreach ($allfiles as $data) {
        echo "['".$data['Mission']."','".$data['BGD']."','".$data['Passport']."','".$data['Given_name']."','".$data['Birth_place']."','".$data['Father_name']."','".$data['Mother_name']."']\n \n";
    }
    header('Content-type: text/plain');
    header('Content-Disposition: attachment; filename="Myfiles.csv"');

}



