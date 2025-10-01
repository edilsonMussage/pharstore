<?php
include 'db_config.php';
include 'header.php';

// Filtros
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$search_term = isset($_GET['search']) ? $_GET['search'] : '';

// Construir query
$sql = "SELECT p.*, c.name as category_name FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        WHERE 1=1";

if (!empty($category_filter)) {
    $sql .= " AND p.category_id = '$category_filter'";
}

if (!empty($search_term)) {
    $sql .= " AND (p.name LIKE '%$search_term%' OR p.description LIKE '%$search_term%')";
}

$sql .= " ORDER BY p.name";

$result = $conn->query($sql);
?>

<main class="py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Nossos Produtos</h1>
        <p class="text-gray-600 mb-8">Encontre os medicamentos e produtos de saúde que precisa</p>
        
        <!-- Filtros -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Pesquisar</label>
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search_term); ?>" 
                           placeholder="Nome do produto..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Categoria</label>
                    <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Todas as categorias</option>
                        <?php
                        $categories_result = $conn->query("SELECT * FROM categories");
                        while ($category = $categories_result->fetch_assoc()) {
                            $selected = ($category_filter == $category['id']) ? 'selected' : '';
                            echo "<option value='{$category['id']}' $selected>{$category['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                        <i class="fas fa-search mr-2"></i>Filtrar
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Produtos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php if ($result->num_rows > 0): ?>
                <?php while($product = $result->fetch_assoc()): ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-all duration-300">
                        <a href="produto.php?id=<?php echo $product['id']; ?>">
                            <img src="<?php echo htmlspecialchars($product['image_url']); ?>" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                 class="w-full h-48 object-cover hover:scale-105 transition duration-300">
                        </a>
                        <div class="p-4">
                            <span class="text-xs font-semibold text-blue-600 bg-blue-100 py-1 px-2 rounded-full">
                                <?php echo htmlspecialchars($product['category_name']); ?>
                            </span>
                            <h3 class="font-bold text-lg text-gray-800 mt-2 mb-1">
                                <a href="produto.php?id=<?php echo $product['id']; ?>" class="hover:text-blue-600 transition duration-300">
                                    <?php echo htmlspecialchars($product['name']); ?>
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2"><?php echo htmlspecialchars($product['description']); ?></p>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-bold text-blue-600"><?php echo number_format($product['price'], 2, ',', '.'); ?> MZN</span>
                                <button class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition duration-300 add-to-cart" 
                                        data-product-id="<?php echo $product['id']; ?>">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-span-4 text-center py-12">
                    <i class="fas fa-search text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">Nenhum produto encontrado</p>
                    <p class="text-gray-400">Tente ajustar os filtros de pesquisa</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
// Adicionar ao carrinho
document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
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
        
        // Feedback
        showNotification('Produto adicionado ao carrinho!', 'success');
    }

    function showNotification(message, type) {
        // Implementar notificação (já existe no código anterior)
    }
});
</script>

<?php
$conn->close();
include 'footer.php';
?>