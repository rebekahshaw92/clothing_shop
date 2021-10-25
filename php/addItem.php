<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "connect.php";

if(isset($_POST['submit'])){  
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $stock = $_POST['stock'];
    $name = $_POST['up_name'];
    $colour = $_POST['up_colour'];
    $size = $_POST['up_size'];
    $price = $_POST['up_price'];

    if(!$_POST['up_name']) { // if no name has been supplied 
        $errorName = 'Please Enter Your Item Name'; // add to array "error"
        echo $errorName;
    } 
    
    if(!$_POST['up_colour']){
       $errorColour = 'Please Enter The Item Colour';   
       echo $errorColour;
   } 
   
   if(!$_POST['up_size']){
       $errorSize = 'Please Enter The Item Size Range'; 
       echo $errorSize;
   } 
   
   if(!$_POST['up_price']){
       $errorPrice = 'Please Enter The Item Price'; 
       echo $errorPrice;  
   } 
   
    // if(!($_POST['file'])) {
    //     $imageError[] = 'Please add an Item Image';
    //     echo $imageError;
    // } else {

        // Get file info
        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
   
        // Allow certain file formatsc
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        
       // Check extensions
       if(in_array($fileType, $allowTypes)) {
        $image = $_FILES['fileToUpload']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        
        // Insert record
        
        $query = "INSERT INTO item (`ItemName`, `ItemType`, `BrandID`, `Colour`, `Size`, `Price`, `Stock`, `ItemImage`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssssssss", $name, $type, $brand, $colour, $size, $price, $stock, $fileName);
        echo $mysqli->error;
        $stmt->execute();

           //$result = mysqli_query($con, $query);
   
           if ($mysqli->error) {
               echo 'Query Failed';
           } else { // If it did not run OK.
               echo '<div class="errormsgbox">Iten could not be added due to a system </div>';
           }

           $stmt->close();
       }
    
  //}       // Upload file
          // move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$target_dir.$imgeName);

}
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
    <input type="text" name="up_name" id="up_name"  placeholder="Item Name" />
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
    <input type="text" name="up_colour" id="up_colour"  placeholder="Colour" />
    <br>
    
    <label for="up_size">Size Range</label>
    <input type="text" name="up_size" id="up_size"  placeholder="Size" />
    <br>
    
    <label for="up_price">Price</label>
    <input type="text" name="up_price" id="up_price"  placeholder="£24.99" />
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
    <input type="file" name="fileToUpload" id="fileToUpload" />
    <br>
    
    <input type="submit" name="submit" value="Add Item" />
    
        </form>

