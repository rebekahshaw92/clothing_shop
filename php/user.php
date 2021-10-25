<?php
include "connect.php";
include "login.php";


error_reporting(E_ALL);
ini_set('display_errors', 1);

$user = $_SESSION['Email'];

$query = "SELECT * FROM user WHERE Email = '" .$_SESSION['Email']. "'";

$result = mysqli_query($con, $query) or die("Invalid Query");

while($row = mysqli_fetch_assoc($result)){ 

$title = $row["Title"];
$firstName = $row["FirstName"];
$lastName = $row["LastName"];
$email = $row["Email"];
$password = $row["Password"];
$dateOfBirth = $row["DataOfBirth"];
$contactNumber = $row["ContactNumber"];
$address = $row["Address"];
$address2 = $row["Address2"];
$country = $row["Country"];
$postcode = $row["Postcode"];
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  


    <!-- Main stylesheet -->

    <link rel="stylesheet" href="css/style.css">

    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">

    <!-- Google Captcha -->

    <!-- <script src="https://www.google.com/recaptcha/api.js?render=6LcCP1EaAAAAAJ3Y4IWGDqQH-FFmUnrIcLgy2AyG"></script> -->
 

    <script src="js/main.js"></script>
    
        <title>Login</title>

        </head>

        <body id="page-top">
        <div class="container">
        <h1>Your Address</h1>
        <p><?php echo $firstName ." ". $lastName; ?></p>
        <p><?php echo $address;?></p>
        <p><?php echo $country; ?></p>
        <p><?php echo $postcode;?></p>
        <p><?php echo $contactNumber;?></p>

        <a href="editAddress.php">Edit</a>
        <a href="">Remove</a>
        </div>
        </body>
        </html>