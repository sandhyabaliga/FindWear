<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if(!isset($_SESSION['id']))
{
    header("Location: ../login.php");
    exit();
}

if($_SESSION['role']!="shop_owner")
{
    header("Location: ../login.php");
    exit();
}
$base = "../";
include("../navbar.php");
?>


<!DOCTYPE html>
<html>

<head>

<title>Owner Dashboard</title>

<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="dashboard-hero">
<h2>Owner Dashboard</h2>
<p>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></p>
</div>

<div class="dashboard-grid">

<a class="dash-card" href="add_shop.php">
<span class="dash-icon">🏬</span>
<h3>My Shop</h3>
<p>Add or update your shop details</p>
</a>

<a class="dash-card" href="add_inventory.php">
<span class="dash-icon">➕</span>
<h3>Add Inventory</h3>
<p>List a new product in your shop</p>
</a>

<a class="dash-card" href="view_inventory.php">
<span class="dash-icon">📦</span>
<h3>View Inventory</h3>
<p>See and manage everything you've listed</p>
</a>

</div>

</body>

</html>