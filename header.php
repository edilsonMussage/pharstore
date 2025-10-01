<?php
// Inicia a sessão se ainda não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Muahivire - Sua Saúde em Primeiro Lugar</title>
    
    <!-- Meta tags para SEO -->

    <!-- Adicione estas meta tags no <head> -->
<meta name="description" content="Clínica Muahivire - Cuidamos da sua saúde com profissionais qualificados. Consultas, exames e produtos farmacêuticos em Maputo, Moçambique.">
<meta name="keywords" content="clínica médica, consultas, exames, farmácia, saúde, Maputo, Moçambique, médico, pediatra, cardiologista">
<meta name="author" content="Clínica Muahivire">
<meta property="og:title" content="Clínica Muahivire - Sua Saúde em Primeiro Lugar">
<meta property="og:description" content="Cuidamos da sua saúde com profissionais qualificados e produtos farmacêuticos de qualidade.">
<meta property="og:image" content="https://muahivire.co.mz/images/logo-social.jpg">
<meta property="og:url" content="https://muahivire.co.mz">
<meta name="twitter:card" content="summary_large_image">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Animações */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }
        
        .animation-delay-200 {
            animation-delay: 0.2s;
            animation-fill-mode: both;
        }
        
        .animation-delay-400 {
            animation-delay: 0.4s;
            animation-fill-mode: both;
        }
        
        /* Slider */
        .slider-indicator.active {
            background-color: white;
            transform: scale(1.2);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo com Imagem -->
                <div class="flex items-center space-x-4">
                    <a href="index.php" class="flex items-center space-x-3">
                        <img src="seclogo12.png" alt="Clínica Muahivire Logo" class="h-12 w-auto">
                        <span class="text-xl font-bold text-blue-600 hidden sm:block">Clínica Muahivire</span>
                    </a>
                </div>

                <!-- Navigation Menu -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Início</a>
                    <a href="produtos.php" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Produtos</a>
                    <a href="categorias.php" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Categorias</a>
                    <a href="agendamento.php" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Agendamento</a>
                    <a href="sobre.php" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Sobre</a>
                    <a href="contacto.php" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Contacto</a>
                </nav>

                <!-- Right Section -->
                <div class="flex items-center space-x-6">
                    <!-- Search Icon -->
                    <button class="text-gray-600 hover:text-blue-600 transition duration-300">
                        <i class="fas fa-search text-xl"></i>
                    </button>
                    
                    <!-- User Account -->
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition duration-300">
                        <i class="fas fa-user text-xl"></i>
                    </a>
                    
                    <!-- Shopping Cart -->
                    <div class="relative">
                        <a href="carrinho.php" class="text-gray-600 hover:text-blue-600 transition duration-300">
                            <i class="fas fa-shopping-cart text-xl"></i>
                            <span class="cart-count" id="cart-count">0</span>
                        </a>
                    </div>

                    <!-- WhatsApp -->
                    <a href="https://wa.me/258841234567" target="_blank" class="text-green-600 hover:text-green-700 transition duration-300">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-600 hover:text-blue-600 transition duration-300" id="mobile-menu-button">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div class="md:hidden hidden mt-4 pb-4" id="mobile-menu">
                <div class="flex flex-col space-y-4">
                    <a href="index.php" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Início</a>
                    <a href="produtos.php" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Produtos</a>
                    <a href="categorias.php" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Categorias</a>
                    <a href="agendamento.php" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Agendamento</a>
                    <a href="sobre.php" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Sobre</a>
                    <a href="contacto.php" class="text-gray-700 hover:text-blue-600 font-medium transition duration-300">Contacto</a>
                </div>
            </div>
        </div>
    </header>

    <script>
    // Menu Mobile
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });

    // Atualizar contador do carrinho
    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        document.getElementById('cart-count').textContent = totalItems;
    }

    // Inicializar contador do carrinho
    document.addEventListener('DOMContentLoaded', updateCartCount);
    </script>