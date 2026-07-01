<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">LuxeGems</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                    <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                        <li><a class="dropdown-item" href="shop.php?category=rings">Rings</a></li>
                        <li><a class="dropdown-item" href="shop.php?category=necklaces">Necklaces</a></li>
                        <li><a class="dropdown-item" href="shop.php?category=earrings">Earrings</a></li>
                        <li><a class="dropdown-item" href="shop.php?category=bracelets">Bracelets</a></li>
                        <li><a class="dropdown-item" href="shop.php?category=watches">Watches</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
            <form class="d-flex me-3" role="search" action="shop.php" method="GET">
                <input class="form-control me-2" type="search" name="search" placeholder="Search for jewelry..." aria-label="Search" style="border-radius: 20px;">
                <button class="btn btn-outline-primary" type="submit" style="border-radius: 20px;">Search</button>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="wishlist.php"><i class="bi bi-heart"></i></a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php"><i class="bi bi-cart3"></i></a></li>
                <?php if(isLoggedIn()): ?>
                    <li class="nav-item"><a class="nav-link" href="profile.php"><i class="bi bi-person"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>