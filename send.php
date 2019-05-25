<?php
/**
   String msg_from,
    String msg_body,
    String msg_dt, --->> Ei colum ta Unique korbi  🙂
    String device_model,
    String device_id,
    String device_user

    sob column VARCHAR type

    POST Method

    jodi post e na kaj kore

    $_REQUEST['msg_from']
 */
header("Access-Control-Allow-Origin:*");

    $sms = $_GET['text'];

if(strpos($sms, 'OTP') !== false) {

    $BGD= substr($sms,18,12);
    $OTP= substr($sms,34,6);

    $NAME = 'OTP_SAVE.txt';
    $HANDLE = fopen($NAME,'r') or die ('CANT OPEN FILE');
    $str= fread($HANDLE,filesize($NAME));
    fclose($HANDLE);

    $my_array= (explode(" ",$str));

    if(in_array($BGD, $my_array)){

        $otp_key= (array_search($BGD,$my_array)+1);
        $Old_OTP=$my_array[$otp_key];

        $New_string=str_replace($Old_OTP,$OTP,$str);


        $FILE="OTP_SAVE.txt";
        $HANDLE = fopen($FILE, 'w') or die ('CANT OPEN FILE');
        fwrite($HANDLE,$New_string);
        fclose($HANDLE);
    }

    else{

        $NewFile=" ".$BGD." ".$OTP;
        $FILE="OTP_SAVE.txt";
        $HANDLE = fopen($FILE, 'a+') or die ('CANT OPEN FILE');
        fwrite($HANDLE,$NewFile);
        fclose($HANDLE);

    }

             include("connect.php");

             $sql = "SELECT BGD FROM `files` WHERE BGD='$BGD'";
             $result = $conn->query($sql);

                     if ($result->num_rows > 0) {
                    $Insert_otp = "UPDATE `files` SET OTP='$OTP',Status='FAILD' WHERE BGD='$BGD'";
                    $conn->query($Insert_otp);
                     }

}
?>