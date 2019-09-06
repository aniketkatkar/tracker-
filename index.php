<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
 $user_login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
 $email = trim($_POST['txtemail']);
 $upass = trim($_POST['txtupass']);
 
 if($user_login->login($email,$upass))
 {
  $user_login->redirect('home.php'); 
 }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png"> 

  <title>Login | Task Tracker</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <style>
    body {
  
  margin: 0px;
  overflow: hidden;

}
    </style>

</head>

<body class="login-img3-body">

  <div class="container">
  
    <form class="login-form" method="post">
    <?php 
  if(isset($_GET['inactive']))
  {
   ?>
            <div class='alert alert-block alert-danger fade in'>
    <button class='close' data-dismiss='alert'>&times;</button>
    <strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. 
   </div>
            <?php
  }
  ?>
    <?php
        if(isset($_GET['error']))
  {
   ?>
            <div class='alert alert-success fade in'>
    <button class='close' data-dismiss='alert'>&times;</button>
    <strong>Wrong Details!</strong> 
   </div>
            <?php
  }
  ?>
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <p>Tester Login</p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" class="form-control" placeholder="Email" name="txtemail" autofocus>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" class="form-control" name="txtupass" placeholder="Password">
        </div>
        <label class="checkbox">
                <!-- <input type="checkbox" value="remember-me"> Remember me -->
                <span class="pull-right"> <a href="fpass.php"> Forgot Password?</a></span>
            </label>
        <button class="btn btn-primary btn-lg btn-block" name="btn-login" type="submit">Login</button>
        <a style="color:#fff" href="signup.php" class="btn btn-info btn-lg btn-block" type="submit"><span style="color:white">Signup</span></a>
        <label class="checkbox">
                <!-- <input type="checkbox" value="remember-me"> Remember me -->
                <span class="pull-right"> <a href="http://10.206.39.245/tracker/admin/index.php">Go to Lead/Manager Section</a></span>
            </label>
      </div>
    </form>
    <div class="text-right">
      <div style="margin-top:20%; color:white" class="credits">
          Powered by <a style="color:white" href="  http://10.206.39.245/">- <b>Team Just Dance</b></a>
        </div>
    </div>
  </div>


</body>

</html>
