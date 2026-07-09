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
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard - FindWear</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="form-container">
<h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
<p>Use the search to find clothes near you.</p>
<br>
<a href="../search.php"><button>🔍 Search Clothes</button></a>
<br><br>
<a href="../logout.php"><button>Logout</button></a>
</div>
</body>
</html>
