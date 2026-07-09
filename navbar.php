<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <div class="logo">👕 FindWear</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="search.php">Search</a>

        <?php if (isset($_SESSION['id'])): ?>
            <?php if ($_SESSION['role'] == 'customer'): ?>
                <a href="customer/dashboard.php">Dashboard</a>
            <?php elseif ($_SESSION['role'] == 'shop_owner'): ?>
                <a href="owner/dashboard.php">Dashboard</a>
            <?php elseif ($_SESSION['role'] == 'admin'): ?>
                <a href="admin/dashboard.php">Dashboard</a>
            <?php endif; ?>
            <a href="logout.php" class="login-btn">Logout</a>
        <?php else: ?>
            <a href="login.php" class="login-btn">Login</a>
            <a href="register.php" class="register-btn">Register</a>
        <?php endif; ?>
    </nav>
</header>