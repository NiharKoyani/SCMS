<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bubble Bliss - Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Styling Area/forgotPass.css">
</head>
<body>
    <div class="password-container">
        <!-- Left Side - Visual Branding -->
        <div class="brand-side">
            <div class="brand-content">
                <div class="logo-circle animate__animated animate__bounceIn">
                    <span class="logo-icon"><i class="fas fa-glass-cheers"></i></span>
                    <h1>Bubble Bliss</h1>
                </div>
                
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
                    <p>Reset your password and get back to business</p>
                    <div class="floating-icons">
                        <i class="fas fa-cocktail"></i>
                        <i class="fas fa-wine-bottle"></i>
                        <i class="fas fa-beer"></i>
                        <i class="fas fa-coffee"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Password Reset Form -->
        <div class="form-side">
            <div class="password-form">
                <h2 class="form-title">Reset Password</h2>
                <p class="form-subtitle">Enter your email to receive a reset link</p>
                
                <div id="successMessage" class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <h3>Reset Link Sent!</h3>
                    <p>We've sent a password reset link to your email address. Please check your inbox.</p>
                </div>
                
                <form id="resetForm" action="reset.php" method="POST">
                    <div class="form-group">
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" required placeholder="Your email address">
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        <span>Send Reset Link</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
                
                <div class="back-to-login">
                    Remembered your password? <a href="login.html">Back to login</a>
                </div>
            </div>
        </div>
    </div>
    <script src="./Js File's/forgotPass.js"></script>
</body>
</html>