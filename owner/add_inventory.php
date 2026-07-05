<?php
session_start();
include("../db.php");

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'shop_owner') {
    header("Location: ../login.php");
    exit();
}

$owner = $_SESSION['id'];

$shopResult = mysqli_query($conn, "SELECT * FROM shops WHERE owner_id='$owner' AND is_approved=1");
$shopData   = mysqli_fetch_assoc($shopResult);

if (!$shopData) {
    echo "<div class='form-container'><h3>Your shop is either not added or not yet approved by admin. Please wait for approval.</h3>
    <a href='dashboard.php'><button>Back</button></a></div>";
    exit();
}

$shop_id  = $shopData['id'];
$products = mysqli_query($conn, "SELECT * FROM products ORDER BY product_name");

$msg = "";

if (isset($_POST['save'])) {
    $product  = intval($_POST['product']);
    $quantity = intval($_POST['quantity']);
    $price    = floatval($_POST['price']);
    $size     = mysqli_real_escape_string($conn, $_POST['size']);
    $color    = mysqli_real_escape_string($conn, $_POST['color']);
    $stock    = intval($_POST['stock']);

    $check = mysqli_query($conn, "SELECT * FROM inventory WHERE shop_id='$shop_id' AND product_id='$product'");

    if (mysqli_num_rows($check) > 0) {
        $msg = "<p style='color:red;'>This product already exists in your inventory. Please edit it instead.</p>";
    } else {
        mysqli_query($conn, "
            INSERT INTO inventory (shop_id, product_id, quantity, price, size, color, in_stock)
            VALUES ('$shop_id','$product','$quantity','$price','$size','$color','$stock')
        ");
        $msg = "<p style='color:green;'>✅ Inventory item added successfully!</p>";
        // Refresh product list to exclude added ones
        $products = mysqli_query($conn, "SELECT * FROM products ORDER BY product_name");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Inventory</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="form-container">
<h2>Add Inventory</h2>
<?php echo $msg; ?>
<form method="POST">

<select name="product" required>
<option value="">-- Select Product --</option>
<?php while($row = mysqli_fetch_assoc($products)) { ?>
<option value="<?php echo $row['id']; ?>"><?php echo $row['product_name']; ?></option>
<?php } ?>
</select>

<input type="number" name="quantity" placeholder="Quantity" min="0" required>

<input type="number" step="0.01" name="price" placeholder="Price (₹)" min="0" required>

<input type="text" name="size" placeholder="Sizes (e.g. S,M,L,XL)">

<input type="text" name="color" placeholder="Colors (e.g. Black,White)">

<select name="stock">
<option value="1">In Stock</option>
<option value="0">Out of Stock</option>
</select>

<button name="save">Add to Inventory</button>
<a href="view_inventory.php"><button type="button">View Inventory</button></a>
<a href="dashboard.php"><button type="button">Back</button></a>

</form>
</div>
</body>
</html>
