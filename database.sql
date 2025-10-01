-- Crie um banco de dados chamado 'pharstore_db' no seu phpMyAdmin antes de executar este script.

-- Tabela para as categorias dos produtos
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon_class` varchar(255) NOT NULL,
  `color_class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserindo os dados das categorias
INSERT INTO `categories` (`id`, `name`, `icon_class`, `color_class`) VALUES
(1, 'Medicamentos', 'fas fa-pills', 'bg-blue-500'),
(2, 'Vitaminas', 'fas fa-leaf', 'bg-green-500'),
(3, 'Cuidados Pessoais', 'fas fa-spa', 'bg-purple-500'),
(4, 'Bebé e Mãe', 'fas fa-baby', 'bg-pink-500');

-- Tabela para os produtos
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserindo os dados dos produtos em destaque
INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`, `category_id`, `is_featured`) VALUES
(1, 'Paracetamol 500mg', 'Analgésico e antipirético para alívio da dor e febre.', 150.00, 'https://placehold.co/300x300/e0e0e0/333?text=Produto+1', 1, 1),
(2, 'Vitamina C', 'Suplemento para reforçar o sistema imunitário.', 350.00, 'https://placehold.co/300x300/d1fae5/333?text=Produto+2', 2, 1),
(3, 'Creme Hidratante', 'Hidratação profunda para pele seca e sensível.', 500.00, 'https://placehold.co/300x300/e9d5ff/333?text=Produto+3', 3, 1),
(4, 'Fraldas de Bebé', 'Máxima absorção e conforto para o seu bebé.', 800.00, 'https://placehold.co/300x300/fce7f3/333?text=Produto+4', 4, 1);
