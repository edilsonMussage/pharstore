<?php
include 'db_config.php';
include 'header.php';
?>

<main class="py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Meu Carrinho</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Itens do Carrinho -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div id="cart-items">
                        <!-- Itens serão carregados via JavaScript -->
                        <div class="text-center py-8">
                            <i class="fas fa-shopping-cart text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">Seu carrinho está vazio</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Resumo do Pedido -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Resumo do Pedido</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold" id="subtotal">0,00 MZN</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Taxa de entrega</span>
                            <span class="font-semibold" id="delivery">200,00 MZN</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span id="total">200,00 MZN</span>
                        </div>
                    </div>
                    
                    <!-- Checkout Button -->
                    <button id="checkout-button" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        <i class="fas fa-credit-card mr-2"></i>Finalizar Compra
                    </button>
                    
                    <!-- Pagamento M-Pesa -->
                    <div class="mt-4 p-4 bg-green-50 rounded-lg border border-green-200">
                        <div class="flex items-center mb-2">
                            <i class="fab fa-cc-mpesa text-green-600 text-xl mr-2"></i>
                            <span class="font-semibold text-green-800">Pagamento via M-Pesa</span>
                        </div>
                        <p class="text-sm text-green-600">Pague facilmente usando M-Pesa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cartItemsContainer = document.getElementById('cart-items');
    const subtotalElement = document.getElementById('subtotal');
    const totalElement = document.getElementById('total');
    const checkoutButton = document.getElementById('checkout-button');
    
    function loadCartItems() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-shopping-cart text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Seu carrinho está vazio</p>
                    <a href="produtos.php" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        Continuar Comprando
                    </a>
                </div>
            `;
            checkoutButton.disabled = true;
            return;
        }
        
        // Buscar detalhes dos produtos
        fetchCartProducts(cart);
    }
    
    async function fetchCartProducts(cart) {
        try {
            const productIds = cart.map(item => item.productId).join(',');
            const response = await fetch(`get_cart_products.php?ids=${productIds}`);
            const products = await response.json();
            
            displayCartItems(cart, products);
        } catch (error) {
            console.error('Erro ao carregar produtos:', error);
        }
    }
    
    function displayCartItems(cart, products) {
        let subtotal = 0;
        let html = '';
        
        cart.forEach(cartItem => {
            const product = products.find(p => p.id == cartItem.productId);
            if (product) {
                const itemTotal = product.price * cartItem.quantity;
                subtotal += itemTotal;
                
                html += `
                    <div class="flex items-center space-x-4 py-4 border-b" data-product-id="${product.id}">
                        <img src="${product.image_url}" alt="${product.name}" class="w-20 h-20 object-cover rounded-lg">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">${product.name}</h3>
                            <p class="text-gray-600 text-sm">${product.price} MZN</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="quantity-btn decrease w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100" data-product-id="${product.id}">-</button>
                            <span class="quantity w-12 text-center">${cartItem.quantity}</span>
                            <button class="quantity-btn increase w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100" data-product-id="${product.id}">+</button>
                        </div>
                        <div class="text-right">
                            <span class="font-semibold item-total">${itemTotal.toFixed(2)} MZN</span>
                            <button class="remove-item block mt-1 text-red-600 hover:text-red-800 text-sm" data-product-id="${product.id}">
                                <i class="fas fa-trash"></i> Remover
                            </button>
                        </div>
                    </div>
                `;
            }
        });
        
        cartItemsContainer.innerHTML = html;
        updateTotals(subtotal);
        attachEventListeners();
    }
    
    function updateTotals(subtotal) {
        const delivery = 200;
        const total = subtotal + delivery;
        
        subtotalElement.textContent = `${subtotal.toFixed(2)} MZN`;
        totalElement.textContent = `${total.toFixed(2)} MZN`;
        
        checkoutButton.disabled = subtotal === 0;
    }
    
    function attachEventListeners() {
        // Botões de quantidade
        document.querySelectorAll('.quantity-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const isIncrease = this.classList.contains('increase');
                updateQuantity(productId, isIncrease);
            });
        });
        
        // Botões de remover
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                removeFromCart(productId);
            });
        });
    }
    
    function updateQuantity(productId, isIncrease) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const item = cart.find(item => item.productId === productId);
        
        if (item) {
            if (isIncrease) {
                item.quantity++;
            } else {
                item.quantity--;
                if (item.quantity <= 0) {
                    cart = cart.filter(item => item.productId !== productId);
                }
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCartItems();
            updateCartCount();
        }
    }
    
    function removeFromCart(productId) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart = cart.filter(item => item.productId !== productId);
        localStorage.setItem('cart', JSON.stringify(cart));
        loadCartItems();
        updateCartCount();
    }
    
    // Finalizar compra
    checkoutButton.addEventListener('click', function() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        if (cart.length === 0) return;
        
        // Simulação de pagamento M-Pesa
        processMPesaPayment();
    });
    
    function processMPesaPayment() {
        const total = parseFloat(totalElement.textContent);
        
        // Simulação de API M-Pesa
        alert(`Redirecionando para M-Pesa...\nValor: ${total} MZN\n\nEm produção, aqui integraria com a API real do M-Pesa.`);
        
        // Limpar carrinho após "pagamento"
        localStorage.removeItem('cart');
        loadCartItems();
        updateCartCount();
        
        // Mostrar confirmação
        showNotification('Compra realizada com sucesso! Obrigado pela sua compra.', 'success');
    }
    
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        } z-50`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 5000);
    }
    
    // Inicializar
    loadCartItems();
});
</script>

<?php
include 'footer.php';
?>