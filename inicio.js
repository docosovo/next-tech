document.addEventListener('DOMContentLoaded', function() {
    const products = [
        {
            id: 1,
            name: "Kit de Desarrollo Arduino",
            price: 45.99,
            image: "../imagenes/KitDesarrolloArduino.jpg",
            category: "Kit de Desarrollo de Arduino",
            description: "Kit completo para comenzar con proyectos de electrónica basados en Arduino.",
        },
        {
            id: 2,
            name: "Sensor de Movimiento PIR",
            price: 8.50,
            image: "../imagenes/sensor-de-movimiento-pir.jpg",
            category: "Sensor de Movimiento PIR",
            description: "Sensor de movimiento pasivo infrarrojo para detectar presencia humana.",
        },
        {
            id: 3,
            name: "Hub Smart Home",
            price: 89.99,
            image: "../imagenes/HubSmartHome.jpg",
            category: "Soluciones Smart Home",
            description: "Centraliza el control de todos tus dispositivos inteligentes.",
        },
        {
            id: 4,
            name: "Display OLED 1.3\"",
            price: 12.75,
            image: "../imagenes/DisplayOLED1.3.webp",
            category: "Componentes Electrónicos",
            description: "Pantalla OLED de alta resolución para tus proyectos electrónicos.",
        },
        {
            id: 5,
            name: "Kit de Reparación Electrónica",
            price: 29.99,
            image: "../imagenes/KitReparaciónElectrónica.jpg",
            category: "Componentes Electrónicos",
            description: "Todo lo necesario para reparaciones electrónicas básicas.",
        },
        {
            id: 6,
            name: "Soporte Técnico Premium",
            price: 99.99,
            image: "../imagenes/SoporteTécnicoPremium.png",
            category: "Soporte Técnico Personalizado",
            description: "Suscripción mensual a nuestro servicio premium de soporte técnico.",
        }
    ];

    // Variables del carrito
    let cart = [];
    let cartCount = 0;


    //tengo mucha hambre profe, invite a alguna cosita :)

    // Elementos del DOM del carrito
    const cartToggle = document.getElementById('cartToggle');
    const cartModal = document.getElementById('cartModal');
    const closeCart = document.getElementById('closeCart');
    const cartCountElement = document.getElementById('cartCount');
    const cartItems = document.getElementById('cartItems');
    const cartTotal = document.getElementById('cartTotal');
    const checkoutBtn = document.getElementById('checkoutBtn');

    // Función para mostrar productos
    function displayProducts(productsToShow) {
        const productGrid = document.getElementById('productGrid');
        productGrid.innerHTML = '';

        productsToShow.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'product-card';
            productCard.innerHTML = `
                <div class="product-img">
                    <img src="${product.image}" alt="${product.name}">
                </div>
                <div class="product-info">
                    <h3>${product.name}</h3>
                    <div class="product-price">$${product.price.toFixed(2)}</div>
                    <div class="product-category">${product.category}</div>
                    <div class="product-actions">
                        <a href="#" class="view-details" data-id="${product.id}">Ver detalles</a>
                        <a href="#" class="add-to-cart" data-id="${product.id}">Añadir al carrito</a>
                    </div>
                </div>
            `;
            productGrid.appendChild(productCard);
        });

        // Evento para mostrar el modal con los detalles
        document.querySelectorAll('.view-details').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const id = parseInt(this.getAttribute('data-id'));
                const product = products.find(p => p.id === id);
                showProductModal(product);
            });
        });

        // Evento para agregar al carrito desde la tarjeta del producto
        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const id = parseInt(this.getAttribute('data-id'));
                const product = products.find(p => p.id === id);
                addToCart(product);
                
                // Feedback visual
                const originalText = this.textContent;
                this.textContent = '✓ Agregado';
                this.style.backgroundColor = '#4CAF50';
                
                setTimeout(() => {
                    this.textContent = originalText;
                    this.style.backgroundColor = '';
                }, 1500);
            });
        });
    }

    // Función para mostrar el modal de detalles
    function showProductModal(product) {
        const modal = document.getElementById('productModal');
        const modalDetails = document.getElementById('modalProductDetails');
        modalDetails.innerHTML = `
            <div class="modal-product-img">
                <img src="${product.image}" alt="${product.name}">
            </div>
            <div class="modal-product-info">
                <h2>${product.name}</h2>
                <div class="modal-product-category">${product.category}</div>
                <div class="modal-product-description">${product.description}</div>
                <div class="modal-product-price">$${product.price.toFixed(2)}</div>
                <button class="add-to-cart-from-modal" data-id="${product.id}">
                    Añadir al carrito
                </button>
            </div>
        `;
        modal.classList.add('active');

        // Evento para agregar al carrito desde el modal
        const addToCartBtn = modalDetails.querySelector('.add-to-cart-from-modal');
        addToCartBtn.addEventListener('click', function() {
            addToCart(product);
            
            // Feedback visual
            const originalText = this.textContent;
            this.textContent = '✓ Agregado al carrito';
            this.style.backgroundColor = '#4CAF50';
            
            setTimeout(() => {
                this.textContent = originalText;
                this.style.backgroundColor = '';
            }, 1500);
        });
    }

    // FUNCIONES DEL CARRITO

    // Función para agregar productos al carrito
    function addToCart(product) {
        // Buscar si el producto ya está en el carrito
        const existingProduct = cart.find(item => item.id === product.id);
        
        if (existingProduct) {
            existingProduct.quantity += 1;
        } else {
            cart.push({
                ...product,
                quantity: 1
            });
        }
        
        updateCart();
        saveCartToLocalStorage();
    }

    // Función para actualizar la visualización del carrito
    function updateCart() {
        // Actualizar contador
        cartCount = cart.reduce((total, item) => total + item.quantity, 0);
        cartCountElement.textContent = cartCount;
        
        // Actualizar lista de productos
        cartItems.innerHTML = '';
        let total = 0;
        
        if (cart.length === 0) {
            cartItems.innerHTML = '<li class="empty-cart">Tu carrito está vacío</li>';
            cartTotal.innerHTML = '<h3>Total: $0.00</h3>';
            return;
        }
        
        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            
            const li = document.createElement('li');
            li.className = 'cart-item';
            li.innerHTML = `
                <div class="cart-item-info">
                    <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                    <div class="cart-item-details">
                        <span class="cart-item-name">${item.name}</span>
                        <span class="cart-item-price">$${item.price.toFixed(2)} c/u</span>
                    </div>
                </div>
                <div class="cart-item-controls">
                    <div class="quantity-controls">
                        <button class="decrease-item" data-id="${item.id}">-</button>
                        <span class="item-quantity">${item.quantity}</span>
                        <button class="increase-item" data-id="${item.id}">+</button>
                    </div>
                    <span class="cart-item-total">$${itemTotal.toFixed(2)}</span>
                    <button class="remove-item" data-id="${item.id}">🗑️</button>
                </div>
            `;
            cartItems.appendChild(li);
        });
        
        // Actualizar total
        cartTotal.innerHTML = `
            <div class="cart-total-container">
                <h3>Total: $${total.toFixed(2)}</h3>
                <button id="checkoutBtn">Finalizar compra</button>
            </div>
        `;
        
        // Agregar event listeners a los botones del carrito
        addCartItemEventListeners();
    }

    // Función para agregar event listeners a los botones del carrito
    function addCartItemEventListeners() {
        // Botones de eliminar
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', (e) => {
                const productId = parseInt(e.target.getAttribute('data-id'));
                removeFromCart(productId);
            });
        });
        
        // Botones de disminuir cantidad
        document.querySelectorAll('.decrease-item').forEach(button => {
            button.addEventListener('click', (e) => {
                const productId = parseInt(e.target.getAttribute('data-id'));
                decreaseQuantity(productId);
            });
        });
        
        // Botones de aumentar cantidad
        document.querySelectorAll('.increase-item').forEach(button => {
            button.addEventListener('click', (e) => {
                const productId = parseInt(e.target.getAttribute('data-id'));
                increaseQuantity(productId);
            });
        });

        // Botón de finalizar compra
        const checkoutBtn = document.getElementById('checkoutBtn');
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', handleCheckout);
        }
    }

    // Funciones para manipular el carrito
    function removeFromCart(productId) {
        cart = cart.filter(item => item.id !== productId);
        updateCart();
        saveCartToLocalStorage();
    }

    function decreaseQuantity(productId) {
        const product = cart.find(item => item.id === productId);
        if (product) {
            if (product.quantity > 1) {
                product.quantity -= 1;
            } else {
                removeFromCart(productId);
            }
            updateCart();
            saveCartToLocalStorage();
        }
    }

    function increaseQuantity(productId) {
        const product = cart.find(item => item.id === productId);
        if (product) {
            product.quantity += 1;
            updateCart();
            saveCartToLocalStorage();
        }
    }

    function handleCheckout() {
        if (cart.length === 0) {
            alert('El carrito está vacío');
            return;
        }
        alert('¡Gracias por tu compra! Redirigiendo al proceso de pago...');
        // Aquí iría la lógica de redirección al checkout
        cart = [];
        updateCart();
        saveCartToLocalStorage();
        cartModal.style.display = 'none';
    }

    // LocalStorage functions
    function saveCartToLocalStorage() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    function loadCartFromLocalStorage() {
        const savedCart = localStorage.getItem('cart');
        if (savedCart) {
            cart = JSON.parse(savedCart);
            updateCart();
        }
    }

    // EVENT LISTENERS PARA EL MODAL DEL CARRITO
    if (cartToggle) {
        cartToggle.addEventListener('click', (e) => {
            e.preventDefault();
            cartModal.style.display = 'block';
        });
    }

    if (closeCart) {
        closeCart.addEventListener('click', () => {
            cartModal.style.display = 'none';
        });
    }

    if (cartModal) {
        window.addEventListener('click', (e) => {
            if (e.target === cartModal) {
                cartModal.style.display = 'none';
            }
        });
    }

    // Código existente para el modal de productos
    const modal = document.getElementById('productModal');
    if (modal) {
        const closeModal = modal.querySelector('.close-modal');
        closeModal.addEventListener('click', function() {
            modal.classList.remove('active');
        });
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });
    }

    // Código existente para la búsqueda (mantener igual)
    const searchOverlay = document.getElementById('searchOverlay');
    const searchToggle = document.getElementById('searchToggle');
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    const closeSearch = document.getElementById('closeSearch');

    if (searchToggle) {
        searchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            searchOverlay.classList.add('active');
            searchInput.focus();
        });
    }

    if (closeSearch) {
        closeSearch.addEventListener('click', function() {
            searchOverlay.classList.remove('active');
        });
    }

    // Función de búsqueda
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = searchInput.value.trim();
            
            if (!query) {
                searchResults.style.display = 'none';
                return;
            }
            
            const results = getMatchingProducts(query);
            
            if (results.length === 0) {
                searchResults.innerHTML = `
                    <div class="no-results">
                        <p>No encontramos resultados para "${query}"</p>
                        <a href="#">¿Necesitas ayuda?</a>
                    </div>
                `;
                searchResults.style.display = 'block';
            } else {
                showSuggestions(results);
            }
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            
            if (query.length > 1) {
                const results = getMatchingProducts(query);
                showSuggestions(results);
            } else {
                searchResults.style.display = 'none';
            }
        });
    }

    function getMatchingProducts(query) {
        const lowerQuery = query.toLowerCase();
        return products.filter(product => 
            product.name.toLowerCase().includes(lowerQuery) || 
            product.category.toLowerCase().includes(lowerQuery)
        );
    }

    function showSuggestions(results) {
        if (results.length === 0) {
            searchResults.innerHTML = `
                <div class="no-results">
                    <p>No encontramos resultados</p>
                    <a href="#">¿Necesitas ayuda?</a>
                </div>
            `;
            searchResults.style.display = 'block';
            return;
        }
        
        let html = '<ul class="suggestions-list">';
        results.forEach(item => {
            html += `
                <li class="suggestion-item">
                    <a href="#" class="suggestion-link" data-id="${item.id}">
                        <div class="suggestion-content">
                            <span class="suggestion-text">${item.name}</span>
                            <span class="suggestion-category">${item.category}</span>
                        </div>
                        <span class="suggestion-price">$${item.price.toFixed(2)}</span>
                    </a>
                </li>
            `;
        });
        html += '</ul>';
        
        searchResults.innerHTML = html;
        searchResults.style.display = 'block';

        // Agregar event listeners a los resultados de búsqueda
        document.querySelectorAll('.suggestion-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const id = parseInt(this.getAttribute('data-id'));
                const product = products.find(p => p.id === id);
                showProductModal(product);
                searchOverlay.classList.remove('active');
                searchResults.style.display = 'none';
            });
        });
    }

    if (searchOverlay) {
        searchOverlay.addEventListener('click', function(e) {
            if (e.target === searchOverlay) {
                searchOverlay.classList.remove('active');
                searchResults.style.display = 'none';
            }
        });
    }

    // INICIALIZACIÓN
    displayProducts(products);
    loadCartFromLocalStorage();


    function handleCheckout() {
    if (cart.length === 0) {
        alert('El carrito está vacío');
        return;
    }
    
    // Guardar el carrito actual en localStorage para usarlo en targetas.php
    saveCartToLocalStorage();
    
    // Redirigir a targetas.php
    window.location.href = 'targetas.php';
}   
    
});