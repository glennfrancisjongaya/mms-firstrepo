<?php
	include 'connection/connection.php';
	session_start();

	if (isset($_POST['login'])) {
		$_SESSION['user'] = $_POST['user'];
		$_SESSION['pass'] = $_POST['pass'];

		$user = $_SESSION['user'];
		$pass = $_SESSION['pass'];

		$result = $conn->query("SELECT * FROM tbl_system WHERE username='$user' AND password='$pass'");
		$row = mysqli_fetch_assoc($result);

		if (!empty($row)) {
			$_SESSION['login'] = true;
			header("Location: admin.php");
			die;
		} else {
			echo "<script>
			alert('Login failed. Make sure your username and password are correct.');
			</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MMS</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
	<style>
		body {
			background-color: #f8f9fa;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			margin: 0;
		}
		.card {
			border-radius: 15px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}
		.card-body {
			font-size: 1rem;
		}
		.form-control {
			font-size: 0.875rem;
		}
		.btn {
			font-size: 0.875rem;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 col-lg-4">
				<div class="card">
					<div class="card-body p-4">
						<h3 class="card-title text-center mb-4"></h3>
						<form action="" method="post">
							<div class="mb-3">
								<label for="username" class="form-label">Username:</label>
								<input type="text" class="form-control" id="username" name="user" required placeholder="Enter your username">
							</div>
							<div class="mb-3">
								<label for="password" class="form-label">Password:</label>
								<input type="password" class="form-control" id="password" name="pass" required placeholder="Enter your password">
							</div>
							<div class="d-flex justify-content-between">
								<button type="submit" name="login" class="btn btn-primary">Login</button>
								<button type="reset" class="btn btn-secondary">Cancel</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
