<?php
include 'db_config.php';
include 'admin_config.php';
requireAdminAuth();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Muahivire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-800 text-white">
            <div class="p-6">
                <img src="seclogo12.png" alt="Logo" class="h-10 mb-4">
                <h2 class="text-xl font-bold">Admin Muahivire</h2>
                <p class="text-blue-200 text-sm"><?php echo $_SESSION['admin_name']; ?></p>
            </div>
            
            <nav class="mt-6">
                <a href="admin_dashboard.php" class="block py-3 px-6 bg-blue-900 border-l-4 border-white">
                    <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                </a>
                <a href="admin_products.php" class="block py-3 px-6 hover:bg-blue-700 border-l-4 border-transparent hover:border-white">
                    <i class="fas fa-pills mr-3"></i>Produtos
                </a>
                <a href="admin_categories.php" class="block py-3 px-6 hover:bg-blue-700 border-l-4 border-transparent hover:border-white">
                    <i class="fas fa-tags mr-3"></i>Categorias
                </a>
                <a href="admin_orders.php" class="block py-3 px-6 hover:bg-blue-700 border-l-4 border-transparent hover:border-white">
                    <i class="fas fa-shopping-cart mr-3"></i>Vendas
                </a>
                <a href="admin_appointments.php" class="block py-3 px-6 hover:bg-blue-700 border-l-4 border-transparent hover:border-white">
                    <i class="fas fa-calendar-check mr-3"></i>Agendamentos
                </a>
                <a href="admin_users.php" class="block py-3 px-6 hover:bg-blue-700 border-l-4 border-transparent hover:border-white">
                    <i class="fas fa-users mr-3"></i>Administradores
                </a>
                <a href="admin_logs.php" class="block py-3 px-6 hover:bg-blue-700 border-l-4 border-transparent hover:border-white">
                    <i class="fas fa-clipboard-list mr-3"></i>Logs do Sistema
                </a>
                <a href="admin_logout.php" class="block py-3 px-6 hover:bg-red-700 border-l-4 border-transparent hover:border-white mt-10">
                    <i class="fas fa-sign-out-alt mr-3"></i>Sair
                </a>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="flex justify-between items-center px-6 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">Bem-vindo, <?php echo $_SESSION['admin_name']; ?></span>
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full"><?php echo $_SESSION['admin_role']; ?></span>
                    </div>
                </div>
            </header>
            
            <!-- Stats -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Notificações de Agendamentos Recentes -->
<div class="bg-white rounded-lg shadow mb-6">
    <div class="p-6 border-b">
        <h2 class="text-xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-bell text-yellow-500 mr-2"></i>
            Agendamentos Hoje
        </h2>
    </div>
    <div class="p-6">
        <?php
        $today = date('Y-m-d');
        $result = $conn->query("SELECT * FROM appointments WHERE appointment_date = '$today' ORDER BY appointment_time ASC");
        if ($result->num_rows > 0):
        ?>
            <div class="space-y-3">
                <?php while($appointment = $result->fetch_assoc()): ?>
                    <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                        <div>
                            <p class="font-semibold"><?php echo htmlspecialchars($appointment['patient_name']); ?></p>
                            <p class="text-sm text-gray-600"><?php echo htmlspecialchars($appointment['service_type']); ?></p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold <?php echo $appointment['status'] == 'pending' ? 'text-yellow-600' : 'text-green-600'; ?>">
                                <?php echo date('H:i', strtotime($appointment['appointment_time'])); ?>
                            </p>
                            <p class="text-xs text-gray-500"><?php echo ucfirst($appointment['status']); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500 text-center py-4">Nenhum agendamento para hoje</p>
        <?php endif; ?>
    </div>
</div>
                    <!-- Total Products -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="bg-blue-100 text-blue-600 rounded-full p-3 mr-4">
                                <i class="fas fa-pills text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">
                                    <?php 
                                    $result = $conn->query("SELECT COUNT(*) as total FROM products");
                                    echo $result->fetch_assoc()['total'];
                                    ?>
                                </h3>
                                <p class="text-gray-600">Total de Produtos</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Total Categories -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="bg-green-100 text-green-600 rounded-full p-3 mr-4">
                                <i class="fas fa-tags text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">
                                    <?php 
                                    $result = $conn->query("SELECT COUNT(*) as total FROM categories");
                                    echo $result->fetch_assoc()['total'];
                                    ?>
                                </h3>
                                <p class="text-gray-600">Categorias</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pending Appointments -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 text-yellow-600 rounded-full p-3 mr-4">
                                <i class="fas fa-calendar-check text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">
                                    <?php 
                                    $result = $conn->query("SELECT COUNT(*) as total FROM appointments WHERE status = 'pending'");
                                    echo $result->fetch_assoc()['total'];
                                    ?>
                                </h3>
                                <p class="text-gray-600">Agendamentos Pendentes</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Low Stock -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="bg-red-100 text-red-600 rounded-full p-3 mr-4">
                                <i class="fas fa-exclamation-triangle text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">
                                    <?php 
                                    $result = $conn->query("SELECT COUNT(*) as total FROM products WHERE stock_quantity < 10");
                                    echo $result->fetch_assoc()['total'];
                                    ?>
                                </h3>
                                <p class="text-gray-600">Produtos com Stock Baixo</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Recent Appointments -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-6 border-b">
                            <h2 class="text-xl font-bold text-gray-800">Agendamentos Recentes</h2>
                        </div>
                        <div class="p-6">
                            <?php
                            $result = $conn->query("SELECT * FROM appointments ORDER BY created_at DESC LIMIT 5");
                            if ($result->num_rows > 0):
                            ?>
                                <div class="space-y-4">
                                    <?php while($appointment = $result->fetch_assoc()): ?>
                                        <div class="flex justify-between items-center py-2 border-b">
                                            <div>
                                                <p class="font-semibold"><?php echo htmlspecialchars($appointment['patient_name']); ?></p>
                                                <p class="text-sm text-gray-600"><?php echo htmlspecialchars($appointment['service_type']); ?></p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-sm font-semibold <?php echo $appointment['status'] == 'pending' ? 'text-yellow-600' : 'text-green-600'; ?>">
                                                    <?php echo ucfirst($appointment['status']); ?>
                                                </p>
                                                <p class="text-xs text-gray-500"><?php echo date('d/m H:i', strtotime($appointment['appointment_date'] . ' ' . $appointment['appointment_time'])); ?></p>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-gray-500 text-center py-4">Nenhum agendamento recente</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- System Logs -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-6 border-b">
                            <h2 class="text-xl font-bold text-gray-800">Logs do Sistema</h2>
                        </div>
                        <div class="p-6">
                            <?php
                            $result = $conn->query("SELECT l.*, a.username FROM system_logs l 
                                                  LEFT JOIN admins a ON l.admin_id = a.id 
                                                  ORDER BY l.created_at DESC LIMIT 5");
                            if ($result->num_rows > 0):
                            ?>
                                <div class="space-y-3">
                                    <?php while($log = $result->fetch_assoc()): ?>
                                        <div class="text-sm">
                                            <p class="font-semibold"><?php echo htmlspecialchars($log['action']); ?></p>
                                            <p class="text-gray-600">Por: <?php echo htmlspecialchars($log['username'] ?? 'Sistema'); ?></p>
                                            <p class="text-xs text-gray-500"><?php echo date('d/m H:i', strtotime($log['created_at'])); ?></p>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-gray-500 text-center py-4">Nenhum log recente</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>