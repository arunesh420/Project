<?php

require_once "config.php";

$name = $email = $contact = $password = $confirm_password = "";
$name_err =  $email_err = $contact_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if name is empty
    if (empty(trim($_POST["name"]))) {
        $name_err = "name cannot be blank";
    } else {
        $sql = "SELECT id FROM users WHERE name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_name);

            // Set the value of param name
            $param_name = trim($_POST['name']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $name_err = "This name is already taken";
                    echo $name_err;
                } else {
                    $name = trim($_POST['name']);
                }
            } else {
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


    
    //check for email
    
    if (empty(trim($_POST["email"]))) {
        $email_err = "email cannot be blank";
    } else {
        $email = trim($_POST['email']);
    }
    
    if (empty(trim($_POST["contact"]))) {
        $contact_err = "contact cannot be blank";
    } else {
        $contact = trim($_POST['contact']);
    }
    


// Check for password
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = "Password cannot be less than 5 characters";
    } else {
        $password = trim($_POST['password']);
    }

// Check for confirm password field
    if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
        $password_err = "Passwords should match";
    }


// If there were no errors, go ahead and insert into the database
    if (empty($name_err) && empty($email_err) && empty($contact_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users (name, email, contact, password) VALUES (?, ? , ?, ? )";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_email, $param_contact, $param_password);

            // Set these parameters
            $param_name = $name;
            
            $param_email = $email;
            $param_contact = $contact;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // Try to execute the query
            if (mysqli_stmt_execute($stmt)) {
                header("location: login.Php");
            } else {
                echo "Something went wrong... cannot redirect!";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);

    
}




?>


<!doctype html>
<html lang="en">
<head>
    <title>Register</title>
    <link href="header.php">
</head>
<body>
<h1>Php Login System</h1>
<a href="register.php">Register</a>
<a href="login.php">Login</a>

    <hr>
    <form action="login.php" method="post">
        <label for="name">name:</label>
        <input type="text" name="name" id="name" placeholder="name">

        

        <label for="email">email:</label>
        <input type="email" name="email" id="email" placeholder="email">

        <label for="contact">contact:</label>
        <input type="text" name="contact" id="contact" placeholder="contact">

        <label for="password">Password:</label>
        <input type="password"  name="password" id="password" placeholder="Password">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password"  name="confirm_password" id="confirm_password"
               placeholder="Confirm Password">

        <button type="submit" class="btn btn-dark" >Sign in</button>

    </form>
</body>
</html>