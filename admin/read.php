<?php
session_start();
require_once 'class.user.php';
include_once '../simpledbconfig.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('index.php');
}
 
$stmt = $user_home->runQuery("SELECT * FROM tracker_admin WHERE adminID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['adminSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//$user_name = $row['userName'];
$id = $_GET['id'];
$project_name = $row['project_name'];
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

  <title>Extra Task Tracker | Task Tracker</title>

  <!-- Bootstrap CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="../css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="../css/elegant-icons-style.css" rel="stylesheet" />
  <link href="../css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style-responsive.css" rel="stylesheet" />

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
      <a href="home.php" class="logo">Task<span class="lite">Tracker</span></a>
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
              <span class="username"><?php echo $row['adminEmail']; ?></span>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
                
              <li>
                <a href="../help.html"><i class="icon_mail_alt"></i>Help</a>
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
              <span> Dashboard</span>
            </a>
          </li>
          

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>Assigned Tasks</h3>

          </div>
        </div>
        <!-- page start-->


        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Your Assigned Tasks - <?php $query=mysqli_query($conn,"SELECT * from tracker_users where userName = '$id' AND project_name='$project_name'"); while($row=mysqli_fetch_array($query)){echo $row['tester_name'];}?>
              </header>
              <div class="table-responsive"></div>
              <table id="myTable" class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th><i class="icon_profile"></i> Task Name</th>
                    <th><i class="icon_calendar"></i> Task Description</th>
                    <th style="text-align:center"><i class="icon_mail_alt"></i> Task Status</th>
                    <th style="text-align:center"><i class="icon_pin_alt"></i> Created on</th>
                    <th style="text-align:center"><i class="icon_mobile"></i> Due date</th>
                    <th style="text-align:center"><i class="icon_cogs"></i> Completed on</th>
                    <th><i class="icon_cogs"></i> Comments</th>
                  </tr>
                  <?php				
                    $query=mysqli_query($conn,"SELECT * from tasks where created_by = '$id' ");
                    while($row=mysqli_fetch_array($query)){
                      if(strcmp($row['task_status'], 'Completed')==0)
                        $task = '<span style="color:green">Completed</span>';
                        else if(strcmp($row['task_status'], 'On Track')==0)
                          $task = '<span style="color:darkblue">On Track</span>';
                            else if(strcmp($row['task_status'], 'On Hold')==0)
                              $task = '<span style="color:orange">On Hold</span>';
                                else if(strcmp($row['task_status'], 'At Risk')==0)
                                  $task = '<span style="color:red">At Risk</span>';
                                    else if(strcmp($row['task_status'], 'Delayed')==0)
                                      $task = '<span style="color:#cccc00">Delayed</span>';
                                        else
                                          $task = '<span>Not Started</span>';

                      ?>
                      <tr>
                        <td><?php echo $row['task_name']; ?></td>
                        <td><?php echo $row['task_description']; ?></td>
                        <td style="text-align:center"><?php echo $task; ?></td>
                        <td style="text-align:center"><?php echo $row['created_date']; ?></td>
                        <td style="text-align:center"><?php echo $row['due_date']; ?></td>
                        <td style="text-align:center"><?php echo $row['completed_date']; ?></td>
                        <td><?php echo $row['comment']; ?></td>
                        
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
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <!-- nicescroll -->
  <script src="../js/jquery.scrollTo.min.js"></script>
  <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
  <!--custome script for all page-->
  <script src="../js/scripts.js"></script>


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

</html>