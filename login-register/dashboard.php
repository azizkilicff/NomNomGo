<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login-register/login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NomNomGo | Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <link rel="stylesheet" href="../home-page/style.css" />
</head>
<body>

  <!-- Header / Navbar -->
  <header>
    <nav class="navbar">
      <a href="#" class="nav-logo">
        <h2 class="logo-text">🍔 NomNomGo</h2>
      </a>
      <ul class="nav-menu">
        <button id="menu-close-button" class="fas fa-times"></button>
        <li class="nav-item"><a href="#home" class="nav-link">Home</a></li> 
        <li class="nav-item"><a href="#menu" class="nav-link">Menu</a></li>
        <!-- Cart & Logout for Logged-in Users -->
        <li class="nav-item"><a href="cart.php" class="nav-link"><i class="fas fa-shopping-cart"></i> Cart</a></li>
        <li class="nav-item"><a href="../home-page/home.html" class="nav-link logout-btn">Logout</a></li>
      </ul>
      <button id="menu-open-button" class="fas fa-bars"></button>
    </nav>
  </header>

  <main>
    <!-- Hero Section -->
    <section class="hero-section" id="home">
      <div class="section-content">
        <div class="hero-details">
          <h2 class="title">Welcome, <?php echo $_SESSION["full_name"]; ?>!</h2>
          <h3 class="subtitle">Explore our delicious menu and place your order</h3>
          <p class="description">
            Enjoy a seamless and convenient way to browse menus, customize meals, and get your food delivered on time!
          </p>
          <div class="buttons">
            <a href="#menu" class="button order-now">View Menu</a>
            <a href="cart.php" class="button login-btn">View Cart</a>
          </div>
        </div>
        <div class="hero-image-wrapper">
          <img src="../images/delicious.jpg" alt="Delicious Food" class="hero-image" loading="lazy"/>
        </div>
      </div>
    </section>

    <!-- Menu Section -->
    <section class="menu-section" id="menu">
      <h2 class="section-title">Our Menu</h2>
      <div class="section-content">
        <div class="swiper menu-swiper">
          <div class="swiper-wrapper">
            <!-- Slide 1: Meal Item -->
            <div class="swiper-slide menu-item">
              <img src="../images/burger.jpg" alt="Classic Cheeseburger" class="menu-image" />
              <div class="menu-details">
                <h3 class="name">Classic Cheeseburger</h3>
                <p class="text">Juicy beef patty, cheddar cheese, and fresh veggies.</p>
                <button class="button add-to-cart">Add to Cart</button>
              </div>
            </div>
            <!-- Slide 2: Meal Item -->
            <div class="swiper-slide menu-item">
              <img src="../images/pizza.jpg" alt="Margherita Pizza" class="menu-image" />
              <div class="menu-details">
                <h3 class="name">Margherita Pizza</h3>
                <p class="text">Authentic Italian pizza with fresh basil & mozzarella.</p>
                <button class="button add-to-cart">Add to Cart</button>
              </div>
            </div>
            <!-- Slide 3: Meal Item -->
            <div class="swiper-slide menu-item">
              <img src="../images/sushi.webp" alt="Sushi Platter" class="menu-image" />
              <div class="menu-details">
                <h3 class="name">Sushi Platter</h3>
                <p class="text">Fresh sushi rolls with soy sauce and wasabi.</p>
                <button class="button add-to-cart">Add to Cart</button>
              </div>
            </div>
          </div>
          <div class="swiper-pagination"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer-section">
    <div class="section-content">
      <p class="copyright-text">© 2025 NomNomGo. All Rights Reserved.</p>
      <div class="social-link-list">
        <a href="#" class="social-link"><i class="fa-brands fa-facebook"></i></a>
        <a href="#" class="social-link"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" class="social-link"><i class="fa-brands fa-x-twitter"></i></a>
      </div>
    </div>
  </footer>

  <!-- Custom Script -->
  <script src="../home-page/script.js"></script>
</body>
</html>
