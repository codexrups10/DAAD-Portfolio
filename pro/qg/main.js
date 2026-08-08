// Initialize Animations
AOS.init({
    duration: 800,
    once: true
});

// Dark Mode Toggle
const themeBtn = document.getElementById('themeToggle');
themeBtn.addEventListener('click', () => {
    const currentTheme = document.documentElement.getAttribute('data-theme');
    const targetTheme = currentTheme === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', targetTheme);
    themeBtn.innerText = targetTheme === 'dark' ? '☀️' : '🌙';
});

// Bored Mode: Random Selection
const boredBtn = document.getElementById('boredBtn');
boredBtn.addEventListener('click', () => {
    const categories = ['geography', 'tech', 'science', 'sports'];
    const random = categories[Math.floor(Math.random() * categories.length)];
    alert("Let's play " + random.toUpperCase() + "!");
    window.location.href = `play.php?cat=${random}`;
});

// Quiz Engine State
let score = 0;
let currentQuestion = 0;

function checkAnswer(selected, correct) {
    if(selected === correct) {
        score += 10;
        showFeedback("Excellent! 🌟", "success");
    } else {
        showFeedback("Oops! Try again. 🧠", "error");
    }
    // Logic to move to next question...
}