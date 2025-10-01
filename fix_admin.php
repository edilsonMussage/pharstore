<?php
include 'db_config.php';

echo "<h1>Correção do Sistema Admin</h1>";

// Verificar se existe algum admin
$result = $conn->query("SELECT * FROM admins");
if ($result->num_rows > 0) {
    echo "<p>✅ Administradores encontrados:</p>";
    while($row = $result->fetch_assoc()) {
        echo "<p>Usuário: <strong>{$row['username']}</strong> - Senha: <strong>{$row['password']}</strong></p>";
    }
    
    // Atualizar senha para admin123
    $update_sql = "UPDATE admins SET password = 'admin123' WHERE username = 'admin'";
    if ($conn->query($update_sql)) {
        echo "<p style='color: green;'>✅ Senha do admin atualizada para 'admin123'</p>";
    } else {
        echo "<p style='color: red;'>❌ Erro ao atualizar senha: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: orange;'>⚠️ Nenhum admin encontrado. Criando novo admin...</p>";
    
    // Inserir novo admin
    $insert_sql = "INSERT INTO admins (username, email, password, full_name, role) 
                   VALUES ('admin', 'admin@muahivire.co.mz', 'admin123', 'Administrador Principal', 'superadmin')";
    
    if ($conn->query($insert_sql)) {
        echo "<p style='color: green;'>✅ Novo admin criado com sucesso!</p>";
        echo "<p><strong>Usuário:</strong> admin</p>";
        echo "<p><strong>Senha:</strong> admin123</p>";
    } else {
        echo "<p style='color: red;'>❌ Erro ao criar admin: " . $conn->error . "</p>";
    }
}

// Testar login
echo "<h2>Teste de Login:</h2>";
$test_username = 'admin';
$test_password = 'admin123';

$stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $test_username, $test_password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    echo "<p style='color: green;'>✅ Login deve funcionar! Credenciais corretas.</p>";
    echo "<p><a href='admin_login.php' style='background: green; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Ir para Login</a></p>";
} else {
    echo "<p style='color: red;'>❌ Credenciais ainda não funcionam.</p>";
}

$conn->close();
?>