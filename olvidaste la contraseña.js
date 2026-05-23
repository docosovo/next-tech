document.addEventListener('DOMContentLoaded', function() {
    const recoveryForm = document.getElementById('recoveryForm');
    const successMessage = document.getElementById('successMessage');
    
    recoveryForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = document.getElementById('email').value;
        
      
        if (!validateEmail(email)) {
            alert('Por favor ingresa un correo electrónico válido');
            return;
        }
        
        console.log('Solicitud de recuperación para:', email);
        
        simulateEmailSend(email);
    });
    
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    function simulateEmailSend(email) {
        recoveryForm.style.display = 'none';
        successMessage.style.display = 'block';
        
   
    }
});