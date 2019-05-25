<?php
/**
 * Created by PhpStorm.
 * User: shuvo
 * Date: 08-Jan-18
 * Time: 11:28 PM
 */
header("Access-Control-Allow-Origin:*");



if(!empty($_POST['BGD'])) {

    $BGD = $_POST['BGD'];

    include("connect.php");

    $sql = "SELECT BGD FROM `files` WHERE BGD='$BGD'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $Insert = "UPDATE `files` SET Status='DONE' WHERE BGD='$BGD'";
        $conn->query($Insert);
    }

}
?>