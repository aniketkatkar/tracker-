<?php
session_start();
require_once 'class.user.php';
include_once '../simpledbconfig.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('index.php');
}
 
$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
// $stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//$user_name = $row['userName'];
$id = $_GET['id'];
?>
<table id="myTable" class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th><i class="icon_profile"></i> Task Name</th>
                    <th><i class="icon_calendar"></i> Task Description</th>
                    <th><i class="icon_mail_alt"></i> Task Status</th>
                    <th><i class="icon_pin_alt"></i> Created on</th>
                    <th><i class="icon_mobile"></i> Due date</th>
                    <th><i class="icon_cogs"></i> Completed on</th>
                    <th><i class="icon_cogs"></i> Comments</th>
                    <th><i class="icon_cogs"></i> Actions</th>
                  </tr>
                  <?php				
                    $query=mysqli_query($conn,"select * from tasks where created_by = '$id'");
                    while($row=mysqli_fetch_array($query)){
                      ?>
                      <tr>
                        <td><?php echo $row['task_name']; ?></td>
                        <td><?php echo $row['task_description']; ?></td>
                        <td><?php echo $row['task_status']; ?></td>
                        <td><?php echo $row['created_date']; ?></td>
                        <td><?php echo $row['due_date']; ?></td>
                        <td><?php echo $row['completed_date']; ?></td>
                        <td><?php echo $row['comment']; ?></td>
                        <td>
                                    <a class="btn btn-primary" href='update.php?task_id=<?php echo $row['task_id'] ?>'><i class="icon_plus_alt2"></i>Update</a> |
                                    <a class="btn btn-danger" href='delete.php?task_id=<?php echo $row['task_id'] ?>'><i class="icon_close_alt2"></i>Delete</a>
                        </td>
                      </tr>
                      <?php
                    }
                  ?>
                  
                
                  
                </tbody>
              </table>
              <?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <p class="form-control-static"><?php echo $row["tester_name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>email</label>
                        <p class="form-control-static"><?php echo $row["userEmail"]; ?></p>
                    </div>
                    <!-- <div class="form-group">
                        <label>Salary</label>
                        <p class="form-control-static">same salary code like above</p>
                    </div> -->
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>