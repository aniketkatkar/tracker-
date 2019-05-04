<?php
	include('simpledbconfig.php');
	
	$task_name=$_POST['task_name'];
	$task_description=$_POST['task_description'];
	$task_status=$_POST['task_status'];
	$due_date=$_POST['due_date'];
	$created_date = DATE("Y-m-d");
	$completed_date=$_POST['completed_date'];
	$comment=$_POST['comment'];
	$created_by=$_POST['created_by'];
	
	mysqli_query($conn,"insert into tasks (task_name, task_description, task_status, created_date, due_date, completed_date, comment, created_by) values ('$task_name', '$task_description', '$task_status', '$created_date', '$due_date', '$completed_date', '$comment', '$created_by')");
	header('location:home.php');

?>