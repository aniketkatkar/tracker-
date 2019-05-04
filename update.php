<?php
session_start();
require_once 'class.user.php';
include_once 'simpledbconfig.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$user_name = $row['userName'];
if(count($_POST)>0) {
	$sql = "UPDATE tasks set task_name='" . $_POST["task_name"] . "', task_description='" . $_POST["task_description"] . "', task_status='" . $_POST["task_status"] . "', due_date='" . $_POST["due_date"] . "', completed_date='" . $_POST["completed_date"] . "', comment='" . $_POST["comment"] . "', created_by='" . $user_name . "' WHERE task_id='" . $_POST["task_id"] . "'";
	mysqli_query($conn,$sql);
	$message = "Record Modified Successfully";
}
$select_query = "SELECT * FROM tasks WHERE task_id='" . $_GET["task_id"] . "'";
$result = mysqli_query($conn,$select_query);
$row = mysqli_fetch_array($result);
?>
<html>
<head>
<title>Add New User</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<form name="frmUser" method="post" action="">
<div style="width:500px;">
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
<div align="right" style="padding-bottom:5px;"><a href="index.php" class="link"><img alt='List' title='List' src='images/list.png' width='15px' height='15px'/> List User</a></div>
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
<tr class="tableheader">
<td colspan="2">Edit User</td>
</tr>
<tr>
<td><label>Task</label></td>
<td><input type="hidden" name="task_id" class="txtField" value="<?php echo $row['task_id']; ?>"><input type="text" name="task_name" class="txtField" value="<?php echo $row['task_name']; ?>"></td>
</tr>
<tr>
<td><label>Password</label></td>
<td><input type="text" name="task_description" class="txtField" value="<?php echo $row['task_description']; ?>"></td>
</tr>
<td><label>First Name</label></td>
<td><input type="text" name="task_status" class="txtField" value="<?php echo $row['task_status']; ?>"></td>
</tr>
<td><label>Last Name</label></td>
<td><input type="text" name="due_date" class="txtField" value="<?php echo $row['due_date']; ?>"></td>
</tr>
<td><label>Last Name</label></td>
<td><input type="text" name="completed_date" class="txtField" value="<?php echo $row['completed_date']; ?>"></td>
</tr>
<td><label>Last Name</label></td>
<td><input type="text" name="comment" class="txtField" value="<?php echo $row['comment']; ?>"></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>
</body></html>