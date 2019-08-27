<?php

require_once 'dbconfig.php';

class USER
{ 

 private $conn;
 
 public function __construct()
 {
  $database = new Database();
  $db = $database->dbConnection();
  $this->conn = $db;
    }
 
 public function runQuery($sql)
 {
  $stmt = $this->conn->prepare($sql);
  return $stmt;
 }
 
 public function lasdID()
 {
  $stmt = $this->conn->lastInsertId();
  return $stmt;
 }
 
 public function register($uname,$tester_name,$email,$upass,$project,$code)
 {
  try
  {       
   $password = md5($upass);
   $stmt = $this->conn->prepare("INSERT INTO tracker_users(userName,tester_name,userEmail,userPass,project_name,tokenCode) 
                                                VALUES(:user_name, :tester_name, :user_mail, :user_pass,:user_project, :active_code)");
   $stmt->bindparam(":user_name",$uname);
   $stmt->bindparam(":tester_name",$tester_name);
   $stmt->bindparam(":user_mail",$email);
   $stmt->bindparam(":user_pass",$password);
   $stmt->bindparam(":user_project",$project);
   $stmt->bindparam(":active_code",$code);
   $stmt->execute(); 
   return $stmt;
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
 
 public function login($email,$upass)
 {
  try
  {
   $stmt = $this->conn->prepare("SELECT * FROM tracker_users WHERE userEmail=:email_id");
   $stmt->execute(array(":email_id"=>$email));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
   
   if($stmt->rowCount() == 1)
   {
    if($userRow['userStatus']=="Y")
    {
     if($userRow['userPass']==md5($upass))
     {
      $_SESSION['userSession'] = $userRow['userID'];
      return true;
     }
     else
     {
      header("Location: index.php?error");
      exit;
     }
    }
    else
    {
     header("Location: index.php?inactive");
     exit;
    } 
   }
   else
   {
    header("Location: index.php?error");
    exit;
   }  
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
 
 
 public function is_logged_in()
 {
  if(isset($_SESSION['userSession']))
  {
   return true;
  }
 }
 
 public function redirect($url)
 {
  header("Location: $url");
 }
 
 public function logout()
 {
  session_destroy();
  $_SESSION['userSession'] = false;
 }
 
 function send_mail($email,$message,$subject)
 {      
  require_once('mailer/class.phpmailer.php');
  $mail = new PHPMailer();
  $mail->IsSMTP(); 
  $mail->SMTPDebug  = 0;                     
  $mail->SMTPAuth   = false;                  
  $mail->SMTPSecure = "TLS";                 
  $mail->Host       = "smtp.ubisoft.org";      
  $mail->Port       = 25;             
  $mail->AddAddress($email);
  $mail->Username="aniket.katkar@ubisoft.com";  
  $mail->Password="yourgmailpassword";            
  $mail->SetFrom('aniket.katkar@ubisoft.com','Team Just Dance');
  $mail->AddReplyTo("aniket.katkar@ubisoft.com","Team Just Dance");
  $mail->Subject    = $subject;
  $mail->MsgHTML($message);
  $mail->Send();
 } 
}