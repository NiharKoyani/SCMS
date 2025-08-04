document.addEventListener('DOMContentLoaded', function () {
  const resetForm = document.getElementById('resetForm');
  const successMessage = document.getElementById('successMessage');
  const formLiquid = document.getElementById('formLiquid');
  const emailInput = document.getElementById('email');

  // Animate liquid when typing
  emailInput.addEventListener('input', function () {
    formLiquid.style.height = this.value.trim() !== '' ? '80%' : '30%';
  });

  emailInput.addEventListener('focus', function () {
    this.parentNode.style.boxShadow = '0 0 0 3px rgba(255, 107, 107, 0.3)';
  });

  emailInput.addEventListener('blur', function () {
    this.parentNode.style.boxShadow = 'none';
  });

  // Form submission
  resetForm.addEventListener('submit', function (e) {
    e.preventDefault();

    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
    submitBtn.disabled = true;

    // Simulate API call
    setTimeout(() => {
      // Show success message
      resetForm.style.display = 'none';
      successMessage.style.display = 'block';

      // Animate success
      successMessage.classList.add('animate__animated', 'animate__fadeIn');

      // Reset button
      submitBtn.innerHTML = originalText;
      submitBtn.disabled = false;

      // Change bottle liquid to success color
      formLiquid.style.background = 'linear-gradient(to top, rgba(46, 213, 115, 0.7), rgba(107, 255, 186, 0.7))';
      formLiquid.style.height = '100%';
    }, 1500);
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
