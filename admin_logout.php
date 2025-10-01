<?php
// admin_logout.php SIMPLIFICADO
session_start();

// Destruir todas as variáveis de sessão
$_SESSION = array();

// Destruir cookie de sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir sessão
session_destroy();

// Redirecionar para login
header('Location: admin_login.php');
exit();
?>