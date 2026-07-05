<?php
session_start();
include("../db.php");

if(isset($_POST['save']))
{
    $owner_id = $_SESSION['id'];
    $shop_name = $_POST['shop_name'];
    $address = $_POST['address'];
    $area = $_POST['area'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $google_map = $_POST['google_map'];

    $sql = "INSERT INTO shops
    (owner_id,shop_name,address,area,city,phone,google_map)
    VALUES
    ('$owner_id','$shop_name','$address','$area','$city','$phone','$google_map')";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>alert('Shop Added Successfully');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Add Shop</title>

<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="form-container">

<h2>Add Shop Details</h2>

<form method="POST">

<input type="text" name="shop_name" placeholder="Shop Name" required>

<input type="text" name="address" placeholder="Address" required>

<input type="text" name="area" placeholder="Area" required>

<input type="text" name="city" placeholder="City" required>

<input type="text" name="phone" placeholder="Phone Number" required>

<input type="text" name="google_map" placeholder="Google Maps Link">

<button type="submit" name="save">Save Shop</button>

</form>

</div>

</body>

</html>