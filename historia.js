document.addEventListener('DOMContentLoaded', function() {
   
    const burger = document.querySelector('.burger');
    const navLinks = document.querySelector('.nav-links');
    
    burger.addEventListener('click', function() {
        navLinks.classList.toggle('active');
        burger.classList.toggle('active');
    });
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
                
                if (navLinks.classList.contains('active')) {
                    navLinks.classList.remove('active');
                    burger.classList.remove('active');
                }
            }
        });
    });
    
    const milestones = document.querySelectorAll('.number');
    
    function animateNumbers() {
        milestones.forEach(milestone => {
            const target = parseInt(milestone.getAttribute('data-count'));
            const suffix = milestone.textContent.includes('+') ? '+' : '';
            const duration = 2000; 
            const step = target / (duration / 16); 
            
            let current = 0;
            const increment = () => {
                current += step;
                if (current < target) {
                    milestone.textContent = Math.floor(current) + suffix;
                    requestAnimationFrame(increment);
                } else {
                    milestone.textContent = target + suffix;
                }
            };
            
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    increment();
                    observer.unobserve(milestone);
                }
            });
            
            observer.observe(milestone);
        });
    }
    
    animateNumbers();
    
    const timelineItems = document.querySelectorAll('.timeline-item');
    
    const timelineObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, { threshold: 0.1 });
    
    timelineItems.forEach(item => {
        timelineObserver.observe(item);
    });
    
    const teamCards = document.querySelectorAll('.team-card');
    
    teamCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            const img = card.querySelector('.team-image img');
            img.style.transform = 'scale(1.05)';
        });
        
        card.addEventListener('mouseleave', () => {
            const img = card.querySelector('.team-image img');
            img.style.transform = 'scale(1)';
        });
    });
    
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = this.querySelector('input[name="name"]');
            const email = this.querySelector('input[name="email"]');
            const message = this.querySelector('textarea[name="message"]');
            let isValid = true;
            
           
            if (!name.value.trim()) {
                name.classList.add('error');
                isValid = false;
            } else {
                name.classList.remove('error');
            }
            
            if (!email.value.trim() || !email.value.includes('@')) {
                email.classList.add('error');
                isValid = false;
            } else {
                email.classList.remove('error');
            }
            
            if (!message.value.trim()) {
                message.classList.add('error');
                isValid = false;
            } else {
                message.classList.remove('error');
            }
            
            if (isValid) {
                alert('Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.');
                this.reset();
            }
        });
    }
    
    const yearElement = document.querySelector('.footer-bottom p');
    if (yearElement) {
        const currentYear = new Date().getFullYear();
        yearElement.innerHTML = yearElement.innerHTML.replace('2024', currentYear);
    }
});