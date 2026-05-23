// JavaScript unificado para el formulario de login - Versión segura
(function() {
    'use strict';
    
    function initPasswordToggle() {
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        
        if (!toggleBtn || !passwordInput) return;
        
        toggleBtn.onclick = function(e) {
            e.preventDefault();
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                this.innerHTML = '<i class="bi bi-eye"></i>';
            }
            return false;
        };
    }
    
    function createParticles() {
        const loginWrapper = document.querySelector('.login-wrapper');
        if (!loginWrapper) return;
        
        const particleCount = 8;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'login-particle';
            
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            const size = Math.random() * 4 + 2;
            const opacity = Math.random() * 0.5 + 0.2;
            
            const colors = [
                'var(--tech-electric)',
                'var(--tech-digital)',
                'var(--tech-cyber)',
                'var(--tech-energy)'
            ];
            const color = colors[Math.floor(Math.random() * colors.length)];
            
            particle.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                background: ${color};
                border-radius: 50%;
                top: ${posY}%;
                left: ${posX}%;
                opacity: ${opacity};
                pointer-events: none;
                z-index: 0;
                animation: floatParticle ${Math.random() * 10 + 10}s infinite ease-in-out;
                animation-delay: ${Math.random() * 5}s;
            `;
            
            loginWrapper.appendChild(particle);
        }
        
        // Añadir estilos de animación para partículas si no existen
        if (!document.querySelector('#particle-styles')) {
            const style = document.createElement('style');
            style.id = 'particle-styles';
            style.textContent = `
                @keyframes floatParticle {
                    0%, 100% {
                        transform: translateY(0) translateX(0) scale(1);
                        opacity: 0.3;
                    }
                    25% {
                        transform: translateY(-20px) translateX(10px) scale(1.1);
                        opacity: 0.6;
                    }
                    50% {
                        transform: translateY(-10px) translateX(-10px) scale(0.9);
                        opacity: 0.4;
                    }
                    75% {
                        transform: translateY(10px) translateX(5px) scale(1.05);
                        opacity: 0.5;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    }
    
    function initFieldValidation() {
        const inputs = document.querySelectorAll('input[required]');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                clearFieldStatus(this);
            });
        });
    }
    
    function validateField(field) {
        const value = field.value.trim();
        
        if (!value) {
            setFieldStatus(field, 'error', 'Este campo es obligatorio');
            return false;
        }
        
        setFieldStatus(field, 'success');
        return true;
    }
    
    function setFieldStatus(field, status, message = '') {
        clearFieldStatus(field);
        
        if (status === 'error') {
            field.style.borderColor = 'var(--tech-energy)';
            field.style.boxShadow = '0 0 0 3px rgba(255, 107, 107, 0.1)';
            
            if (message) {
                const errorElement = document.createElement('div');
                errorElement.className = 'field-error';
                errorElement.textContent = message;
                errorElement.style.cssText = `
                    color: var(--tech-energy);
                    font-size: 0.8rem;
                    margin-top: 0.25rem;
                    display: block;
                `;
                field.parentNode.appendChild(errorElement);
            }
        } else if (status === 'success') {
            field.style.borderColor = 'var(--tech-cyber)';
            field.style.boxShadow = '0 0 0 3px rgba(0, 255, 157, 0.1)';
        }
    }
    
    function clearFieldStatus(field) {
        field.style.borderColor = '';
        field.style.boxShadow = '';
        
        const existingError = field.parentNode.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }
    }
    
    // Inicializar todo cuando el DOM esté listo
    function init() {
        initPasswordToggle();
        createParticles();
        initFieldValidation();
        
        console.log('Sistema de login inicializado correctamente');
    }
    
    // Esperar a que el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
})();