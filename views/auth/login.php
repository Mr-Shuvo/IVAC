

<?php
include("../../vendor/autoload.php");
use App\reg\reg;
session_start();
if (isset($_POST) & !empty($_POST)){
    $obj = new reg();
    $obj -> login($_POST);
    //$w= $obj->wrong;
}

/*if (isset($_SESSION['user_id']) && $_SESSION['user_id']['User_type']=='USER') {
    header('location:../portal/index.php');
}

else if (isset($_SESSION['user_id'])&& $_SESSION['user_id']['User_type']=='ADMIN') {

    header('location:../portal/Admin.php');
} */
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Website CSS style -->
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">

    <link rel="stylesheet" type="text/css" href="assets/css/GoLoignCss.css">

    <script src="assets/js/jquery-3.1.0.min.js"></script>

    <script src="assets/js/GoLogin.js"></script>

    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

    <title>Admin</title>
</head>
<body>
<div class="container">
    <div class="row main">
        <div class="panel-heading">
            <div class="panel-title text-center">
                <h1 class="title">User Login Panel</h1>
                <h6 style="margin-left:397px; margin-right: 397px;">
                    <?php if(isset($_SESSION['logout'])){ ?><div class="alert alert-success" role="alert"> <?php echo $_SESSION['logout']; unset($_SESSION['logout']);?> </div><?php } ?>
                    <?php if(isset($_SESSION['Message'])){ ?><div class="alert alert-danger" role="alert"> <?php echo $_SESSION['Message']; unset($_SESSION['Message']);?> </div><?php } ?>

                </h6>
                <hr/>
            </div>
        </div>

            <div id="login-box">
                <div class="logo">
                    <img src="assets/img/user.png" class="img img-responsive img-circle center-block"/>
                    <h1 class="logo-caption"><span class="tweak">L</span>ogin</h1>
                </div><!-- /.logo -->
                <div class="controls">
                    <form class="form-horizontal" method="post">
                    <input type="text" name="username" placeholder="Username" class="form-control" /><br>
                    <input type="password" name="password" placeholder="Password" class="form-control" /><br>
                    <button type="submit" class="btn btn-default btn-block btn-custom">Login</button>
                    </form>
                </div><!-- /.controls -->
            </div><!-- /#login-box -->
        <!-- /.container -->
        <div id="particles-js"></div>


    </div>
</div>
</body>