<?php
include("../../vendor/autoload.php");
use App\reg\reg;
session_start();
$obj = new reg();
if (empty($_SESSION['user_id'])) {
    $_SESSION['Message'] ="Access Denied ! Login First ";
    header('location:../auth/login.php');
}
elseif($_SESSION['user_id']['User_type']!='USER'){
    header('location:../portal/Admin.php');
}
if (isset($_POST) & !empty($_POST)){

    if (  !empty($_POST['BGD']) &  !empty($_POST['Passport']) ) {
        $user=$_SESSION['user_id']['User_name'];
        $obj->getallfiles($user);
        $amount=$obj->FileOverCount();
        $total=$obj->countfiles;
          if($total==$amount['File_amount']){
              $_SESSION['error']= "You Already Added Maximum Amount !";
          }
          else{
              $obj->setfile($_POST)->storfile();
          }


    }
    else{
        $_SESSION['error']= " Check Your Files !";

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
                <li style="background-color:#c4c6ca; padding-top:7px">
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

                <li>
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
                <li>
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

            <div class="container" style="margin-top: 30px">
                <div class="row">
                    <div class="col-xs-offset-2 col-xs-7 col-sm-7 " >
                        <?php if(isset($_SESSION['department'])){?><div class="btn-success" style="background-color:#388e3c;color: white; text-align: center; font-weight: bold; height: 30px; border-radius: 2px; border: 1px solid black" role="alert"> <?php echo  $_SESSION['department']; unset( $_SESSION['department']); ?> </div><?php } ?>
                        <?php if(isset( $_SESSION['error'])){?><div style="background-color:crimson;color: whitesmoke; text-align: center; height: 26px; font-weight: bold; border-radius: 2px; border: 1px solid black" role="alert"> <?php echo  $_SESSION['error']; unset( $_SESSION['error']);?> </div><?php } ?>
                        <br />

            <div class="col-md-offset-2 col-md-8" >
                <div class="card">
                    <div class="card-header" data-background-color="green">
                        <h4 class="title" style="text-align: center">Add Your File</h4>
                    </div>
                    <div class="card-content table-responsive">
                        <form class="form-horizontal" method="post" >
                            <table class="table table-hover">
                                <thead class="text-warning">
                                <tbody>
                                <tr>
                                    <td style="font-weight:800;color:#2e2e2e;" > Mission </td>
                                    <td><select name="Mission" style="width:162px;font-weight:bold;color:#DC143C;border-radius: 5px " size="1">
                                            <option style="font-weight:800;color: #2e2e2e" value="">Select center</option>
                                            <option style="font-weight:800;color: #2e2e2e" value="Gulshan">Gulshan</option>
                                            <option style="font-weight:800;color: #2e2e2e" value="Sylhet">Sylhet</option>
                                            <option style="font-weight:800;color: #2e2e2e" value="Motijheel">Motijheel</option>
                                            <option style="font-weight:800;color: #2e2e2e" value="Uttara">Uttara</option>
                                            <option style="font-weight:800;color: #2e2e2e" value="Barishal">Barishal</option>
                                            <option style="font-weight:800;color: #2e2e2e" value="Mymensingh">Mymensingh</option>
                                            <option style="font-weight:800;color: #2e2e2e" value="Khulna">Khulna</option>
                                            <option style="font-weight:800;color: #2e2e2e" value="Jessore">Jessore</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight:800;color:#2e2e2e;">BGD Number</td>
                                    <td><input type="text" name="BGD" style="font-weight:500;olor:#DC143C;border-radius: 5px"  placeholder=" BGD Number" required> </td>

                                </tr>
                                <tr>
                                    <td style="font-weight:800;color:#2e2e2e;">Passport</td>
                                    <td><input type="text" name="Passport" style="font-weight:500;olor:#DC143C;border-radius: 5px"   placeholder=" Passport Number" required> </td>
                                </tr>
                                <tr>
                                    <td style="font-weight:800;color:#2e2e2e;">Given Name</td>
                                    <td><input type="text" name="Given_name" style="font-weight:500;olor:#DC143C;border-radius: 5px"   placeholder=" Given Name" required></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:800;color:#2e2e2e;">Birth Place</td>
                                    <td><input type="text" name="Birth_place" style="font-weight:500;olor:#DC143C;border-radius: 5px"  placeholder=" Birth Place" required></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:800;color:#2e2e2e;" >Father's Name</td>
                                    <td><input type="text" name="Father_name" style="font-weight:500;olor:#DC143C;border-radius: 5px"  placeholder=" Father Name" required></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:800;color:#2e2e2e;" >Mother's Name</td>
                                    <td><input type="text" name="Mother_name" style="font-weight:500;olor:#DC143C;border-radius: 5px"  placeholder=" Mother Name" required></td>
                                </tr>

                                </tbody>
                            </table>
                            <div class="panel-footer">

                            <span style="margin-left:15%" >
                                <span id="NotAllow" > <button  type="submit" class="btn btn-info" ><i class="fa fa-fw fa-floppy-o"></i> Save</button></span>
                                <a href="index.php" data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
                            </span>
                        </form>
                    </div>
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

    // Javascript method's body can be found in assets/js/demos.js
    function clock() {// We create a new Date object and assign it to a variable called "time".
        var time = new Date(),

            // Access the "getHours" method on the Date object with the dot accessor.
            hours = time.getHours(),

            // Access the "getMinutes" method with the dot accessor.
            minutes = time.getMinutes(),


            seconds = time.getSeconds();

        var Current_time = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);
      <?php

        $user=$_SESSION['user_id']['User_name'];
        $obj->getallfiles($user);

        if( $obj->countfiles!=0) {

        echo

        " if(parseInt(harold(hours))>=parseInt('03')){

            document.getElementById('NotAllow').style.color='crimson';
            document.getElementById('NotAllow').style.fontWeight='900';

           //$('#NotAllow').html('After 12 Am');


        } ";

                                }

        ?>


        function harold(standIn) {
            if (standIn < 10) {
                standIn = '0' + standIn
            }
            return standIn;
        }
    }

    setInterval(clock, 100);




</script>

</html>


