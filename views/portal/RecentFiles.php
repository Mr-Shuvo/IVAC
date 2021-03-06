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
else{
    $obj = new reg();
    $alldata =$obj->GetAllDate();

}
if (isset($_GET['Resubmit']) & !empty($_GET['Resubmit'])){
        $user=$_SESSION['user_id']['User_name'];
        $fileId=$_GET['Resubmit'] ;
        $obj->getallfiles($user);
        $obj->ResubmitFile($fileId);
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
    <script>

        function showOrNot() {

            if( document.getElementById('select_date').value=='null'){
                document.getElementById('show').style.color='crimson';
                document.getElementById('show').innerHTML = 'Select date to show your recent submit files';
            }
            else if( document.getElementById('select_date').value!=null){
                document.getElementById('show').style.color='green';
                document.getElementById('show').innerHTML = 'Click Resubmit To Reprocess Your File';

            }

        }
    </script>
</head>


<body>

<div class="wrapper">

    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-1.jpg">
        <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

            Tip 2: you can also add an image using data-image tag
        -->

        <div class="logo" style="background-color:purple; color: white; text-align: center; margin-top: 11px" >
            <a href="index.php" style="color: white; font-weight: bold ; color:whitesmoke ; margin-right:14px "  ><i class="fa fa-fw fa-gear"></i>
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
                        <p>Your Upload Files</p>
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
                <li style="background-color:#c4c6ca; padding-top:7px">
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


            <div class="col-sm-offset-1 col-sm-10">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title" style="text-align: center">Your Recent Working Files</h4>

                    </div>
                    <div class="card-content table-responsive">
                        <div style="font-weight: 900; " class="col-md-offset-4 col-md-4">
                            <tr>
                                <td>Working Date : </td>
                                <td><select name="select_date" onchange="showOrNot();"  id="select_date" style="width: 50%;height: 25px">
                                        <option value="null">Select Date</option> <?php
                                        foreach ($alldata as $data) {?>

                                            <option value="<?php echo $data['Submit_time']?>"><?php echo $data['Submit_time'] ?></option>

                                            <?php
                                        }

                                        ?>
                                    </select></td>
                            </tr>
                        </div><br>

                        <table class="table table-hover">

                            <thead>
                            <hr>
                            <th style="font-weight:bolder; color:#4a148c"><center>SN</center></th>
                            <th style="font-weight:bolder; color:#4a148c"><center>Mission</center></th>
                            <th style="font-weight:bolder; color:#4a148c"><center>BGD</center></th>
                            <th style="font-weight:bolder; color:#4a148c"><center>Passport</center></th>
                            <th style="font-weight:bolder; color:#4a148c"><center>Given Name</center></th>
                            <th style="font-weight:bolder; color:#4a148c"><center>Status</center></th>
                            <th style="font-weight:bolder; color:#4a148c"><center>Action</center></th>
                            </thead>
                            <tbody id="td">

                            </tbody>
                        </table>
                        <div style="height: 40px; font-weight: 600;color: crimson; margin-top:30px ;text-align: center" id="show">
                            Select date to show your recent submit files
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


<!-- Material Dashboard javascript methods -->
<script src="assets/js/material-dashboard.js"></script>

<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

<script type="text/javascript">
        $(document).ready(function(){
            $("#select_date").change(function(){

                var date = $(this).val();

                $.ajax({

                    url: 'Ajax_LostFile.php',
                    type: 'post',
                    data: {lost_files:date},
                    dataType: 'json',
                    success:function(response){

                        var len = response.length;

                        $('#td').empty();



                            for (var i = 0; i < len; i++) {
                                var ID = response[i]['id'];
                                var Mission = response[i]['Mission'];
                                var BGD = response[i]['BGD'];
                                var Passport = response[i]['Passport'];
                                var G_name = response[i]['Given_name'];
                                var Status  = response[i]['Status'];


                                $("#td").append("<tr id='rem'><td><center>" + (i+1) + "</center></td><td><center>" + Mission + "</center></td><td><center>" + BGD + "</center></td><td><center>" + Passport + "</center></td><td><center>" + G_name + "</center></td><td><center>" + Status + "</center></td><td class='NotAllow'><center><a href='RecentFiles.php?Resubmit="+ID+"' data-original-title='Remove this user' data-toggle='tooltip' type='button' class='btn btn-success'>Resubmit</a></center></td></tr>");

                            }

                    }
                });
            });

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

                    document.getElementById("show").style.color ="red";
                    document.getElementById("show").innerHTML ="Manage Your File's At  12:00 - 3:00 Am";


                }



                function harold(standIn) {
                    if (standIn < 10) {
                        standIn = '0' + standIn
                    }
                    return standIn;
                }
            }

            setInterval(clock, 100);




        });


</script>

</html>


