<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

include("../db.php");

$id = intval($_GET['id']);


mysqli_query($conn,
"DELETE FROM products
WHERE id='$id'");

header("Location: manage_products.php");

?>