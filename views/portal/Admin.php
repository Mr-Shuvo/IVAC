<?php
include("../../vendor/autoload.php");
use App\reg\reg;
session_start();



if (empty($_SESSION['user_id'])) {
    $_SESSION['Message'] ="Access Denied ! Login First ";
    header('location:../auth/login.php');
}
elseif($_SESSION['user_id']['User_type']!='ADMIN'){
    header('location:../portal/index.php');
}
else{

    $obj = new reg();
    $alluser=$obj->getalluser();
    $allfiles=$obj->Total_file();

}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Admin Panel</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/slide.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="assets/css/material-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/tablecss.css">
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>

<div class="wrapper">

    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-1.jpg">
        <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

            Tip 2: you can also add an image using data-image tag
        -->

        <div class="logo" style="background-color:purple; color: white; text-align: center; margin-top: 11px" >
            <a href="index.php" style="color: white; font-weight: bold ; color:whitesmoke ; margin-right:14px "  ><i class="fa fa-fw fa-tachometer "></i>
                Admin Dashboard
            </a>
        </div>

        <div class="sidebar-wrapper">
            <ul class="nav">
                <li>
                    <a style="margin-top: 0%; padding-top: 0%;margin-left:10px" href="manageuser.php">
                        <i class="material-icons">unarchive</i>
                        <p>Manage User</p>
                    </a>
                </li>
                <li>
                    <a style="margin-top: 0%; padding-top: 0%;margin-left:10px" href="checkfiles.php">
                       <span><i  class="material-icons">content_paste</i>
                        <p>Confirm Files</p>
                    </a>
                </li>

                <li>
                    <a style="margin-top: 0%; padding-top: 0%;margin-left:10px" href="adduser.php">
                        <i class="material-icons">location_on</i>
                        <p>Add User</p>
                    </a>
                </li>
                <li>
                    <a style="margin-top: 0%; padding-top: 0%;margin-left:10px" href="admin_edit_profile.php">
                        <i class="material-icons"> face </i>
                        <p>Manage Profile</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" style="background-color:darkcyan; color: white">
                    <p class="navbar-left"  style="color: white; font-weight: bold ; color:whitesmoke; margin-top:14px"> IVAC E-Token Processing System <a href="https://www.facebook.com/aka.shuvo" style="color: #3e2723">( Support )</a></p>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="assets/img/shuvo.jpg" style="height:25px; width: 30px; border-radius: 12px; margin-right: 5px" alt="User Image"><?php echo  $_SESSION['user_id']['User_name'];?></a>

                        </li>
                        <li>
                            <a href="logout.php" ><small><i class="fa fa-fw fa-power-off" style="font-size: 15px;margin-top:4px"></i></small> Log Out</a>
                        </li>
                        </ul>
                </div>
            </div>


        <div class="container">
            <div class="row">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <h2 style="font-family: Lobster"> Taday's File Statistic Table</h2>
                                <span style="color: #000000; margin-left: 130px"><b>Date : ( <?php  date_default_timezone_set('Asia/Dhaka'); echo  date("d-m-Y");  ?> ) </b></span>
                            </div>

                        </div>
                    </div>
                </div>

                 <div class="col-md-11">
                            <table class="responstable">
                                <thead>
                                <tr>
                                    <th><center>SN</center></th>
                                    <th><center>Customer Name</center></th>
                                    <th><center>File's Uploaded</center></th>
                                    <th><center>File's Confirmed</center></th>
                                    <th><center>Otp Received</center></th>
                                    <th><center>File's Download</center></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                foreach ($alluser as $data) {

                                    ?>

                                    <tr>
                                        <td style="font-size: 18px;font-weight: bolder;text-align: center"><?php echo $obj->i++; ?></td>
                                        <td  style="font-size: 18px;font-weight: bolder;text-align: center"><?php echo $data['User_name'] ?></td>
                                        <td style="font-size: 18px;font-weight: bolder;text-align: center"><?php
                                                foreach ($allfiles as $get) {

                                                     if( $get['User_name'] == $data['User_name'] ){
                                                         $obj->file++;
                                                     }
                                                }

                                                  echo $obj->file;

                                                ?>
                                        </td>
                                        <td style="font-size: 18px;font-weight: bolder;text-align: center" ><?php

                                            foreach ($allfiles as $get) {

                                                if( $get['User_name'] == $data['User_name'] ){
                                                    if($get['Status']=="DONE"){
                                                        $obj->Done++;
                                                    }

                                                }
                                            }

                                            echo $obj->Done;
                                            $obj->Done=0;

                                            ?> </td>
                                        <td style="font-size: 18px;font-weight: bolder;text-align: center"><?php

                                            foreach ($allfiles as $get) {

                                                if( $get['User_name'] == $data['User_name'] ){
                                                    if($get['OTP']!=""){
                                                        $obj->otp++;
                                                    }

                                                }
                                            }

                                            echo $obj->otp;
                                            $obj->otp=0;



                                            ?> </td>
                                        <td class="NotAllow"><?php
                                              if($obj->file!=0){
                                                 echo '<a class="btn btn-info" href="download.php?user='.$data['User_name'].'">Download</a>';
                                              }
                                              else{
                                                  echo "<p style='font-weight: 900;color: crimson'>File Not Found</p>";
                                              }

                                            $obj->file=0;
                                            ?>






                                        </td>
                                    </tr>
                                    <?php
                                }

                                ?>

                                </tbody>



                            </table>
                     </div>
                 </div>
            </div>
        </div>

</div>


            <footer class="footer">
                            <div class="container-fluid">
                                <nav class="pull-left">

                                </nav>
                                <p class="copyright pull-right">
                                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="#"> Copyright Shuvo Mukherjee</a>
                                </p>
                            </div>
            </footer>
    </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/material.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<script src="assets/js/slide.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Material Dashboard javascript methods -->
<script src="assets/js/material-dashboard.js"></script>

<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>


