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

$user_name = $row['userName'];
$user_email = $row['userEmail'];
if(count($_POST)>0) {
	$sql = "UPDATE tasks set task_name='" . $_POST["task_name"] . "', task_description='" . $_POST["task_description"] . "', task_status='" . $_POST["task_status"] . "', due_date='" . $_POST["due_date"] . "', completed_date='" . $_POST["completed_date"] . "', comment='" . $_POST["comment"] . "', created_by='" . $user_name . "' WHERE task_id='" . $_POST["task_id"] . "'";
	mysqli_query($conn,$sql);
	$message = "Record Modified Successfully";
}
$select_query = "SELECT * FROM tasks WHERE task_id='" . $_GET["task_id"] . "'";
$result = mysqli_query($conn,$select_query);
$row = mysqli_fetch_array($result);
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

  <title>Task Tracker | Just Dance</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />


</head>

<body>
  <!-- container section start -->
  <section id="container" class="">
    <!--header start-->
    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i
            class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="home.php" class="logo">Task <span class="lite">Tracker</span></a>
      <!--logo end-->

      <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
          <li>
            <form class="navbar-form">
              <input class="form-control" placeholder="Search" type="text">
            </form>
          </li>
        </ul>
        <!--  search form end -->
      </div>

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">

         
          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <span class="profile-ava">
              </span>
              <span class="username"><?php echo $user_email; ?></span>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="#"><i class="icon_profile"></i> My Profile</a>
              </li>
               
              <li>
                <a href="logout.php"><i class="icon_key_alt"></i> Log Out</a>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="home.php">
              <i class="icon_house_alt"></i>
              <span>Dashboard</span>
            </a>
          </li>
          

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i> Update Tasks</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="home.php">Home</a></li>
              <li><i class="icon_document_alt"></i>Update Tasks</li>
            </ol>
          </div>
        </div>
        <!-- Form validations -->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Update Tasks
              </header>
              <div class="panel-body">
                <div class="form">
				<?php if(isset($message)) { 
					echo "<p class='alert alert-success fade in'>".$message."</p>" ;
					} ?>
                  <form class="form-validate form-horizontal" name="frmUser" method="post" action="">
                    <div class="form-group ">
                      <label for="cname" class="control-label col-lg-2">Task Name <span
                          class="required">*</span></label>
                      <div class="col-lg-10">
					  <input type="hidden" name="task_id" class="txtField" value="<?php echo $row['task_id']; ?>"><input class="form-control" name="task_name" type="text" value="<?php echo $row['task_name']; ?>" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cemail" class="control-label col-lg-2">Task Description <span class="required">*</span></label>
                      <div class="col-lg-10">
                        <textarea class="form-control" type="text" name="task_description" required maxlength="400"><?php echo $row['task_description']; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="curl" class="control-label col-lg-2">Task Status</label>
                      <div class="col-lg-10">
					  <select class="form-control m-bot15" name="task_status" style="width:100%" value="<?php echo $row['task_status']; ?>">
								<option style="color:darkblue" value="On Track">On-track</option>
								<option value="Not Started">Not Started</option>
								<option style="color:orange" value="On Hold">On Hold</option>
								<option style="color:red" value="At Risk">At Risk</option>
								<option style="color:#cccc00" value="Delayed">Delayed</option>
								<option style="color:green" value="Completed">Completed</option>
							</select>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cname" class="control-label col-lg-2">Due Date <span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control" name="due_date" value="<?php echo $row['due_date']; ?>" type="date" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="ccomment" class="control-label col-lg-2">Completed on</label>
                      <div class="col-lg-10">
                        <input class="form-control" type="date" value="<?php echo $row['completed_date']; ?>" name="completed_date"/>
                      </div>
					</div>
					<div class="form-group ">
                      <label for="ccomment" class="control-label col-lg-2">Comments</label>
                      <div class="col-lg-10">
                        <textarea type="text" class="form-control" name="comment" maxlength="400"><?php echo $row['comment']; ?></textarea>
                      </div>
                    </div><p style="color:lightgrey">Max limit : 400 characters</p>
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-primary" name="submit" type="submit">Save</button>
                        <a href="home.php" class="btn btn-default" type="button">Cancel</a>
                      </div>
                    </div>
                  </form>
                </div>

              </div>
            </section>
          </div>
        </div>
        
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
    <div class="text-right">
      <div class="credits">
        Powered by <a style="color:white" href="https://10.206.39.245/">- <b>Team Just Dance</b></a>
      </div>
    </div>
  </section>
  <!-- container section end -->

  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- jquery validate js -->
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>

  <!-- custom form validation script for this page-->
  <script src="js/form-validation-script.js"></script>
  <!--custome script for all page-->
  <script src="js/scripts.js"></script>


</body>

</html>