<?php
	session_start();
	require 'function.php';
	require 'db-connect.php';
	
	$email=$pass=$errorMessage="";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = test_input($_POST['email']);
		$pass = test_input($_POST['pass']);

		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = $conn->query($sql);

		if ($result->num_rows === 1) {
			$row = $result->fetch_assoc();
			if (password_verify($pass, $row['password'])) {
				$_SESSION['email'] = $row['email'];
				$_SESSION['name'] = $row['name'];
				header("Location: home.php");
				exit();
			}
			else {
				$errorMessage = "incorrect password";
			}
		}
		else {
			$errorMessage = "email does not exist.";
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<style type="text/css">
		.error{
			color: red;
		}
	</style>
</head>
<body>
	<h1>Login</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		Email: <input type="email" name="email" required=""><br><br>
		Password: <input type="password" name="pass" required=""><br><br>
		<button type="submit" name="submit">Login</button>
		<a href="index.php">Signup</a><br><br>
		<span class="error"><?php echo $errorMessage; ?></span>
	</form>
</body>
</html>