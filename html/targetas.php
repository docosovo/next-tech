<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra - NEX-TECH MECH-DOOM</title>
    <link rel="stylesheet" href="../css/targetas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="../imagenes/logo.jpg" type="image/x-icon">
</head>
<body>

<header>
    <nav>
        <div class="container">
            <div class="logo">
                <h1>NEX-TECH<span>MECH-DOOM</span></h1>
            </div>
            <div class="checkout-steps">
                <div class="step active">1. Carrito</div>
                <div class="step active">2. Información de Pago</div>
                <div class="step">3. Confirmación</div>
            </div>
        </div>
    </nav>
</header>

<main class="checkout-container">
    <div class="container">
        <h1>Finalizar Compra</h1>
        
        <div class="checkout-content">
           
            <div class="order-summary">
                <h2>Resumen de tu Pedido</h2>
                <div id="orderItems">
                   
                </div>
                <div class="order-totals">
                    <div class="total-line">
                        <span>Subtotal:</span>
                        <span id="subtotal">$0</span>
                    </div>
                    <div class="total-line">
                        <span>Envío:</span>
                        <span id="shipping">$0</span>
                    </div>
                    <div class="total-line grand-total">
                        <span>Total:</span>
                        <span id="total">$0</span>
                    </div>
                </div>
            </div>

            <!-- Formulario de Pago -->
            <div class="payment-form">
                <h2>Método de Pago</h2>
                
                <form id="paymentForm">
                    <!-- Selección de Método de Pago -->
                    <div class="payment-methods">
                        <div class="payment-method">
                            <input type="radio" id="creditCard" name="paymentMethod" value="credit" checked>
                            <label for="creditCard">
                                <i class="fab fa-cc-visa"></i>
                                <i class="fab fa-cc-mastercard"></i>
                                <i class="fab fa-cc-amex"></i>
                                Tarjeta de Crédito/Débito
                            </label>
                        </div>
                        <div class="payment-method">
                            <input type="radio" id="cash" name="paymentMethod" value="cash">
                            <label for="cash">
                                <i class="fas fa-money-bill-wave"></i>
                                Pago en Efectivo
                            </label>
                        </div>
                        <div class="payment-method">
                            <input type="radio" id="paypal" name="paymentMethod" value="paypal">
                            <label for="paypal">
                                <i class="fab fa-paypal"></i>
                                PayPal
                            </label>
                        </div>
                    </div>

                    <!-- Formulario de Tarjeta de Crédito -->
                    <div id="creditCardForm" class="payment-details">
                        <div class="form-group">
                            <label for="cardNumber">Número de Tarjeta</label>
                            <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
                            <div class="card-icons">
                                <i class="fab fa-cc-visa"></i>
                                <i class="fab fa-cc-mastercard"></i>
                                <i class="fab fa-cc-amex"></i>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="expiryDate">Fecha de Expiración</label>
                                <input type="text" id="expiryDate" placeholder="MM/AA" maxlength="5">
                            </div>
                            <div class="form-group">
                                <label for="cvv">CVV</label>
                                <input type="text" id="cvv" placeholder="123" maxlength="4">
                                <span class="cvv-info" title="Código de seguridad de 3 o 4 dígitos">?</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cardName">Tipo De Targeta</label>
                            <input type="text" id="cardName" placeholder="Como aparece en la tarjeta">
                        </div>
                    </div>

                    <!-- Información para Pago en Efectivo -->
                    <div id="cashPayment" class="payment-details" style="display: none;">
                        <div class="cash-info">
                            <i class="fas fa-money-bill-wave"></i>
                            <h3>Pago en Efectivo</h3>
                            <p>Puedes pagar en efectivo al momento de la entrega o en nuestras sucursales autorizadas.</p>
                            <div class="cash-instructions">
                                <h4>Instrucciones:</h4>
                                <ul>
                                    <li>El pago se realiza al recibir el producto</li>
                                    <li>Aceptamos dólares y pesos colombainos</li>
                                    <li>Ten el monto exacto disponible</li>
                                    <li>Recibirás tu comprobante de pago</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Información para PayPal -->
                    <div id="paypalPayment" class="payment-details" style="display: none;">
                        <div class="paypal-info">
                            <i class="fab fa-paypal"></i>
                            <h3>Pago con PayPal</h3>
                            <p>Serás redirigido a PayPal para completar tu pago de forma segura.</p>
                            <button type="button" class="paypal-btn">
                                <i class="fab fa-paypal"></i>
                                Pagar con PayPal
                            </button>
                        </div>
                    </div>

                    <!-- Información de Contacto -->
                    <div class="contact-info">
                        <h3>Información de Contacto</h3>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" placeholder="tu@email.com" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="tel" id="phone" placeholder="+1 234 567 890" required>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="form-actions">
                        <button type="button" class="btn-back" onclick="window.history.back()">
                            <i class="fas fa-arrow-left"></i>
                            Volver al Carrito
                        </button>
                        <button type="submit" class="btn-pay">
                            <i class="fas fa-lock"></i>
                            Pagar Ahora
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<footer>
    <div class="footer-bottom">
        <div class="container">
            <p>&copy; 2025 NEX-TECH MECH-DOOM. Todos los derechos reservados.</p>
            <div class="security-badges">
                <i class="fas fa-lock" title="Conexión Segura"></i>
                <i class="fas fa-shield-alt" title="Protegido contra fraudes"></i>
                <i class="fas fa-credit-card" title="Pagos Seguros"></i>
            </div>
        </div>
    </div>
</footer>

<script src="../targetas.js"></script>
</body>
</html>