<?php
require_once "config.php" ;
// Check connection

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $temp_name=$_FILES['image']['tmp_name'];
    $filename=$_FILES['image']['name'];
    $folder = "upload/".$filename;
    if (move_uploaded_file($temp_name, $folder))  {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }

// Prepare an insert statement
$sql = "INSERT INTO contacts (name, address, email, contact, image) VALUES (?, ? , ?, ?,?)";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_address, $param_email, $param_contact, $filename);

    // Set these parameters
    $param_name = $_POST['name'];
    $param_address = $_POST['address'];
    $param_email = $_POST['email'];
    $param_contact = $_POST['contact'];
   $filename = $_FILES['image']['name'];
    

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
<form method="post" action="prepared_form.php" enctype="multipart/form-data">
<label for="name">name:</label>
        <input type="text" name="name" id="name" placeholder="name">

        <label for="address">address:</label>
        <input type="text" name="address" id="address" placeholder="address">

        <label for="email">email:</label>
        <input type="email" name="email" id="email" placeholder="email">

        <label for="contact">contact:</label>
        <input type="text" name="contact" id="contact" placeholder="contact">
    <input type="file" name="image" id="image" value="image">


        
    <input type="submit" value="Insert">
</form>
</body>
</html>
