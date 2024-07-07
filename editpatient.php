<?php
include 'connection/connection.php';
session_start();
if (!isset($_SESSION['login'])) {
    header("location:index.php");
    die;
}

// Check if PatientID parameter is provided
if (isset($_GET['patientid'])) {
  $patientid = $_GET['patientid'];

  // Retrieve patient information from the database
  $sql = "SELECT * FROM tbl_patient WHERE PatientID = '$patientid'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  if (!$row) {
    echo "<script>alert('Patient not found.');</script>";
    // Redirect back to the previous page or display an error message
    exit;
  }
} else {
  echo "<script>alert('Invalid request.');</script>";
  // Redirect back to the previous page or display an error message
  exit;
}

// Update patient if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $contactinfo = $_POST['contactinfo'];
        $medication = $_POST['medication']; 
        $frequency = $_POST['frequency'];
        $medcon = $_POST['medcon'];

  $sql = "UPDATE tbl_patient SET Lname = '$lname', Fname = '$fname', DoB = '$dob', Gender = '$gender', ContactInfo = '$contactinfo', Medication = '$medication',  Frequency= '$frequency' WHERE PatientID = '$patientid'";
  if ($conn->query($sql) === TRUE) {
    // Update successful
    echo "<script>
      alert(Patient updated successfully.');
      window.location.href = 'patient.php';
    </script>";
    // Redirect back to the previous page or any other page
    exit;
  } else {
    // Update failed
    echo "<script>alert('Error updating medicine: " . $conn->error . "');</script>";
  }
}

// Delete medicine if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
  $patientid = $_POST['PatientID'];

  $sql = "DELETE FROM tbl_patient WHERE PatientID = '$patientid'";
  if ($conn->query($sql) === TRUE) {
    // Delete successful
    echo "<script>
      alert('Patient deleted successfully.');
      window.location.href = 'patient.php';
    </script>";
    // Redirect back to the previous page or any other page
    exit;
  } else {
    // Delete failed
    echo "<script>alert('Error deleting patient: " . $conn->error . "');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        .sidebar {
            background-color: #343a40;
            width: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            transition: all 0.3s;
            z-index: 100;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed .sidebar-brand,
        .sidebar.collapsed .sidebar-nav {
            display: none;
        }

        .sidebar-brand {
            font-weight: bold;
            color: #fff;
            text-align: center;
            margin: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar-brand img {
            margin-bottom: 10px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
            align-items: start;
            padding: 0 1rem;
        }

        .nav-item {
            width: 100%;
        }

        .nav-link {
            color: #fff;
            padding: 0.5rem 1rem;
            text-align: left;
            border-radius: 0.25rem;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .nav-link:hover,
        .nav-link:focus {
            background-color: #495057;
        }

        .dropdown-menu {
            background-color: #343a40;
            border: none;
        }

        .dropdown-item {
            color: #fff;
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #007bff;
        }

        @media (max-width: 991px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar-nav {
                flex-direction: row;
                overflow-x: auto;
            }

            .nav-link {
                white-space: nowrap;
            }

            .sidebar.collapsed {
                width: 100%;
            }
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            transition: margin-left 0.3s;
            width: calc(100% - 250px);
        }

        .main-content.collapsed {
            margin-left: 80px;
            width: calc(100% - 80px);
        }

        @media (max-width: 991px) {
            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .main-content.collapsed {
                margin-left: 0;
                width: 100%;
            }
        }

        .features-section {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .feature-box {
            flex: 1;
            min-width: 250px;
            text-align: center;
        }

        .feature-box i {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .feature-box h3 {
            margin-bottom: 10px;
        }

        .feature-box p {
            color: #555;
        }
    </style>
</head>

<body>

<div class="sidebar" id="sidebar">
    <a class="sidebar-brand" href="#">
        <img src="medicines/tablet2.jpeg" alt="Logo">
        <span>MMS</span>
    </a>
    <ul class="sidebar-nav nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="admin.php">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="medicineDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Medicine
            </a>
            <ul class="dropdown-menu" aria-labelledby="medicineDropdown">
                <li><a class="dropdown-item" href="medicine.php">Medicine Types</a></li>
                <li><a class="dropdown-item" href="addmedicine.php">Add New Medicine</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="patientDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Patient
            </a>
            <ul class="dropdown-menu" aria-labelledby="patientDropdown">
                <li><a class="dropdown-item" href="patient.php">Patient List</a></li>
                <li><a class="dropdown-item" href="addpatient.php">Add New Patient</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logs.php">Logs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="inventory.php">Inventory</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="report.php">Report</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Users
            </a>
            <ul class="dropdown-menu" aria-labelledby="usersDropdown">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="users.php">Add New User</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="session.php">Logout</a>
        </li>
    </ul>
</div>

<div class="main-content" id="main-content">
    <div class="container-fluid">
    <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
      <div class="row g-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Edit Patient Information</h3>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="form-group">
                <label for="patientid">Patient ID:</label>
                <input class="form-control" type="text" id="patientid" name="patientid" value="<?php echo $row['PatientID'] ?>">
              </div>

              <div class="form-group">
                <label for="lname">Last Name:</label>
                <input class="form-control" type="text" id="lname" name="lname" value="<?php echo $row['Lname'] ?>">
              </div>

              <div class="form-group">
              <label for="fname">First Name:</label>
              <input class="form-control" type="text" id="fname" name="fname" value="<?php echo $row['Fname'] ?>">
            </div>
            <div class="form-group">
              <label for="dob">Date of Birth:</label>
              <input class="form-control" type="text" id="dob" name="dob" value="<?php echo $row['DoB'] ?>">
            </div>

           <div class="form-group">
              <label for="gender">Gender:</label>
              <input class="form-control" type="text" id="gender" name="gender" value="<?php echo $row['Gender'] ?>">
            </div>

            <div class="form-group">
              <label for="contactinfo">Contact Info:</label>
              <input class="form-control" type="text" id="contactinfo" name="contactinfo" value="<?php echo $row['ContactInfo'] ?>">
            </div>

            <div class="form-group">
              <label for="medication">Medication:</label>
              <input class="form-control" type="text" id="medication" name="medication" value="<?php echo $row['MedicineName'] ?>">
            </div>
            <div class="form-group">
              <label for="frequency">Frequency:</label>
              <input class="form-control" type="text" id="frequency" name="frequency" value="<?php echo $row['Frequency'] ?>">
            </div>
            <div class="form-group">
              <label for="medcon">Medical Condition:</label>
              <input class="form-control" type="text" id="medcon" name="medcon" value="<?php echo $row['MedicalCondition'] ?>">
            </div>

              <div class="text-center">
                <input class="btn btn-primary" type="submit" name="update" value="Update">
                <input class="btn btn-danger" type="submit" name="delete" value="Delete">
              </div>
            </form>
          </div>
        </div>
      </div>
     
      <div class="text-center">
          <a href="patient.php" class="btn btn-primary float-end fs-4" style="margin-top: 10px">Back</a>
      </div> 

    </div>
  </div>
</div>
</div>

</body>
</html>
