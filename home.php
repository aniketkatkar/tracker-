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

?>
<?php include('add_modal.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Home | Task Tracker</title>

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

<body >
  <!-- container section start -->
  <section id="container" class="">
    <!--header start-->
    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i
            class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="#" class="logo">Task<span class="lite">Tracker</span></a>
      <!--logo end-->

      <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
          <li>
            <form class="navbar-form">
              <input id="myInput" class="form-control" onkeyup="searchname();" placeholder="Search" type="text">
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
                <!-- <img alt="" src="img/avatar1_small.jpg"> -->
              </span>
              <span class="username"><?php echo $row['userEmail']; ?></span>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
                
              <li>
                <a href="help.html"><i class="icon_mail_alt"></i>Help</a>
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
          <li class="">
            <a class="" href="home.php">
              <i class="icon_house_alt"></i>
              <span>Dashboard</span>
            </a>
          </li>
          

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>

    <!--main content start-->
    <section class="" id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i> Dashboard</h3>

          </div>
        </div>
        <!-- page start-->


        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Your Assigned Tasks
                <a href="#addnew" data-toggle="modal" class="btn btn-primary" style="float:right">Create a new task</a>
              </header>
              <div class="table-responsive"></div>
              <table id="myTable" class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th>Task Name</th>
                    <th>Task Description</th>
                    <th>Task Status</th>
                    <th>Created on</th>
                    <th>Due date</th>
                    <th>Completed on</th>
                    <th>Comments</th>
                    <th>Actions</th>
                  </tr>
                  <?php				
                    $query=mysqli_query($conn,"select * from tasks where created_by = '$user_name'");
                    while($row=mysqli_fetch_array($query)){
                      ?>
                      <tr>
                        <td><?php echo $row['task_name']; ?></td>
                        <td><?php echo $row['task_description']; ?></td>
                        <td style='text-align:center'><?php echo $row['task_status']; ?></td>
                        <td style='text-align:center'><?php echo $row['created_date']; ?></td>
                        <td style='text-align:center'><?php echo $row['due_date']; ?></td>
                        <td style='text-align:center'><?php echo $row['completed_date']; ?></td>
                        <td ><?php echo $row['comment']; ?></td>
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
      Powered by <a style="color:white" href="  http://10.206.39.245/">- <b>Team Just Dance</b></a>
    </div>
  </div>
  </section>
  <!-- container section end -->
  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- nicescroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <!--custome script for all page-->
  <script src="js/scripts.js"></script>


</body>
<script>
function searchname() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
<script src="js/swirl.js"></script>
<script src="js/noise.min.js"></script>
	<script src="js/util.js"></script>
</html>