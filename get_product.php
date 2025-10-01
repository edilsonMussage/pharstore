<?php
include 'db_config.php';
include 'admin_config.php';

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $result = $conn->query("SELECT * FROM products WHERE id = $id");
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode($product);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Produto não encontrado']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'ID não fornecido']);
}
?>