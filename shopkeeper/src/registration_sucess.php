<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Bubble Bliss!</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Styling Area/registration_sucess.css">
</head>
<body>
    <div class="floating-bubbles">
        <div class="bubble" style="width: 40px; height: 40px; left: 10%; animation-duration: 8s;"></div>
        <div class="bubble" style="width: 20px; height: 20px; left: 20%; animation-duration: 5s; animation-delay: 1s;"></div>
        <div class="bubble" style="width: 50px; height: 50px; left: 35%; animation-duration: 7s; animation-delay: 2s;"></div>
        <div class="bubble" style="width: 80px; height: 80px; left: 50%; animation-duration: 11s; animation-delay: 0s;"></div>
        <div class="bubble" style="width: 35px; height: 35px; left: 80%; animation-duration: 6s; animation-delay: 1s;"></div>
    </div>
    
    <div class="success-container animate__animated animate__fadeIn">
        <div class="success-header">
            <div class="logo-circle">
                <span class="logo-icon"><i class="fas fa-glass-cheers"></i></span>
                <h1>Bubble Bliss</h1>
            </div>
        </div>
        
        <div class="success-content">
            <div class="success-icon animate__animated animate__bounce">
                <i class="fas fa-check-circle"></i>
            </div>
            
            <h2>Registration Successful!</h2>
            <p>Welcome to the Bubble Bliss family! Your account has been successfully created. We're thrilled to have you on board as part of our premium beverage network.</p>
            
            <div class="next-steps">
                <h3><i class="fas fa-clipboard-list"></i> What's Next?</h3>
                <ol>
                    <li>Check your email for a verification link (may be in your spam folder)</li>
                    <li>Complete your shop profile to get listed in our directory</li>
                    <li>Explore our vendor dashboard to manage your products</li>
                    <li>Join our community forum to connect with other vendors</li>
                </ol>
            </div>
            
            <div class="action-buttons">
                <a href="dashboard.html" class="btn btn-primary">
                    <i class="fas fa-tachometer-alt"></i> Go to Dashboard
                </a>
                <a href="profile_setup.html" class="btn btn-outline">
                    <i class="fas fa-user-edit"></i> Complete Profile
                </a>
            </div>
        </div>
    </div>

    <script src="./Js File's/registration_sucess.js"></script>
</body>
</html>