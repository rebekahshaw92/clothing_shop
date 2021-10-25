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

<title>Checkout</title>

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
<div class="container">
                 <div class="row">
                    <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-item-center mb-3">
                            <span class="text-muted">Your Cart</span>
                            <span class="badge badge-secondary badge-pill">2</span>
                        </h4>

                        <?php


if(isset($_POST['checkout'])){
    $oderNumber = rand(100,999);
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $orderEmail = $_POST['email'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    $cardNumber = $_POST['cc-number'];
    $cardExpiry = $_POST['cc-exporation'];
    $cardCVV = $_POST['cc-cvv'];
    $cardName = $_POST['cc-name'];
    

    $query_insert_order = "INSERT INTO OrderPerson (`Email`, `FirstName`, `LastName`) VALUES (?, ?, ?)";
    $query=$mysqli->prepare($query_insert_order);
    $query->bind_param("sss", $orderEmail, $firstName, $lastName);
    echo $mysqli->error;
    $query->execute();
    
    $stmt = $mysqli->query("SELECT MAX(OrderPersonID) as OrderPersonID FROM OrderPerson");
  $result = $stmt->fetch_array(MYSQLI_ASSOC);

  $orderPersonID = $result['OrderPersonID'];


$query_insert_address = "INSERT INTO PersonAddress  (`OrderPersonID`, `Address1`, `Address2`, `Country`, `State`, `Postcode`) VALUES (?, ?, ?, ?, ?, ?)";

$address_query=$mysqli->prepare($query_insert_address);
$address_query->bind_param("ssssss", $orderPersonID, $address, $address2, $country, $state, $postcode);
echo $mysqli->error;
$address_query->execute();


$datePayed = date("Y-m-d");

$query_insert_payment= "INSERT INTO payments (`UserID`, `CardNumber`, `ExpDate`, `CardHolder`, `DatePayed`) VALUES (?, ?, ?, ?, ?)";

$payment_query=$mysqli->prepare($query_insert_payment);
$payment_query->bind_param("sssss", $orderPersonID, $cardNumber, $cardExpiry, $cardName, $datePayed);
echo $mysqli->error;
$payment_query->execute();



$today = date("Ymd");
$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
$oderNumber = $today . $rand;


$orderPaymentID = $mysqli->query("SELECT MAX(PaymentID) as PaymentID FROM payments");
$paymentResult = $stmt->fetch_array(MYSQLI_ASSOC);

$paymentID = $paymentResult['paymentID'];

$query_insert_order= "INSERT INTO orders (`OrderNumber`, `ItemID`, `Date`, `UserID`, `PaymentID`) VALUES (?, ?, ?, ?, ?)";
$order_query=$mysqli->prepare($query_insert_order);
$order_query->bind_param("sssss", $orderNumber, $id, $datePayed, $orderPersonID, $PaymentID);
echo $mysqli->error;
$payment_query->execute();


}
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

            $subtotal = $price*$quantity;
                            $total += $subtotal;

?>
            <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                        <h6 class="my-0"><?php echo $name; ?></h5>
                        <small class="text-muted">Size: <?php echo $size; ?> Quantity: <?php echo $quantity; ?></small>
                        </div>
                        <span class="text-muted">£<?php echo $subtotal; ?></span>
                        </li>
                        <?php
                
       }
    }    
?>
                    
                        <li class="list-group-item d-flex justify-content-between">
                        <span>Total (GBP)</span>
                        <?php
                            $subtotal = $price*$quantity;
                            $total += $subtotal;

                        ?>
                        <strong>£<?php echo $total;?></strong>
                        <?php } ?>
                        </li>
                        </ul>
                        </div>

      
                        <div class="col-md-8 order-md-1">
                            <h4 class="mb-3">Billing Address</h4>
                            <form class="needs-validation" action="" method="post">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName">First Name</label>
                                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="yourEmail" placeholder="you@example.com" required>
                            </div>

                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" required>
                            </div>

                            <div class="mb-3">
                                <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                                <input type="text" class="form-control" name="address2" id="address2" placeholder="1234 Main St">
                            </div>
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                <label for="country">Country</label>
                                <select name="country" class="costom-select d-block w-100" id="country" required>
                                    <option>Choose...</option>
                                    <option value="United States">United States</option>
                                </select>
                                </div>   
                                <div class="col-md-4 mb-3">
                                    <label for="state">State</label>
                                    <select name="state" class="custom-select d-block w-100" id="state" required>
                                    <option>Choose...</option>
                                    <option value="Califormia">California</option>
                                    </select>
                                            </div>
                                <div class="col-md-3 mb-3">
                                    <label for="postcode">Postcode</label>
                                    <input type="text" class="form-control" name="postcode" id="postcode" placeholder="" value="" required>
                                </div>
                                <hr class="mb-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="same-address">
                                    <label class="custom-control-label" for="same-address"> Shipping address is the same as my billing address</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="save-info">
                                    <label class="custom-control-label" for="save-info"> Save this information for next time</label>
                                    </div>
                                <hr class="mb-4">
                                <h4 class="mb-3">Payment</h4>
                                <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="credit">Credit Card</label>
                            </div>
                                <div class="custom-control custom-radio">
                                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="debit">Debit Card</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="paypal">PayPal</label>
                            </div>
                            </div>
                            <div class="row">
                            <div class="mb-3">
                                <labdl for="cc-number"> Card Number</label>
                                <input type="text" class="form-control" name="cc-number" id="cc-number" placeholder="" required>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6 mb-3">
                            <label for="cc-exporation">Expiration Date</label>
                            <input type="text" class="form-control" name="cc-exporation" id="cc-exporation" placeholder="" required>
                            </div>
                            <div class="col-md-6 mb-3 mb-3">
                            <label for="cc-cvv">CVV Code</label>
                            <input type="text" class="form-control" name="cc-cvv" id="cc-cvv" placeholder="" required>
                            </div>
                            </div>
                            <div class="row">
                            <div class="mb-3">
                                <labdl for="cc-name"> Card Holder's Name</label>
                                <input type="text" class="form-control" name="cc-name" id="cc-name" placeholder="" required>
                                </div>
                                </div>
                                <hr class="mb-4">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" id="checkout" name="checkout" value="Continue to checkout"/>

      </form>
    </div>
  </div>
</body>
<?php
include "footer.php";
?>
</html>
