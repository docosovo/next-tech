<?php
session_start();

if(isset($_SESSION['nombre'])) {
    echo "Bienvenido: " . $_SESSION['nombre'];
    echo " | <a href='../php/salir.php'>Cerrar sesión</a>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEX-TECH MECH-DOOM - Tecnología al Alcance de Todos</title>
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="../css/inicio2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../imagenes/logo.jpg" type="image/x-icon">
    <!-- Información del proyecto NEX-TECH MECH-DOOM -->
    <meta name="description" content="NEX-TECH MECH-DOOM - Proyecto educativo de Fe y Alegría La Cima. Servicios técnicos y venta de componentes electrónicos en Medellín">
    <meta name="keywords" content="reparación computadores, servicio técnico, componentes electrónicos, Medellín, Arduino, sensores">
    <meta name="author" content="Arturo Villa, Daniel Castañeda">
</head>
<body>

<div class="search-overlay" id="searchOverlay">
  <div class="search-container">
    <form id="searchForm">
      <input type="text" id="searchInput" placeholder="Buscar productos, servicios..." autocomplete="off">
      <button type="submit"><i class="fas fa-search"></i></button>
      <!-- <span class="close-search" id="closeSearch">&times;</span>-->
    </form>
    <div class="search-results" id="searchResults"></div>
  </div>
</div>

<header>
    <nav>
        <div class="container">
            <div class="logo">
                <h1>NEX-TECH<span>MECH-DOOM</span></h1>
                <!-- Información del equipo -->
                <div class="team-info">
                    <p><strong>Proyecto:</strong> Fe y Alegría La Cima</p>
                    <p><strong>Integrantes:</strong> Arturo Villa | Daniel Castañeda</p>
                </div>
            </div>
            <ul class="nav-links">
                <li><a href="inicio.php" class="active">Inicio</a></li>
                <li><a href="#productos">Productos</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#soporte">Soporte en Casa</a></li>
                <li><a href="historia.html">Nosotros</a></li>
                <li><a href="contactos.html">Contacto</a></li>
            </ul>

<script>
        // Función para resaltar la sección activa en la navegación
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('nav a');
            
            // Manejar el clic en los enlaces de navegación
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Remover la clase activa de todos los enlaces
                    navLinks.forEach(l => l.classList.remove('active-section'));
                    
                    // Agregar la clase activa al enlace clickeado
                    this.classList.add('active-section');
                    
                    // Desplazamiento suave
                    const targetId = this.getAttribute('href');
                    if (targetId.startsWith('#')) {
                        e.preventDefault();
                        const targetSection = document.querySelector(targetId);
                        if (targetSection) {
                            window.scrollTo({
                                top: targetSection.offsetTop - 20,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });
            
            // Resaltar la sección actual al hacer scroll
            window.addEventListener('scroll', function() {
                let current = '';
                const sections = document.querySelectorAll('section');
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (pageYOffset >= (sectionTop - 60)) {
                        current = section.getAttribute('id');
                    }
                });
                
                navLinks.forEach(link => {
                    link.classList.remove('active-section');
                    if (link.getAttribute('href') === '#' + current) {
                        link.classList.add('active-section');
                    }
                });
            });
        });
    </script>



            <div class="nav-icons">
                <a href="#" id="searchToggle"><i class="fas fa-search"></i></a>
                <div class="user-dropdown">
                  <a href="#" id="userToggle"><i class="fas fa-user"></i></a>
                  <div class="user-dropdown-content" id="userDropdown">
                     <a href="iniciosesion.html"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</a>
                     <a href="crearusuario.html"><i class="fas fa-user-plus"></i> Registrarse</a>
                   </div>
                </div>
                <a href="#" id="cartToggle">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cartCount" class="cart-count">0</span>
                </a>
            </div>
        </div>
    </nav>
</header>

<div class="cart-modal" id="cartModal">
    <div class="cart-modal-content">
        <span class="close-cart" id="closeCart">&times;</span>
        <h2>Tu Carrito</h2>
        <ul id="cartItems"></ul>
        <div id="cartTotal"></div>
        <button id="checkoutBtn">Finalizar compra</button>
    </div>
</div>

