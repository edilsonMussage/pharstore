<?php
include 'db_config.php';
include 'admin_config.php';
requireAdminAuth();

// Adicionar produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);
    $image_url = $conn->real_escape_string($_POST['image_url']);
    $category_id = $conn->real_escape_string($_POST['category_id']);
    $stock_quantity = $conn->real_escape_string($_POST['stock_quantity']);
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image_url, category_id, stock_quantity, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsiii", $name, $description, $price, $image_url, $category_id, $stock_quantity, $is_featured);
    
    if ($stmt->execute()) {
        $success = "Produto adicionado com sucesso!";
        logSystemAction('ADD_PRODUCT', "Produto adicionado: $name");
    } else {
        $error = "Erro ao adicionar produto: " . $stmt->error;
    }
    $stmt->close();
}

// Editar produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_product'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);
    $image_url = $conn->real_escape_string($_POST['image_url']);
    $category_id = $conn->real_escape_string($_POST['category_id']);
    $stock_quantity = $conn->real_escape_string($_POST['stock_quantity']);
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    
    $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, image_url=?, category_id=?, stock_quantity=?, is_featured=? WHERE id=?");
    $stmt->bind_param("ssdsiiii", $name, $description, $price, $image_url, $category_id, $stock_quantity, $is_featured, $id);
    
    if ($stmt->execute()) {
        $success = "Produto atualizado com sucesso!";
        logSystemAction('UPDATE_PRODUCT', "Produto atualizado: $name");
    } else {
        $error = "Erro ao atualizar produto: " . $stmt->error;
    }
    $stmt->close();
}

// Deletar produto
if (isset($_GET['delete'])) {
    $id = $conn->real_escape_string($_GET['delete']);
    
    // Buscar nome do produto para o log
    $product_result = $conn->query("SELECT name FROM products WHERE id = $id");
    $product_name = $product_result->fetch_assoc()['name'];
    
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $success = "Produto deletado com sucesso!";
        logSystemAction('DELETE_PRODUCT', "Produto deletado: $product_name");
    } else {
        $error = "Erro ao deletar produto: " . $stmt->error;
    }
    $stmt->close();
}

// Buscar produtos
$products_result = $conn->query("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC");
$categories_result = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Produtos - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <?php include 'admin_sidebar.php'; ?>
        
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow-sm border-b">
                <div class="flex justify-between items-center px-6 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">Gestão de Produtos</h1>
                </div>
            </header>
            
            <div class="p-6">
                <?php if (isset($success)): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($error)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Formulário de Adicionar/Editar Produto -->
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="p-6 border-b">
                        <h2 class="text-xl font-bold text-gray-800" id="form-title">Adicionar Novo Produto</h2>
                    </div>
                    <div class="p-6">
                        <form method="POST" id="product-form">
                            <input type="hidden" name="id" id="product-id">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Nome do Produto *</label>
                                    <input type="text" name="name" id="product-name" required 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Categoria *</label>
                                    <select name="category_id" id="product-category" required 
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Selecione uma categoria</option>
                                        <?php while($category = $categories_result->fetch_assoc()): ?>
                                            <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Preço (MZN) *</label>
                                    <input type="number" name="price" id="product-price" step="0.01" required 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Stock *</label>
                                    <input type="number" name="stock_quantity" id="product-stock" required 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 font-semibold mb-2">Descrição *</label>
                                    <textarea name="description" id="product-description" required rows="3"
                                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 font-semibold mb-2">URL da Imagem *</label>
                                    <input type="url" name="image_url" id="product-image" required 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div class="flex items-center">
                                    <input type="checkbox" name="is_featured" id="product-featured" 
                                           class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="product-featured" class="ml-2 text-gray-700 font-semibold">Produto em Destaque</label>
                                </div>
                            </div>
                            
                            <div class="mt-6 flex space-x-4">
                                <button type="submit" name="add_product" id="add-btn" 
                                        class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                                    <i class="fas fa-plus mr-2"></i>Adicionar Produto
                                </button>
                                <button type="submit" name="edit_product" id="edit-btn" style="display: none;"
                                        class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
                                    <i class="fas fa-save mr-2"></i>Atualizar Produto
                                </button>
                                <button type="button" id="cancel-btn" style="display: none;"
                                        class="bg-gray-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-700 transition duration-300">
                                    <i class="fas fa-times mr-2"></i>Cancelar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Lista de Produtos -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b">
                        <h2 class="text-xl font-bold text-gray-800">Lista de Produtos</h2>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-4 py-2 text-left">Produto</th>
                                        <th class="px-4 py-2 text-left">Categoria</th>
                                        <th class="px-4 py-2 text-left">Preço</th>
                                        <th class="px-4 py-2 text-left">Stock</th>
                                        <th class="px-4 py-2 text-left">Destaque</th>
                                        <th class="px-4 py-2 text-left">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($product = $products_result->fetch_assoc()): ?>
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center">
                                                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" 
                                                         alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                                         class="w-10 h-10 object-cover rounded mr-3">
                                                    <div>
                                                        <p class="font-semibold"><?php echo htmlspecialchars($product['name']); ?></p>
                                                        <p class="text-sm text-gray-600 truncate max-w-xs"><?php echo htmlspecialchars($product['description']); ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3"><?php echo htmlspecialchars($product['category_name']); ?></td>
                                            <td class="px-4 py-3 font-semibold"><?php echo number_format($product['price'], 2, ',', '.'); ?> MZN</td>
                                            <td class="px-4 py-3">
                                                <span class="<?php echo $product['stock_quantity'] < 10 ? 'text-red-600 font-bold' : 'text-gray-600'; ?>">
                                                    <?php echo $product['stock_quantity']; ?>
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <?php if ($product['is_featured']): ?>
                                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Sim</span>
                                                <?php else: ?>
                                                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">Não</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex space-x-2">
                                                    <button onclick="editProduct(<?php echo $product['id']; ?>)" 
                                                            class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition duration-300">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a href="?delete=<?php echo $product['id']; ?>" 
                                                       onclick="return confirm('Tem certeza que deseja deletar este produto?')"
                                                       class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition duration-300">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function editProduct(productId) {
        fetch(`get_product.php?id=${productId}`)
            .then(response => response.json())
            .then(product => {
                document.getElementById('product-id').value = product.id;
                document.getElementById('product-name').value = product.name;
                document.getElementById('product-description').value = product.description;
                document.getElementById('product-price').value = product.price;
                document.getElementById('product-image').value = product.image_url;
                document.getElementById('product-category').value = product.category_id;
                document.getElementById('product-stock').value = product.stock_quantity;
                document.getElementById('product-featured').checked = product.is_featured == 1;
                
                document.getElementById('form-title').textContent = 'Editar Produto';
                document.getElementById('add-btn').style.display = 'none';
                document.getElementById('edit-btn').style.display = 'inline-block';
                document.getElementById('cancel-btn').style.display = 'inline-block';
                
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
    }
    
    document.getElementById('cancel-btn').addEventListener('click', function() {
        document.getElementById('product-form').reset();
        document.getElementById('product-id').value = '';
        document.getElementById('form-title').textContent = 'Adicionar Novo Produto';
        document.getElementById('add-btn').style.display = 'inline-block';
        document.getElementById('edit-btn').style.display = 'none';
        document.getElementById('cancel-btn').style.display = 'none';
    });
    </script>
</body>
</html>