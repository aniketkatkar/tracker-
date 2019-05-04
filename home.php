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

?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Ubisoft</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> 
        <?php echo $row['userEmail']; ?> <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="active">
                                <a href="http://10.206.33.24/tracker">Home</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Tutorials <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li><a href="">PHP OOP</a></li>
                                    <li><a href="">PHP PDO</a></li>
                                </ul>
                            </li>
                            
                            
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <!-- this is the main section -->
        <div style="margin-left:1%; margin-right:1%;width:auto;" class="container">
	<div style="height:50px;width:auto;"></div>
	<div class="well" style="margin:auto; width:auto;">
	<span style="font-size:25px; color:black"><center><strong>Tasks created</strong></center></span>	
		<span class="pull-left"><a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Create New Task</a></span>
		<div style="height:50px;"></div>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<th>Task Name</th>
				<th>Task Description</th>
				<th>Task Status</th>
				<th>Created on</th>
                <th>Due date</th>
                <th>Completed on</th>
                <th>Comments</th>
                <th>Action</th>
			</thead>
			<tbody>
			<?php				
				$query=mysqli_query($conn,"select * from tasks");
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
                        <a href='update.php?task_id=<?php echo $row['task_id'] ?>' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span>Update</a> || 
                        <a href='delete.php?task_id=<?php echo $row['task_id'] ?>' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span>Delete</a>
						</td>
					</tr>
					<?php
				}
			?>
			</tbody>
		</table>
	</div>
    
    <!-- exprimetnt -->
    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- end -->
	<?php include('add_modal.php'); ?>
        
        <!--/.fluid-container-->
        <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
        
    </body>

</html>