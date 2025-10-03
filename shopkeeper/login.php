<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRIME - Vendor Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./Styling Area/login.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="auth.css">

</head>
<style>
    /* Bottle Liquid Animation */
    .liquid {
        height: 50%;
        background: linear-gradient(to top, rgba(107, 255, 107, 0.7), rgba(186, 255, 107, 0.7));
    }

    /* Form Side Styles */

    .form-group {
        margin-bottom: 1.5rem;
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 1.5rem 0;
    }

    .remember-me {
        display: flex;
        align-items: center;
    }

    .remember-me input {
        margin-right: 0.5rem;
        width: 1rem;
        height: 1rem;
        accent-color: var(--primary);
    }

    .remember-me label {
        font-size: 0.8rem;
        color: #666;
    }

    .register-link {
        margin-top: 1rem;
        text-align: center;
        font-size: 0.8rem;
        color: #666;
    }

    .forgot-password a,
    .register-link a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }

    .forgot-password a:hover,
    .register-link a:hover {
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {

        .login-container,
        .password-container {
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

        .remember-forgot {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .brand-message {
            font-size: 0.95rem;
        }

        .floating-icons i {
            font-size: 1rem;
        }
    }
</style>


<body>
    <div></div>
    <div class="login-container">
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
            <form id="loginForm" action="./src/Process.php" method="POST" class="compact-form">
                <h2 class="form-title">Vendor Login</h2>
                <p class="form-subtitle">Sign in to your account</p>

                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" value="nihar@google.com" required placeholder="Email Address">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" value="#NIHAR1221#" name="password" required placeholder="Password">
                        <span class="toggle-password" onclick="togglePassword('password')">
                            <i class="fas fa-eye" style="left: -15px;"></i>
                        </span>
                    </div>
                </div>

                <span style="color: #ff0000ca; margin-bottom: 0.5rem; font-size: 0.9rem;">
                    <?php echo isset($_SESSION['login_error']) ?  $_SESSION['login_error'] : null;
                    unset($_SESSION['login_error']) ?>
                </span>

                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="forgot-password">
                        <a href="./forgotPass.php">Forgot password?</a>
                    </div>
                </div>

                <button type="submit" name="login" class="submit-btn">
                    <span>Login</span>
                    <i class="fas fa-long-arrow-alt-right"></i>
                </button>

                <div class="register-link">
                    Don't have an account? <a href="./registration.php">Register here</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate the liquid level based on form completion
            const formInputs = document.querySelectorAll('#loginForm input');
            const formLiquid = document.getElementById('formLiquid');

            formInputs.forEach((input) => {
                input.addEventListener('input', function() {
                    let filledFields = 0;
                    formInputs.forEach((input) => {
                        if (input.value.trim() !== '' && input.type !== 'checkbox') {
                            filledFields++;
                        }
                    });

                    const newHeight = filledFields === 2 ? 100 : 60;
                    formLiquid.style.height = `${newHeight}%`;
                });

                input.addEventListener('focus', function() {
                    this.parentNode.style.boxShadow = '0 0 0 3px rgba(255, 107, 107, 0.3)';
                });

                input.addEventListener('blur', function() {
                    this.parentNode.style.boxShadow = 'none';
                });
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