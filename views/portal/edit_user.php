<?php
include("../../vendor/autoload.php");
use App\reg\reg;
session_start();
$obj = new reg();
if (empty($_SESSION['user_id'])) {
    $_SESSION['Message'] ="Access Denied ! Login First ";
    header('location:../auth/login.php');
}
elseif($_SESSION['user_id']['User_type']!='ADMIN'){
    header('location:../portal/index.php');
}
if (isset($_GET) & !empty($_GET)){

    if ($_GET['edit']) {
        $fileId=$_GET['edit'] ;
        $oneuser=$obj->OneUserdata($fileId);

    }
}

if (isset($_POST) & !empty($_POST)){

    if (  !empty($_POST['User_name']) &  !empty($_POST['Password']) &  !empty($_POST['File_amount']) & !empty($_POST['reffer_email']) & !empty($_POST['fullname'])) {
        $UserId=$_GET['edit'] ;
        $obj->setData($_POST)->EditOneUser($UserId);
    }

    else{
        $_SESSION['error']= " Check Your Fields !";

    }
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
                <li  style="background-color:#c4c6ca; padding-top:7px">
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
                    <div class="col-xs-offset-2 col-xs-7 col-sm-7 " >
                        <div class="text-center">
                            <h5 style="margin-left:400px; margin-right: 400px; height:5px; margin-top: 7px">

                                <?php if(isset( $_SESSION['adduser'])){?><div class="alert alert-success" role="alert"> <?php echo  $_SESSION['adduser']; unset( $_SESSION['adduser']); ?> </div><?php } ?>
                                <?php if(isset( $_SESSION['adderror'])){?><div class="alert alert-danger" role="alert"> <?php echo  $_SESSION['adderror']; unset( $_SESSION['adderror']);?> </div><?php } ?>

                            </h5>
                            <hr />
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="text-align: center; color:black; font-weight: bold">Fill Up Your New User Information</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10 ">
                                        <form class="form-group" method="post">
                                            <table class="table table-user-information">
                                                <tbody>
                                                <tr>
                                                    <td style="font-weight:800;color:#2e2e2e;">Full Name </td>
                                                    <td><input name="fullname" style="font-weight:500;olor:#DC143C;border-radius: 5px" type="text"  value="<?php if(isset($oneuser)){ echo $oneuser['Full_name'];} ?>" placeholder=" Full Name"  required></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight:800;color:#2e2e2e;" >Username</td>
                                                    <td><input name="User_name" style="font-weight:500;olor:#DC143C;border-radius: 5px" type="text" value="<?php if(isset($oneuser)){ echo $oneuser['User_name'];} ?>" placeholder=" Username" required></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight:800;color:#2e2e2e;">File Amount</td>
                                                    <td><input name="File_amount" style="font-weight:500;olor:#DC143C;border-radius: 5px" type="number" value="<?php if(isset($oneuser)){ echo $oneuser['File_amount'];} ?>" placeholder=" Maximum 5" required></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight:800;color:#2e2e2e;">Mobile No</td>
                                                    <td><input name="Mobile" style="font-weight:500;olor:#DC143C;border-radius: 5px" type="number" value="<?php if(isset($oneuser)){ echo '0'.$oneuser['Mobile'];} ?>" placeholder=" Mobile No" required></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight:800;color:#2e2e2e;">Reffer Email</td>
                                                    <td><input name="reffer_email" style="font-weight:500;olor:#DC143C;border-radius: 5px" type="email" value="<?php if(isset($oneuser)){ echo $oneuser['Reffer_email'];} ?>" placeholder=" Reffer Email" required></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight:800;color:#2e2e2e;">Password</td>
                                                    <td><input name="Password" style="font-weight:500;olor:#DC143C;border-radius: 5px" type="password" placeholder="New Or Old Password" required></td>
                                                </tr>
                                                </tbody>
                                            </table>

                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn"><i class="glyphicon glyphicon-envelope"></i></a>
                                <span class="pull-right">
                                    <button   type="submit" class="btn btn-primary" ><i class="fa fa-fw fa-gear"></i>Add User</button>
                                     <a href="profile.php" data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-danger"> Cancel</a>
                        </span>
                            </div>
                            </form>
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
