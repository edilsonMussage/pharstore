<?php
// Configurações específicas do painel administrativo
session_start();

// Incluir configuração do banco
include 'db_config.php';

// Verificar se o usuário está logado
function isAdminLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

// Redirecionar para login se não estiver autenticado
function requireAdminAuth() {
    if (!isAdminLoggedIn()) {
        header('Location: admin_login.php');
        exit();
    }
}

// Registrar log do sistema
function logSystemAction($action, $description = '') {
    global $conn;
    
    // Verificar se a conexão existe
    if (!$conn) {
        error_log("Erro: Conexão com banco não disponível para log - $action: $description");
        return false;
    }
    
    $admin_id = $_SESSION['admin_id'] ?? null;
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
    try {
        $stmt = $conn->prepare("INSERT INTO system_logs (admin_id, action, description, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("issss", $admin_id, $action, $description, $ip_address, $user_agent);
            $stmt->execute();
            $stmt->close();
            return true;
        }
    } catch (Exception $e) {
        error_log("Erro ao registrar log: " . $e->getMessage());
    }
    
    return false;
}
?>