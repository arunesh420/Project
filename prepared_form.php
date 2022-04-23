<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$conn = mysqli_connect("localhost", "root", "", "phonebook");

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
// Prepare an insert statement
$sql = "INSERT INTO contacts (name, address, email, contact) VALUES (?, ? , ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_address, $param_email, $param_contact);

    // Set these parameters
    $param_name = $_POST['name'];
    $param_address = $_POST['address'];
    $param_email = $_POST['email'];
    $param_contact = $_POST['contact'];
   
    

    // Try to execute the query
    if (mysqli_stmt_execute($stmt)) {
        header("location: login.Php");
    } else {
        echo "Something went wrong... cannot redirect!";
    }
}

// Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($conn);
}
?>


<html>
<head>
    <title>Prepared form</title><link href="header.php">
</head>
<body>
<form method="post" action="prepared_form.php">
<label for="name">name:</label>
        <input type="text" name="name" id="name" placeholder="name">

        <label for="address">address:</label>
        <input type="text" name="address" id="address" placeholder="address">

        <label for="email">email:</label>
        <input type="email" name="email" id="email" placeholder="email">

        <label for="contact">contact:</label>
        <input type="text" name="contact" id="contact" placeholder="contact">


        
    <input type="submit" value="Insert">
</form>
</body>
</html>
