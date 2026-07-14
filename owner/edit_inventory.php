<?php
session_start();
include("../db.php");

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'shop_owner') {
    header("Location: ../login.php");
    exit();
}

$id = intval($_GET['id']);
$owner_id = $_SESSION['id'];

// Make sure this inventory item belongs to this owner
$result = mysqli_query($conn, "
    SELECT inventory.*, products.product_name
    FROM inventory
    JOIN shops ON inventory.shop_id = shops.id
    JOIN products ON inventory.product_id = products.id
    WHERE inventory.id = '$id' AND shops.owner_id = '$owner_id'
");

if (mysqli_num_rows($result) == 0) {
    die("Item not found or access denied.");
}

$item = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $quantity = intval($_POST['quantity']);
    $price    = floatval($_POST['price']);
    $size     = mysqli_real_escape_string($conn, $_POST['size']);
    $color    = mysqli_real_escape_string($conn, $_POST['color']);
    $in_stock = intval($_POST['stock']);

    mysqli_query($conn, "
        UPDATE inventory
        SET quantity='$quantity', price='$price', size='$size', color='$color', in_stock='$in_stock'
        WHERE id='$id'
    ");

    echo "<script>alert('Updated Successfully'); window.location='view_inventory.php';</script>";
    exit();
}

$base = "../";
include("../navbar.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Inventory</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="form-container">
<h2>Edit: <?php echo htmlspecialchars($item['product_name']); ?></h2>
<form method="POST">

<input type="number" name="quantity" placeholder="Quantity" value="<?php echo $item['quantity']; ?>" required>

<input type="number" step="0.01" name="price" placeholder="Price" value="<?php echo htmlspecialchars($item['price']); ?>" required>

<input type="text" name="size" placeholder="Size (e.g. S,M,L,XL)" value="<?php echo $item['size']; ?>">

<input type="text" name="color" placeholder="Color (e.g. Black, White)" value="<?php echo htmlspecialchars($item['color']); ?>">

<select name="stock">
<option value="1" <?php if($item['in_stock']==1) echo 'selected'; ?>>In Stock</option>
<option value="0" <?php if($item['in_stock']==0) echo 'selected'; ?>>Out of Stock</option>
</select>

<button type="submit" name="update">Update</button>
<a href="view_inventory.php"><button type="button">Cancel</button></a>

</form>
</div>
</body>
</html>
