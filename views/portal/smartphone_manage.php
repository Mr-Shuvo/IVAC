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

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>User Panel</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/slide.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="assets/css/material-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

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
            <a href="index.php" style="color: white; font-weight: bold ; color:whitesmoke ; margin-right:14px "  ><i class="fa fa-fw fa-tachometer"></i>
                User Dashboard
            </a>
        </div>

        <div class="sidebar-wrapper">
            <ul class="nav">
                <li>
                    <a style="margin-top: 0%; padding-top: 0%;margin-left:10px" href="Insert_file.php">
                        <i class="material-icons">unarchive</i>
                        <p>Insert New File</p>
                    </a>
                </li>
                <li>
                    <a style="margin-top: 0%; padding-top: 0%;margin-left:10px" href="upload_files.php">
                       <span><i  class="material-icons">content_paste</i>
                        <p>Upload Files</p>
                    </a>
                </li>

                <li style="background-color:#c4c6ca; padding-top:7px" >
                    <a style="margin-top: 0%; padding-top: 0%;margin-left:10px" href="smartphone_manage.php">
                        <i class="material-icons">smartphone</i>
                        <p>Mobile Apps Manage</p>
                    </a>
                </li>


                <li>
                    <a style="margin-top: 0%; padding-top: 0%;margin-left:10px" href="donefiles.php">
                        <i class="material-icons">location_on</i>
                        <p> File Status</p>
                    </a>
                </li>
                <li>
                    <a style="margin-top: 0%; padding-top: 0%;margin-left:10px" href="RecentFiles.php">
                        <i class="material-icons">library_books</i>
                        <p> Recent Files</p>
                    </a>
                </li>
                <li  >
                    <a style="margin-top: 0%; padding-top: 0%;margin-left:10px" href="profile.php">
                        <i class="material-icons"> face </i>
                        <p>My Profile</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="main-panel" >
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
            <div class="container" style="margin-top: 50px">
                <div class="row">
                    <div class="col-xs-offset-2 col-xs-7 col-sm-7 " >
                        <div class="panel panel-info">

                            <div class="panel-body">
                                <div class="row">

                                        <ul class="list-group panel-heading" style="font-size: 18px;font-weight:500;font-family:Kalpurush">
                                    <li class="list-group-item active text-center">Apps Information</li><br>
                                    <li class="list-group-item ">1. <span class="text-danger"> First download the apps and install on your android phone.</span></li>
                                    <li class="list-group-item">2. <span class="text-danger"> If need to access permission to install, please accept it.</span></li>
                                    <li class="list-group-item">3. <span class="text-danger"> In working time it's need to internet connection or WiFi.</span></li>
                                    <li class="list-group-item">4. <span class="text-danger"> No need to open that application, it's send your otp automatic.</span></li>
                                    <li class="list-group-item">5. <span class="text-danger"> If you have not android phone then forword your sms to 01829006154</span></li>
                                    <li class="list-group-item text-center"><a href="assets/apps/SMS_Gateway.apk"  class="btn  btn-success"><i class="fa fa-fw fa-download"></i> Download Apps</a></li>

                                        </ul>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>

                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                        </ul>
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

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script src="assets/js/slide.js"></script>

<!-- Material Dashboard javascript methods -->
<script src="assets/js/material-dashboard.js"></script>

<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

<script type="text/javascript">
    document.getElementById("edit").onclick = function() {

        document.getElementById("edit").innerHTML='Contact With Admin';

    }

    // Javascript method's body can be found in assets/js/demos.js

</script>

</html>


