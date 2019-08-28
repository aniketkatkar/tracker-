<?php
session_start();
require_once 'class.user.php';
 
$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
 $reg_user->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
 $uname = trim($_POST['txtuname']);
 $email = trim($_POST['txtemail']);
 $upass = trim($_POST['txtpass']);
 $project = trim($_POST['project_name']);
 $code = md5(uniqid(rand()));
 
 $stmt = $reg_user->runQuery("SELECT * FROM tracker_admin WHERE adminEmail=:email_id");
 $stmt->execute(array(":email_id"=>$email));
 $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
 if($stmt->rowCount() > 0)
 {
  $msg = "
        <div class='alert alert-error'>
    <button class='close' data-dismiss='alert'>&times;</button>
     <strong>Sorry !</strong>  email already exists , Please Try another one
     </div>
     ";
 }
 else
 {
  if($reg_user->register($uname,$email,$upass,$project,$code))
  {   
   $id = $reg_user->lasdID();  
   $key = base64_encode($id);
   $id = $key;
   
   $message = "     
      Hello $uname,
      <br /><br />
      Welcome to Task Tracker!<br/>
      You have registered to the application with the username : $uname and email : $email for the project : $project.
      To complete your registration  please , just click following link<br/>
      <br /><br />
      <a href='http://10.206.39.245/tracker/admin/verify.php?id=$id&code=$code'>Click HERE to Activate</a>
      <br /><br />
      Thanks,
      Tracker Server<br><br><br>
      
      <i>This is an auto reply system. Please do not reply to this email. For any query, refer the Help page.</i>";
      
   $subject = "Confirm Registration | Task Tracker";
      
   $reg_user->send_mail($email,$message,$subject); 
   $msg = "
     <div class='alert alert-success'>
      <button class='close' data-dismiss='alert'>&times;</button>
      <strong>Success!</strong>  We've sent an email to $email.
                    Please click on the confirmation link in the email to activate your account. 
       </div>
     ";
  }
  else
  {
   echo "sorry , Query could no execute...";
  }  
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

  <title>Signup | Task Tracker</title>

  <!-- Bootstrap CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="../css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="../css/elegant-icons-style.css" rel="stylesheet" />
  <link href="../css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style-responsive.css" rel="stylesheet" />


</head>

<body class="login-img3-body">

  <div class="container">
  <?php if(isset($msg)) 
  echo '<p class="alert alert-success fade in">'.$msg.'</p>'; 
  ?>
    <form class="login-form" method="post">
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" class="form-control" name="txtuname" placeholder="Username" autofocus>
        </div>
        <div class="form-group">
          <label style="float:left;color:black">Select Project</label>
              <select class="form-control" name="project_name" style="width:100%">
                  <option value="Just Dance">Just Dance</option>
                  <option value="The Crew 2">The Crew 2</option>
              </select>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="email" class="form-control" name="txtemail" placeholder="Ubisoft Email" >
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" class="form-control" name="txtpass" placeholder="Password">
        </div>
        <label class="checkbox">
                <!-- <input type="checkbox" value="remember-me"> Remember me -->
                <span class="pull-right"> <a href="fpass.php"> Forgot Password?</a></span>
            </label>
            <button class="btn btn-primary btn-lg btn-block" name="btn-signup" type="submit">Signup</button>
        <a href="index.php" class="btn btn-info btn-lg btn-block" type="submit"><span style="color:white">Login</span></a>
        
      </div>
    </form>
    <div class="text-right">
    <div style="margin-top:20%" class="credits">
          
          Powered by <a style="color:white" href="https://10.206.39.245/">- <b>Team Just Dance</b></a>
        </div>
    </div>
  </div>


</body>

</html>
