<?php
include "connect.php";
include "login.php";


error_reporting(E_ALL);
ini_set('display_errors', 1);

$email = $_SESSION['Email'];

$query = "SELECT * FROM user WHERE Email = '" .$_SESSION['Email']. "'";

$result = mysqli_query($con, $query) or die("Invalid Query");

while($row = mysqli_fetch_assoc($result)){ 

$title = $row["Title"];
$firstName = $row["FirstName"];
$lastName = $row["LastName"];
$contactNumber = $row["ContactNumber"];
$address = $row["Address"];
$address2 = $row["Address2"];
$country = $row["Country"];
$postcode = $row["Postcode"];
}

if(isset($_POST['Submit'])) {
$firstNameChange = $_POST['up_first_name'];
$lastNameChange = $_POST['up_last_name'];
$contactNumberChange = $_POST['up_number'];
$addressChange = $_POST['up_address'];
$address2Change = $_POST['up_address2'];
$countryChange = $_POST['up_country'];
$postcodeChange = $_POST["up_postcode"];

$query2 = "UPDATE User SET FirstName='$firstNameChange', LastName='$lastNameChange', ContactNumber='$contactNumber', Address='$addressChange', Address2='$address2Change', Country='$countryChange', Postcode='$postcodeChange' WHERE Email='$user'";

$result2 = mysqli_query($db, $query2) or die("Invalid Query");

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
    
        <title>Your Address</title>

        </head>

        <body id="page-top">
        <div class="container">
        <h1>Edit Your Address</h1>
     
        <form action="user.php" method="post">
 <input type="hidden" name="id" value="<?=$id;?>"/>
 <label for="up_first_name">First Name</label>
<input type="text" name="up_first_name" id="up_first_name" value="<?=$firstName;?>"/> 
<br>
<label for="up_last_name">Last Name</label>
<input type="text" name="up_last_name" id="up_last_name" value="<?=$lastName;?>" />
<br>


<label for="up_address">Address</label>
			<input type="text" name="up_address" id="up_address" value="<?=$address;?>" />
            <br>


            <label for="up_country">Country</label>
			<input type="text" name="up_country" id="up_country" value="<?=$country;?>" />

            <br>

            <label for="up_postcode">Postcode</label>
			<input type="text" name="up_postcode" id="up_postcode" value="<?=$postcode;?>"/>
            <br>




            <label for="up_number">Contact Number</label>
			<input type="text" name="up_number" id="up_number" value="<?=$contactNumber;?>" />

<br>

            <input id="submit" name="submit" type="submit" value="Save Changes" class="btn btn-primary"/>

  </form>

 </div>
        </body>
        </html>