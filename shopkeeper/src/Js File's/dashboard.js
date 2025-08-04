document.addEventListener('DOMContentLoaded', function () {
  // Create background bubbles
  const bubblesBg = document.querySelector('.bubbles-bg');
  for (let i = 0; i < 15; i++) {
    const bubble = document.createElement('div');
    bubble.className = 'bubble';
    bubble.style.width = Math.random() * 60 + 20 + 'px';
    bubble.style.height = bubble.style.width;
    bubble.style.left = Math.random() * 100 + '%';
    bubble.style.animationDuration = 5 + Math.random() * 15 + 's';
    bubble.style.animationDelay = Math.random() * 5 + 's';
    bubble.style.setProperty('--move-x', Math.random() > 0.5 ? 1 : -1);
    bubblesBg.appendChild(bubble);
  }

  // Create bottle bubbles
  const bubbleAnimation = document.querySelector('.bubble-animation');
  for (let i = 0; i < 5; i++) {
    const bubble = document.createElement('div');
    bubble.className = 'mini-bubble';
    bubble.style.left = Math.random() * 80 + 10 + '%';
    bubble.style.animationDelay = Math.random() * 3 + 's';
    bubble.style.animationDuration = 2 + Math.random() * 3 + 's';
    bubbleAnimation.appendChild(bubble);
  }

  // Toggle sidebar on mobile
  const menuToggle = document.querySelector('.menu-toggle');
  const sidebar = document.querySelector('.sidebar');

  menuToggle.addEventListener('click', function () {
    sidebar.classList.toggle('open');
  });

  // Animate bottle liquid
  const bottleLiquid = document.querySelector('.bottle-liquid');
  let fillDirection = 1;

  function animateLiquid() {
    const currentHeight = parseFloat(bottleLiquid.style.height || '60%');
    let newHeight = currentHeight + fillDirection * 0.5;

    if (newHeight >= 80) fillDirection = -1;
    if (newHeight <= 40) fillDirection = 1;

    bottleLiquid.style.height = newHeight + '%';
    requestAnimationFrame(animateLiquid);
  }

  animateLiquid();

  // Add bubbles periodically
  setInterval(() => {
    const bubble = document.createElement('div');
    bubble.className = 'mini-bubble';
    bubble.style.left = Math.random() * 80 + 10 + '%';
    bubble.style.animationDelay = '0s';
    bubble.style.animationDuration = 2 + Math.random() * 3 + 's';
    bubbleAnimation.appendChild(bubble);

    // Remove bubble after animation
    setTimeout(() => {
      bubble.remove();
    }, 5000);
  }, 800);

  // Chart period buttons
  const periodButtons = document.querySelectorAll('.period-btn');
  periodButtons.forEach((button) => {
    button.addEventListener('click', function () {
      periodButtons.forEach((btn) => btn.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // Product bottle interaction
  const productBottle = document.querySelector('.product-bottle');
  productBottle.addEventListener('click', function () {
    // Create a burst of bubbles
    for (let i = 0; i < 10; i++) {
      const bubble = document.createElement('div');
      bubble.className = 'mini-bubble';
      bubble.style.left = Math.random() * 80 + 10 + '%';
      bubble.style.bottom = '20%';
      bubble.style.animationDuration = 1 + Math.random() * 2 + 's';
      bubble.style.width = '6px';
      bubble.style.height = '6px';
      bubbleAnimation.appendChild(bubble);

      // Remove bubble after animation
      setTimeout(() => {
        bubble.remove();
      }, 3000);
    }
  });
});
