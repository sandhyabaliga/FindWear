<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

include("../db.php");

$categories=mysqli_query($conn,"SELECT * FROM categories");

if(isset($_POST['save']))
{

$product=$_POST['product'];

$category=$_POST['category'];

$gender=$_POST['gender'];

$stmt = mysqli_prepare($conn, "INSERT INTO products (product_name,category_id,gender) VALUES (?,?,?)");
mysqli_stmt_bind_param($stmt, "sis", $product, $category, $gender);
mysqli_stmt_execute($stmt);

echo "<script>alert('Product Added');</script>";

}

$base = "../";
include("../navbar.php");
?>

<!DOCTYPE html>

<html>

<head>

<title>Add Product</title>

<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="form-container">

<h2>Add Product</h2>

<form method="POST">

<input type="text"
name="product"
placeholder="Product Name"
required>

<select name="category">

<?php

while($row=mysqli_fetch_assoc($categories))
{

?>

<option value="<?php echo $row['id'];?>">

<?php echo $row['category_name'];?>

</option>

<?php

}

?>

</select>

<select name="gender">

<option>Men</option>

<option>Women</option>

<option>Kids</option>

<option>Unisex</option>

</select>

<button name="save">

Add Product

</button>

</form>

</div>

</body>

</html>