<?php
include("db.php");

if(isset($_POST['register']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Customers are approved automatically
    if($role == "customer")
    {
        $status = "approved";
    }
    else
    {
        $status = "pending";
    }

    // Check duplicate email
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0)
    {
        echo "<script>alert('Email already exists!');</script>";
    }
    else
    {
        $sql = "INSERT INTO users(full_name,email,password,phone,role,status)
                VALUES('$fullname','$email','$password','$phone','$role','$status')";

        if(mysqli_query($conn,$sql))
        {
            echo "<script>alert('Registration Successful'); window.location='login.php';</script>";
        }
        else
        {
            echo "<script>alert('Registration Failed');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css/style.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register - FindWear</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="form-container">

<h2>Create Account</h2>

<form action="" method="POST">

<input type="text" name="fullname" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email Address" required>

<input type="text" name="phone" placeholder="Phone Number" required>

<input type="password" name="password" placeholder="Password" required>

<select name="role">

<option value="customer">Customer</option>

<option value="shop_owner">Shop Owner</option>

</select>

<button type="submit" name="register">Register</button>

</form>

<p>
Already have an account?
<a href="login.php">Login</a>
</p>

</div>

</body>

</html>