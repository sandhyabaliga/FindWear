<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

include("../db.php");

$result = mysqli_query($conn,"
SELECT products.id,
products.product_name,
categories.category_name,
products.gender
FROM products
JOIN categories
ON products.category_id=categories.id");

$base = "../";
include("../navbar.php");
?>

<!DOCTYPE html>

<html>

<head>

<title>Manage Products</title>

<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="form-container">

<h2>Products</h2>

<a href="add_product.php">

<button>Add Product</button>

</a>

<br><br>

<div class="table-wrap">
<table class="styled">
<tr>

<th>Name</th>

<th>Category</th>

<th>Gender</th>

<th>Delete</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo htmlspecialchars($row['product_name']); ?></td>

<td><?php echo htmlspecialchars($row['category_name']); ?></td>

<td><?php echo htmlspecialchars($row['gender']); ?></td>

<td>

<a class="action-link action-delete" href="delete_product.php?id=<?php echo $row['id'];?>">
Delete
</a>

</td>

</tr>

<?php

}

?>

</table>
</div>

</div>

</body>

</html>