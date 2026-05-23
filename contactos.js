document.addEventListener('DOMContentLoaded', function() {
    // Botón de direcciones
    const directionsBtn = document.getElementById('directions-btn');
    directionsBtn.addEventListener('click', function() {
        window.open('https://www.google.com/maps/dir//Av.+Tecnología+1234,+Ciudad+Digital', '_blank');
    });

    // Formulario de contacto
    const contactForm = document.getElementById('contactForm');
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Obtener valores del formulario
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value;
        
        // Validación simple
        if (!name || !email || !subject || !message) {
            alert('Por favor completa todos los campos');
            return;
        }
        
        // Simular envío del formulario
        console.log('Formulario enviado:', {
            name,
            email,
            subject,
            message
        });
        
        alert('Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.');
        contactForm.reset();
    });

    // Efecto de scroll suave para todos los enlaces
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});