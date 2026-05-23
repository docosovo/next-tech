document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const nombre = document.getElementById('nombre').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirm_password = document.getElementById('confirm_password').value;
    
    if (password !== confirm_password) {
        showMessage('Las contraseñas no coinciden', 'error');
        return;
    }
    
    const userData = {
        nombre: nombre,
        email: email,
        password: password
    };
    

    fetch('/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(userData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showMessage('Registro exitoso!', 'success');
            document.getElementById('registerForm').reset();
        } else {
            showMessage(data.message || 'Error en el registro', 'error');
        }
    })
    .catch(error => {
        showMessage('Error de conexión con el servidor', 'error');
        console.error('Error:', error);
    });
});

function showMessage(message, type) {
    const messageDiv = document.getElementById('message');
    messageDiv.textContent = message;
    messageDiv.className = 'message ' + type;
    
 
    setTimeout(() => {
        messageDiv.textContent = '';
        messageDiv.className = 'message';
    }, 5000);
}