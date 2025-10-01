<?php
include 'db_config.php';

echo "<h1>Debug do Sistema Admin</h1>";

// Verificar se a tabela admins existe
$result = $conn->query("SHOW TABLES LIKE 'admins'");
if ($result->num_rows === 0) {
    echo "<p style='color: red;'>❌ A tabela 'admins' NÃO existe!</p>";
} else {
    echo "<p style='color: green;'>✅ A tabela 'admins' existe!</p>";
}

// Verificar usuários na tabela admins
$result = $conn->query("SELECT * FROM admins");
echo "<h2>Usuários no sistema:</h2>";

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Password</th><th>Full Name</th><th>Role</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['role'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: red;'>❌ Nenhum usuário encontrado na tabela admins!</p>";
}

// Testar login
echo "<h2>Teste de Login:</h2>";
$test_username = 'admin';
$test_password = 'admin123';

$stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
$stmt->bind_param("s", $test_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();
    $db_password = $admin['password'];
    
    echo "<p>Senha no banco: <strong>$db_password</strong></p>";
    echo "<p>Senha de teste: <strong>$test_password</strong></p>";
    
    if ($test_password === $db_password) {
        echo "<p style='color: green;'>✅ Senhas coincidem - Login deve funcionar!</p>";
    } else {
        echo "<p style='color: red;'>❌ Senhas NÃO coincidem!</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Usuário 'admin' não encontrado!</p>";
}

$conn->close();
?>