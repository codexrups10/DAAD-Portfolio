// Mobile Navigation Toggle
const navToggle = document.querySelector('.nav-toggle');
const navList = document.querySelector('.nav-list');

navToggle.addEventListener('click', () => {
    navList.classList.toggle('active');
    navToggle.classList.toggle('active');
});

// Close mobile menu when clicking on a link
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
        navList.classList.remove('active');
        navToggle.classList.remove('active');
    });
});

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            const headerOffset = 80;
            const elementPosition = target.offsetTop;
            const offsetPosition = elementPosition - headerOffset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    });
});

// Header background change on scroll
const header = document.querySelector('.header');
window.addEventListener('scroll', () => {
    if (window.scrollY > 100) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Animate elements on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate');
        }
    });
}, observerOptions);

// Observe elements for animation
document.querySelectorAll('.program-card, .stat, .contact-item, .form-card').forEach(el => {
    observer.observe(el);
});

// Form validation for contact form
const contactForm = document.querySelector('.contact-form');
if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();

        // Simple validation
        const inputs = contactForm.querySelectorAll('input, select, textarea');
        let isValid = true;

        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value.trim()) {
                input.style.borderColor = '#e74c3c';
                isValid = false;
            } else {
                input.style.borderColor = '#27ae60';
            }
        });

        if (isValid) {
            // Simulate form submission
            alert('Thank you for your message! We will get back to you soon.');
            contactForm.reset();
            inputs.forEach(input => {
                input.style.borderColor = '#e1e8ed';
            });
        }
    });
}

// Form validation for admission form
const admissionForm = document.querySelector('#admissionForm');
if (admissionForm) {
    admissionForm.addEventListener('submit', (e) => {
        e.preventDefault();

        // Simple validation
        const inputs = admissionForm.querySelectorAll('input, select');
        let isValid = true;

        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value.trim()) {
                input.style.borderColor = '#e74c3c';
                isValid = false;
            } else {
                input.style.borderColor = '#27ae60';
            }
        });

        if (isValid) {
            // Form is valid, submit to next step
            admissionForm.submit();
        }
    });
}

// Character counting for admission form inputs
document.querySelectorAll('#admissionForm .input-wrapper input').forEach(input => {
    const charCount = input.parentElement.querySelector('.char-count');

    if (charCount) {
        input.addEventListener('input', () => {
            const currentLength = input.value.length;
            const maxLength = 500; // Assuming 500 character limit
            charCount.textContent = `${currentLength} / ${maxLength}`;

            if (currentLength > maxLength * 0.9) {
                charCount.style.color = '#e74c3c';
            } else {
                charCount.style.color = '#999';
            }
        });
    }
});

// Reset input border color on focus for admission form
document.querySelectorAll('#admissionForm input, #admissionForm select').forEach(input => {
    input.addEventListener('focus', () => {
        input.style.borderColor = '#3498db';
    });

    input.addEventListener('blur', () => {
        if (!input.value.trim() && input.hasAttribute('required')) {
            input.style.borderColor = '#e1e8ed';
        }
    });
});

// Reset input border color on focus
document.querySelectorAll('.contact-form input, .contact-form select, .contact-form textarea').forEach(input => {
    input.addEventListener('focus', () => {
        input.style.borderColor = '#3498db';
    });

    input.addEventListener('blur', () => {
        if (!input.value.trim() && input.hasAttribute('required')) {
            input.style.borderColor = '#e1e8ed';
        }
    });
});

// Add loading animation for hero image
const heroImage = document.querySelector('.hero-image img');
if (heroImage) {
    heroImage.addEventListener('load', () => {
        heroImage.classList.add('loaded');
    });
}

// Parallax effect for hero section (subtle)
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const heroImage = document.querySelector('.hero-image img');
    if (heroImage) {
        heroImage.style.transform = `translateY(${scrolled * 0.2}px)`;
    }
});

// Stats counter animation
function animateStats() {
    const stats = document.querySelectorAll('.stat h4');
    stats.forEach(stat => {
        const target = parseInt(stat.textContent.replace(/[^\d]/g, ''));
        const suffix = stat.textContent.replace(/[\d]/g, '');
        let current = 0;
        const increment = target / 100;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            stat.textContent = Math.floor(current) + suffix;
        }, 20);
    });
}

// Trigger stats animation when section is visible
const statsSection = document.querySelector('.stats');
if (statsSection) {
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateStats();
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    statsObserver.observe(statsSection);
}

// Add CSS for animations
const style = document.createElement('style');
style.textContent = `
    .nav-list.active {
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .nav-toggle.active .bar:nth-child(1) {
        transform: rotate(-45deg) translate(-5px, 6px);
    }
    
    .nav-toggle.active .bar:nth-child(2) {
        opacity: 0;
    }
    
    .nav-toggle.active .bar:nth-child(3) {
        transform: rotate(45deg) translate(-5px, -6px);
    }
    
    .header.scrolled {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }
    
    .program-card, .stat, .contact-item, .form-card {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .program-card.animate, .stat.animate, .contact-item.animate, .form-card.animate {
        opacity: 1;
        transform: translateY(0);
    }
    
    .hero-image img {
        transition: transform 0.3s ease;
    }
    
    .hero-image img.loaded {
        animation: fadeIn 1s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
    
    @media (min-width: 769px) {
        .nav-list {
            display: flex !important;
        }
    }
`;
document.head.appendChild(style);