<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SESSION['role'] != 'customer') {
    header("Location: ../login.php");
    exit();
}

$base = "../";
include("../navbar.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard - FindWear</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="dashboard-hero">
<h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
<p>Find clothes available at shops near you.</p>
</div>

<div class="dashboard-grid">

<a class="dash-card" href="../search.php">
<span class="dash-icon">🔍</span>
<h3>Search Clothes</h3>
<p>Search by product name and area</p>
</a>

</div>
</body>
</html>
