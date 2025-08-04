document.addEventListener('DOMContentLoaded', function () {
  // Animate the liquid level based on form completion
  const formInputs = document.querySelectorAll('#registrationForm input');
  const formLiquid = document.getElementById('formLiquid');

  formInputs.forEach((input) => {
    input.addEventListener('input', updateLiquidLevel);
    input.addEventListener('focus', function () {
      this.parentNode.style.boxShadow = '0 0 0 3px rgba(255, 107, 107, 0.3)';
    });
    input.addEventListener('blur', function () {
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

  passwordInput.addEventListener('input', function () {
    const password = this.value;
    const strength = calculatePasswordStrength(password);

    strengthBar.style.width = strength.percentage + '%';
    strengthBar.style.backgroundColor = strength.color;
  });

  // Password match checker
  const confirmPasswordInput = document.getElementById('confirmPassword');
  const passwordMatch = document.getElementById('passwordMatch');

  confirmPasswordInput.addEventListener('input', function () {
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

  registrationForm.addEventListener('submit', function (e) {
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
