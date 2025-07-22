document.addEventListener('DOMContentLoaded', function() {
    // Animate the liquid level based on form completion
    const formInputs = document.querySelectorAll('#registrationForm input');
    const formLiquid = document.getElementById('formLiquid');
    
    formInputs.forEach(input => {
        input.addEventListener('input', updateLiquidLevel);
        input.addEventListener('focus', function() {
            gsap.to(this.parentNode, { 
                boxShadow: '0 0 0 3px rgba(255, 107, 107, 0.3)',
                duration: 0.3 
            });
        });
        input.addEventListener('blur', function() {
            gsap.to(this.parentNode, { 
                boxShadow: 'none',
                duration: 0.3 
            });
        });
    });
    
    function updateLiquidLevel() {
        let filledFields = 0;
        formInputs.forEach(input => {
            if (input.value.trim() !== '' && input.type !== 'checkbox') {
                filledFields++;
            }
        });
        
        const percentageFilled = (filledFields / (formInputs.length - 1)) * 100;
        const newHeight = Math.min(100, Math.max(30, 30 + (percentageFilled * 0.7)));
        
        gsap.to(formLiquid, {
            height: `${newHeight}%`,
            duration: 1,
            ease: "elastic.out(1, 0.5)"
        });
        
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
        
        gsap.to(strengthBar, {
            width: strength.percentage + '%',
            backgroundColor: strength.color,
            duration: 0.5
        });
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
            
            // Add celebration effect
            gsap.to(passwordMatch, {
                scale: 1.1,
                duration: 0.3,
                yoyo: true,
                repeat: 1
            });
        } else {
            passwordMatch.textContent = '✗ Passwords do not match';
            passwordMatch.style.color = 'var(--danger)';
            
            // Add shake effect
            gsap.to(confirmPasswordInput.parentNode, {
                x: [-5, 5, -5, 5, 0],
                duration: 0.5,
                ease: "power1.inOut"
            });
        }
    });
    
    // Form submission
    const registrationForm = document.getElementById('registrationForm');
    
    registrationForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate terms checkbox
        const termsCheckbox = document.getElementById('terms');
        if (!termsCheckbox.checked) {
            animateTermsWarning();
            return;
        }
        
        // Validate password match
        if (passwordInput.value !== confirmPasswordInput.value) {
            animatePasswordMismatch();
            return;
        }
        
        // If all validations pass, submit the form
        simulateFormSubmission();
    });
    
    // Initial animations
    gsap.from(".brand-side", {
        x: -50,
        opacity: 0,
        duration: 1,
        ease: "power3.out"
    });
    
    gsap.from(".form-side", {
        x: 50,
        opacity: 0,
        duration: 1,
        ease: "power3.out",
        delay: 0.2
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
        color: ''
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

function animateTermsWarning() {
    const termsLabel = document.querySelector('.terms label');
    
    gsap.to(termsLabel, {
        color: 'var(--danger)',
        duration: 0.3,
        yoyo: true,
        repeat: 1
    });
    
    gsap.to(termsLabel, {
        x: [-5, 5, -5, 5, 0],
        duration: 0.5,
        ease: "power1.inOut"
    });
}

function animatePasswordMismatch() {
    gsap.to(confirmPasswordInput.parentNode, {
        borderColor: 'var(--danger)',
        boxShadow: '0 0 0 3px rgba(255, 71, 87, 0.3)',
        duration: 0.3,
        yoyo: true,
        repeat: 1
    });
}

function simulateFormSubmission() {
    const submitBtn = document.querySelector('.submit-btn');
    const originalText = submitBtn.innerHTML;
    
    // Disable button and show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
    
    // Simulate API call
    setTimeout(() => {
        // Show success state
        submitBtn.innerHTML = '<i class="fas fa-check"></i> Registration Successful!';
        submitBtn.style.background = 'var(--success)';
        
        // Create confetti effect
        createConfetti();
        
        // Redirect after delay
        setTimeout(() => {
            window.location.href = "dashboard.html";
        }, 2000);
    }, 1500);
}

function createConfetti() {
    const colors = ['#FF6B6B', '#70A1FF', '#FFA502', '#2ED573', '#FFFFFF'];
    
    for (let i = 0; i < 100; i++) {
        const confetti = document.createElement('div');
        confetti.className = 'confetti';
        confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        confetti.style.left = Math.random() * 100 + 'vw';
        confetti.style.width = Math.random() * 10 + 5 + 'px';
        confetti.style.height = Math.random() * 10 + 5 + 'px';
        confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
        
        document.body.appendChild(confetti);
        
        gsap.to(confetti, {
            y: -1000,
            x: Math.random() * 1000 - 500,
            opacity: 0,
            duration: 2 + Math.random() * 3,
            ease: "power1.out",
            onComplete: () => confetti.remove()
        });
    }
}