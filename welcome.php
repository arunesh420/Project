 <?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.Php");
}
?>


<html >
<head>
    <title>PHP login system!- HOME</title><link href="header.php">
</head>
<body>
<a href="logout.php">Logout</a>
<a href = "change_password.php" > Change Password</a>

<div class="container mt-4">
    <h3><?php echo "Welcome " . $_SESSION['name'] ?>! You can now use this website</h3>
    <h1>Start your phonebook<a href="prepared_form.php">Add</a></h1>
    <h1>View your phonebook<a href="retrieve.php">View</a></h1>
    <hr>
</div>
</body>
</html>