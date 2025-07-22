<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join PRIME | Hydration Revolution</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&family=Orbitron:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #00F0FF;
            --primary-dark: #0066FF;
            --secondary: #FF00AA;
            --accent: #FFD300;
            --dark: #0A0F1A;
            --light: #F0F5FF;
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
            background-color: var(--dark);
            color: var(--light);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Animated Background */
        .liquid-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            overflow: hidden;
        }

        .liquid-shape {
            position: absolute;
            width: 200%;
            height: 200%;
            background: linear-gradient(135deg, 
                rgba(0, 240, 255, 0.03), 
                rgba(0, 102, 255, 0.05));
            border-radius: 45%;
            animation: liquid-move 25s infinite linear;
            filter: blur(40px);
        }

        @keyframes liquid-move {
            0% { transform: rotate(0deg) translate(-50%, -50%); }
            100% { transform: rotate(360deg) translate(-50%, -50%); }
        }

        /* Main Container */
        .registration-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Character Animation Side */
        .character-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .character-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            height: 500px;
        }

        .character {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 300px;
            height: 400px;
            background: url('https://i.imgur.com/JqYeZ7L.png') no-repeat center bottom;
            background-size: contain;
            z-index: 2;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(-20px); }
        }

        .prime-can {
            position: absolute;
            bottom: 120px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 120px;
            background: linear-gradient(to bottom, #00F0FF, #0066FF);
            border-radius: 10px;
            z-index: 3;
            animation: drink 5s infinite;
            transform-origin: bottom center;
        }

        @keyframes drink {
            0%, 100% { transform: translateX(-50%) rotate(0deg); }
            20% { transform: translateX(-50%) rotate(60deg); }
            40% { transform: translateX(-50%) rotate(0deg); }
        }

        .energy-effect {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(0, 240, 255, 0.2), transparent 70%);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            filter: blur(20px);
            animation: pulse 3s infinite;
            opacity: 0;
        }

        @keyframes pulse {
            0% { transform: translate(-50%, -50%) scale(0.8); opacity: 0; }
            50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.5; }
            100% { transform: translate(-50%, -50%) scale(0.8); opacity: 0; }
        }

        .bubbles {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .bubble {
            position: absolute;
            background: rgba(0, 240, 255, 0.5);
            border-radius: 50%;
            filter: blur(2px);
            animation: bubble-rise 6s infinite ease-in;
        }

        @keyframes bubble-rise {
            0% { transform: translateY(0) scale(0); opacity: 0; }
            20% { opacity: 0.7; }
            100% { transform: translateY(-300px) scale(1); opacity: 0; }
        }

        /* Form Side */
        .form-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background-color: rgba(10, 15, 26, 0.8);
            backdrop-filter: blur(10px);
        }

        .registration-form {
            width: 100%;
            max-width: 400px;
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-header h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(to right, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-header p {
            color: rgba(240, 245, 255, 0.7);
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--primary);
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            background-color: rgba(240, 245, 255, 0.1);
            border: 1px solid rgba(0, 240, 255, 0.3);
            border-radius: 6px;
            color: var(--light);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 240, 255, 0.2);
        }

        .password-strength {
            height: 4px;
            background-color: rgba(240, 245, 255, 0.1);
            margin-top: 0.5rem;
            border-radius: 2px;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 0;
            background: var(--gradient);
            transition: width 0.3s ease;
        }

        .terms-group {
            display: flex;
            align-items: center;
            margin: 2rem 0;
        }

        .terms-group input {
            margin-right: 0.8rem;
        }

        .terms-group label {
            font-size: 0.9rem;
            color: rgba(240, 245, 255, 0.7);
        }

        .terms-group a {
            color: var(--primary);
            text-decoration: none;
        }

        .btn-register {
            width: 100%;
            padding: 1rem;
            background: var(--gradient);
            color: var(--white);
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 240, 255, 0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: rgba(240, 245, 255, 0.7);
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .registration-container {
                flex-direction: column;
            }

            .character-side {
                padding: 4rem 2rem;
                height: 400px;
            }

            .form-side {
                padding: 4rem 2rem;
            }
        }

        @media (max-width: 768px) {
            .character {
                width: 250px;
                height: 350px;
            }

            .prime-can {
                width: 60px;
                height: 90px;
                bottom: 100px;
            }
        }

        @media (max-width: 480px) {
            .character-side {
                height: 300px;
                padding: 2rem 1rem;
            }

            .character {
                width: 200px;
                height: 280px;
            }

            .prime-can {
                width: 50px;
                height: 75px;
                bottom: 80px;
            }

            .form-side {
                padding: 2rem 1rem;
            }

            .form-header h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="liquid-bg">
        <div class="liquid-shape"></div>
    </div>

    <div class="registration-container">
        <!-- Character Animation Side -->
        <div class="character-side">
            <div class="character-container">
                <div class="character"></div>
                <div class="prime-can"></div>
                <div class="energy-effect"></div>
                <div class="bubbles" id="bubbles"></div>
            </div>
        </div>

        <!-- Registration Form Side -->
        <div class="form-side">
            <form class="registration-form">
                <div class="form-header">
                    <h2>JOIN THE PRIME MOVEMENT</h2>
                    <p>Create your account and elevate your hydration</p>
                </div>

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" class="form-control" placeholder="Your full name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="your@email.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Create a password" required>
                    <div class="password-strength">
                        <div class="strength-bar" id="strengthBar"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" class="form-control" placeholder="Confirm your password" required>
                </div>

                <div class="terms-group">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                </div>

                <button type="submit" class="btn-register">
                    <i class="fas fa-bolt"></i> GET PRIMED
                </button>

                <div class="login-link">
                    Already have an account? <a href="#">Log in</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create bubbles
            const bubblesContainer = document.getElementById('bubbles');
            for (let i = 0; i < 15; i++) {
                createBubble();
            }

            function createBubble() {
                const bubble = document.createElement('div');
                bubble.className = 'bubble';
                bubble.style.width = Math.random() * 15 + 5 + 'px';
                bubble.style.height = bubble.style.width;
                bubble.style.left = Math.random() * 100 + '%';
                bubble.style.bottom = '0';
                bubble.style.animationDuration = 3 + Math.random() * 5 + 's';
                bubble.style.animationDelay = Math.random() * 3 + 's';
                bubblesContainer.appendChild(bubble);

                // Remove bubble after animation completes
                setTimeout(() => {
                    bubble.remove();
                    createBubble(); // Create new bubble
                }, 6000);
            }

            // Password strength indicator
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('strengthBar');

            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const strength = calculatePasswordStrength(password);
                strengthBar.style.width = strength + '%';
                
                // Change color based on strength
                if (strength < 30) {
                    strengthBar.style.background = '#FF4757'; // Red
                } else if (strength < 70) {
                    strengthBar.style.background = '#FFA502'; // Orange
                } else {
                    strengthBar.style.background = 'var(--gradient)'; // Prime gradient
                }
            });

            function calculatePasswordStrength(password) {
                let strength = 0;
                
                // Length check
                if (password.length >= 8) strength += 30;
                if (password.length >= 12) strength += 20;
                
                // Character variety
                if (/[A-Z]/.test(password)) strength += 15;
                if (/[0-9]/.test(password)) strength += 15;
                if (/[^A-Za-z0-9]/.test(password)) strength += 20;
                
                return Math.min(100, strength);
            }

            // Form submission
            const registrationForm = document.querySelector('.registration-form');
            
            registrationForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validate password match
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirm-password').value;
                
                if (password !== confirmPassword) {
                    alert('Passwords do not match!');
                    return;
                }
                
                // Validate terms checkbox
                if (!document.getElementById('terms').checked) {
                    alert('Please agree to the Terms of Service and Privacy Policy');
                    return;
                }
                
                // If all validations pass, show success
                alert('Registration successful! Welcome to PRIME!');
                // In a real app, you would submit the form here
            });
        });
    </script>
</body>
</html>