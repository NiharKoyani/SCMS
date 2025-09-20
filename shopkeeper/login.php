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

    body {
        min-height: 100vh;
        background-color: var(--light);
        overflow-x: hidden;
    }

    .login-container {
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
        height: 60%;
        background: linear-gradient(to top, rgba(107, 255, 107, 0.7), rgba(186, 255, 107, 0.7));
        transition: height 0.5s ease;
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
        max-width: 400px;
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
        margin-bottom: 2rem;
        font-size: 0.9rem;
    }

    .form-group {
        position: relative;
        margin-bottom: 1.5rem;
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

    .forgot-password {
        font-size: 0.8rem;
    }

    .forgot-password a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }

    .forgot-password a:hover {
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
        margin: 1rem 0;
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

    .register-link {
        text-align: center;
        font-size: 0.9rem;
        color: #666;
    }

    .register-link a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .login-container {
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

        .remember-forgot {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
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