<?php
session_start(); 
include("db.php");

$results = null;

if(isset($_GET['search']))
{
    $keyword = mysqli_real_escape_string($conn, $_GET['keyword']);
$area = isset($_GET['area']) ? mysqli_real_escape_string($conn, $_GET['area']) : "";
    $sql = "
    SELECT
        shops.shop_name,
        shops.address,
        shops.area,
        shops.city,
        shops.phone,
        shops.google_map,
        products.product_name,
        inventory.price,
        inventory.quantity,
        inventory.color,
        inventory.size

    FROM inventory

    INNER JOIN shops
        ON inventory.shop_id = shops.id

    INNER JOIN products
        ON inventory.product_id = products.id

    WHERE
        products.product_name LIKE '%$keyword%'
        AND shops.area LIKE '%$area%'
        AND inventory.in_stock = 1
        AND shops.is_approved = 1
    ";

    $results = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Search - FindWear</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<?php include("navbar.php"); ?>

<div class="form-container" style="width:900px;">

<h2>Search Clothes</h2>

<form method="GET">

<input
type="text"
name="keyword"
placeholder="Product Name (e.g. Black Shirt)"
required>

<input
type="text"
name="area"
placeholder="Area (Optional)">

<button
type="submit"
name="search">

Search

</button>

</form>

<br>

<?php

if(isset($_GET['search']))
{

    if(mysqli_num_rows($results) > 0)
    {

        while($row = mysqli_fetch_assoc($results))
        {

?>

<div class="card">

<h2><?php echo $row['shop_name']; ?></h2>

<p><b>Product:</b> <?php echo $row['product_name']; ?></p>

<p><b>Color:</b> <?php echo $row['color']; ?></p>

<p><b>Size:</b> <?php echo $row['size']; ?></p>

<p><b>Price:</b> ₹<?php echo $row['price']; ?></p>

<p><b>Available Quantity:</b> <?php echo $row['quantity']; ?></p>

<p><b>Address:</b>
<?php
echo $row['address'] . ", " .
     $row['area'] . ", " .
     $row['city'];
?>
</p>

<p><b>Phone:</b> <?php echo $row['phone']; ?></p>

<p>
<a target="_blank" href="<?php echo $row['google_map']; ?>">
📍 Open Google Maps
</a>
</p>

</div>

<br>

<?php

        }

    }
    else
    {

        echo "<h3>No shops found for this product.</h3>";

    }

}

?>

</div>

</body>

</html>