<?php 

include "connect.php";

   if (isset($_SESSION['Email'])){

      $query = "SELECT * FROM user WHERE Email = ?";
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("s",  $_SESSION['Email']);
      echo $mysqli->error;
      $stmt->execute();
      $query_result = $stmt->get_result();
    
     
      while($row = $query_result->fetch_assoc()){
      $name = $row['FirstName'];
  
    }
  }
  

    if (isset($_POST["add_to_cart"]) && (isset($_GET['id']))) {
     $query = "SELECT * FROM item WHERE ItemID = ?";
       $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i",  $_GET['id']);
        echo $mysqli->error;
        $stmt->execute();
        $query_result = $stmt->get_result();  
    
       while($row = $query_result->fetch_assoc()){
          $name = $row['ItemName'];
          $image = $row['ItemImage'];
          $price = $row['Price'];
          $size = $row['Size'];

      // echo "Hello " ."<a href='user.php'>$name</a>". " ". "<a href='logout.php'>Logout</a>";
        }
    }
?>

        <header class="header">
       
  <nav class="navbar navbar-dark bg-dark d-flex justify-content-end">
  <div class="container-fluid">
  <!-- Navbar content -->
       
        <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> -->
        <!-- <? //if($_SESSION['Email'] != '') { ?>
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
               <?php //echo "Hello". " " . $name;
               //$stmt->close();
               ?>
               </button> -->
               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
  <a class="dropdown-item" href="#">Your Account</a>
    <a class="dropdown-item" href="#">Your Orders</a>
    <a class="dropdown-item" href="logout.php">Logout</a>
  </div>

                
                <?php 
              //} else 
              { 
                ?>

 
  </div>
  <ul class="nav" id="myNavbar">
        <li class="nav-item"><a class="nav-link" href="login.php">Login / Create Account</a></li>
        </ul>
       

         <!-- <i class="fas fa-shopping-cart" style="color: #fff;">Cart</i>   -->

<!-- <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="<?php if (isset($_POST["add_to_cart"])) { echo '<h2>'.$name.'<h2>';?><?php echo $price;?>  <?php echo $size;?> <?php } else { echo "Your Cart Is Empty!";} }?>"><i class="fas fa-shopping-cart" style="color: #fff;">
  Cart></i> -->


<!-- </button> -->

<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-shopping-cart" style="color: #fff;">
  Cart <?php if($_SESSION['count'] > 0){echo "(".$_SESSION['count'].")";}?></i>

        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <div class="row" style="padding-top: 40px;">
        <div class="col-lg-6 col-md-6">
          <div id="shopImage">
        <img src="../images/<?php echo $image; ?>" alt="Card image cap">
                </div>
                </div>
                <div class="col-lg-6 col-md-6">
    <?php echo "<h3>$name</h3>" ?>
    
    <?php echo "<p>Size $size</p>" ?>

    <form action="#" method="post">
<select name="amount">
<?php
for ($i = $_SESSION['count']; $i < 101; $i++){
  echo '<option value="'.$i.'">'.$i.'</option>';
}
?>
</select>
   
    <?php echo '<p>Quantity ' .$_SESSION['count'] . '</p>' ?>
                </div>
                </div>
    <?php echo "<p> Total £$price </p>" ?>
    <a class="btn btn-primary" href="addcart.php" id="checkout">Checkout</a>
</form>
  </div>
</div>
    </ul>
           <!-- <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> 
      </form> -->
                </div>
</nav>      
                

<div id="mainMenu">
<div class="container-fluid">
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
  <img src="../images/logo.png"class="navbar-brand" href="#page-top" />
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav mr-auto" id="myNavbar">
    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Brand
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
        <li class="nav-item"><a class="nav-link" href="index.php">Accessories</a></li>
    </ul>
  </div>
</nav>
</div>
    </header>