<?php
    session_start();
    if (empty(($_SESSION['email'])) || $_SESSION['email'] == null || !isset($_SESSION['email'])) {
        echo "
            <script>
              alert('Your Current Logged In Session Has Expired, Please Login To Continue');
                window.location = 'logout.php';
            </script>
        ";
        die("session expired");
    }else{
        $email = $_SESSION['email'];
        require_once '../server/classes/fetchData.php';
        $fetchData = new fetchData;
        $fetchResponse = $fetchData->fetchUserData($email,$tblname = "admin");
        if(is_array($fetchResponse)){
            foreach ($fetchResponse as $row) {
                $name =  $row['name'];
                $email = $row['email'];
            }
        }else{
          echo "
            <script>
              alert('Your Current Logged In Session Has Expired, Please Login To Continue');
                window.location = 'logout.php';
            </script>
        ";
        die("not found session expired");
        }

    }

  // $userPurchases = $fetchData->fetchPurchases($email,"purchases");
  
  $allTrainings = $fetchData->fetchAll("trainings");

  $allResources = $fetchData->fetchAll("traing_resources");

  $allFreeResources = $fetchData->fetchAll("free_resources");

  $allUsers = $fetchData->fetchAll("users");

  $allBought = $fetchData->fetchAll("purchases");

  $allSubscribers = $fetchData->fetchAll("subscribers");

  $allFreeLeads = $fetchData->fetchAll("free_leads");

  

  $financeTrainings = $fetchData->fetchByCategory("business");

  $relationshipTrainings = $fetchData->fetchByCategory("relationship");

  $leadershipTrainings = $fetchData->fetchByCategory("leadership");

  $freeTrainings = $fetchData->fetchByPrice("0");
  

?>
<!DOCTYPE html>
<html>
  
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Anny Ikebudu | Admin Panel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"  />
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="https://d19m59y37dris4.cloudfront.net/dark-admin/1-4-7/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
 
    
   
  </head>
  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
          <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn">Close <i class="fa fa-close"></i></div>
            <form id="searchForm" action="#">
              <div class="form-group">
                <input type="search" name="search" placeholder="What are you searching for...">
                <button type="submit" class="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="index.php" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Anny</strong><strong>Ikebudu</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">A</strong><strong>I</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>
          <div class="right-menu list-inline no-margin-bottom">    
            
            <!-- Log out               -->
            <div class="list-inline-item logout">                   <a id="logout" href="logout.php" class="nav-link"> <span class="d-none d-sm-inline">Logout </span><i class="icon-logout"></i></a></div>
          </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="https://ui-avatars.com/api/?color=b22222&name=<?php echo $name?>" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5"><?php echo $name?></h1>
            <p>Admin</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
          <li class=""><a href="index.php"> <i class="icon-home"></i>Dashboard Home </a></li>
          <li><a href="#courseDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Resources </a>
            <ul id="courseDropdown" class="collapse list-unstyled ">
              <li><a href="new-course.php">Create A New Training</a></li>
              <li><a href="trainings.php">View/ Edit Training</a></li>
              <li><a href="add-resource.php">Add New Full Resources To Training</a></li>
              <li><a href="resources.php">View/ Delete Full Resource</a></li>
              <li><a href="add-free-resource.php">Add Free Resources To Training</a></li>
              <li><a href="free-resources.php">View/ Delete Free Resources</a></li>
            </ul>
          </li>



          <li><a href="users.php"> <i class="icon-grid"></i>All Users </a></li>
          <li><a href="purchases.php"> <i class="fa fa-bar-chart"></i>Purchases </a></li>
          <li><a href="subscribers.php"> <i class="icon-padnote"></i>Subscribers </a></li>
          <li><a href="free-leads.php"> <i class="icon-user"></i>Free Leads </a></li>
          <li><a href="change-password.php"> <i class="fa fa-key"></i>Change Password </a></li>
          
          <li><a href="logout.php"> <i class="icon-logout"></i>Logout </a></li>
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->