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
?>


<!DOCTYPE html>
<html>

<head>

<title>Owner Dashboard</title>

<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="form-container">

<h2>Owner Dashboard</h2>

<h3>Welcome <?php echo htmlspecialchars($_SESSION['name']); ?></h3>

<br>

<a href="edit_shop.php">
<button>Add / Edit Shop</button>
</a>

<br><br>

<a href="add_inventory.php">
<button>Add Inventory</button>
</a>

<br><br>

<a href="view_inventory.php">
<button>View Inventory</button>
</a>

<br><br>

<a href="../logout.php">
<button>Logout</button>
</a>

</div>

</body>

</html>