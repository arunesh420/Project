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

<?php include "header.php"?>
<!--<h1>Php Login System</h1>-->
<!--<a href="register.php" class="btn btn-primary btn-lg " tabindex="-1" role="button" aria-disabled="true">Register</a>-->
<!--<a href="login.php" class="btn btn-secondary btn-lg" tabindex="-1" role="button" aria-disabled="true">Login</a>-->
<!---->
<!--<div class="">-->
<!--    <h3>Please Login Here:</h3>-->
<!--    <hr>-->
<!---->
<!--    <form action="login.php" method="post">-->
<!--        <label for="name"  class="form-label">name:</label>-->
<!--        <input type="text" name="name" id="email" placeholder="Enter name"><br>-->
<!--        <label for="password" class="form-label">Password:</label>-->
<!--        <input type="password" name="password" id="password" placeholder="Enter Password">-->
<!--        <button type="submit" class="btn btn-dark" >Submit</button>-->
<!--    </form>-->
<!--<form action="login.php" method="post">-->
<!--    <h1>PHP login system</h1>-->
<!--    <a href="register.php" class="btn btn-primary btn-lg " tabindex="-1" role="button" aria-disabled="true">Register</a>-->
<!--    <a href="login.php" class="btn btn-secondary btn-lg" tabindex="-1" role="button" aria-disabled="true">Login</a>-->
<!--    <div class="mb-3">-->
<!--        <label for="exampleInputEmail1" class="form-label">Name:</label>-->
<!--        <input type="name" class="form-control" id="name" name="name" aria-describedby="emailHelp">-->
<!--    </div>-->
<!--    <div class="mb-3">-->
<!--        <label for="exampleInputPassword1" class="form-label">Password</label>-->
<!--        <input type="password" class="form-control" name="password" id="password">-->
<!--    </div>-->
<!--    <button type="submit" class="btn btn-primary">Submit</button>-->
<!--</form>-->
<!---->
<!--</body>-->
<!--</html>-->


<!--    <form action="login.php" method="post">-->
<!--        <h1>PHP login system</h1>-->
<!--        <a href="register.php" class="btn btn-primary btn-lg " tabindex="-1" role="button" aria-disabled="true">Register</a>-->
<!--        <a href="login.php" class="btn btn-secondary btn-lg" tabindex="-1" role="button" aria-disabled="true">Login</a>-->
<!--        <div class="mb-3">-->
<!--            <label for="exampleInputEmail1" class="form-label">Name:</label>-->
<!--            <input type="name" class="form-control" id="name" name="name" aria-describedby="emailHelp">-->
<!--        </div>-->
<!--        <div class="mb-3">-->
<!--            <label for="exampleInputPassword1" class="form-label">Password</label>-->
<!--            <input type="password" class="form-control" name="password" id="password">-->
<!--        </div>-->
<!--        <button type="submit" class="btn btn-primary">Submit</button>-->
<!--    </form>-->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
        *,
        *:before,
        *:after{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body{
            background-color: #080710;
        }
        .background{
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%,-50%);
            left: 50%;
            top: 50%;
        }
        .background .shape{
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }
        .shape:first-child{
            background: linear-gradient(
                    #1845ad,
                    #23a2f6
            );
            left: -80px;
            top: -80px;
        }
        .shape:last-child{
            background: linear-gradient(
                    to right,
                    #ff512f,
                    #f09819
            );
            right: -30px;
            bottom: -80px;
        }
        form{
            height: 520px;
            width: 400px;
            background-color: rgba(255,255,255,0.13);
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.1);
            box-shadow: 0 0 40px rgba(8,7,16,0.6);
            padding: 50px 35px;
        }
        form *{
            font-family: 'Poppins',sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }
        form h3{
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label{
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }
        input{
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255,255,255,0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }
        ::placeholder{
            color: #e5e5e5;
        }
        button{
            margin-top: 50px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }
        .social{
            margin-top: 30px;
            display: flex;
        }
        .social div{
            background: red;
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255,255,255,0.27);
            color: #eaf0fb;
            text-align: center;
        }
        .social div:hover{
            background-color: rgba(255,255,255,0.47);
        }
        .social .fb{
            margin-left: 25px;
        }
        .social i{
            margin-right: 4px;
        }

    </style>
</head>
<body>
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<form>
    <h3>Login Here</h3>

    <label for="username">Username</label>
    <input type="text" placeholder="Email or Phone" id="username">

    <label for="password">Password</label>
    <input type="password" placeholder="Password" id="password">

    <button>Log In</button>
    <div class="social">
        <div class="go"><i class="fab fa-google"></i>  Google</div>
        <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
    </div>
</form>
</body>
</html>