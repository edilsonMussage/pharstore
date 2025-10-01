<div class="w-64 bg-blue-800 text-white">
    <div class="p-6">
        <img src="seclogo12.png" alt="Logo" class="h-10 mb-4">
        <h2 class="text-xl font-bold">Admin Muahivire</h2>
        <p class="text-blue-200 text-sm"><?php echo $_SESSION['admin_name']; ?></p>
    </div>
    
    <nav class="mt-6">
        <a href="admin_dashboard.php" class="block py-3 px-6 <?php echo basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php' ? 'bg-blue-900 border-l-4 border-white' : 'hover:bg-blue-700 border-l-4 border-transparent hover:border-white'; ?>">
            <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
        </a>
        <a href="admin_products.php" class="block py-3 px-6 <?php echo basename($_SERVER['PHP_SELF']) == 'admin_products.php' ? 'bg-blue-900 border-l-4 border-white' : 'hover:bg-blue-700 border-l-4 border-transparent hover:border-white'; ?>">
            <i class="fas fa-pills mr-3"></i>Produtos
        </a>
        <a href="admin_categories.php" class="block py-3 px-6 <?php echo basename($_SERVER['PHP_SELF']) == 'admin_categories.php' ? 'bg-blue-900 border-l-4 border-white' : 'hover:bg-blue-700 border-l-4 border-transparent hover:border-white'; ?>">
            <i class="fas fa-tags mr-3"></i>Categorias
        </a>
        <a href="admin_appointments.php" class="block py-3 px-6 <?php echo basename($_SERVER['PHP_SELF']) == 'admin_appointments.php' ? 'bg-blue-900 border-l-4 border-white' : 'hover:bg-blue-700 border-l-4 border-transparent hover:border-white'; ?>">
            <i class="fas fa-calendar-check mr-3"></i>Agendamentos
        </a>
        <a href="admin_users.php" class="block py-3 px-6 <?php echo basename($_SERVER['PHP_SELF']) == 'admin_users.php' ? 'bg-blue-900 border-l-4 border-white' : 'hover:bg-blue-700 border-l-4 border-transparent hover:border-white'; ?>">
            <i class="fas fa-users mr-3"></i>Administradores
        </a>
        <a href="admin_logs.php" class="block py-3 px-6 <?php echo basename($_SERVER['PHP_SELF']) == 'admin_logs.php' ? 'bg-blue-900 border-l-4 border-white' : 'hover:bg-blue-700 border-l-4 border-transparent hover:border-white'; ?>">
            <i class="fas fa-clipboard-list mr-3"></i>Logs do Sistema
        </a>
        <a href="admin_logout.php" class="block py-3 px-6 hover:bg-red-700 border-l-4 border-transparent hover:border-white mt-10">
            <i class="fas fa-sign-out-alt mr-3"></i>Sair
        </a>
    </nav>
</div>a