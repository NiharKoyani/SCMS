// Add more bubbles dynamically
document.addEventListener("DOMContentLoaded", function () {
  const bubblesContainer = document.querySelector(".floating-bubbles");

  for (let i = 0; i < 5; i++) {
    const bubble = document.createElement("div");
    bubble.className = "bubble";
    bubble.style.width = Math.random() * 30 + 20 + "px";
    bubble.style.height = bubble.style.width;
    bubble.style.left = Math.random() * 100 + "%";
    bubble.style.animationDuration = 5 + Math.random() * 10 + "s";
    bubble.style.animationDelay = Math.random() * 5 + "s";
    bubblesContainer.appendChild(bubble);
  }

  // Confetti effect
  const successIcon = document.querySelector(".success-icon");
  successIcon.addEventListener("click", function () {
    createConfetti();
  });

  // Trigger confetti on page load
  setTimeout(createConfetti, 500);
});

function createConfetti() {
  const colors = ["#FF6B6B", "#70A1FF", "#FFA502", "#2ED573", "#FFFFFF"];

  for (let i = 0; i < 50; i++) {
    const confetti = document.createElement("div");
    confetti.className = "confetti";
    confetti.style.backgroundColor =
      colors[Math.floor(Math.random() * colors.length)];
    confetti.style.left = Math.random() * 100 + "vw";
    confetti.style.width = Math.random() * 10 + 5 + "px";
    confetti.style.height = Math.random() * 10 + 5 + "px";
    confetti.style.position = "fixed";
    confetti.style.top = "0";
    confetti.style.zIndex = "1000";
    confetti.style.borderRadius = "50%";
    confetti.style.transform = `rotate(${Math.random() * 360}deg)`;

    document.body.appendChild(confetti);

    const animationDuration = 2 + Math.random() * 3;

    confetti.animate(
      [
        { transform: "translateY(0) rotate(0deg)", opacity: 1 },
        {
          transform: `translateY(${window.innerHeight}px) rotate(${
            Math.random() * 360
          }deg)`,
          opacity: 0,
        },
      ],
      {
        duration: animationDuration * 1000,
        easing: "cubic-bezier(0.1, 0.8, 0.3, 1)",
        fill: "forwards",
      }
    );

    setTimeout(() => {
      confetti.remove();
    }, animationDuration * 1000);
  }
}
