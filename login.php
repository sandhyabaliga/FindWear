<?php
session_start();
include("db.php");

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1)
    {
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password']))
        {
            if($user['status'] == "pending")
            {
                echo "<script>alert('Your account is waiting for Admin approval');</script>";
            }
            else
            {
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['full_name'];
                $_SESSION['role'] = $user['role'];

                if($user['role'] == "customer")
                {
                    header("Location: customer/dashboard.php");
                    exit();
                }
                elseif($user['role'] == "shop_owner")
                {
                    header("Location: owner/dashboard.php");
                    exit();
                }
                elseif($user['role'] == "admin")
                {
                    header("Location: admin/dashboard.php");
                    exit();
                }
            }
        }
        else
        {
            echo "<script>alert('Incorrect Password');</script>";
        }
    }
    else
    {
        echo "<script>alert('Email not found');</script>";
    }
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
<link rel="stylesheet" href="css/style.css">
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="form-container">

<h2>Login</h2>

<form action="" method="POST">

<input type="email" name="email" placeholder="Email Address" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>

</form>

<p>

Don't have an account?

<a href="register.php">Register</a>

</p>

</div>

</body>

</html>