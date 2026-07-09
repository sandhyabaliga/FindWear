<?php
session_start();
include("../db.php");

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'shop_owner') {
    header("Location: ../login.php");
    exit();
}

$owner_id = $_SESSION['id'];
$existing = mysqli_query($conn, "SELECT id FROM shops WHERE owner_id='$owner_id'");
if (mysqli_num_rows($existing) > 0) {
    header("Location: edit_shop.php");
    exit();
}

if(isset($_POST['save']))
{
    $owner_id = $_SESSION['id'];
    $shop_name = $_POST['shop_name'];
    $address = $_POST['address'];
    $area = $_POST['area'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $google_map = $_POST['google_map'];

    $stmt = mysqli_prepare($conn, "INSERT INTO shops (owner_id,shop_name,address,area,city,phone,google_map) VALUES (?,?,?,?,?,?,?)");
mysqli_stmt_bind_param($stmt, "issssss", $owner_id, $shop_name, $address, $area, $city, $phone, $google_map);

if(mysqli_stmt_execute($stmt))
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