<main>
    <section class="hero">
        <div class="hero-content">
            <h2>Tecnología que simplifica tu vida</h2>
            <p>Componentes electrónicos y soluciones personalizadas a tu alcance</p>
            <!-- Información de contacto del equipo -->
            <div class="contact-badges">
                <div class="contact-badge">
                    <i class="fas fa-user"></i>
                    <span>Arturo Villa: 3136531489</span>
                </div>
                <div class="contact-badge">
                    <i class="fas fa-user"></i>
                    <span>Daniel Castañeda: 3022137152</span>
                </div>
            </div>
            <a href="#servicios" class="btn">Explora nuestros servicios</a>
        </div>
    </section>

    <section id="soporte" class="categories">
        <div class="container">
            <h2 class="section-title">Nuestras Categorías</h2>
            <div class="category-grid">
                <div class="category-card">
                    <img src="../imagenes/componeentes electronicos.jpg" alt="Componentes Electrónicos">
                    <h3>Componentes Electrónicos</h3>
                    <p>Desde lo más común hasta piezas difíciles de encontrar</p>
                </div>
                <div class="category-card">
                    <img src="../imagenes/Soluciones Smart Home.jpg" alt="Soluciones Smart Home">
                    <h3>Soluciones Smart Home</h3>
                    <p>Controla tu hogar desde cualquier dispositivo</p>
                </div>
                <div class="category-card">
                    <img src="../imagenes/soporte personalizado.jpeg" alt="Soporte Técnico">
                    <h3>Soporte Técnico Personalizado</h3>
                    <p>Vamos hasta tu casa para resolver tus problemas</p>
                </div>
            </div>
        </div>
    </section>

    <section id="productos" class="featured-products">
        <div class="container">
            <h2 class="section-title">Productos Destacados</h2>
            <div class="product-grid" id="productGrid">
                <!-- Los productos destacados se insertan por JS -->
            </div>
        </div>
    </section>

    <section id="servicios" class="services">
        <div class="container">
            <h2 class="section-title">Nuestros Servicios</h2>
            <div class="service-grid">
                <div class="service-card">
                    <i class="fas fa-home"></i>
                    <h3>Soporte en Casa</h3>
                    <p>No solo vendemos tecnología, vamos hasta tu hogar para ayudarte a organizar todo y resolver problemas personalmente.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-mobile-alt"></i>
                    <h3>Control Remoto</h3>
                    <p>Monitorea y controla tus sistemas desde cualquier dispositivo: computadoras, celulares, televisores y más.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-cogs"></i>
                    <h3>Soluciones Personalizadas</h3>
                    <p>Creamos sistemas adaptados a tus necesidades específicas con componentes de calidad.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="about">
        <div class="container">
            <div class="about-content">
                <h2>Cambiando las reglas del juego tecnológico</h2>
                <p>Nuestra meta no es solo ofrecer tecnología, sino hacerla útil, fácil de usar y al alcance de todos. Con precios justos y servicio excepcional, estamos redefiniendo lo que significa comprar electrónica y recibir soporte técnico.</p>
                <!-- Información del proyecto -->
                <div class="project-details">
                    <p><strong>Proyecto Educativo:</strong> Institución Fe y Alegría La Cima</p>
                    <p><strong>Desarrollado por:</strong> Arturo Villa y Daniel Castañeda</p>
                    <p><strong>Contacto:</strong> villaarturo355@gmail.com | doco93229@gmail.com</p>
                </div>
                <a href="historia.html" class="btn">Conoce nuestra historia</a>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">Lo que dicen nuestros clientes</h2>
            <div class="testimonial-slider">
                <div class="testimonial-card">
                    <p>"Finalmente encontré todos los componentes que necesitaba para mi proyecto, y a precios justos. El soporte en casa fue increíblemente útil."</p>
                    <div class="client-info">
                        <h4>Carlos M.</h4>
                        <span>Ingeniero electrónico</span>
                    </div>
                </div>
                <div class="testimonial-card">
                    <p>"Configuraron todo mi sistema smart home y me enseñaron a usarlo. Ahora controlo todo desde mi teléfono fácilmente."</p>
                    <div class="client-info">
                        <h4>Ana R.</h4>
                        <span>Dueña de casa</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<footer>
    <div class="footer-top">
        <div class="container">
            <div class="footer-col">
                <h3>NEX-TECH MECH-DOOM</h3>
                <p>Proyecto educativo de la Institución Fe y Alegría La Cima. Especialistas en soluciones tecnológicas y servicios técnicos.</p>
                <div class="team-contact-footer">
                    <p><strong>Arturo Villa:</strong> villaarturo355@gmail.com</p>
                    <p><strong>Daniel Castañeda:</strong> doco93229@gmail.com</p>
                </div>
                <div class="footer-social">
                    <a href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com/"><i class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                    <a href="https://youtube.com/"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h3>Enlaces Rápidos</h3>
                <ul>
                    <li><a href="inicio.php">Inicio</a></li>
                    <li><a href="#productos">Productos</a></li>
                    <li><a href="#servicios">Servicios</a></li>
                    <li><a href="#soporte">Soporte en Casa</a></li>
                    <li><a href="contactos.html">Contacto</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Contacto</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> Institución Fe y Alegría La Cima</li>
                    <li><i class="fas fa-phone"></i> Arturo: 3136531489</li>
                    <li><i class="fas fa-phone"></i> Daniel: 3022137152</li>
                    <li><i class="fas fa-envelope"></i> villaarturo355@gmail.com</li>
                    <li><i class="fas fa-clock"></i> Lunes a Viernes: 9am - 6pm</li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Boletín Informativo</h3>
                <p>Suscríbete para recibir ofertas y consejos tecnológicos.</p>
                <form>
                    <input type="email" placeholder="Tu correo electrónico">
                    <button type="submit">Suscribirse</button>
                </form>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p>&copy; 2025 NEX-TECH MECH-DOOM. Todos los derechos reservados.</p>
            <div class="project-credits">
                <p><strong>Proyecto:</strong> Fe y Alegría La Cima | <strong>Desarrollado por:</strong> Arturo Villa & Daniel Castañeda</p>
            </div>
            <div class="payment-methods">
                <i class="fab fa-cc-visa" title="Visa"></i>
                <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                <i class="fab fa-cc-paypal" title="PayPal"></i>
                <i class="fab fa-cc-amex" title="American Express"></i>
            </div>
        </div>
    </div>
