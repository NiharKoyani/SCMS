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
    <link rel="stylesheet" href="./Styling Area/registration.css">
</head>
<style>
    :root {
        --primary: #09122c;
        --primary-light: #ff8e8e;
        --primary-dark: #596792;
        --secondary: #11204be0;
        --accent: #ffa502;
        --dark: #2f3542;
        --light: #f1f2f6;
        --white: #ffffff;
        --success: #2ed573;
        --warning: #ffa502;
        --danger: #ff4757;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif;
    }

    .brand-content img {
        height: 6.1rem;
        margin-bottom: 2rem;
    }

    body {
        min-height: 100vh;
        background-color: var(--light);
        overflow-x: hidden;
    }

    .registration-container {
        display: flex;
        flex-direction: row;
        min-height: 100vh;
    }

    /* Brand Side Styles */
    .brand-side {
        width: 40%;
        background: black;
        color: var(--white);
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        overflow: hidden;
        padding: 2rem;
    }

    .brand-content {
        width: 100%;
        max-width: 400px;
        text-align: center;
        z-index: 2;
    }

    .brand-side img {
        width: 12rem;
        margin-bottom: 10px;
    }

    /* Bottle Animation */
    .bottle-animation {
        margin: 2rem auto;
        height: 250px;
        display: flex;
        justify-content: center;
        align-items: flex-end;
    }

    .bottle {
        width: 100px;
        position: relative;
        animation: gentle-shake 5s ease-in-out infinite;
    }

    .bottle-neck {
        width: 30px;
        height: 40px;
        background: rgba(255, 255, 255, 0.8);
        margin: 0 auto;
        border-radius: 5px 5px 0 0;
    }

    .bottle-body {
        width: 80px;
        height: 180px;
        background: rgba(255, 255, 255, 0.3);
        margin: 0 auto;
        border-radius: 5px 5px 0px 0px;
        position: relative;
        overflow: hidden;
    }

    .liquid {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 30%;
        background: linear-gradient(to top, rgba(255, 107, 107, 0.7), rgba(255, 167, 107, 0.7));
        transition: height 1s ease;
    }

    .bubbles {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .bubble {
        position: absolute;
        width: 8px;
        height: 8px;
        background-color: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        bottom: 0;
        animation: bubble-rise 4s infinite ease-in;
    }

    @keyframes bubble-rise {
        0% {
            transform: translateY(0);
            opacity: 0;
        }

        20% {
            opacity: 1;
        }

        100% {
            transform: translateY(-180px);
            opacity: 0;
        }
    }

    .bottle-bottom {
        width: 80px;
        height: 10px;
        background: rgba(255, 255, 255, 0.8);
        margin: 0 auto;
        border-radius: 0 0 5px 5px;
    }

    /* Gentle shake animation */
    @keyframes gentle-shake {

        0%,
        100% {
            transform: rotate(0deg);
        }

        20% {
            transform: rotate(-3deg);
            /* Slight left tilt */
        }

        40% {
            transform: rotate(3deg);
            /* Slight right tilt */
        }

        60% {
            transform: rotate(-2deg);
            /* Subtle left tilt */
        }

        80% {
            transform: rotate(2deg);
            /* Subtle right tilt */
        }
    }

    .brand-message {
        margin-top: 2rem;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .floating-icons {
        display: flex;
        justify-content: center;
        margin-top: 1rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    /*
.floating-icons i {
  font-size: 1.5rem;
  animation: float 3s ease-in-out infinite;
}

@keyframes float {
  0%,
  100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
} */

    .floating-icons {
        display: flex;
        gap: 15px;
        /* Spacing between icons */
    }

    .floating-icons i {
        font-size: 1.5rem;
        animation: float-wave 15s ease-in-out infinite;
    }

    /* Different delays for each icon */
    .floating-icons i:nth-child(1) {
        animation-delay: 0s;
    }

    .floating-icons i:nth-child(2) {
        animation-delay: 0.5s;
    }

    .floating-icons i:nth-child(3) {
        animation-delay: 1s;
    }

    .floating-icons i:nth-child(4) {
        animation-delay: 1.5s;
    }

    /* Wave-like floating effect */
    @keyframes float-wave {

        0%,
        100% {
            transform: translateY(0);
        }

        25% {
            transform: translateY(-15px);
        }

        50% {
            transform: translateY(0);
        }

        75% {
            transform: translateY(-10px);
        }
    }

    /* Form Side Styles */
    .form-side {
        width: 60%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 2rem;
        overflow-y: auto;
    }

    .compact-form {
        width: 100%;
        max-width: 500px;
    }

    .form-title {
        font-size: 2rem;
        color: var(--dark);
        margin-bottom: 0.5rem;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .form-subtitle {
        color: #666;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.8rem;
    }

    .form-group {
        position: relative;
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary);
    }

    .input-with-icon input {
        width: 100%;
        padding: 0.8rem 1rem 0.8rem 2.8rem;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .input-with-icon input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.2);
        outline: none;
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #999;
        transition: color 0.3s ease;
    }

    .toggle-password:hover {
        color: var(--primary);
    }

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

    .submit-btn {
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        color: white;
        border: none;
        padding: 0.9rem;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 0.5rem;
        width: 100%;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
    }

    .submit-btn i {
        margin-left: 0.5rem;
        transition: transform 0.3s ease;
    }

    .submit-btn:hover i {
        transform: translateX(3px);
    }

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

    /* Responsive Design */
    @media (max-width: 1024px) {
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

        .logo-circle {
            width: 120px;
            height: 120px;
            margin-bottom: 1rem;
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

        .logo-icon {
            font-size: 2.5rem;
        }

        .logo-circle h1 {
            font-size: 1.5rem;
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

        .input-with-icon input {
            padding: 0.7rem 0.8rem 0.7rem 2.5rem;
            font-size: 0.85rem;
        }

        .submit-btn {
            padding: 0.8rem;
            font-size: 0.9rem;
        }
    }

    /* Confetti for success animation */
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
            <form id="registrationForm" action="./src/Process.php" method="POST" class="compact-form">
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
                            <input type="text" id="ownerName" name="ownerName" required placeholder="Owner Name">
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="form-group mobile">
                        <div class="input-with-icon">
                            <i class="fas fa-mobile-alt"></i>
                            <input type="tel" id="mobile" name="mobile" required placeholder="Mobile Number">
                        </div>
                        <span style="color: #ff0000ca; margin-bottom: 0.5rem; font-size: 0.9rem;">
                            <?php echo isset($_SESSION['registration_error_phoneNumber']) ?  $_SESSION['registration_error_phoneNumber'] : null;
                            unset($_SESSION['registration_error_phoneNumber']) ?>
                        </span>
                    </div>

                    <div class="form-group email">
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" required placeholder="Email Address">
                        </div>
                        <span style="color: #ff0000ca; margin-bottom: 0.5rem; font-size: 0.9rem;">
                            <?php echo isset($_SESSION['registration_error_email']) ?  $_SESSION['registration_error_email'] : null;
                            unset($_SESSION['registration_error_email̃']) ?>
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