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
  <title>Home</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>   

  <style>

  .navbar-nav .nav-link {
    font-size: 15px;
  }

  .navbar {
    background-color: #222;
  }

  .navbar-brand {
    font-weight: bold;
    color: #fff;
  }

  .nav-link {
    color: #fff;
  }

  .nav-link:hover,
  .nav-link:focus {
    color: #aaa;
  }

  .dropdown-menu {
    background-color: #222;
    border: none;
  }

  .dropdown-item {
    color: #fff;
  }

  .dropdown-item:hover,
  .dropdown-item:focus {
    background-color: #111;
    color: #aaa;
  }

@media (max-width: 991px) {
  .navbar-nav {
    margin-top: 10px;
  }

  .navbar-collapse {
    background-color: #222;
    padding: 15px;
    border-radius: 5px;
  }

  .navbar-toggler {
    border-color: #aaa;
  }

  </style>

</head>
<body> 

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="medicines/tablet2.jpeg" alt="Logo" width="40" height="40" class="rounded-pill align-top me-2">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
      <ul class="navbar-nav">
        <li class="nav-item ms-3">
          <a class="nav-link" href="admin.php">Home</a>
        </li>

        <li class="nav-item dropdown ms-3">
          <a class="nav-link dropdown-toggle" href="#" id="medicineDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Medicine
          </a>
          <div class="dropdown-menu fs-4" aria-labelledby="medicineDropdown">
            <a class="dropdown-item" href="medicine.php">Medicine Types</a>
            <a class="dropdown-item" href="addmedicine.php">Add New Medicine</a>
          </div>
        </li>

        <li class="nav-item dropdown ms-3">
          <a class="nav-link dropdown-toggle" href="#" id="patientDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Patient
          </a>
          <div class="dropdown-menu fs-4" aria-labelledby="usersDropdown">
            <a class="dropdown-item" href="patient.php">Patient List</a>
            <a class="dropdown-item" href="addpatient.php">Add New Patient</a>
          </div>
        </li>
        
        <li class="nav-item ms-3">
          <a class="nav-link" href="logs.php">Logs</a>
        </li>
        
        <li class="nav-item ms-3">
          <a class="nav-link" href="inventory.php">Inventory</a>
        </li>
        
        <li class="nav-item ms-3">
          <a class="nav-link" href="report.php">Report</a>
        </li>   

        <li class="nav-item dropdown ms-3">
          <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Users
          </a>
          <div class="dropdown-menu fs-4" aria-labelledby="usersDropdown">
            <a class="dropdown-item" href="profile.php">Profile</a>
            <a class="dropdown-item" href="users.php">Add New User</a>
          </div>
        </li>

        <li class="nav-item ms-3">
          <a class="nav-link" href="session.php">
            <span>Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>   

  <div class="container-fluid">
  <div class="row">

      <!-- Main Content Area -->
      <main class="col-md-10 ml-md-auto px-md-4 bg-light fs-4">          
        <!-- Content Goes Here -->

      <?php
       $row = null; // Initialize $row variable
         if (isset($_POST['submit'])){
          $search=$_POST['search']; 
          $result=$conn->query("select * from tbl_patient where Lname='$search'");
          $row=mysqli_fetch_object($result);
         }
      ?>

    <form action="" method="POST">
      <div class="form-group">
        <label for="patientid">Patient ID:</label>
        <input class="form-control fs-4" type="text" id="patientid" name="patientid" value="<?php echo $row->PatientID ?>">
      </div>
      <div class="form-group">
        <label for="lname">Last Name:</label>
        <input class="form-control fs-4" type="text" id="lname" name="lname" value="<?php echo $row->Lname ?>">
      </div>
      <div class="form-group">
        <label for="fname">First Name:</label>
        <input class="form-control fs-4" type="text" id="fname" name="fname" value="<?php echo $row->Fname ?>">
      </div>
      <div class="form-group">
        <label for="dob">Date of Birth:</label>
        <input class="form-control fs-4" type="text" id="dob" name="dob" value="<?php echo $row->DoB ?>">
      </div>

     <div class="form-group">
        <label for="gender">Gender:</label>
        <input class="form-control fs-4" type="text" id="gender" name="gender" value="<?php echo $row->Gender ?>">
      </div>

      <div class="form-group">
        <label for="contactinfo">Contact Info:</label>
        <input class="form-control fs-4" type="text" id="contactinfo" name="contactinfo" value="<?php echo $row->ContactInfo ?>">
      </div>

      <div class="form-group">
        <label for="medication">Medication:</label>
        <input class="form-control fs-4" type="text" id="medication" name="medication" value="<?php echo $row->MedicineName ?>">
      </div>
      <div class="form-group">
        <label for="frequency">Frequency:</label>
        <input class="form-control fs-4" type="text" id="frequency" name="frequency" value="<?php echo $row->Frequency ?>">
      </div>
      <div class="form-group">
        <label for="medcon">Medical Condition:</label>
        <input class="form-control fs-4" type="text" id="medcon" name="medcon" value="<?php echo $row->MedicalCondition ?>">
      </div>

      <button class="btn btn-success fs-4" type="submit" name="update">Update</button>
      <button class="btn btn-danger fs-4" type="submit" name="delete">Delete</button>
    </form>  

 <?php

        if (isset($_POST['update'])) {
        $patientid = $_POST['patientid'];
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $contactinfo = $_POST['contactinfo'];
        $medication = $_POST['medication'];
        $frequency = $_POST['frequency'];
        $medcon = $_POST['medcon'];

         $sql = ("update tbl_patient set Lname='$lname', Fname='$fname', DoB='$dob', Gender='$gender', ContactInfo='$contactinfo', MedicineName='$medication', Frequency='$frequency',MedicalCondition='$medcon' where PatientID='$patientid'");
    if (mysqli_query($conn, $sql)) {
      
        die;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
  } 

if (isset($_POST['delete'])) {
    $patientid = $_POST['patientid'];
    $sql = "delete from tbl_patient where PatientID='$patientid'";
    if (mysqli_query($conn, $sql)) {
        header("location:patient.php");
        die;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

?>

<!-- Close the "main" and "row" divs -->
</main>

</div>
</div>

</body>
</html>