<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "connect.php";


$username = "admin"; 
$password = "admin";

if(isset($_POST['submit'])) {
    if($_POST['username'] == $username && $_POST['password'] == $password) {
    ?>
        <form method="post" enctype="multipart/form-data">
        <label for="brand">Brand</label>
      <select name="brand" id="brand">
      <option value="Mr">Mr</option>
      <option value="Miss">Miss</option>
      <option value="Mrs">Mrs</option>
      <option value="Ms">Ms</option>
      <option value="Dr">Dr</option>
    </select>
    <br>
    
        <label for="up_name">Item Name</label>
    <input type="text" name="up_name" id="up_name" placeholder="Item Name" />
    <br>
    <label for="type">Item Type</label>
      <select name="type" id="type">
      <option value="Mr">Mr</option>
      <option value="Miss">Miss</option>
      <option value="Mrs">Mrs</option>
      <option value="Ms">Ms</option>
      <option value="Dr">Dr</option>
    </select>
    <br>
    
    <label for="up_colour">Colour</label>
    <input type="text" name="up_colour" id="up_colour" placeholder="Colour" />
    <br>
    
    <label for="up_size">Size Range</label>
    <input type="text" name="up_size" id="up_size" placeholder="Size" />
    <br>
    
    <label for="up_price">Price</label>
    <input type="text" name="up_price" id="up_price" placeholder="£24.99" />
    <br>
    
    <label for="stock">Stock</label>
      <select name="stock" id="stock">
      <option value="Mr">Mr</option>
      <option value="Miss">Miss</option>
      <option value="Mrs">Mrs</option>
      <option value="Ms">Ms</option>
      <option value="Dr">Dr</option>
    </select>
    <br>
    <label for="file">Select image:</label>
    <input type="file" name="file" />
    <br>
    
    <input type="submit" name="add" value="Add Item" />
    
        </form>

   <?php } else {
        echo "sorry the username and password are incorrect";
    }
} else {
    ?><form method="post">
    Username: <input type="text" name="username" /> <br />
    Password: <input type="password" name="password" /> 
    <input type="submit" name="submit" value="submit" />

    </form>
    <?php
}


if(isset($_POST['add'])) {
    $error = array();
   
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $stock = $_POST['stock'];
   
    if(empty($_POST['up_name'])){
        $error[] = 'Please Enter The Item Name';   
    } else {
        $name = $_POST['up_name'];
    }
   
    if(empty($_POST['up_colour'])){
       $error[] = 'Please Enter The Item Colour';   
   } else {
       $colour = $_POST['up_colour'];
   }
   
   if(empty($_POST['up_size'])){
       $error[] = 'Please Enter The Item Size Range';   
   } else {
       $size = $_POST['up_size'];
   }
   
   if(empty($_POST['up_price'])){
       $error[] = 'Please Enter The Item Price';   
   } else {
       $price = $_POST['up_price'];
   }
   
   if(empty($_POST['file'])) {
       $error[] = 'Please add an Item Image';
   } else {
      $imageName = $_FILES['file']['name'];
      $target_dir = "upload/";
      $target_file = $target_dir . basename($_FILES['file']["name"]);
      
      var_dump($_FILES);
      // Select file type
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
      // Valid file extensions 
   
      $extensions_arr = array("jpg". "jpeg", "png", "gif");
   
       // Check extensions
       if( in_array($imageFileType,$extensions_arr)) {
   
           // Insert record
           $query = "INSERT INTO item(name) (`ItemName`, `ItemType`, `BrandID`, `Colour`, `Size`, `Stock`, `ItemImage`) VALUES ('$name', '$type', '$brand', '$colour', '$size', '$price', '$stock', '".$imageName."')";
           $result = mysqli_query($con, $query);
   
           if (!$result) {
               echo 'Query Failed';
           } else { // If it did not run OK.
               echo '<div class="errormsgbox">Iten could not be added due to a system </div>';
           }
       }
   
  }       // Upload file
//            move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$imgeName);
   
   }
?>