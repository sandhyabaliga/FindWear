<?php
session_start();
include("../db.php");

$owner_id = $_SESSION['id'];

$result = mysqli_query($conn, "SELECT * FROM shops WHERE owner_id='$owner_id'");
$shop = mysqli_fetch_assoc($result);

if(!$shop)
{
    die("No shop found. Please add a shop first.");
}

if(isset($_POST['update']))
{
    $shop_name = $_POST['shop_name'];
    $address = $_POST['address'];
    $area = $_POST['area'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $google_map = $_POST['google_map'];

$stmt = mysqli_prepare($conn, "UPDATE shops SET shop_name=?, address=?, area=?, city=?, phone=?, google_map=? WHERE owner_id=?");
mysqli_stmt_bind_param($stmt, "ssssssi", $shop_name, $address, $area, $city, $phone, $google_map, $owner_id);
mysqli_stmt_execute($stmt);

    echo "<script>
    alert('Shop Updated Successfully');
    window.location='dashboard.php';
    </script>";
}

$base = "../";
include("../navbar.php");
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Shop</title>

<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="form-container">

<h2>Edit Shop</h2>

<form method="POST">

<input
type="text"
name="shop_name"
value="<?php echo htmlspecialchars($shop['shop_name']); ?>"
required>

<input
type="text"
name="address"
value="<?php echo htmlspecialchars($shop['address']); ?>"
required>

<input
type="text"
name="area"
value="<?php echo htmlspecialchars($shop['area']); ?>"
required>

<input
type="text"
name="city"
value="<?php echo htmlspecialchars($shop['city']); ?>"
required>

<input
type="text"
name="phone"
value="<?php echo htmlspecialchars($shop['phone']); ?>"
required>

<input
type="text"
name="google_map"
value="<?php echo htmlspecialchars($shop['google_map']); ?>">

<button
type="submit"
name="update">

Update Shop

</button>

</form>

</div>

</body>

</html>