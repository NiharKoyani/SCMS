document.addEventListener('DOMContentLoaded', function () {
  // Animate the liquid level based on form completion
  const formInputs = document.querySelectorAll('#loginForm input');
  const formLiquid = document.getElementById('formLiquid');

  formInputs.forEach((input) => {
    input.addEventListener('input', function () {
      let filledFields = 0;
      formInputs.forEach((input) => {
        if (input.value.trim() !== '' && input.type !== 'checkbox') {
          filledFields++;
        }
      });

      const newHeight = filledFields === 2 ? 100 : 60;
      formLiquid.style.height = `${newHeight}%`;
    });

    input.addEventListener('focus', function () {
      this.parentNode.style.boxShadow = '0 0 0 3px rgba(255, 107, 107, 0.3)';
    });

    input.addEventListener('blur', function () {
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
