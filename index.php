<?php 
	require 'function.php';
	require 'db-connect.php';

	$name=$email=$pass="";
	$confirmPassErr=$errorMessage=$successMessage="";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){

		$sql = "INSERT INTO users VALUES(?, ?, ?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("sss", $name, $email, $pass);

		$name = $_POST['name'];
		$email = $_POST['email'];
		if ($_POST['pass'] === $_POST['confirmPass']) {
			$pass = $_POST['pass'];
		}
		else{
			$confirmPassErr = "Password is not matching.";
			exit();
		}

		if ($stmt->execute()) {
			$successMessage = "Account created successfully.";
		}
		else{
			$errorMessage = "email is already exist.";
		}
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Signup</title>
	<style type="text/css">
		.error{
			color: red;
		}
		.success{
			color:  blue;
		}
	</style>
</head>
<body>
	<h1>Signup</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		Name: <input type="text" name="name" pattern="[a-zA-z- ]+" title="Only alphabets and white spaces allowed" required=""><br><br>
		Email: <input type="text" name="email" required=""><br><br>
		Password: <input type="text" name="pass" required=""><br><br>
		Confirm Password: <input type="text" name="confirmPass" required=""><span class="error"><?php echo $confirmPassErr; ?></span><br><br>
		<button type="submit">Signup</button>
		<a href="login.php">Login</a><br><br>
		<span class="success"><?php echo $successMessage; ?></span>
		<span class="error"><?php echo $errorMessage; ?></span>
	</form>
</body>
</html>