<?php
session_start();
error_reporting(E_ALL); ini_set('display_errors', 1);
include "connect.php";

$_SESSION['count'] = 0;
?>

<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Home</title>

<!-- Bootstrap CSS -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


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
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../images/slide1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="../images/slide2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="../images/slide3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

</body>

<div class="container">
<div id="newIn">
<h2>New In</h2>
<?php

//$itemID = 3;

$query1 = "SELECT * FROM item ORDER BY ItemID";
$stmt = $mysqli->prepare($query1);
//$stmt->bind_param("s", $itemID);
echo $mysqli->error;
$stmt->execute();
$query1_result = $stmt->get_result();

 //while($row = $query1_result->fetch_assoc()) {
 while($row = $query1_result->fetch_array()) {
   $rows[] = $row;
 
 }
  //  $myResult = implode(",", $rows);
  //  printf($myResult);
 //}

// $row = $query1_result->fetch_array(MSQLI_ASSOC);
//   $itemImage = $row['ItemImage'];
//   $itemName = $row['ItemName'];
//   $itemBrand = $row['BrandID'];
//   $colour = $row['Colour'];
//   $size = $row['Size'];
//   $price = $row['Price'];

//   $query1_result->free_result();

$numOfCols = 3;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;

foreach($rows as $row){
  if($rowCount % $numOfCols  == 0){ ?>
  <div class="row" style="padding-top: 20px;">
  <?php }  $rowCount++; ?>
<div class="col-lg-<?php echo $bootstrapColWidth; ?> col-md-<?php echo $bootstrapColWidth; ?>">
<div class="card" style="width: 18rem;">
<img class="card-img-top" src="../images/<?php echo $row['ItemImage']; ?>" alt="Card image cap">
<div class="card-body">
<h5 class="card-title text-uppercase"><?php echo $row['ItemName']; ?> </h5>
<a href="item.php?id=<?php echo $row['ItemID'];?>" class="btn btn-primary">Shop Now</a>
</div> 
</div>
</div>


<?php 
if($rowCount % $numOfCols == 0) {
?>
</div>

<?php } } ?>
</div>
<?php
include "footer.php";
?>
</html>