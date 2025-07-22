<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRIME - Vendor Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Styling Area/registration.css">
</head>

<body>
    <div class="registration-container">
        <!-- Left Side - Visual Branding -->
        <div class="brand-side">
            <div class="brand-content">
                <img src="../../Asserts/Prime-Logo.png" alt="">

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
                    <p>Join the fastest growing beverage network</p>
                    <div class="floating-icons">
                        <i class="fas fa-cocktail"></i>
                        <i class="fas fa-wine-bottle"></i>
                        <i class="fas fa-beer"></i>
                        <i class="fas fa-coffee"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Registration Form -->
        <div class="form-side">
            <form id="registrationForm" action="./Process.php" method="POST" class="compact-form">
                <h2 class="form-title">Vendor Registration</h2>
                <p class="form-subtitle">Fill your details to get started</p>

                <div class="form-grid">
                    <!-- Row 1 -->
                    <div class="form-group shop-name">
                        <div class="input-with-icon">
                            <i class="fas fa-store"></i>
                            <input onchange="handelOnChange()" type="text" id="shopName" name="shopName" required placeholder="Shop Name">
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="form-group owner-name">
                        <div class="input-with-icon">
                            <i class="fas fa-user-tie"></i>
                            <input  type="text" id="ownerName" name="ownerName" required placeholder="Owner Name">
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="form-group mobile">
                        <div class="input-with-icon">
                            <i class="fas fa-mobile-alt"></i>
                            <input  type="tel" id="mobile" name="mobile" required placeholder="Mobile Number">
                        </div>
                        <span style="color: #ff0000ca; margin-bottom: 0.5rem; font-size: 0.9rem;">
                            <?php echo isset($_SESSION['registration_error_phoneNumber']) ?  $_SESSION['registration_error_phoneNumber'] : null; unset($_SESSION['registration_error_phoneNumber'])?>
                        </span>
                    </div>

                    <div class="form-group email">
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input  type="email" id="email" name="email" required placeholder="Email Address">
                        </div>
                        <span style="color: #ff0000ca; margin-bottom: 0.5rem; font-size: 0.9rem;">
                            <?php echo isset($_SESSION['registration_error_email']) ?  $_SESSION['registration_error_email'] : null; unset($_SESSION['registration_error_email̃'])?>
                        </span>
                    </div>

                    <!-- Row 4 -->
                    <div class="form-group password">
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input  type="password" id="password" name="password" required placeholder="Password">
                            <span class="toggle-password" onclick="togglePassword('password')">
                                <i class="fas fa-eye" style="left: -15px;"></i>
                            </span>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar"></div>
                        </div>
                    </div>

                    <div class="form-group confirm-password">
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input  type="password" id="confirmPassword" name="confirmPassword" required placeholder="Confirm Password">
                            <span class="toggle-password" onclick="togglePassword('confirmPassword')">
                                <i class="fas fa-eye" style="left: -15px;"></i>
                            </span>
                        </div>
                        <div id="passwordMatch" class="password-match"></div>
                    </div>

                    <!-- Row 5 -->
                    <div class="form-group address">
                        <div class="input-with-icon">
                            <i class="fas fa-map-marker-alt"></i>
                            <input  type="text" id="shopAddress" name="shopAddress" required placeholder="Shop Address">
                        </div>
                    </div>

                    <!-- Row 6 -->
                    <div class="form-group terms">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">I agree to <a href="#">Terms & Conditions</a></label>
                    </div>

                    <!-- Row 7 -->
                    <button type="submit" name="submit" class="submit-btn">
                        <span>Register Now</span>
                        <i class="fas fa-long-arrow-alt-right"></i>
                    </button>
                </div>
            </form>

            <div class="form-footer">
                Already have an account? <a href="../src/login.php">Sign In</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="./Js File's/registration.js"></script>
</body>

</html>