</footer>

<div class="product-modal" id="productModal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <div class="modal-product-details" id="modalProductDetails">
        </div>
    </div>
</div>

<script src="../inicio.js"></script>

<script>
// CÓDIGO ORIGINAL DEL CARRITO - SOLO ACTUALIZADO PARA FUNCIONAR MEJOR
const cart = [];
const cartCount = document.getElementById('cartCount');
const cartModal = document.getElementById('cartModal');
const cartItems = document.getElementById('cartItems');
const cartTotal = document.getElementById('cartTotal');
const cartToggle = document.getElementById('cartToggle');
const closeCart = document.getElementById('closeCart');

// PRODUCTOS DESTACADOS - MANTENIENDO EL FORMATO ORIGINAL
const featuredProducts = [
    { id: 1, name: "Kit Arduino Uno R3", price: 25000 },
    { id: 2, name: "Resistores 1/4W Pack 100", price: 5000 },
    { id: 3, name: "Sensor de Movimiento PIR", price: 15000 },
    { id: 4, name: "Hub Smart Home WiFi", price: 45000 },
    { id: 5, name: "Soporte Técnico Premium", price: 75000 },
    { id: 6, name: "Display LCD 16x2", price: 12000 }
];

// CARGAR PRODUCTOS DESTACADOS - CÓDIGO ORIGINAL
document.addEventListener('DOMContentLoaded', function() {
  const grid = document.getElementById('productGrid');
  if (grid) {
    featuredProducts.forEach(prod => {
      const div = document.createElement('div');
      div.className = 'product-card';
      div.innerHTML = `
        <div class="product-info" style="display:flex;align-items:center;justify-content:space-between;">
          <div>
            <h3 style="margin-bottom:5px;">${prod.name}</h3>
            <div class="product-price">$${prod.price.toLocaleString()}</div>
          </div>
          <button class="add-to-cart-btn" title="Añadir al carrito" onclick="addToCart(${prod.id});return false;" style="background:#34495e;color:#fff;border:none;padding:8px 12px;border-radius:4px;cursor:pointer;font-weight:bold;">
            Añadir al carrito
          </button>
        </div>
      `;
      grid.appendChild(div);
    });
  }
});

// FUNCIÓN MEJORADA PARA AGREGAR AL CARRITO
window.addToCart = function(productId) {
  const product = featuredProducts.find(p => p.id === productId);
  if (!product) return;
  
  // Buscar si el producto ya está en el carrito
  const existingItem = cart.find(item => item.id === productId);
  if (existingItem) {
    existingItem.qty += 1;
  } else {
    cart.push({
      id: product.id,
      name: product.name,
      price: product.price,
      qty: 1
    });
  }
  
  updateCartUI();
  showAddToCartNotification(product.name);
};

// FUNCIÓN PARA MOSTRAR NOTIFICACIÓN
function showAddToCartNotification(productName) {
  // Crear notificación
  const notification = document.createElement('div');
  notification.style.cssText = `
    position: fixed;
    top: 100px;
    right: 20px;
    background: #27ae60;
    color: white;
    padding: 15px 20px;
    border-radius: 5px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    z-index: 10000;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: bold;
  `;
  notification.innerHTML = `
    <i class="fas fa-check-circle"></i>
    <span>${productName} agregado al carrito</span>
  `;
  
  document.body.appendChild(notification);
  
  // Remover después de 3 segundos
  setTimeout(() => {
    if (notification.parentNode) {
      notification.parentNode.removeChild(notification);
    }
  }, 3000);
}

