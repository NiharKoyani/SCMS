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
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/auth.css">
</head>
<style>
    /* Bottle Liquid Animation */
    .liquid {
        height: 30%;
        background: linear-gradient(to top, rgba(255, 107, 107, 0.7), rgba(255, 167, 107, 0.7));
    }

    /* Password Strength & Terms */
    .password-strength {
        margin-top: 0.3rem;
        height: 3px;
        width: 100%;
        background-color: #e0e0e0;
        border-radius: 3px;
        overflow: hidden;
    }

    .strength-bar {
        height: 100%;
        width: 0%;
        background-color: var(--danger);
        transition: width 0.3s ease, background-color 0.3s ease;
    }

    .password-match {
        font-size: 0.7rem;
        margin-top: 0.2rem;
        height: 0.8rem;
        color: var(--danger);
    }

    .terms {
        display: flex;
        align-items: center;
        margin: 0.5rem 0;
    }

    .terms input {
        margin-right: 0.5rem;
        width: 1rem;
        height: 1rem;
        accent-color: var(--primary);
    }

    .terms label {
        font-size: 0.8rem;
        color: #666;
    }

    .terms a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }

    .terms a:hover {
        text-decoration: underline;
    }



    /* Footer Links */
    .form-footer {
        margin-top: 1rem;
        text-align: center;
        font-size: 0.8rem;
        color: #666;
    }

    .form-footer a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }

    .form-footer a:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 1024px) {

        .login-container,
        .password-container,
        .registration-container {
            flex-direction: column;
            min-height: auto;
        }

        .brand-side,
        .form-side {
            width: 100%;
            padding: 2rem 1.5rem;
        }

        .brand-side {
            height: auto;
            padding-bottom: 1rem;
        }

        .bottle-animation {
            height: 180px;
            margin: 1rem auto;
        }

        .bottle-body {
            height: 140px;
        }

        .brand-message {
            margin-top: 1rem;
        }
    }

    @media (max-width: 768px) {
        .bottle {
            width: 80px;
        }

        .bottle-neck {
            width: 25px;
            height: 30px;
        }

        .bottle-body {
            width: 70px;
            height: 120px;
        }

        .bottle-bottom {
            width: 70px;
        }

        .brand-message {
            font-size: 1rem;
        }

        .floating-icons i {
            font-size: 1.2rem;
        }

        .form-title {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 480px) {

        .brand-side,
        .form-side {
            padding: 1.5rem 1rem;
        }

        .bottle-animation {
            height: 150px;
        }

        .bottle-body {
            height: 100px;
        }

        .bottle-neck {
            width: 20px;
            height: 25px;
        }

        .bottle {
            width: 70px;
        }

        .bottle-bottom {
            width: 70px;
        }

        .input-with-icon input {
            padding: 0.7rem 0.8rem 0.7rem 2.5rem;
            font-size: 0.85rem;
        }

        .submit-btn {
            padding: 0.8rem;
            font-size: 0.9rem;
        }
    }

    /* Confetti */
    .confetti {
        position: fixed;
        width: 10px;
        height: 10px;
        background-color: var(--primary);
        top: 100vh;
        z-index: 1000;
        pointer-events: none;
    }
</style>


<body>
    <div class="registration-container">
        <!-- Left Side - Visual Branding -->
        <div class="brand-side">
            <div class="brand-content">
                <img src="../Asserts/Prime-Logo.png" alt="Prime-Logo">

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
            <form id="registrationForm" action="../shopkeeper/server/Process.php" method="POST" class="compact-form">
                <h2 class="form-title">Vendor Registration</h2>
                <p class="form-subtitle">Fill your details to get started</p>

                <div class="form-grid">
                    <!-- Row 1 -->
                    <div class="form-group shop-name">
                        <div class="input-with-icon">
                            <i class="fas fa-store"></i>
                            <input type="text" id="shopName" name="shopName" required placeholder="Shop Name">
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="form-group owner-name">
                        <div class="input-with-icon">
                            <i class="fas fa-user-tie"></i>
                            <input type="text" id="ownerName" name="ownerName" required placeholder="Owner Name">
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="form-group mobile">
                        <div class="input-with-icon">
                            <i class="fas fa-mobile-alt"></i>
                            <input type="tel" id="mobile" pattern="^\[6-9]\d{9}$"
                                title="Enter a valid Indian phone number with country code, e.g. 9876543210" name="mobile" required placeholder="Mobile Number">
                        </div>
                        <span style="color: #ff0000ca; margin-bottom: 0.5rem; font-size: 0.9rem;">
                            <?php
                            if (isset($_SESSION['registration_error_phoneNumber'])) {
                                echo $_SESSION['registration_error_phoneNumber'];
                                unset($_SESSION['registration_error_phoneNumber']);
                            }
                            ?>
                        </span>
                    </div>

                    <div class="form-group email">
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" required placeholder="Email Address">
                        </div>
                        <span style="color: #ff0000ca; margin-bottom: 0.5rem; font-size: 0.9rem;">
                            <?php
                            if (isset($_SESSION['registration_error'])) {
                                echo $_SESSION['registration_error'];
                                unset($_SESSION['registration_error']);
                            }
                            ?>
                        </span>
                    </div>

                    <!-- Row 4 -->
                    <div class="form-group password">
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" required placeholder="Password">
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
                            <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="Confirm Password">
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
                            <input type="text" id="shopAddress" name="shopAddress" required placeholder="Shop Address">
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
                Already have an account? <a href="./login.php">Sign In</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate the liquid level based on form completion
            const formInputs = document.querySelectorAll('#registrationForm input');
            const formLiquid = document.getElementById('formLiquid');

            formInputs.forEach((input) => {
                input.addEventListener('input', updateLiquidLevel);
                input.addEventListener('focus', function() {
                    this.parentNode.style.boxShadow = '0 0 0 3px rgba(255, 107, 107, 0.3)';
                });
                input.addEventListener('blur', function() {
                    this.parentNode.style.boxShadow = 'none';
                });
            });

            function updateLiquidLevel() {
                let filledFields = 0;
                formInputs.forEach((input) => {
                    if (input.value.trim() !== '' && input.type !== 'checkbox') {
                        filledFields++;
                    }
                });

                const percentageFilled = (filledFields / (formInputs.length - 1)) * 100;
                const newHeight = Math.min(100, Math.max(30, 30 + percentageFilled * 0.7));

                formLiquid.style.height = `${newHeight}%`;

                // Change liquid color based on completion
                if (percentageFilled < 30) {
                    formLiquid.style.background = 'linear-gradient(to top, rgba(255, 107, 107, 0.7), rgba(255, 167, 107, 0.7))';
                } else if (percentageFilled < 70) {
                    formLiquid.style.background = 'linear-gradient(to top, rgba(107, 186, 255, 0.7), rgba(107, 255, 186, 0.7))';
                } else {
                    formLiquid.style.background = 'linear-gradient(to top, rgba(107, 255, 107, 0.7), rgba(186, 255, 107, 0.7))';
                }
            }

            // Password strength indicator
            const passwordInput = document.getElementById('password');
            const strengthBar = document.querySelector('.strength-bar');

            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const strength = calculatePasswordStrength(password);

                strengthBar.style.width = strength.percentage + '%';
                strengthBar.style.backgroundColor = strength.color;
            });

            // Password match checker
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const passwordMatch = document.getElementById('passwordMatch');

            confirmPasswordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                const confirmPassword = this.value;

                if (confirmPassword === '') {
                    passwordMatch.textContent = '';
                } else if (password === confirmPassword) {
                    passwordMatch.textContent = '✓ Passwords match';
                    passwordMatch.style.color = 'var(--success)';
                } else {
                    passwordMatch.textContent = '✗ Passwords do not match';
                    passwordMatch.style.color = 'var(--danger)';
                }
            });

            // Form submission
            const registrationForm = document.getElementById('registrationForm');

            registrationForm.addEventListener('submit', function(e) {
                // e.preventDefault();

                // Validate terms checkbox
                const termsCheckbox = document.getElementById('terms');
                if (!termsCheckbox.checked) {
                    alert('Please agree to the terms and conditions');
                    return;
                }

                // Validate password match
                if (passwordInput.value !== confirmPasswordInput.value) {
                    alert('Passwords do not match');
                    return;
                }

                // If all validations pass, submit the form
                this.submit();
            });

            // Bubble animation in bottle
            setInterval(() => {
                const bubble = document.createElement('div');
                bubble.className = 'bubble';
                bubble.style.left = Math.random() * 80 + 10 + '%';
                bubble.style.animationDuration = 3 + Math.random() * 3 + 's';
                document.querySelector('.bubbles').appendChild(bubble);

                // Remove bubble after animation completes
                setTimeout(() => {
                    bubble.remove();
                }, 6000);
            }, 800);
        });

        function calculatePasswordStrength(password) {
            let strength = 0;

            // Length check
            if (password.length >= 8) strength += 1;
            if (password.length >= 12) strength += 1;

            // Character variety
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;

            let result = {
                percentage: 0,
                color: '',
            };

            if (strength <= 2) {
                result.percentage = 33;
                result.color = 'var(--danger)';
            } else if (strength <= 4) {
                result.percentage = 66;
                result.color = 'var(--warning)';
            } else {
                result.percentage = 100;
                result.color = 'var(--success)';
            }

            return result;
        }

        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>