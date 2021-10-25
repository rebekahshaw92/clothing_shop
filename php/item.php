<?php
session_start();
ob_start();
error_reporting(E_ALL); ini_set('display_errors', 1);
include "connect.php";
?>

<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Home</title>

<!-- Bootstrap CSS -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">

<!-- Main stylesheet -->

<link rel="stylesheet" href="../css/style.css">

<!-- Google Fonts -->

<link rel="preconnect" href="https://fonts.gstatic.com"> 
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">

<!-- Google Captcha -->

<!-- <script src="https://www.google.com/recaptcha/api.js?render=6LcCP1EaAAAAAJ3Y4IWGDqQH-FFmUnrIcLgy2AyG"></script> -->

</head>
<?php
include "header.php";
?>
<body>

<?php



  if (isset($_GET['id'])){
    $query = "SELECT * FROM item WHERE ItemID = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i",  $_GET['id']);
    echo $mysqli->error;
    $stmt->execute();
    $query_result = $stmt->get_result();
    
     
      while($row = $query_result->fetch_assoc()){
      $id = $row['ItemID'];
      $name = $row['ItemName'];
      $image = $row['ItemImage'];
      $price = $row['Price'];
      $size = $row['Size'];
}

// if (isset($_POST['id'] && $_POST['id']!="")){
// $id = $_POST['id'];
// $result = "SELECT * FROM Item  WHERE ItemID = ?";

// }




?>

<div class="container">
<div class="row">
<div class="col-lg-5 col-md-5">
<div id="itemImage">
<img src="../images/<?php echo $image; ?>" alt="Card image cap">
</div>
</div>

<div class="col-lg-5 col-md-5">
<h2><?php echo $name;?></h2>
<p>£<?php echo $price;?></p>
<p>Size: <?php echo $size;?></p>
<?php } ?>
<?php

$count = 0;

if (isset($_POST["add_to_cart"])) {
  $amount = $_POST["amount"];
  $_SESSION['count'] = $count + $amount;  
}
?>
<form action="addcart.php?id=<?php echo $id;?>" method="post">
<select name="amount">
<?php
for ($i = 1; $i < 21; $i++){
  echo '<option value="'.$i.'">'.$i.'</option>';
}
?>
</select>
<input type="submit" class="btn btn-primary" id="addToCart" name="add_to_cart" value="Add To Cart"/>
<i class="far fa-heart"></i>
</form>
</div>

</div>
</div>

</body>

<?php
include "footer.php";
?>
</html>