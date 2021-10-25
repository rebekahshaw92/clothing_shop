<?php
session_start();
error_reporting(E_ALL); ini_set('display_errors', 1);
include "connect.php";
include "header.php";

if (isset($_POST["submit"])) {


$title = $_POST['title'];
$address2 = $_POST['up_address2'];
$firstName = $_POST['up_first_name'];
$lastName = $_POST['up_last_name'];
$password = $_POST['up_password'];
$dateOfBirth = $_POST['up_date_of_birth'];
$number = $_POST['up_number'];
$address = $_POST['up_address'];
$country = $_POST['up_country'];
$postcode = $_POST['up_postcode'];


if(!$_POST['up_first_name']) { // if no name has been supplied 
  $firstNameError  = 'Please Enter Your First Name'; 
  echo $firstNameError;
}

if(!$_POST['up_last_name']) { // if no name has been supplied 
    $lastNameError = 'Please Enter Your Last Name'; 
    echo $lastNameError;
} 

if(!$_POST['up_email']) { // if no name has been supplied 
    $emailError = 'Please Enter Your Email'; 
    echo $emailError;
} else {
    if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['up_email'])) {

        // regular expression for email validation
        $email = $_POST['up_email'];
} 
}

if(!$_POST['up_password']) {
    $passwordError = 'Please Enter Your Password';
    echo $passwordError;
} 

if(!$_POST['up_date_of_birth']) {
    $dateOfBirthError = 'Please Enter Your Date Of Birth';
    echo $dateOfBirthError;
} 

if(!$_POST['up_number']) {
    $numberError = 'Please Enter Your Contact Number';
    echo $numberError;
} 

if(!$_POST['up_address']) {
    $addressError = 'Please Enter Your First Line of Your Address';
    echo $addressError;
} 

if(!$_POST['up_country']) {
    $countryError = 'Please Enter Your Home Country';
    echo $countryError;
} 

if(!$_POST['up_postcode']) {
    $postcodeError = 'Please Enter Your Postcode';
    echo $postcodeError;
} 

if(!$firstNameError && !$lastNameError && !$emailError && !$passwordError && !$dateOfBirthError && !$numberError && !$addressError && !$countryError && !$postcodeError) // send to Database if there's no error
{
    // If everything is ok...

    // Make sure the email address is avilable:

    $query_verify_email = "SELECT * FROM user WHERE Email = ?";
    $stmt = $mysqli->prepare($query_verify_email);
    $stmt->bind_param("s", $email);
    echo $mysqli->error;
    $stmt->execute();


    //$query_verify_email = "SELECT * FROM user WHERE Email ='$email'";
   // $result_verify_email = mysqli_query($con, $query_verify_email);

    if(!$query_verify_email) {
        echo 'Database Error Occured';
    }

        if ($stmt->num_rows === 0) { // IF no previous user is using this email.
            $stmt->close();
            $query_insert_user = "INSERT INTO user (`Title`, `FirstName`, `LastName`, `Email`, `Password`, `DataOfBirth`, `ContactNumber`, `Address`, `Address2`, `Country`, `Postcode`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $query=$mysqli->prepare($query_insert_user);
            $query->bind_param("sssssssssss", $title, $firstName, $lastName, $email, $password, $dateOfBirth, $number, $address, $address2, $country, $postcode);
            echo $mysqli->error;
            $query->execute();
            
            //$query_insert_user = "INSERT INTO user (`Title`, `FirstName`, `LastName`, `Email`, `Password`, `DataOfBirth`, `ContactNumber`, `Address`, `Address2`, `Country`, `Postcode`)VALUES ('$title', '$firstName', '$lastName', '$email', '$password', '$dateOfBirth', '$number', '$address', '$address2', '$country', '$postcode')";
          
            //$result_insert_user = mysqli_query($con, $query_insert_user);

            if (!$query_insert_user) {

            echo 'Query Failed ';

            }

            //header('location:index.php');

        } else { // If it did not run OK.
            echo '<div class="errormsgbox">You could not be registered due to a system </div>';

        }

            } else { // The email address is not available.

            echo '<div class="errormsgbox" >That email address has already been registered.</div>';

        }
    }
    

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create An Account</title>

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
    <div id="createAccount">
  <h1>Sign Up</h1>
  <form name="signup" id="signup" action="create_account.php" method="post">
  <label for="title">Title</label>
  <select name="title" id="title">
  <option value="Mr">Mr</option>
  <option value="Miss">Miss</option>
  <option value="Mrs">Mrs</option>
  <option value="Ms">Ms</option>
  <option value="Dr">Dr</option>
</select>
<br>
<label for="up_first_name">First Name</label>
<input type="text" name="up_first_name" id="up_first_name" placeholder="First Name" />
<br>

<label for="up_last_name">Last Name</label>
<input type="text" name="up_last_name" id="up_last_name" placeholder="Last Name" />
<br>

<label for="up_email"> Email</label>
			<input type="email" name="up_email" id="up_email" placeholder="username@email.com" />
            <br>

            <label for="up_password">Password</label>
			<input type="password" name="up_password" id="up_password" placeholder="Password" />
    <br>


    <label for="up_date_of_birth">Date Of Birth</label>
			<input type="text" name="up_date_of_birth" id="up_date_of_birth" placeholder="dd/mm/yyyy" />

            <br>


            <label for="up_number">Contact Number</label>
			<input type="text" name="up_number" id="up_number" placeholder="+44 0000 000000" />

<br>


            <label for="up_address">Address</label>
			<input type="text" name="up_address" id="up_address" placeholder="Address" />
            <br>

            <label for="up_address2">Address 2 (optional)</label>
			<input type="text" name="up_address2" id="up_address2" placeholder="Address 2" />

            <br>

            <label for="up_country">Country</label>
			<input type="text" name="up_country" id="up_country" placeholder="Address 2" />

            <br>

            <label for="up_postcode">Postcode</label>
			<input type="text" name="up_postcode" id="up_postcode" placeholder="Postcode" />
            <br>

            <input id="submit" name="submit" type="submit" value="Register My Account" id="myButton" class="btn btn-primary"/>

  </form>

  </div>
  </div>
  </body>
  </html>