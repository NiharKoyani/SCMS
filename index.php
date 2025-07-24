<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRIME | Hydration Elevated</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #00C9FF;
            --primary-dark: #0088FF;
            --secondary: #FF2D75;
            --accent: #FFAC30;
            --dark: #0A1A2F;
            --light: #F5F9FF;
            --white: #FFFFFF;
            --gradient: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: black;
            color: var(--light);
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Particle Background */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            filter: blur(1px);
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); opacity: 0; }
            10% { opacity: 0.3; }
            90% { opacity: 0.3; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 0;
            animation: fadeInDown 1s ease-out;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-icon {
            font-size: 2rem;
            color: white;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .logo-text {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            background: white;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        nav ul {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        nav a {
            color: var(--light);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 0.5rem 0;
            transition: all 0.3s ease;
        }

        nav a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient);
            transition: width 0.3s ease;
        }

        nav a:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 4rem 0;
        }

        .hero-content {
            max-width: 600px;
            animation: slideInLeft 1s ease-out;
        }

        .hero h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            line-height: 1.6;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.9rem 2rem;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--gradient);
            color: var(--white);
            border: none;
            box-shadow: 0 5px 15px rgba(0, 201, 255, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 201, 255, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-secondary:hover {
            background: rgba(0, 201, 255, 0.1);
            transform: translateY(-3px);
        }

        /* Product Animation */
        .product-display {
            position: absolute;
            right: 5%;
            top: 50%;
            transform: translateY(-50%);
            width: 400px;
            height: 400px;
            animation: floatProduct 8s ease-in-out infinite;
        }

        @keyframes floatProduct {
            0%, 100% { transform: translateY(-50%) translateX(0) rotate(0deg); }
            50% { transform: translateY(-55%) translateX(10px) rotate(2deg); }
        }

        .product-can {
            position: relative;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 30% 30%, var(--primary), var(--primary-dark));
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .product-can::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
            border-radius: 20px;
        }

        .product-label {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            height: 60%;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .product-name {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .product-type {
            color: var(--dark);
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .bubbles {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .bubble {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: bubbleRise 6s infinite ease-in;
        }

        @keyframes bubbleRise {
            0% { transform: translateY(0) scale(0); opacity: 0; }
            20% { opacity: 0.5; }
            100% { transform: translateY(-100px) scale(1); opacity: 0; }
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .product-display {
                width: 300px;
                height: 300px;
                right: 2%;
            }
        }

        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                text-align: center;
                padding: 2rem 0;
            }

            .hero-content {
                margin-bottom: 3rem;
                animation: none;
            }

            .product-display {
                position: relative;
                right: auto;
                top: auto;
                transform: none;
                margin: 0 auto;
                animation: floatProductMobile 8s ease-in-out infinite;
            }

            @keyframes floatProductMobile {
                0%, 100% { transform: translateY(0) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(2deg); }
            }

            .cta-buttons {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            header {
                flex-direction: column;
                gap: 1rem;
            }

            nav ul {
                gap: 1rem;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .product-display {
                width: 250px;
                height: 250px;
            }

            .product-name {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Particle Background -->
    <div class="particles" id="particles"></div>

    <div class="container">
        <!-- Header -->
        <header>
            <div class="logo">
                <i class="fas fa-bolt logo-icon"></i>
                <span class="logo-text">PRIME</span>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="./shopkeeper/src/login.php">Login</a></li>
                </ul>
            </nav>
        </header>

        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>HYDRATION ELEVATED</h1>
                <p>PRIME is a revolutionary hydration drink packed with electrolytes, BCAAs, and vitamins to help you refresh, replenish, and refuel.</p>
                <div class="cta-buttons">
                    <a href="./shopkeeper/src/registration.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Join Now
                    </a>
                    <a href="#" class="btn btn-secondary">
                        <i class="fas fa-play"></i> Watch Video
                    </a>
                </div>
            </div>

            <!-- Animated Product Display -->
            <div class="product-display">
                <div class="product-can">
                    <div class="bubbles" id="bubbles"></div>
                    <div class="product-label">
                        <div class="product-name">PRIME</div>
                        <div class="product-type">HYDRATION DRINK</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create particles
            const particlesContainer = document.getElementById('particles');
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.width = Math.random() * 10 + 2 + 'px';
                particle.style.height = particle.style.width;
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDuration = 5 + Math.random() * 20 + 's';
                particle.style.animationDelay = Math.random() * 5 + 's';
                particlesContainer.appendChild(particle);
            }

            // Create bubbles in product can
            const bubblesContainer = document.getElementById('bubbles');
            for (let i = 0; i < 15; i++) {
                const bubble = document.createElement('div');
                bubble.className = 'bubble';
                bubble.style.width = Math.random() * 20 + 5 + 'px';
                bubble.style.height = bubble.style.width;
                bubble.style.left = Math.random() * 100 + '%';
                bubble.style.bottom = '-20px';
                bubble.style.animationDuration = 3 + Math.random() * 5 + 's';
                bubble.style.animationDelay = Math.random() * 3 + 's';
                bubblesContainer.appendChild(bubble);
            }

            // Add more bubbles periodically
            setInterval(() => {
                const bubble = document.createElement('div');
                bubble.className = 'bubble';
                bubble.style.width = Math.random() * 15 + 5 + 'px';
                bubble.style.height = bubble.style.width;
                bubble.style.left = Math.random() * 100 + '%';
                bubble.style.bottom = '-20px';
                bubble.style.animationDuration = 3 + Math.random() * 4 + 's';
                bubblesContainer.appendChild(bubble);

                // Remove bubble after animation
                setTimeout(() => {
                    bubble.remove();
                }, 7000);
            }, 800);
        });
    </script>
</body>
</html>