// FUNCIÓN MEJORADA PARA ACTUALIZAR EL CARRITO
function updateCartUI() {
  // Actualizar contador
  const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
  cartCount.textContent = totalItems;
  
  // Actualizar items del carrito
  cartItems.innerHTML = '';
  let total = 0;
  
  cart.forEach(item => {
    const itemTotal = item.price * item.qty;
    total += itemTotal;
    
    const li = document.createElement('li');
    li.innerHTML = `
      <span class="cart-item-name">${item.name}</span>
      <div style="display: flex; align-items: center; gap: 5px; margin: 5px 0;">
        <button onclick="decreaseQuantity(${item.id})" style="background:#34495e;color:#fff;border:none;width:25px;height:25px;border-radius:3px;cursor:pointer;">-</button>
        <span class="cart-item-qty">${item.qty}</span>
        <button onclick="increaseQuantity(${item.id})" style="background:#34495e;color:#fff;border:none;width:25px;height:25px;border-radius:3px;cursor:pointer;">+</button>
      </div>
      <span class="cart-item-price">$${itemTotal.toLocaleString()}</span>
      <span class="cart-item-remove" onclick="removeFromCart(${item.id})" title="Eliminar">&times;</span>
    `;
    cartItems.appendChild(li);
  });
  
  cartTotal.textContent = 'Total: $' + total.toLocaleString();
  
  // Guardar en localStorage
  localStorage.setItem('cart', JSON.stringify(cart));
}

// FUNCIONES PARA MANEJAR CANTIDADES
window.increaseQuantity = function(productId) {
  const item = cart.find(i => i.id === productId);
  if (item) {
    item.qty += 1;
    updateCartUI();
  }
};

window.decreaseQuantity = function(productId) {
  const item = cart.find(i => i.id === productId);
  if (item && item.qty > 1) {
    item.qty -= 1;
    updateCartUI();
  } else {
    removeFromCart(productId);
  }
};

window.removeFromCart = function(productId) {
  const index = cart.findIndex(i => i.id === productId);
  if (index !== -1) {
    cart.splice(index, 1);
    updateCartUI();
  }
};

// CARGAR CARRITO DESDE LOCALSTORAGE AL INICIAR
document.addEventListener('DOMContentLoaded', function() {
  const savedCart = localStorage.getItem('cart');
  if (savedCart) {
    const parsedCart = JSON.parse(savedCart);
    cart.length = 0; // Limpiar array
    cart.push(...parsedCart); // Agregar items guardados
    updateCartUI();
  }
});

// MANEJAR MODAL DEL CARRITO - CÓDIGO ORIGINAL
cartToggle.addEventListener('click', function(e) {
  e.preventDefault();
  cartModal.classList.add('active');
});

closeCart.addEventListener('click', function() {
  cartModal.classList.remove('active');
});

document.addEventListener('click', function(e) {
  if (cartModal.classList.contains('active') && e.target === cartModal) {
    cartModal.classList.remove('active');
  }
});

// BOTÓN CHECKOUT - CÓDIGO ORIGINAL
const checkoutBtn = document.getElementById('checkoutBtn');
if (checkoutBtn) {
  checkoutBtn.addEventListener('click', function() {
    if (cart.length === 0) {
      alert('Tu carrito está vacío.');
      return;
    }
    localStorage.setItem('cartData', JSON.stringify(cart));
    window.location.href = 'targetas.php';
  });
}

// BUSCADOR - CÓDIGO ORIGINAL
//document.addEventListener('DOMContentLoaded', function() {
//    const searchInput = document.getElementById('searchInput');
//    const searchResults = document.getElementById('searchResults');
//
//    searchInput.addEventListener('input', function() {
//        const query = this.value.trim();
//        
//        if (query.length > 2) {
//            fetch(`buscar.php?q=${encodeURIComponent(query)}`)
//                .then(response => response.json())
//                .then(data => showResults(data))
//                .catch(error => console.error('Error:', error));
//        } else {
//            searchResults.style.display = 'none';
//        }
//    });

