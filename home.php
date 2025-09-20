<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRIME | Hydration Elevated</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./home.css">
</head>

<body>
    <!-- Particle Background -->
    <div class="particles" id="particles"></div>

    <div class="container">
        <!-- Header -->
        <header>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                </ul>
            </nav>
            <div class="logo">
                <i class="fas fa-bolt logo-icon"></i>
                <span class="logo-text">PRIME</span>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Contact</a></li>
                    <li><a href="./shopkeeper/login.php">Login</a></li>
                </ul>
            </nav>
        </header>

        <!-- Hero Section -->
        <section class="hero">

            <!-- Animated Product Display -->
            <div class="product-display">
                <img style="height: 35rem;" src="./Asserts/OrangeKreampng.png" alt="">
            </div>

            <div class="hero-content">
                <h1>HYDRATION ELEVATED</h1>
                <p>PRIME is a revolutionary hydration drink packed with electrolytes, BCAAs, and vitamins to help you refresh, replenish, and refuel.</p>
                <div class="cta-buttons">
                    <a href="./shopkeeper/registration.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Join Now
                    </a>
                    <a href="#" class="btn btn-secondary">
                        <i class="fas fa-play"></i> Watch Video
                    </a>
                </div>
            </div>


        </section>
    </div>

    <script src="./home.js"></script>
</body>

</html>