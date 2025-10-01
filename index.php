<?php
include 'db_config.php';
include 'header.php';
?>

<!-- Main Content -->
<main>
    <!-- Hero Section com Slider -->
    <section class="hero-section relative text-white py-24 sm:py-32 overflow-hidden">
        <!-- Slider de Imagens -->
        <div class="absolute inset-0 z-0">
            <div class="slider-container relative w-full h-full">
                <!-- Slide 1 -->
                <div class="slide absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat opacity-100 transition-opacity duration-1000" 
                     style="background-image: url('https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80')">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                </div>
                
                <!-- Slide 2 -->
                <div class="slide absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat opacity-0 transition-opacity duration-1000" 
                     style="background-image: url('1232.jpg')">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                </div>
                
                <!-- Slide 3 -->
                <div class="slide absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat opacity-0 transition-opacity duration-1000" 
                     style="background-image: url('https://images.unsplash.com/photo-1551601651-2a8555f1a136?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80')">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                </div>
            </div>
        </div>

        <!-- Conteúdo do Hero -->
        <div class="container mx-auto text-center px-6 relative z-10">
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-4 animate-fade-in-up">Bem-vindo à Clínica Muahivire</h1>
            <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto animate-fade-in-up animation-delay-200">Cuidamos da sua saúde com profissionais qualificados e produtos farmacêuticos de qualidade.</p>
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up animation-delay-400">
                <a href="agendamento.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full transition duration-300">
                    <i class="fas fa-calendar-check mr-2"></i>Agendar Consulta
                </a>
                <a href="produtos.php" class="bg-white hover:bg-gray-100 text-blue-600 font-bold py-3 px-8 rounded-full transition duration-300">
                    <i class="fas fa-shopping-cart mr-2"></i>Ver Produtos
                </a>
            </div>
        </div>
        

        <!-- Indicadores do Slider -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10 flex space-x-3">
            <button class="slider-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all duration-300 active" data-slide="0"></button>
            <button class="slider-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all duration-300" data-slide="1"></button>
            <button class="slider-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all duration-300" data-slide="2"></button>
        </div>

        <!-- Botões de Navegação -->
        <button class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-3 rounded-full transition-all duration-300 slider-prev">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-3 rounded-full transition-all duration-300 slider-next">
            <i class="fas fa-chevron-right"></i>
        </button>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 text-center">
             <h2 class="text-3xl font-bold text-gray-800 mb-2">Nossas Categorias</h2>
             <p class="text-gray-600 mb-12">Explore nossa vasta gama de produtos de saúde.</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <?php
                // Busca as categorias no banco de dados
                $sql_categories = "SELECT id, name, icon_class, color_class FROM categories";
                $result_categories = $conn->query($sql_categories);

                if ($result_categories->num_rows > 0) {
                    // Exibe cada categoria dinamicamente
                    while($row = $result_categories->fetch_assoc()) {
                        echo '<a href="categoria.php?id=' . $row['id'] . '" class="flex flex-col items-center p-6 bg-gray-100 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">';
                        echo '    <div class="' . htmlspecialchars($row["color_class"]) . ' text-white rounded-full p-5 mb-4">';
                        echo '        <i class="' . htmlspecialchars($row["icon_class"]) . ' fa-2x"></i>';
                        echo '    </div>';
                        echo '    <h3 class="font-semibold text-lg text-gray-800">' . htmlspecialchars($row["name"]) . '</h3>';
                        echo '</a>';
                    }
                } else {
                    echo "<p>Nenhuma categoria encontrada.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Produtos em Destaque</h2>
            <p class="text-gray-600 mb-12 text-center">Os produtos mais procurados pelos nossos clientes.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <?php
                // Busca os produtos em destaque no banco de dados
                $sql_products = "SELECT id, name, description, price, image_url, stock_quantity FROM products WHERE is_featured = 1 LIMIT 8";
                $result_products = $conn->query($sql_products);

                if ($result_products->num_rows > 0) {
                    // Exibe cada produto dinamicamente
                    while($row = $result_products->fetch_assoc()) {
                ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-all duration-300">
                        <a href="produto.php?id=<?php echo $row['id']; ?>">
                            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="w-full h-48 object-cover hover:scale-105 transition duration-300">
                        </a>
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2 text-gray-800">
                                <a href="produto.php?id=<?php echo $row['id']; ?>" class="hover:text-blue-600 transition duration-300">
                                    <?php echo htmlspecialchars($row['name']); ?>
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2"><?php echo htmlspecialchars($row['description']); ?></p>
                            
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-2xl font-bold text-blue-600"><?php echo number_format($row['price'], 2, ',', '.'); ?> MZN</span>
                                <span class="text-sm <?php echo $row['stock_quantity'] > 0 ? 'text-green-600' : 'text-red-600'; ?>">
                                    <i class="fas <?php echo $row['stock_quantity'] > 0 ? 'fa-check' : 'fa-times'; ?> mr-1"></i>
                                    <?php echo $row['stock_quantity'] > 0 ? 'Em stock' : 'Fora de stock'; ?>
                                </span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <a href="produto.php?id=<?php echo $row['id']; ?>" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                    Ver detalhes
                                </a>
                                <button class="bg-blue-600 text-white px-4 py-2 rounded-full font-semibold hover:bg-blue-700 transition duration-300 add-to-cart <?php echo $row['stock_quantity'] == 0 ? 'opacity-50 cursor-not-allowed' : ''; ?>" 
                                        data-product-id="<?php echo $row['id']; ?>" 
                                        <?php echo $row['stock_quantity'] == 0 ? 'disabled' : ''; ?>>
                                    <i class="fas fa-cart-plus mr-2"></i>Adicionar
                                </button>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                } else {
                    echo "<p class='col-span-4 text-center text-gray-600 py-8'>Nenhum produto em destaque encontrado.</p>";
                }
                ?>
            </div>
            
            <!-- View All Products Button -->
            <div class="text-center mt-12">
                <a href="produtos.php" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-blue-700 transition duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-store mr-2"></i>Ver Todos os Produtos
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="bg-blue-100 text-blue-600 rounded-full p-4 inline-block mb-4">
                        <i class="fas fa-shipping-fast text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Entrega Rápida</h3>
                    <p class="text-gray-600">Entrega em até 24h na área metropolitana</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="bg-green-100 text-green-600 rounded-full p-4 inline-block mb-4">
                        <i class="fas fa-shield-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Produtos Originais</h3>
                    <p class="text-gray-600">Garantia de produtos 100% originais e de qualidade</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="bg-purple-100 text-purple-600 rounded-full p-4 inline-block mb-4">
                        <i class="fas fa-headset text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Suporte 24/7</h3>
                    <p class="text-gray-600">Nossa equipa está sempre disponível para ajudar</p>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
// Sistema de carrinho
document.addEventListener('DOMContentLoaded', function() {
    // Atualizar contador do carrinho
    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        const cartCount = document.getElementById('cart-count');
        if (cartCount) {
            cartCount.textContent = totalItems;
        }
    }

    // Adicionar ao carrinho
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (this.disabled) return;
            
            const productId = this.getAttribute('data-product-id');
            addToCart(productId, 1);
        });
    });

    function addToCart(productId, quantity) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const existingItem = cart.find(item => item.productId === productId);
        
        if (existingItem) {
            existingItem.quantity += parseInt(quantity);
        } else {
            cart.push({
                productId: productId,
                quantity: parseInt(quantity)
            });
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        
        // Feedback visual
        showNotification('Produto adicionado ao carrinho!', 'success');
    }

    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        } z-50 transform translate-x-full transition-transform duration-300`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Inicializar contador do carrinho
    updateCartCount();
});
</script>

<!-- Script do Slider -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.slider-indicator');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    let currentSlide = 0;
    let slideInterval;

    function showSlide(n) {
        slides.forEach(slide => slide.classList.remove('opacity-100'));
        slides.forEach(slide => slide.classList.add('opacity-0'));
        indicators.forEach(indicator => indicator.classList.remove('active'));

        currentSlide = (n + slides.length) % slides.length;

        slides[currentSlide].classList.remove('opacity-0');
        slides[currentSlide].classList.add('opacity-100');
        indicators[currentSlide].classList.add('active');
    }

    function nextSlide() { showSlide(currentSlide + 1); }
    function prevSlide() { showSlide(currentSlide - 1); }
    function startSlider() { slideInterval = setInterval(nextSlide, 5000); }
    function stopSlider() { clearInterval(slideInterval); }

    nextBtn.addEventListener('click', function() {
        stopSlider(); nextSlide(); startSlider();
    });
    prevBtn.addEventListener('click', function() {
        stopSlider(); prevSlide(); startSlider();
    });
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function() {
            stopSlider(); showSlide(index); startSlider();
        });
    });

    const heroSection = document.querySelector('.hero-section');
    heroSection.addEventListener('mouseenter', stopSlider);
    heroSection.addEventListener('mouseleave', startSlider);

    startSlider();
});
</script>

<?php
// Fecha conexão e inclui rodapé uma única vez
$conn->close();
include 'footer.php';
?>