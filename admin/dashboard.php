<?php
session_start();

if(!isset($_SESSION['id']))
{
    header("Location: ../login.php");
    exit();
}

if($_SESSION['role']!="admin")
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

<title>Admin Dashboard</title>

<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="dashboard-hero">
<h2>Admin Dashboard</h2>
<p>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></p>
</div>

<div class="dashboard-grid">

<a class="dash-card" href="approve_users.php">
<span class="dash-icon">✅</span>
<h3>Approve Shop Owners</h3>
<p>Review and approve pending shop registrations</p>
</a>

<a class="dash-card" href="manage_products.php">
<span class="dash-icon">👕</span>
<h3>Manage Products</h3>
<p>Add or remove product categories</p>
</a>

</div>

</body>
</html>