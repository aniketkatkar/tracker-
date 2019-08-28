<?php
session_start();
require_once 'class.user.php';
$user = new USER();

if($user->is_logged_in()!="")
{
 $user->redirect('home.php');
}

if(isset($_POST['btn-submit']))
{
 $email = $_POST['txtemail'];
 
 $stmt = $user->runQuery("SELECT userID FROM tracker_users WHERE userEmail=:email LIMIT 1");
 $stmt->execute(array(":email"=>$email));
 $row = $stmt->fetch(PDO::FETCH_ASSOC); 
 if($stmt->rowCount() == 1)
 {
  $id = base64_encode($row['userID']);
  $code = md5(uniqid(rand()));
  
  $stmt = $user->runQuery("UPDATE tracker_users SET tokenCode=:token WHERE userEmail=:email");
  $stmt->execute(array(":token"=>$code,"email"=>$email));
  
  $message= "
  Hello, $email
  <br /><br />
  We got a request to reset your password, please click the following link to continue,
  <br /><br />
  <a href='http://10.206.39.245/tracker/resetpass.php?id=$id&code=$code'>click here to reset your password</a>
  <br /><br />
  Thank you :) Have a great day!!!
  ";
  $subject = "Password Reset";
  
  $user->send_mail($email,$message,$subject);
  
  $msg = "<div class='alert alert-success'>
     <button class='close' data-dismiss='alert'>&times;</button>
     We've sent an email to $email.
                    Please click on the password reset link in the email to generate a new password. 
      </div>";
      header("refresh:10;index.php");
 }
 else
 {
  $msg = "<div class='alert alert-danger'>
     <button class='close' data-dismiss='alert'>&times;</button>
     <strong>Sorry!</strong>  This email was not found Please check again or register. 
       </div>";
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

  <title>Forget Password | Task Tracker</title>

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

</head>

<body class="login-img3-body">

  <div class="container">

    <form class="login-form" method="post">
    <?php
   if(isset($msg))
   {
    echo $msg;
   }
   else
   {
    ?>
               <div class='alert alert-info'>
    Please enter your email address. You will receive a link to create a new password via email.!
    </div>  
                <?php
   }
   ?>
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" class="form-control" name="txtemail" placeholder="Ubisoft Email" autofocus>
        </div>
        
        <button class="btn btn-primary btn-lg btn-block" name="btn-submit" type="submit">Generate new Password</button>
      </div>
    </form>
    <div class="text-right">
      <div style="color:white; margin-top:20%" class="credits">
          Powered by <a style="color:white" href="https://10.206.39.245/">- Team Just Dance</a>
        </div>
    </div>
  </div>


</body>

</html>
