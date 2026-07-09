<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

include("../db.php");

$result=mysqli_query($conn,
"SELECT * FROM users
WHERE role='shop_owner'
AND status='pending'");
?>

<!DOCTYPE html>

<html>

<head>

<title>Approve Shop Owners</title>

<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="form-container">

<h2>Pending Shop Owners</h2>

<table border="1" cellpadding="10">

<tr>

<th>Name</th>

<th>Email</th>

<th>Action</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td>

<a href="approve.php?id=<?php echo $row['id']; ?>">

Approve

</a>

</td>

</tr>

<?php

}

?>

</table>

</div>

</body>

</html>