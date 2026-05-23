document.addEventListener('DOMContentLoaded', function() {
    // Cargar productos del carrito desde sessionStorage
    loadOrderSummary();
    
    // Manejar cambio de método de pago
    setupPaymentMethods();
    
    // Formatear inputs de tarjeta
    setupCardInputs();
    
    // Manejar envío del formulario
    setupFormSubmission();
});

function loadOrderSummary() {
    const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    const orderItems = document.getElementById('orderItems');
    const subtotalElement = document.getElementById('subtotal');
    const shippingElement = document.getElementById('shipping');
    const totalElement = document.getElementById('total');
    
    if (cart.length === 0) {
        orderItems.innerHTML = '<p class="empty-cart">No hay productos en el carrito</p>';
        return;
    }
    
    let subtotal = 0;
    let html = '';
    
    cart.forEach(item => {
        const itemTotal = item.price * item.qty;
        subtotal += itemTotal;
        
        html += `
            <div class="order-item">
                <div class="item-info">
                    <h4>${item.name}</h4>
                    <div class="item-price">$${item.price.toLocaleString()} x ${item.qty}</div>
                </div>
                <div class="item-total">$${itemTotal.toLocaleString()}</div>
            </div>
        `;
    });
    
    orderItems.innerHTML = html;
    
    const shipping = subtotal > 100 ? 0 : 10; // Envío gratis sobre $100
    const total = subtotal + shipping;
    
    subtotalElement.textContent = `$${subtotal.toLocaleString()}`;
    shippingElement.textContent = shipping === 0 ? 'Gratis' : `$${shipping.toLocaleString()}`;
    totalElement.textContent = `$${total.toLocaleString()}`;
}

function setupPaymentMethods() {
    const paymentMethods = document.querySelectorAll('input[name="paymentMethod"]');
    const creditCardForm = document.getElementById('creditCardForm');
    const cashPayment = document.getElementById('cashPayment');
    const paypalPayment = document.getElementById('paypalPayment');
    
    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            // Ocultar todos los formularios
            creditCardForm.style.display = 'none';
            cashPayment.style.display = 'none';
            paypalPayment.style.display = 'none';
            
            // Mostrar el formulario correspondiente
            switch(this.value) {
                case 'credit':
                    creditCardForm.style.display = 'block';
                    break;
                case 'cash':
                    cashPayment.style.display = 'block';
                    break;
                case 'paypal':
                    paypalPayment.style.display = 'block';
                    break;
            }
        });
    });
}

function setupCardInputs() {
    // Formatear número de tarjeta
    const cardNumber = document.getElementById('cardNumber');
    cardNumber.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
        let formattedValue = '';
        
        for (let i = 0; i < value.length; i++) {
            if (i > 0 && i % 4 === 0) {
                formattedValue += ' ';
            }
            formattedValue += value[i];
        }
        
        e.target.value = formattedValue;
    });
    
    // Formatear fecha de expiración
    const expiryDate = document.getElementById('expiryDate');
    expiryDate.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        if (value.length >= 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        
        e.target.value = value;
    });
    
    // Validar CVV
    const cvv = document.getElementById('cvv');
    cvv.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });
}

function setupFormSubmission() {
    const form = document.getElementById('paymentForm');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            processPayment();
        }
    });
}

function validateForm() {
    const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
    
    if (paymentMethod === 'credit') {
        // Validar tarjeta de crédito
        const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
        const expiryDate = document.getElementById('expiryDate').value;
        const cvv = document.getElementById('cvv').value;
        const cardName = document.getElementById('cardName').value;
        
        if (cardNumber.length !== 16) {
            alert('Por favor ingresa un número de tarjeta válido (16 dígitos)');
            return false;
        }
        
        if (!expiryDate.match(/^\d{2}\/\d{2}$/)) {
            alert('Por favor ingresa una fecha de expiración válida (MM/AA)');
            return false;
        }
        
        if (cvv.length < 3 || cvv.length > 4) {
            alert('Por favor ingresa un CVV válido (3-4 dígitos)');
            return false;
        }
        
        if (cardName.trim().length < 3) {
            alert('Por favor ingresa el nombre como aparece en la tarjeta');
            return false;
        }
    }
    
    // Validar información de contacto
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    
    if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
        alert('Por favor ingresa un email válido');
        return false;
    }
    
    if (phone.trim().length < 8) {
        alert('Por favor ingresa un número de teléfono válido');
        return false;
    }
    
    return true;
}

function processPayment() {
    const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
    const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    
    // Simular procesamiento de pago
    const payButton = document.querySelector('.btn-pay');
    const originalText = payButton.innerHTML;
    
    payButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Procesando...';
    payButton.disabled = true;
    
    // Simular delay de procesamiento
    setTimeout(() => {
        // Aquí normalmente enviarías los datos al servidor
        console.log('Procesando pago con método:', paymentMethod);
        console.log('Productos:', cart);
        
        // Limpiar carrito y redirigir a confirmación
        sessionStorage.removeItem('cart');
        
        // Redirigir a página de confirmación
        window.location.href = 'confirmacion.php?order=' + generateOrderId();
        
    }, 2000);
}

function generateOrderId() {
    return 'ORD-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9).toUpperCase();
}

// Helper para manejar PayPal
document.querySelector('.paypal-btn')?.addEventListener('click', function() {
    document.querySelector('input[value="paypal"]').checked = true;
    document.getElementById('paymentForm').dispatchEvent(new Event('submit'));
});