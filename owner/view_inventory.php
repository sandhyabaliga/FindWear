<?php
session_start();
include("../db.php");

$owner_id = $_SESSION['id'];

$sql = "
SELECT
inventory.id,
products.product_name,
inventory.quantity,
inventory.price,
inventory.size,
inventory.color,
inventory.in_stock

FROM inventory

JOIN shops
ON inventory.shop_id = shops.id

JOIN products
ON inventory.product_id = products.id

WHERE shops.owner_id = '$owner_id'
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>

<title>View Inventory</title>

<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="form-container" style="width:900px;">

<h2>My Inventory</h2>

<table border="1" width="100%" cellpadding="10">

<tr>
<th>Product</th>
<th>Quantity</th>
<th>Price</th>
<th>Size</th>
<th>Color</th>
<th>Stock</th>
<th>Edit</th>
<th>Delete</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?php echo htmlspecialchars($row['product_name']); ?></td>

<td><?php echo htmlspecialchars($row['quantity']); ?></td>

<td>₹<?php echo htmlspecialchars($row['price']); ?></td>

<td><?php echo htmlspecialchars($row['size']); ?></td>

<td><?php echo htmlspecialchars($row['color']); ?></td>

<td>
<?php
echo ($row['in_stock'] == 1) ? "In Stock" : "Out of Stock";
?>
</td>

<td>
<a href="edit_inventory.php?id=<?php echo $row['id']; ?>">
Edit
</a>
</td>

<td>
<a href="delete_inventory.php?id=<?php echo $row['id']; ?>">
Delete
</a>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>