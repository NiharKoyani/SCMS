<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - Vendor Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #09122c;
            --primary-color: #596792;
            --secondary-color: #f1f2f6;
            --accent-color: #10b981;
            --text-color: #1f2937;
            --light-text: #6b7280;
            --border-color: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-color) 100%);
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .container {
            text-align: center;
            z-index: 10;
            position: relative;
            padding: 2rem;
            max-width: 800px;
        }

        .error-code {
            font-size: 12rem;
            font-weight: 900;
            margin-bottom: -2rem;
            background: linear-gradient(45deg, #fff 30%, #f0f0f0 70%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            animation: float 3s ease-in-out infinite;
        }

        .error-title {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .error-description {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            line-height: 1.6;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background-color: white;
            color: var(--primary-color);
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 255, 255, 0.3);
        }

        .btn-secondary {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        /* Animation Elements */
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatAround 20s infinite linear;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-duration: 25s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 70%;
            left: 80%;
            animation-duration: 30s;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 20%;
            left: 85%;
            animation-duration: 20s;
            animation-delay: 1s;
        }

        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            top: 80%;
            left: 15%;
            animation-duration: 35s;
            animation-delay: 3s;
        }

        .shape:nth-child(5) {
            width: 50px;
            height: 50px;
            top: 60%;
            left: 5%;
            animation-duration: 15s;
            animation-delay: 0.5s;
        }

        /* Astronaut Animation */
        .astronaut {
            position: absolute;
            top: 50%;
            right: 10%;
            width: 150px;
            height: 150px;
            z-index: 5;
            animation: floatAstronaut 8s ease-in-out infinite;
        }

        .astronaut-body {
            position: absolute;
            width: 80px;
            height: 100px;
            background: white;
            border-radius: 40% 40% 40% 40%;
            top: 25px;
            left: 35px;
        }

        .astronaut-helmet {
            position: absolute;
            width: 70px;
            height: 70px;
            background: white;
            border-radius: 50%;
            top: 10px;
            left: 40px;
            box-shadow: inset 0 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .astronaut-visor {
            position: absolute;
            width: 50px;
            height: 30px;
            background: #4a90e2;
            border-radius: 50%;
            top: 25px;
            left: 50px;
            opacity: 0.7;
        }

        .astronaut-backpack {
            position: absolute;
            width: 40px;
            height: 50px;
            background: #e0e0e0;
            border-radius: 10px;
            top: 50px;
            left: 20px;
        }

        /* Search bar animation */
        .search-animation {
            margin: 2rem auto;
            width: 300px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            display: flex;
            align-items: center;
            padding: 0 15px;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-icon {
            color: white;
            font-size: 1.2rem;
            margin-right: 10px;
        }

        .search-text {
            color: white;
            font-size: 1rem;
            animation: typing 3s steps(40, end) infinite, blink 0.75s step-end infinite;
            white-space: nowrap;
            overflow: hidden;
            border-right: 2px solid white;
            width: 0;
        }

        /* Animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes floatAround {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            25% {
                transform: translate(100px, 100px) rotate(90deg);
            }

            50% {
                transform: translate(200px, 0) rotate(180deg);
            }

            75% {
                transform: translate(100px, -100px) rotate(270deg);
            }

            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }

        @keyframes floatAstronaut {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            25% {
                transform: translateY(-20px) rotate(5deg);
            }

            50% {
                transform: translateY(-10px) rotate(0deg);
            }

            75% {
                transform: translateY(-20px) rotate(-5deg);
            }
        }

        @keyframes typing {
            0% {
                width: 0;
            }

            50% {
                width: 100%;
            }

            100% {
                width: 0;
            }
        }

        @keyframes blink {

            0%,
            50% {
                border-color: transparent;
            }

            51%,
            100% {
                border-color: white;
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .error-code {
                font-size: 8rem;
            }

            .error-title {
                font-size: 2rem;
            }

            .error-description {
                font-size: 1rem;
            }

            .astronaut {
                display: none;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 250px;
                justify-content: center;
            }
        }

        /* Particle effect */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: particleFloat 15s infinite linear;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Floating shapes background -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Particle effect -->
    <div class="particles" id="particles"></div>

    <!-- Astronaut animation -->
    <div class="astronaut">
        <div class="astronaut-body"></div>
        <div class="astronaut-helmet"></div>
        <div class="astronaut-visor"></div>
        <div class="astronaut-backpack"></div>
    </div>

    <!-- Main content -->
    <div class="container">
        <div class="error-code">404</div>
        <h1 class="error-title">Oops! Page Not Found</h1>
        <p class="error-description">
            The page you're looking for seems to have drifted off into the digital cosmos.
            It might have been moved, deleted, or perhaps it never existed in the first place.
        </p>

        <!-- Search animation -->
        <div class="search-animation">
            <i class="fas fa-search search-icon"></i>
            <div class="search-text">Searching for the missing page...</div>
        </div>

        <div class="action-buttons">
            <a href="./dashboard.php" class="btn btn-primary">
                <i class="fas fa-home"></i> Back to Dashboard
            </a>
            <!-- <a href="" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Go Back
            </a> -->
            <a href="mailto:gamebazaar.fun@gmail.com?subject=404%20page&body=I%20found%20a%20404%20error%20on%20your%20website." class="btn btn-secondary">
                <i class="fas fa-envelope"></i> Contact Support
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create particle effect
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Random properties
                const size = Math.random() * 5 + 2;
                const left = Math.random() * 100;
                const animationDuration = Math.random() * 10 + 10;
                const animationDelay = Math.random() * 5;

                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${left}%`;
                particle.style.animationDuration = `${animationDuration}s`;
                particle.style.animationDelay = `${animationDelay}s`;

                particlesContainer.appendChild(particle);
            }

            // Add interactive floating effect to the error code
            const errorCode = document.querySelector('.error-code');
            document.addEventListener('mousemove', (e) => {
                const xAxis = (window.innerWidth / 2 - e.pageX) / 25;
                const yAxis = (window.innerHeight / 2 - e.pageY) / 25;
                errorCode.style.transform = `translateY(-20px) rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
            });

            // Button hover effects
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px) scale(1.05)';
                });

                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Add a fun click effect to the 404 number
            errorCode.addEventListener('click', function() {
                this.style.animation = 'none';
                setTimeout(() => {
                    this.style.animation = 'float 3s ease-in-out infinite';
                }, 10);

                // Create a burst effect
                for (let i = 0; i < 10; i++) {
                    const burstParticle = document.createElement('div');
                    burstParticle.classList.add('particle');
                    burstParticle.style.position = 'absolute';
                    burstParticle.style.top = '50%';
                    burstParticle.style.left = '50%';
                    burstParticle.style.width = '10px';
                    burstParticle.style.height = '10px';
                    burstParticle.style.background = 'white';
                    burstParticle.style.borderRadius = '50%';
                    burstParticle.style.animation = `burst 1s forwards`;

                    // Random direction
                    const angle = Math.random() * Math.PI * 2;
                    const distance = 100 + Math.random() * 100;

                    document.body.appendChild(burstParticle);

                    // Animate the burst
                    setTimeout(() => {
                        burstParticle.style.transform = `translate(${Math.cos(angle) * distance}px, ${Math.sin(angle) * distance}px)`;
                        burstParticle.style.opacity = '0';
                    }, 10);

                    // Remove after animation
                    setTimeout(() => {
                        document.body.removeChild(burstParticle);
                    }, 1000);
                }
            });

            // Add CSS for burst animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes burst {
                    0% {
                        transform: translate(0, 0);
                        opacity: 1;
                    }
                    100% {
                        transform: translate(var(--tx), var(--ty));
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>

</html>