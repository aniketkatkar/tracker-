<?php
	session_start(); 
	require_once 'class.user.php';
	include_once 'simpledbconfig.php';
	$user_home = new USER();
	 
	if(!$user_home->is_logged_in())
	{
	 $user_home->redirect('index.php');
	}
	
	$stmt = $user_home->runQuery("SELECT * FROM tracker_users WHERE userID=:uid");
	$stmt->execute(array(":uid"=>$_SESSION['userSession']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
	$task_name=$_POST['task_name'];
	$task_description=$_POST['task_description'];
	$task_status=$_POST['task_status'];
	$due_date=$_POST['due_date'];
	$created_date = DATE("Y-m-d");
	$completed_date=$_POST['completed_date'];
	$comment=$_POST['comment'];
	$created_by=$row['userName'];
	
	mysqli_query($conn,"insert into tasks (task_name, task_description, task_status, created_date, due_date, completed_date, comment, created_by) values ('$task_name', '$task_description', '$task_status', '$created_date', '$due_date', '$completed_date', '$comment', '$created_by')");
	header('location:home.php');

?>