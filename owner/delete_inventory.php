<?php
session_start();
include("../db.php");

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'shop_owner') {
    header("Location: ../login.php");
    exit();
}

$id = intval($_GET['id']);
$owner_id = $_SESSION['id'];

// Verify this inventory item belongs to this owner before deleting
$check = mysqli_query($conn, "
    SELECT inventory.id
    FROM inventory
    JOIN shops ON inventory.shop_id = shops.id
    WHERE inventory.id = '$id' AND shops.owner_id = '$owner_id'
");

if (mysqli_num_rows($check) == 0) {
    die("Item not found or access denied.");
}

mysqli_query($conn, "DELETE FROM inventory WHERE id='$id'");

header("Location: view_inventory.php");
exit();
?>
