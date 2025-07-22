<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bubble Bliss - Vendor Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Styling Area/login.css">
</head>
<body>
    <div class="login-container">
        <!-- Left Side - Visual Branding -->
        <div class="brand-side">
            <div class="brand-content">
                <h1><img src="./Asserts/Prime-Logo_600x.avif" alt=""></h1>
                
                <div class="bottle-animation">
                    <div class="bottle">
                        <div class="bottle-neck"></div>
                        <div class="bottle-body">
                            <div class="liquid" id="formLiquid"></div>
                            <div class="bubbles">
                                <div class="bubble" style="left: 20%; animation-delay: 0.3s;"></div>
                                <div class="bubble" style="left: 50%; animation-delay: 0.7s;"></div>
                                <div class="bubble" style="left: 70%; animation-delay: 0.1s;"></div>
                            </div>
                        </div>
                        <div class="bottle-bottom"></div>
                    </div>
                </div>
                
                <div class="brand-message">
                    <p>Welcome back to our beverage network</p>
                    <div class="floating-icons">
                        <i class="fas fa-cocktail"></i>
                        <i class="fas fa-wine-bottle"></i>
                        <i class="fas fa-beer"></i>
                        <i class="fas fa-coffee"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Login Form -->
        <div class="form-side">
            <form id="loginForm" action="./Process.php" method="POST" class="compact-form">
                <h2 class="form-title">Vendor Login</h2>
                <p class="form-subtitle">Sign in to your account</p>
                
                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" required placeholder="Email Address">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" required placeholder="Password">
                        <span class="toggle-password" onclick="togglePassword('password')">
                            <i class="fas fa-eye" style="left: -15px;"></i>
                        </span>
                    </div>
                </div>

                <span style="color: #ff0000ca; margin-bottom: 0.5rem; font-size: 0.9rem;">
                    <?php echo isset($_SESSION['login_error']) ?  $_SESSION['login_error'] : null;  unset($_SESSION['login_error'])?>
                </span>
                
                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="forgot-password">
                        <a href="./forgot.html">Forgot password?</a>
                    </div>
                </div>
                
                <button type="submit" name="login" class="submit-btn">
                    <span>Login</span>
                    <i class="fas fa-long-arrow-alt-right"></i>
                </button>
                
                <div class="register-link">
                    Don't have an account? <a href="./index.html">Register here</a>
                </div>
            </form>
        </div>
    </div>

    <script src="./Js File's/login.js"></script>
</body>
</html>