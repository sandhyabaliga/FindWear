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
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="form-container">

<h2>Admin Dashboard</h2>

<h3>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h3>

<br>

<a href="approve_users.php">
<button>Approve Shop Owners</button>
</a>

<br><br>

<a href="manage_products.php">
    <button>Manage Products</button>
</a>

<br><br>

<a href="../logout.php">
<button>Logout</button>
</a>

</div>

</body>
</html>