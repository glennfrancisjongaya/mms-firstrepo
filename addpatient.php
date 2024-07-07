<?php
include 'connection/connection.php';
session_start();

if (!isset($_SESSION['login'])) {
    header("location:index.php");
    die;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medication = $_POST['medication'];
    $quantity = $_POST['quantities'];

    // Validate the inputs
    if (!empty($medication) && !empty($quantity)) {
        // Prepare the SQL statement
        $query = "UPDATE tbl_medicine SET quantity = quantity - ? WHERE MedicineName = ?";
        $stmt = mysqli_prepare($conn, $query);

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, 'is', $quantity, $medication);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Deducted $quantity of medication '{$medication}' successfully.";
        } else {
            echo "Error deducting $quantity of medication '{$medication}': " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }
}

// Fetch medicine types
$query = "SELECT ID, Med FROM tbl_medicinetype";
$result = mysqli_query($conn, $query);
$medicineTypes = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
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
            display: flex;
            flex-direction: column;
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

        .container-fluid {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .form-container {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .input-group-text {
            background-color: #fff;
            border: none;
            border-radius: 0 0.5rem 0.5rem 0;
        }

        .bi-calendar3 {
            color: #6c757d;
        }
    </style>

    <script>
        function populateMedicines() {
            var selectedType = document.getElementById("medicinetype").value;

            // Create an AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "fetchmedicine.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var medicines = JSON.parse(xhr.responseText);
                    var selectMedicine = document.getElementById("medication");
                    selectMedicine.innerHTML = "";

                    for (var i = 0; i < medicines.length; i++) {
                        var option = document.createElement("option");
                        option.value = medicines[i].MedicineID;
                        option.text = medicines[i].MedicineName;
                        selectMedicine.appendChild(option);
                    }
                }
            };

            // Send the AJAX request
            xhr.send("medicinetype=" + selectedType);
        }
    </script>
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
                                <h4>Add Patient</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-container">
                                    <form method="POST" action="">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label class="form-label">Patient ID:</label>
                                                <input type="text" class="form-control" name="patientid" id="patientid" value="<?php echo rand(1000, 9999); ?>" readonly required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Last Name:</label>
                                                <input class="form-control" type="text" name="lname" id="lname">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label for="fname" class="form-label">First Name:</label>
                                                <input type="text" class="form-control" name="fname" id="fname">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dob" class="form-label">Date of Birth:</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" name="dob" id="dob">
                                                    <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label for="gender">Gender:</label>
                                                <input class="form-control" type="text" name="gender" id="gender">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="contactinfo" class="form-label">Contact Info:</label>
                                                <input type="text" class="form-control" name="contactinfo" id="contactinfo">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="medicinetype">Medicine Type:</label>
                                                <select class="form-control" id="medicinetype" name="medicinetype" onchange="populateMedicines()">
                                                    <option value=""></option>
                                                    <?php foreach ($medicineTypes as $type): ?>
                                                        <option value="<?php echo $type['ID']; ?>"><?php echo $type['Med']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="medication">Medicine:</label>
                                                <textarea class="form-control" id="medication" name="medication"></textarea>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="quantities">Quantities:</label>
                                            <textarea class="form-control" rows="5" id="quantities" name="quantities"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="frequency" class="form-label">Frequency:</label>
                                            <input type="text" class="form-control" name="frequency" id="frequency">
                                        </div>
                                        <div class="mb-3">
                                            <label for="medcon">Medical Condition:</label>
                                            <textarea class="form-control" rows="5" id="medcon" name="medcon"></textarea>
                                        </div>
                                        <br>
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
    </div>    

    <?php
    if (isset($_POST['save'])) {
        $patientid = $_POST['patientid'];
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $contactinfo = $_POST['contactinfo'];
        $medicinetype = $_POST['medicinetype'];
        $medication = $_POST['medication']; 
        $frequency = $_POST['frequency'];
        $medcon = $_POST['medcon'];

        $stmt = $conn->prepare("INSERT INTO tbl_patient (PatientID, Lname, Fname, DoB, Gender, ContactInfo, MedicineType, MedicineName, Frequency, MedicalCondition)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $patientid, $lname, $fname, $dob, $gender, $contactinfo, $medicinetype, $medication, $frequency, $medcon);
        $stmt->execute();
        $stmt->close();
    }
    ?>
</body>
</html>
