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
 
 public function register($uname,$email,$upass,$code)
 {
  try
  {       
   $password = md5($upass);
   $stmt = $this->conn->prepare("INSERT INTO tbl_admin(adminName,adminEmail,adminPass,tokenCode) 
                                                VALUES(:user_name, :user_mail, :user_pass, :active_code)");
   $stmt->bindparam(":user_name",$uname);
   $stmt->bindparam(":user_mail",$email);
   $stmt->bindparam(":user_pass",$password);
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
   $stmt = $this->conn->prepare("SELECT * FROM tbl_admin WHERE adminEmail=:email_id");
   $stmt->execute(array(":email_id"=>$email));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
   
   if($stmt->rowCount() == 1)
   {
    if($userRow['userStatus']=="Y")
    {
     if($userRow['adminPass']==md5($upass))
     {
      $_SESSION['adminSession'] = $userRow['adminID'];
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
  if(isset($_SESSION['adminSession']))
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
  $_SESSION['adminSession'] = false;
 }
 
 function send_mail($email,$message,$subject)
 {      
  require_once('../mailer/class.phpmailer.php');
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
  $mail->SetFrom('aniket.katkar@ubisoft.com','Coding Cage');
  $mail->AddReplyTo("aniket.katkar@ubisoft.com","Coding Cage");
  $mail->Subject    = $subject;
  $mail->MsgHTML($message);
  $mail->Send();
 } 
}