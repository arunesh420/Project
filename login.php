<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['name']))
{
    header("location: welcome.Php");
    exit;
}
require_once "config.php";
$name = $password = "";
$err = "";
// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){

    if(empty(trim($_POST['name'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter name and password";
        echo $err;
    }
    else{
        $name = trim($_POST['name']);
        $password = trim($_POST['password']);
    }


    if(empty($err))
    {
        $sql = "SELECT id, name, password FROM users WHERE name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_name);
        $param_name = $_POST['name'];

// Try to execute this statement
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result($stmt, $id, $name, $hashed_password);
                if(mysqli_stmt_fetch($stmt))
                {
                    if(password_verify($password, $hashed_password))
                    {
// this means the password is correct. Allow user to login
                        session_start();
                        $_SESSION["name"] = $name;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;

//Redirect user to welcome page
                        header("location: welcome.Php");

                    }
                }

            }

        }
    }


}


?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PHP login system!</title>
</head>
<body>

<h1>Php Login System</h1>
<a href="register.php">Register</a>
<a href="login.php">Login</a>


<div class="container mt-4">
    <h3>Please Login Here:</h3>
    <hr>

    <form action="login.php" method="post">
        <label for="name">name:</label>
        <input type="text" name="name" id="email" placeholder="Enter name">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter Password">
        <button type="submit" >Submit</button>
    </form>

</div>
</body>
</html>