<?php
session_start();
ob_start();
error_reporting(E_ALL); ini_set('display_errors', 1);
include "connect.php";
?>


<?php
if(isset($_POST['add_to_cart']) && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if there is a session for the cart set already, if not then set one.
    if(!isset($_SESSION['shoppingcart'])) {
        $_SESSION['shoppingcart'] = [];
    }

    $quantity = $_POST["amount"];

    $item = [
        "id"        => $id,
        "quantity"  => $quantity
    ];

    // Now add new item to the cart 
    array_push($_SESSION['shoppingcart'], $item);

    // Once add let's take the user to the cart 
    header("Location: cart.php");   
} else {
// If the add to cart button was not clicked then go back to the products page.
header("Location: index.php");
}
?>
