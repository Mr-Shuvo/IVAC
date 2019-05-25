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
}

if (isset($_GET) & !empty($_GET)) {

    if ($_GET['delete']) {
        $fileId = $_GET['delete'];
        $obj->DeleteOneUser($fileId);
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
                <li style="background-color:#c4c6ca; padding-top:7px" >
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
            </div><br><br>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header" data-background-color="blue">
                        <h4 class="title" style="text-align: center"> User Table Information </h4>
                    </div>
                    <div class="card-content table-responsive">
                        <table id="table" class="table table-hover">
                            <thead class="text-warning">
                            <th>SN</th>
                            <th>Full Name</th>
                            <th>User Name</th>
                            <th> Mobile </th>
                            <th>Vacancy</th>
                            <th>Reffer Email</th>

                            <th id="action"> Action </th>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($alluser as $data) {

                                ?>

                                <tr>
                                    <td><?php echo $obj->i++; ?></td>
                                    <td><?php echo $data['Full_name'] ?></td>
                                    <td><?php echo $data['User_name'] ?></td>
                                    <td>0<?php echo $data['Mobile'] ?> </small></td>
                                    <td><?php echo $data['File_amount'] ?> </td>
                                    <td><?php echo $data['Reffer_email'] ?></td>
                                    <td><a href="<?php echo"Edit_user.php?edit=";echo $data['id'] ?>">Edit</a>  / <a href="<?php echo"?delete=";echo $data['id'] ?>">Delete</a> </td>
                                </tr>
                                <?php
                            }

                            ?>

                            </tbody>
                        </table>
                        <div class="panel-footer"><span style="color:#c2185b; font-weight: bold;font-family: "Roboto", "Helvetica", "Arial", sans-serif"><center> Manage Your User Information</center></span>

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

<!-- Material Dashboard javascript methods -->
<script src="assets/js/material-dashboard.js"></script>

<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>
