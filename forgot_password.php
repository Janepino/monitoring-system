<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$message = "hakdog";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
<link rel="stylesheet" href="style.css">
</head>
<body style = "background-color:white;">  

<div class="container" div id ="login">
<h2>Forgot Password</h2>

<p><?php echo $message; ?></p>

<form method="post">
<input type="text" name="email" placeholder="Enter your email">
<button type="submit">Submit</button>
<a href="login.php">
<button type="button">Balik login</button>
</form>
</div>

</body>
</html>
