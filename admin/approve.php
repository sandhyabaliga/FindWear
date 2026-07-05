<?php
session_start();
include("../db.php");

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$id = intval($_GET['id']);

// Approve the user account
mysqli_query($conn, "UPDATE users SET status='approved' WHERE id='$id'");

// Also approve their shop so it shows in search results
mysqli_query($conn, "UPDATE shops SET is_approved=1 WHERE owner_id='$id'");

header("Location: approve_users.php");
exit();
?>
