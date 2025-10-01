<?php
include 'db_config.php';
include 'header.php';

$category_id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : 0;

// Buscar informações da categoria
$category_sql = "SELECT name FROM categories WHERE id = ?";
$stmt_category = $conn->prepare($category_sql);
$stmt_category->bind_param("i", $category_id);
$stmt_category->execute();
$category_result = $stmt_category->get_result();
$category = $category_result->fetch_assoc();
$stmt_category->close();

// Buscar produtos da categoria
$products_sql = "SELECT id, name, description, price, image_url, stock_quantity FROM products WHERE category_id = ?";
$stmt_products = $conn->prepare($products_sql);
$stmt_products->bind_param("i", $category_id);
$stmt_products->execute();
$products_result = $stmt_products->get_result();
?>

<main class="py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-6">
        <?php if ($category): ?>
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Categoria: <?php echo htmlspecialchars($category['name']); ?></h1>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <?php if ($products_result->num_rows > 0): ?>
                    <?php while($product = $products_result->fetch_assoc()): ?>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                            <a href="produto.php?id=<?php echo $product['id']; ?>">
                                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-48 object-cover">
                            </a>
                            <div class="p-6">
                                <h3 class="font-bold text-xl mb-2 text-gray-800">
                                    <a href="produto.php?id=<?php echo $product['id']; ?>" class="hover:text-blue-600 transition duration-300">
                                        <?php echo htmlspecialchars($product['name']); ?>
                                    </a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-4"><?php echo htmlspecialchars($product['description']); ?></p>
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-blue-600"><?php echo number_format($product['price'], 2, ',', '.'); ?> MZN</span>
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-full font-semibold hover:bg-blue-700 transition duration-300 add-to-cart" data-product-id="<?php echo $product['id']; ?>">
                                        <i class="fas fa-cart-plus mr-2"></i>Adicionar
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-span-4 text-center py-12">
                        <p class="text-gray-600 text-lg">Nenhum produto encontrado nesta categoria.</p>
                        <a href="index.php" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-300">
                            Voltar à loja
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <h1 class="text-2xl font-bold text-red-600 mb-4">Categoria Não Encontrada</h1>
                <a href="index.php" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition duration-300">
                    Voltar à Página Inicial
                </a>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
// Adicionar ao carrinho
document.addEventListener('DOMContentLoaded', function() {
    const addToCartBtns = document.querySelectorAll('.add-to-cart');
    addToCartBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            alert(`Produto ${productId} adicionado ao carrinho!`);
        });
    });
});
</script>

<?php
$stmt_products->close();
$conn->close();
include 'footer.php';
?>