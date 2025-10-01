<?php
include 'db_config.php';

// Função para log (se a função não existir ainda)
function logSystemAction($action, $description = '') {
    global $conn;
    
    $admin_id = $_SESSION['admin_id'] ?? null;
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
    $stmt = $conn->prepare("INSERT INTO system_logs (admin_id, action, description, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("issss", $admin_id, $action, $description, $ip_address, $user_agent);
        $stmt->execute();
        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    
    // DEBUG: Ver o que está chegando
    error_log("Tentativa de login: Usuário: $username, Senha: $password");
    
    $stmt = $conn->prepare("SELECT id, username, email, password, full_name, role FROM admins WHERE username = ? AND is_active = 1");
    
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            
            // DEBUG: Ver a senha no banco
            error_log("Senha no banco: " . $admin['password']);
            error_log("Senha digitada: " . $password);
            
            // Verificar senha (agora comparando texto simples para teste)
            if ($password === $admin['password']) {
                session_start();
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_role'] = $admin['role'];
                $_SESSION['admin_name'] = $admin['full_name'];
                
                // Atualizar último login
                $update_stmt = $conn->prepare("UPDATE admins SET last_login = NOW() WHERE id = ?");
                $update_stmt->bind_param("i", $admin['id']);
                $update_stmt->execute();
                $update_stmt->close();
                
                // Registrar log
                logSystemAction('LOGIN', 'Login no sistema administrativo');
                
                header('Location: admin_dashboard.php');
                exit();
            } else {
                $error = "Senha incorreta!";
                error_log("Senha incorreta para usuário: $username");
            }
        } else {
            $error = "Usuário não encontrado!";
            error_log("Usuário não encontrado: $username");
        }
        $stmt->close();
    } else {
        $error = "Erro na consulta: " . $conn->error;
        error_log("Erro no prepare: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Clínica Muahivire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="max-w-md w-full bg-white rounded-lg shadow-2xl p-8 mx-4">
        <div class="text-center mb-8">
            <div class="bg-blue-100 rounded-full p-4 inline-block mb-4">
                <i class="fas fa-lock text-blue-600 text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Painel Administrativo</h1>
            <p class="text-gray-600 mt-2">Clínica Muahivire</p>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex items-center">
                <i class="fas fa-exclamation-triangle mr-3"></i>
                <div>
                    <strong class="font-bold">Erro!</strong>
                    <span class="block sm:inline"><?php echo $error; ?></span>
                </div>
            </div>
        <?php endif; ?>
        
        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-user mr-2 text-blue-500"></i>Usuário
                </label>
                <input type="text" name="username" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300"
                       placeholder="Digite seu usuário"
                       value="admin">
            </div>
            
            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-lock mr-2 text-blue-500"></i>Senha
                </label>
                <input type="password" name="password" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300"
                       placeholder="Digite sua senha"
                       value="admin123">
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transform hover:-translate-y-1 transition duration-300 shadow-lg">
                <i class="fas fa-sign-in-alt mr-2"></i>Entrar no Sistema
            </button>
        </form>
        
        <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-200">
            <h3 class="font-semibold text-blue-800 mb-2 flex items-center">
                <i class="fas fa-info-circle mr-2"></i>Credenciais de Teste
            </h3>
            <div class="text-sm text-blue-700 space-y-1">
                <p><strong>Usuário:</strong> admin</p>
                <p><strong>Senha:</strong> admin123</p>
            </div>
        </div>
        
        <div class="mt-6 text-center text-sm text-gray-500">
            <p>Problemas para acessar? Verifique o banco de dados.</p>
        </div>
    </div>

    <script>
        // Auto-preenchimento para facilitar
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Página de login carregada');
        });
    </script>
</body>
</html>