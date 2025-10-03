<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to PRIME!</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Pacifico&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="auth.css">
</head>
<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2rem;
  }

  .success-container {
    max-width: 800px;
    width: 100%;
    background-color: var(--white);
    border-radius: 15px;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }

  .success-header {
    background: black;
    color: var(--white);
    padding: 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .success-header::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgb(255 255 255 / 21%) 0%, rgb(0 0 0 / 0%) 70%);
    animation: bubble-float 15s infinite linear;
  }

  @keyframes bubble-float {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  .success-header img {
    width: 12rem;
  }

  .success-content {
    padding: 3rem 2rem;
    text-align: center;
  }

  .success-icon {
    font-size: 5rem;
    color: var(--success);
    margin-bottom: 1.5rem;
    animation: bounce 2s infinite;
  }

  @keyframes bounce {

    0%,
    20%,
    50%,
    80%,
    100% {
      transform: translateY(0);
    }

    40% {
      transform: translateY(-20px);
    }

    60% {
      transform: translateY(-10px);
    }
  }

  h2 {
    font-size: 2rem;
    color: var(--dark);
    margin-bottom: 1rem;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  p {
    color: #666;
    margin-bottom: 2rem;
    font-size: 1rem;
    line-height: 1.6;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
  }

  .next-steps {
    background-color: rgba(241, 242, 246, 0.5);
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    text-align: left;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
  }

  .next-steps h3 {
    color: var(--dark);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .next-steps h3 i {
    color: var(--primary);
  }

  .next-steps ol {
    padding-left: 1.5rem;
    color: #666;
  }

  .next-steps li {
    margin-bottom: 0.5rem;
  }

  .action-buttons {
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
    margin-top: 2rem;
  }

  .btn {
    padding: 0.9rem 1.5rem;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-decoration: none;
  }

  .btn-primary {
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    color: white;
    border: none;
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
  }

  .btn-outline {
    background: transparent;
    color: var(--primary);
    border: 2px solid var(--primary);
  }

  .btn-outline:hover {
    background-color: rgba(255, 107, 107, 0.1);
    transform: translateY(-2px);
  }

  .floating-bubbles {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    overflow: hidden;
  }

  .bubble {
    position: absolute;
    bottom: -100px;
    background: rgba(0, 0, 0, 0.1);
    border-radius: 50%;
    animation: rise 15s infinite ease-in;
  }

  @keyframes rise {
    0% {
      bottom: -100px;
      transform: translateX(0);
    }

    50% {
      transform: translateX(100px);
    }

    100% {
      bottom: 1080px;
      transform: translateX(-200px);
    }
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    body {
      padding: 1rem;
    }

    .success-container {
      max-width: 100%;
    }

    .success-content {
      padding: 2rem 1.5rem;
    }

    .success-icon {
      font-size: 4rem;
    }

    h2 {
      font-size: 1.8rem;
    }

    .action-buttons {
      flex-direction: column;
      gap: 0.8rem;
    }

    .btn {
      width: 100%;
    }
  }

  @media (max-width: 480px) {
    .success-header {
      padding: 1.5rem;
    }

    .logo-circle {
      width: 80px;
      height: 80px;
    }

    .logo-icon {
      font-size: 2rem;
    }

    .logo-circle h1 {
      font-size: 1.2rem;
    }

    .success-content {
      padding: 1.5rem 1rem;
    }

    .next-steps {
      padding: 1rem;
    }
  }
</style>

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
      <img src="../Asserts/Prime-Logo.png" alt="">
    </div>

    <div class="success-content">
      <div class="success-icon animate__animated animate__bounce">
        <i class="fas fa-check-circle"></i>
      </div>

      <h2>Registration Successful!</h2>
      <p>Welcome to the Prime family! Your account has been successfully created. We're thrilled to have you on board as part of our premium beverage network.</p>

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
        <a href="./dashboard.php" class="btn btn-primary">
          <i class="fas fa-tachometer-alt"></i> Go to Dashboard
        </a>
        <a href="../" class="btn btn-outline">
          <i class="fas fa-user-edit"></i> Home Page
        </a>
      </div>
    </div>
  </div>

  <script>
    // Add more bubbles dynamically
    document.addEventListener('DOMContentLoaded', function() {
      const bubblesContainer = document.querySelector('.floating-bubbles');

      for (let i = 0; i < 5; i++) {
        const bubble = document.createElement('div');
        bubble.className = 'bubble';
        bubble.style.width = Math.random() * 30 + 20 + 'px';
        bubble.style.height = bubble.style.width;
        bubble.style.left = Math.random() * 100 + '%';
        bubble.style.animationDuration = 5 + Math.random() * 10 + 's';
        bubble.style.animationDelay = Math.random() * 5 + 's';
        bubblesContainer.appendChild(bubble);
      }

      // Confetti effect
      const successIcon = document.querySelector('.success-icon');
      successIcon.addEventListener('click', function() {
        createConfetti();
      });

      // Trigger confetti on page load
      setTimeout(createConfetti, 500);
    });

    function createConfetti() {
      const colors = ['#FF6B6B', '#70A1FF', '#FFA502', '#2ED573', '#FFFFFF'];

      for (let i = 0; i < 50; i++) {
        const confetti = document.createElement('div');
        confetti.className = 'confetti';
        confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        confetti.style.left = Math.random() * 100 + 'vw';
        confetti.style.width = Math.random() * 10 + 5 + 'px';
        confetti.style.height = Math.random() * 10 + 5 + 'px';
        confetti.style.position = 'fixed';
        confetti.style.top = '0';
        confetti.style.zIndex = '1000';
        confetti.style.borderRadius = '50%';
        confetti.style.transform = `rotate(${Math.random() * 360}deg)`;

        document.body.appendChild(confetti);

        const animationDuration = 2 + Math.random() * 3;

        confetti.animate(
          [{
              transform: 'translateY(0) rotate(0deg)',
              opacity: 1
            },
            {
              transform: `translateY(${window.innerHeight}px) rotate(${Math.random() * 360}deg)`,
              opacity: 0,
            },
          ], {
            duration: animationDuration * 1000,
            easing: 'cubic-bezier(0.1, 0.8, 0.3, 1)',
            fill: 'forwards',
          }
        );

        setTimeout(() => {
          confetti.remove();
        }, animationDuration * 1000);
      }
    }
  </script>
</body>

</html>