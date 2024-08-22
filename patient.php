<?php
    include 'connection/connection.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("location:index.php");
        die;
    }

    // Initialize the result variable
    $result = null;

    if (isset($_GET['submit'])) {
        $search = $_GET['search'];
        // Escape the search query to prevent SQL injection
        $search = $conn->real_escape_string($search);
        $query = "SELECT * FROM tbl_patient WHERE Lname LIKE '%$search%' OR Fname LIKE '%$search%' OR PatientID LIKE '%$search%' OR MedicalCondition LIKE '%$search%'";
        $result = $conn->query($query);
    } else {
        $result = $conn->query("SELECT * FROM tbl_patient");
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

<?php
$result = $conn->query("SELECT * FROM tbl_patient");
?>

<form action="editpatient.php" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search">
        <div class="input-group-append">
            <button type="submit" name="submit" class="btn btn-success">Search</button>
        </div>
    </div>
</form>

      </form>
    
      <div class="card">
        <div class="card-header">
          <h4>Patients</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>PatientID</th>
                  <th>Lname</th>
                  <th>Fname</th>
                  <th>DoB</th>
                  <th>Gender</th>
                  <th>ContactInfo</th>
                  <th>Medication</th>
                  <th>Frequency</th>
                  <th>MedicalCondition</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_object($result)) { ?>
                  <tr>
                    <td><?php echo $row->PatientID ?></td>
                    <td><?php echo $row->Lname ?></td>
                    <td><?php echo $row->Fname ?></td>
                    <td><?php echo $row->DoB ?></td>
                    <td><?php echo $row->Gender ?></td>
                    <td><?php echo $row->ContactInfo ?></td>
                    <td><?php echo $row->MedicineName ?></td>
                    <td><?php echo $row->Frequency ?></td>
                    <td><?php echo $row->MedicalCondition ?></td>
                    <td>
                      <form action='editpatient.php' method='GET'>
                          <input type='hidden' name='PatientID' value='<?php echo $row->PatientID; ?>'>
                          <button type='submit' name='edit' class='btn btn-primary'>EDIT</button>                          
                        </form>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center">
       <a href="report.php" class="btn btn-primary" style="margin-top: 10px">Back</a>
    </div> 

    </div>
  </div>
</div>
</main>

</body>
</html>