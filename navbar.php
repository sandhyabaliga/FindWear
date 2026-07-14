<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($base)) {
    $base = "";
}
?>
<header>
    <div class="logo">👕 FindWear</div>
    <nav>
        <a href="<?php echo $base; ?>index.php">Home</a>
        <a href="<?php echo $base; ?>search.php">Search</a>

        <?php if (isset($_SESSION['id'])): ?>
            <?php if ($_SESSION['role'] == 'customer'): ?>
                <a href="<?php echo $base; ?>customer/dashboard.php">Dashboard</a>
            <?php elseif ($_SESSION['role'] == 'shop_owner'): ?>
                <a href="<?php echo $base; ?>owner/dashboard.php">Dashboard</a>
            <?php elseif ($_SESSION['role'] == 'admin'): ?>
                <a href="<?php echo $base; ?>admin/dashboard.php">Dashboard</a>
            <?php endif; ?>
            <a href="<?php echo $base; ?>logout.php" class="login-btn">Logout</a>
        <?php else: ?>
            <a href="<?php echo $base; ?>login.php" class="login-btn">Login</a>
            <a href="<?php echo $base; ?>register.php" class="register-btn">Register</a>
        <?php endif; ?>
    </nav>
        </header>