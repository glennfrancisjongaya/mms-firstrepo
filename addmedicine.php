<?php
	include 'connection/connection.php';
	session_start();
	if(!isset($_SESSION['login'])){
  		header("location:index.php");
   		die;
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
        <div class="col-mb-3">
          <div class="card">
            <div class="card-header">
              <h3>Add New Medicine</h3>
            </div>
            <div class="card-body">
              <form action="addmedicine.php" method="POST">
                <div class="row mb-2">
                  <div class="col-md-6">
                    <label class="form-label">Medicine ID:</label>
                    <input class="form-control" type="text" name="Medid" value="<?php echo rand(1000, 9999); ?>" readonly required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Medicine Name:</label>
                    <input class="form-control" type="text" name="Medname">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md-6">
                    <label class="form-label">Dosage Form:</label>
                    <input class="form-control" type="text" name="Doform">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Strength:</label>
                    <input class="form-control" type="text" name="Strength">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md-6">
                    <label class="form-label">Quantity:</label>
                    <input class="form-control" type="text" name="Quantity">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Expiration Date:</label>
                    <input class="form-control" type="text" name="Expidate">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md-6">
                    <label for="instructions">Instructions:</label>
                    <textarea class="form-control" rows="4" id="instructions" name="Instructions"></textarea>
                  </div>
                  <div class="col-md-6">
                    <label for="sideeffects">Side Effects:</label>
                    <textarea class="form-control" rows="4" id="sideeffects" name="SideEffects"></textarea>
                  </div>
                </div>
                
                    <div class="text-center">
                      <button class="btn btn-success" type="submit" name="save">Save</button>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
  </div>

  <?php
  if (isset($_POST['save'])) {
    $medid = $_POST['Medid'];
    $medname = $_POST['Medname'];
    $doform = $_POST['Doform'];
    $strength = $_POST['Strength'];
    $quantity = $_POST['Quantity'];
    $expidate = $_POST['Expidate'];
    $instructions = $_POST['Instructions'];
    $sideeffects = $_POST['SideEffects'];

    $conn->query("INSERT INTO tbl_medicine(MedicineID, MedicineName, DosageForm, Strength, Quantity, ExpirationDate, Instructions, SideEffects)
      VALUES ('$medid', '$medname', '$doform', '$strength', '$quantity', '$expidate', '$instructions', '$sideeffects')");

    $conn->query("INSERT INTO tbl_medication(MedicineName, DosageForm, Instructions, SideEffects)
      VALUES ( '$medname', '$doform', '$instructions', '$sideeffects')");

    $conn->query("INSERT INTO tbl_prescriptions(MedicineName, DosageForm, ExpirationDate)
      VALUES ( '$medname', '$doform', '$expidate')");

    echo "Medicine has been added";
  }
  ?>
</body>
</html>
