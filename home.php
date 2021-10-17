<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
</head>
<body>
	<h1>Welcome. </h1>
	<?php echo $_SESSION['name'] ?>
	<a href="logout.php">Logout</a>
</body>
</html>