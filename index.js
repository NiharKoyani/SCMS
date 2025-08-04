document.addEventListener('DOMContentLoaded', function () {
  // Create particles
  const particlesContainer = document.getElementById('particles');
  for (let i = 0; i < 50; i++) {
    const particle = document.createElement('div');
    particle.className = 'particle';
    particle.style.width = Math.random() * 10 + 2 + 'px';
    particle.style.height = particle.style.width;
    particle.style.left = Math.random() * 100 + '%';
    particle.style.top = Math.random() * 100 + '%';
    particle.style.animationDuration = 5 + Math.random() * 20 + 's';
    particle.style.animationDelay = Math.random() * 5 + 's';
    particlesContainer.appendChild(particle);
  }

  // Create bubbles in product can
  const bubblesContainer = document.getElementById('bubbles');
  for (let i = 0; i < 15; i++) {
    const bubble = document.createElement('div');
    bubble.className = 'bubble';
    bubble.style.width = Math.random() * 20 + 5 + 'px';
    bubble.style.height = bubble.style.width;
    bubble.style.left = Math.random() * 100 + '%';
    bubble.style.bottom = '-20px';
    bubble.style.animationDuration = 3 + Math.random() * 5 + 's';
    bubble.style.animationDelay = Math.random() * 3 + 's';
    bubblesContainer.appendChild(bubble);
  }

  // Add more bubbles periodically
  setInterval(() => {
    const bubble = document.createElement('div');
    bubble.className = 'bubble';
    bubble.style.width = Math.random() * 15 + 5 + 'px';
    bubble.style.height = bubble.style.width;
    bubble.style.left = Math.random() * 100 + '%';
    bubble.style.bottom = '-20px';
    bubble.style.animationDuration = 3 + Math.random() * 4 + 's';
    bubblesContainer.appendChild(bubble);

    // Remove bubble after animation
    setTimeout(() => {
      bubble.remove();
    }, 7000);
  }, 800);
});
