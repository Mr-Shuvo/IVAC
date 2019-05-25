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
else{
    $user=$_SESSION['user_id']['User_name'];
    $allfiles=$obj->getallfiles($user);

}

if (isset($_GET['delete'])) {
        $fileId = $_GET['delete'];
        $obj->DeleteOneFile($fileId);

}
elseif (isset($_GET['deleteAll'])) {
        $obj->DeleteAllFiles();
}

elseif (isset($_GET['Submit'])){

                    $user=$_SESSION['user_id']['User_name'];
                    $obj->getallfiles($user);

                    $sender=$obj->getMail($user);

                    $sendTo='shuvo.ezzyr@gmail.com';

                    require("PHPMailer/class.phpmailer.php");

                    $mail = new PHPMailer();

                    $mail->IsSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "pakkna@gmail.com";
                    $mail->Password = "pakkna100";

                    $mail->From = "pakkna@gmail.com";
                    $mail->FromName = "IVAC SOFT";

                    $mail->AddAddress($sendTo);

                    $mail->WordWrap = 100;

                    $mail->IsHTML(true);
                    $mail->Subject = "Mr ".$user." Files";

                    $mail->Body = "Mr $user Submitted <b> $obj->countfiles</b> Files .<br><br> Please, Donload It From Our Portal";

                    if (!$mail->Send()) {
                        $_SESSION['mailerror'] ="Have An Error Contact With Admin";
                        header('location:upload_files.php');
                        exit;
                    }

                    $_SESSION['mailsent']= "Files Submitted Successfully";
                    header('location:upload_files.php');
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
                <li style="background-color:#c4c6ca; padding-top:7px" >
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
                <h4 class="title" style="text-align: center">Your Uploaded Files</h4>
            </div>
            <div class="card-content table-responsive">
                <table id="table" class="table table-hover">
                    <thead class="text-warning">
                    <th>SN</th>
                    <th>Mission</th>
                    <th>BGD Number</th>
                    <th>Passport</th>
                    <th>Given Name</th>
                    <th>Birth Place</th>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>Date</th>
                    <th id="action"> Action </th>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($allfiles as $data) {

                        ?>

                        <tr>
                            <td><small><?php echo $obj->i++; ?></small></td>
                            <td><small><?php echo $data['Mission'] ?></small></td>
                            <td ><small><?php echo $data['BGD'] ?></small></td>
                            <td><small><?php echo $data['Passport'] ?> </small></td>
                            <td style="width:120px"><small><?php echo $data['Given_name'] ?> </small></td>
                            <td><small><?php echo $data['Birth_place'] ?> </small></td>
                            <td style="width:120px"><small><?php echo $data['Father_name'] ?> </small></td>
                            <td style="width:120px"><small><?php echo $data['Mother_name'] ?> </small></td>
                            <td><small><?php echo $data['Submit_time'] ?></small></td>
                            <td class="NotAllow"><a href="<?php echo"Edit_file.php?edit=";echo $data['id'] ?>">Edit</a>  / <a href="<?php echo"upload_files.php?delete=";echo $data['id'] ?>">Delete</a> </td>
                        </tr>
                        <?php
                    }

                    ?>

                    </tbody>
                </table>
                <div class="panel-footer"><span style="color:#c2185b; font-weight: bold;font-family: "Roboto", "Helvetica", "Arial", sans-serif"><center> Manage Your File's At  12:00 - 3:00 Am</center></span>

                            <span id="del_btn" class="pull-right">
                                    <a href="<?php echo"upload_files.php?deleteAll=all" ?>" data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-danger">Delete All Files</a>
                            </span>
                </div>
            </div>
        </div>
    </div>
            <br>
            <div class="container" style="margin-top: 30px">
                <div class="row">
                    <div class="col-xs-offset-2 col-xs-7 col-sm-7 " >
                        <?php if(isset($_SESSION['mailsent'])){?><div class="btn-success" style="background-color:#388e3c;color: white; text-align: center; font-weight: bold; height: 30px; border-radius: 2px; border: 1px solid black" role="alert"> <?php echo  $_SESSION['mailsent']; unset( $_SESSION['mailsent']); ?> </div><?php } ?>
                        <?php if(isset( $_SESSION['mailerror'])){?><div style="background-color:crimson;color: whitesmoke; text-align: center; height: 26px; font-weight: bold; border-radius: 2px; border: 1px solid black" role="alert"> <?php echo  $_SESSION['mailerror']; unset( $_SESSION['mailerror']);?> </div><?php } ?>
                        <br />


                            <div align="center">
                                 <p style="color: black;font-weight: 800;font-size: 16px" "> Please Click Submit Button When Your Uploading Files Are Ready</p>
                                <a href="<?php echo"upload_files.php?Submit=ALL" ?>" data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-success">Submit My Files</a>

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
<script src="assets/js/slide.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

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

            if(parseInt(harold(hours))>=parseInt('24')){


                var tdList = document.getElementsByClassName("NotAllow");

                for(var i = 0; i < tdList.length; i++){

                    tdList[i].style.color ="red";
                    tdList[i].style.fontWeight ="900";
                    tdList[i].innerHTML = 'Not Allow'
                }
                document.getElementById("del_btn").innerHTML ='';

            }



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


