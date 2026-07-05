<?php
include("db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindWear</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header>

    <div class="logo">
        👕 FindWear
    </div>

    <nav>

    <a href="#">Home</a>

    <a href="#">Categories</a>

    <a href="#">How It Works</a>

    <a href="#">Contact</a>

    <a href="login.php" class="login-btn">Login</a>
    <a href="register.php" class="register-btn">Register</a>
</nav>

</header>

<section class="hero">

    <h1>Find Your Fashion, Instantly.</h1>

    <p>
        Search clothes from nearby fashion stores and know exactly where they're available before you leave home.
    </p>

    <form class="search-box" action="search.php" method="GET">

        <input type="text" name="keyword"placeholder="Search Product" required>

        <input type="text" name="area" placeholder="Enter Area / City">

        <button type="submit" name="search">Search </button>

   </form>

</section>
<section class="features">

    <h2>How FindWear Works</h2>

    <div class="feature-container">

        <div class="card">
            <h3>🔍 Search</h3>
            <p>Search for any clothing item.</p>
        </div>

        <div class="card">
            <h3>🏪 Find Shops</h3>
            <p>See nearby shops where it's available.</p>
        </div>

        <div class="card">
            <h3>🛍 Buy</h3>
            <p>Visit the right shop and save time.</p>
        </div>

    </div>

</section>

<section class="categories">

    <h2>Popular Categories</h2>

    <div class="category-container">

        <div class="category">👔 Shirts</div>

        <div class="category">👖 Jeans</div>

        <div class="category">👗 Dresses</div>

        <div class="category">👟 Shoes</div>

        <div class="category">🥻 Sarees</div>

        <div class="category">🧥 Jackets</div>

    </div>

</section>

<script src="js/script.js"></script>
<footer>

    <h3>FindWear</h3>

    <p>
        Helping customers find clothes faster and helping local fashion stores reach more buyers.
    </p>

    <p>
        © 2026 FindWear. All Rights Reserved.
    </p>

</footer>
</body>
</html>