<?php
	include 'connection/connection.php';
	session_start();
	if(!isset($_SESSION['login'])){
  		header("location:index.php");
   		die;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tablet</title>
	<meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="bootstrap/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/jquery-1.12.4-jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-- Bootstrap JS -->
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 14px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 14px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 14px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width:100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
}
</style>

</head>
<body>	

       <div class="">
      <div class="topnav">
      <a class="active" href="Admin.php"> Home </a>
      <a href="#about">About</a>
      <a href="#contact">Contact</a>
      <div class="search-container">
        <form action="#" method="post" style="margin-left:10px;">
          <label for="search" class="fs-4">Search:</label>
           <input type="text" name="search">
           <input class="btn btn-info fs-4" type="submit" name="submit" value="Search">
         </form>
      </div>
    </div>

  <div class="container-fluid">
    <div class="row">
      <!-- Side Navigation Bar -->
      <nav class="col-md-2 col-lg-2 d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">          

             <li class="nav-item">
              <a class="nav-link fs-4" href="medicine.php">Medicines</a>
            </li>
            
           
             <li class="nav-item">
              <a class="nav-link fs-4" href="patient.php">Patient</a>
            </li>
             <li class="nav-item">
              <a class="nav-link fs-4" href="logs.php">Logs</a>
            </li>
             <li class="nav-item">
              <a class="nav-link fs-4" href="inventory.php">Inventory</a>
            </li>
             <li class="nav-item">
              <a class="nav-link fs-4" href="report.php">Report</a>
            </li>

             <li class="nav-item">
			  <a class="nav-link fs-4" href="" data-bs-toggle="collapse" data-bs-target="#medicinesMenu">Users<i class="caret"></i></a>
			   <ul class="nav flex-column ml-3 collapse" id="medicinesMenu">
			   <li class="nav-item">
			    <a class="nav-link fs-5" href="tablet.php">Profile</a>
			   </li>
			   <li class="nav-item">
			    <a class="nav-link fs-5" href="capsule.php">New User</a>
			   </li>
			   </ul>
			</li>

             <li> <a href="session.php" class="nav-link fs-4"> <footer> Logout </footer></a></li>

          </ul>
        </div>
      </nav>

      <!-- Main Content Area -->
      <main class="col-md-10 col-lg-10 ml-sm-auto px-md-4">         
        <!-- Content Goes Here -->


    </div>

    <!-- Close the "main" and "row" divs -->
</main>
	
</body>
</html>