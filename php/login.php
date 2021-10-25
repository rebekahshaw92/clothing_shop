<?php
session_start();
ob_start();
error_reporting(E_ALL); ini_set('display_errors', 1);
include "connect.php";
include "header.php";

if (isset($_POST['email']) and isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE Email = ? and Password = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    echo $mysqli->error;
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows();

    if ($count == 1){

        $_SESSION['Email'] = $email;

        header('location:index.php');

        $stmt->close();
        
        }else {
        
        echo "Invalid Login Credentials.";
        
        }


        }
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  


    <!-- Main stylesheet -->

    <link rel="stylesheet" href="../css/style.css">

    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">

    <!-- Google Captcha -->

    <!-- <script src="https://www.google.com/recaptcha/api.js?render=6LcCP1EaAAAAAJ3Y4IWGDqQH-FFmUnrIcLgy2AyG"></script> -->


  </head>
        <body id="page-top">
        <div class="container">
        <div class="row">
       <div class="col-lg-6 col-md-4">
          <div id="login">

       
        <h1>Existing Customer</h1>
        <h2>Sign In</h2>
        <form action="login.php" method="post">
        <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>

  <input type="submit" class="btn btn-primary" id="signIn" value="Sign In" />

        </form>

        </div>
      </div>
      <div class="col-lg-6 col-md-4 text-center">
        <div id="newCustomer">
        <h1>New Customer</h1>

      <h2>Create a new account</h2>
      <form>
        <a href="create_account.php" class="btn btn-primary" id="newAccount">Register</a>
      </form>
        </div>
        </div>
        </div>
        </div>
        </body>
        </html>
