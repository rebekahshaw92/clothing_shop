<?php
session_start();
error_reporting(E_ALL); ini_set('display_errors', 1);
include "connect.php";
?>
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Cart</title>

<!-- Bootstrap CSS -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">


<!-- Main stylesheet -->

<link rel="stylesheet" href="../css/style.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

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

if(isset($_GET['reset'])) {
    unset($_SESSION['shoppingcart']);
    session_destroy();
}

?>


<div class="container">
<h1>Your Cart</h1>


            <!--Section: Block Content-->
            <section>

<!--Grid row-->
<div class="row">

  <!--Grid column-->
  <div class="col-lg-8">

    <!-- Card -->
    <div class="mb-3">
      <div class="pt-4 wish-list">

        <h5 class="mb-4">Cart (<span>2</span> items)</h5>
<?php
if(isset($_SESSION['shoppingcart']) && count($_SESSION['shoppingcart']) != 0) {
    $list = $_SESSION['shoppingcart'];
$total = 0;
    foreach($list as $item) {
        $id = $item['id'];

        $query = "SELECT * FROM item WHERE ItemID = '$id'";

        $result = mysqli_query($mysqli, $query);

        
        // $query = "SELECT * FROM item WHERE ItemID = ?";
        // $stmt = $mysqli->prepare($query);
        // $stmt->bind_param("i",  $id);
        // echo $mysqli->error;
        // $stmt->execute();
        // $query_result = $stmt->get_result();

        // if ($stmt->num_rows == 1){
        //     $row = $query_result->fetch_assoc();

       if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);

            $id = $row['ItemID'];
            $name = $row['ItemName'];
            $image = $row['ItemImage'];
            $price = $row['Price'];
            $colour = $row['Colour'];
            $size = $row['Size'];
            $quantity = $item['quantity'];

            if(isset($_POST['plus'])) {
              $quantity = (isset($_SESSION['quantity']) ? $_SESSION['quantity'] : 0);
              if ($quantity < 20) {
                $quantity++; 
                $_SESSION['quantity'] = $quantity; 
              }
            }
            
            if(isset($_POST['minus'])) {
              $quantity = (isset($_SESSION['quantity']) ? $_SESSION['quantity'] : 0);
                $quantity--; 
                $_SESSION['quantity'] = $quantity; 
              }
            }

            $subtotal = $price*$quantity;
            $total += $subtotal;


            ?>   



          <div class="row mb-4">
          <hr class="mb-4">
          <div class="row mb-4">
            <div class="col-md-5 col-lg-3 col-xl-3">
              <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                <img class="img-fluid w-100"
                src="../images/<?php echo $image; ?>"  alt="Sample">
                <a href="#!">
                </a>
              </div>
            </div>
            <div class="col-md-7 col-lg-9 col-xl-9">
              <div>
                <div class="d-flex justify-content-between">
                  <div>
                    <h5><?php echo $name; ?></h5>
                    <p class="mb-3 text-muted text-uppercase small"><?php echo $name; ?></p>
                    <p class="mb-2 text-muted text-uppercase small">Colour: <?php echo $colour; ?></p>
                    <p class="mb-3 text-muted text-uppercase small">Size: <?php echo $size; ?></p>
                  </div>
                  <div>
              <div class="def-number-input number-input safari_only mb-0 w-100">
                    <form method="post" action=""> 
                    <input type="submit" value="-" name="minus" id="minus" />
                      <!-- <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                        class="bi bi-dash minus"></button> -->

                      <input type+="number" class="quantity" id="quantity" min="0" name="quantity" value=<?php echo $quantity; ?> type="number">
                      <input type="submit" value="+" name="plus" id="plus" />
                     
                      <!-- <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                        class="bi bi-plus plus"></button> -->
                        </form>
                    </div>
                  </div>
                  
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <a href="#!" type="button" class="card-link-secondary small text-uppercase mr-3"><i
                        class="fas fa-trash-alt mr-1"></i> Remove item </a>
                    <a href="#!" type="button" class="card-link-secondary small text-uppercase"><i
                        class="fas fa-heart mr-1"></i> Move to wish list </a>
                  </div>
                  <p class="mb-0"><span><strong>£<?php echo $subtotal; ?></strong></span></p class="mb-0">
                </div>
              </div>
 
            </div>
          </div>
          <?php
}
} else { ?>

<h2><?php echo "You don't have any items in your shopping cart."; ?></h2>
<?php } 

?>
        </div>
      <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i> Do not delay the purchase, adding
            items to your cart does not mean booking them.</p>

        </div>
      </div>
      <!-- Card -->
      <!-- Card -->

    </div>
    <!--Grid column-->
 <!-- Card -->
 <div class="mb-3">
        <div class="pt-4">

          <h5 class="mb-4">Expected shipping delivery</h5>

          <p class="mb-0"> Thu., 12.03. - Mon., 16.03.</p>
        </div>
      </div>

<!-- Card -->
<div class="mb-3">
        <div class="pt-4">

          <h5 class="mb-4">We accept</h5>

          <img class="mr-2" width="45px"
            src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
            alt="Visa">
          <img class="mr-2" width="45px"
            src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
            alt="American Express">
          <img class="mr-2" width="45px"
            src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
            alt="Mastercard">
          <img class="mr-2" width="45px"
            src="https://mdbootstrap.com/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.png"
            alt="PayPal acceptance mark">
        </div>
      </div>
      </div>

        <!--Grid column-->
        <div class="col-lg-4">

      <!-- Card -->
      <div class="mb-3">
        <div class="pt-4">

          <h5 class="mb-3">The total amount of</h5>

          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
              Temporary amount
              <span>£<?php echo $total; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
              Shipping
              <span>Free</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
              <div>
                <strong>The total amount of</strong>
                <strong>
                  <p class="mb-0">(including VAT)</p>
                </strong>
              </div>
              <span><strong>£<?php echo $total; ?></strong></span>
            </li>
          </ul>

          <a href="checkout.php" type="button" class="btn btn-primary btn-block">Checkout</a>

        </div>
      </div>
      <!-- Card -->

      <!-- Card -->
      <div class="mb-3">
        <div class="pt-4">

          <a class="dark-grey-text d-flex justify-content-between" data-toggle="collapse" href="#collapseExample"
            aria-expanded="false" aria-controls="collapseExample">
            Add a discount code (optional)
            <span><i class="fas fa-chevron-down pt-1"></i></span>
          </a>

          <div class="collapse" id="collapseExample">
            <div class="mt-3">
              <div class="md-form md-outline mb-0">
                <input type="text" id="discount-code" class="form-control font-weight-light"
                  placeholder="Enter discount code">
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <!-- Card -->

    </div>
    <!--Grid column-->

  </div>
  <!-- Grid row -->

</section>
<!--Section: Block Content-->         

<!-- <form action="#" method="post"> -->

<!-- <h4>Quantity:  </h4><input type="submit" value="+" name="plus" id="plus" /> <input type="text" class="form-control" id="quanitiy" name="quanitity" value= <?php echo "$quantity"; ?>><input type="submit" value="-" name="minus" id="minus"  />

</form>
<form action="#" method="GET">
	<label for="reset">Reset cart: </label>
	<input type="submit" value="RESET" name="reset" id="reset" />
</form> -->

</div>
</body>
<?php
include "footer.php";
?>
</html>
    