//    function showResults(products) {
//        if (products.length === 0) {
//            searchResults.innerHTML = '<div class="no-results">No se encontraron productos</div>';
//            searchResults.style.display = 'block';
//            return;
//        }
//
//        let html = '<ul class="suggestions-list">';
//        products.forEach(product => {
//            html += `
//                <li class="suggestion-item">
//                    <a href="producto.php?id=${product.id}" class="suggestion-link">
//                        <img src="${product.imagen_principal}" alt="${product.nombre}" width="50">
//                        <div class="suggestion-content">
//                            <span class="suggestion-text">${product.nombre}</span>
//                            <span class="suggestion-category">${product.categoria}</span>
//                        </div>
//                        <span class="suggestion-price">$${product.precio.toFixed(2)}</span>
//                    </a>
//                </li>
//            `;
//      });
//        html += '</ul>';
//        
//        searchResults.innerHTML = html;
//        searchResults.style.display = 'block';
//    }
//});

// BUSCADOR OVERLAY - CÓDIGO ORIGINAL
//document.addEventListener('DOMContentLoaded', function() {
//  const searchOverlay = document.getElementById('searchOverlay');
//  const searchToggle = document.getElementById('searchToggle');
//  const searchForm = document.getElementById('searchForm');
//  const searchInput = document.getElementById('searchInput');
//  const searchResults = document.getElementById('searchResults');
//  const closeSearch = document.getElementById('closeSearch');
//
//  const products = [
//    {id: 1, name: "Kit Arduino Uno", category: "Electrónica", url: "producto1.html"},
//    {id: 2, name: "Resistores 1/4W", category: "Componentes", url: "producto2.html"},
//    {id: 3, name: "Sensor de Movimiento", category: "Smart Home", url: "producto3.html"},
//    {id: 4, name: "Hub Smart Home", category: "Smart Home", url: "producto4.html"},
//    {id: 5, name: "Soporte Técnico Premium", category: "Soporte Técnico Personalizado", url: "producto5.html"}
//  ];

//  searchToggle.addEventListener('click', function(e) {
//    e.preventDefault();
//    searchOverlay.classList.add('active');
//    searchInput.focus();
//  });

//  closeSearch.addEventListener('click', function() {
//    searchOverlay.classList.remove('active');
//  });

//  searchForm.addEventListener('submit', function(e) {
//    e.preventDefault();
//    const query = searchInput.value.trim();
//    
//    if (!query) {
//      searchResults.style.display = 'none';
//      return;
//    }
    
//    const results = getMatchingProducts(query);
    
//    if (results.length === 0) {
//      window.location.href = `https://www.google.com/search?q=${encodeURIComponent(query)}`;
//    } else if (results.length === 1) {
//      window.location.href = results[0].url;
//    } else {
//      showSuggestions(results);
//    }
//  });

//  searchInput.addEventListener('input', function() {
//    const query = this.value.trim();
//    
//    if (query.length > 2) { 
//      const results = getMatchingProducts(query);
//      showSuggestions(results);
//    } else {
//      searchResults.style.display = 'none';
//    }
//  });

//  function getMatchingProducts(query) {
//    const lowerQuery = query.toLowerCase();
//    return products.filter(product => 
//      product.name.toLowerCase().includes(lowerQuery) || 
//      product.category.toLowerCase().includes(lowerQuery)
//    );
//  }

//  function showSuggestions(results) {
//    if (results.length === 0) {
//      searchResults.style.display = 'none';
//      return;
//    }
    
//    let html = '<ul class="suggestions-list">';
//    results.forEach(item => {
//      html += `
//        <li class="suggestion-item">
//          <a href="${item.url}" class="suggestion-link">
//            <span class="suggestion-text">${item.name}</span>
//            <span class="suggestion-category">${item.category}</span>
//          </a>
//        </li>
//      `;
//    });
//    html += '</ul>';
//    
//    searchResults.innerHTML = html;
//    searchResults.style.display = 'block';
//  }
//
//  searchOverlay.addEventListener('click', function(e) {
//    if (e.target === searchOverlay) {
//      searchOverlay.classList.remove('active');
//      searchResults.style.display = 'none';
//    }
//  });
//});

// DROPDOWN USUARIO - CÓDIGO ORIGINAL
document.addEventListener('DOMContentLoaded', function() {
    const userToggle = document.getElementById('userToggle');
    const userDropdown = document.getElementById('userDropdown');
    const userDropdownContainer = document.querySelector('.user-dropdown');

    if (userToggle) {
        userToggle.addEventListener('click', function(e) {
            e.preventDefault();
            userDropdownContainer.classList.toggle('active');
        });

        document.addEventListener('click', function(e) {
            if (!userDropdownContainer.contains(e.target)) {
                userDropdownContainer.classList.remove('active');
            }
        });
    }
});
</script>

</body>
</html>