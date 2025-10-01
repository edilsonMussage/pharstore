<?php
include 'db_config.php';

// Criar ou resetar admin
$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$email = 'admin@muahivire.co.mz';
$full_name = 'Administrador Principal';

// Verificar se admin já existe
$check_sql = "SELECT id FROM admins WHERE username = '$username'";
$result = $conn->query($check_sql);

if ($result->num_rows > 0) {
    // Atualizar admin existente
    $sql = "UPDATE admins SET password = '$password', email = '$email', full_name = '$full_name' WHERE username = '$username'";
} else {
    // Criar novo admin
    $sql = "INSERT INTO admins (username, email, password, full_name, role) VALUES ('$username', '$email', '$password', '$full_name', 'superadmin')";
}

if ($conn->query($sql) === TRUE) {
    echo "✅ Admin configurado com sucesso!<br>";
    echo "Usuário: <strong>admin</strong><br>";
    echo "Senha: <strong>admin123</strong><br><br>";
    echo '<a href="admin_login.php" style="background: #3B82F6; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Ir para Login</a>';
} else {
    echo "❌ Erro: " . $conn->error;
}

$conn->close();
?>