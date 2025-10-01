<?php
include 'db_config.php';

header('Content-Type: application/json');

if (isset($_GET['ids'])) {
    $productIds = $_GET['ids'];
    $idsArray = explode(',', $productIds);
    
    // Criar placeholders para a consulta
    $placeholders = str_repeat('?,', count($idsArray) - 1) . '?';
    
    $stmt = $conn->prepare("SELECT id, name, price, image_url FROM products WHERE id IN ($placeholders)");
    $stmt->bind_param(str_repeat('i', count($idsArray)), ...$idsArray);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    echo json_encode($products);
    $stmt->close();
} else {
    echo json_encode([]);
}

$conn->close();
?>