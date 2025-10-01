<?php
include 'db_config.php';
include 'header.php';

// Processar formulário de contacto
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);
    
    // Aqui você pode adicionar o código para enviar email
    // Por enquanto, vamos apenas simular o sucesso
    $success_message = "Mensagem enviada com sucesso! Entraremos em contacto em breve.";
    
    // Você pode adicionar aqui o código para salvar no banco se quiser
    /*
    $sql = "INSERT INTO contacts (name, email, phone, subject, message) 
            VALUES ('$name', '$email', '$phone', '$subject', '$message')";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Mensagem enviada com sucesso!";
    } else {
        $error_message = "Erro ao enviar mensagem: " . $conn->error;
    }
    */
}
?>

<main class="py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Contacte-Nos</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
            <!-- Informações de Contacto -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Informações de Contacto</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="bg-blue-100 text-blue-600 rounded-full p-3 mr-4">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Endereço</h3>
                            <p class="text-gray-600">Av. 25 de Setembro, nº 123<br>Maputo, Moçambique</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-green-100 text-green-600 rounded-full p-3 mr-4">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Telefone</h3>
                            <p class="text-gray-600">+258 84 123 4567<br>+258 86 123 4567</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-purple-100 text-purple-600 rounded-full p-3 mr-4">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Email</h3>
                            <p class="text-gray-600">info@muahivire.co.mz<br>agendamentos@muahivire.co.mz</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-orange-100 text-orange-600 rounded-full p-3 mr-4">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Horário de Funcionamento</h3>
                            <p class="text-gray-600">
                                Segunda a Sexta: 7h30 - 19h00<br>
                                Sábado: 8h00 - 13h00<br>
                                Domingo: Encerrado
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Redes Sociais -->
                <div class="mt-8">
                    <h3 class="font-semibold text-gray-800 mb-4">Siga-nos</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="bg-blue-400 text-white p-3 rounded-full hover:bg-blue-500 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="bg-pink-600 text-white p-3 rounded-full hover:bg-pink-700 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/258841234567" target="_blank" class="bg-green-500 text-white p-3 rounded-full hover:bg-green-600 transition duration-300">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Formulário de Contacto -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Envie-nos uma Mensagem</h2>
                
                <?php if ($success_message): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($error_message): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nome *</label>
                            <input type="text" name="name" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Email *</label>
                            <input type="email" name="email" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Telefone</label>
                            <input type="tel" name="phone" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Assunto *</label>
                            <select name="subject" required 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Selecione o assunto</option>
                                <option value="Consulta">Agendamento de Consulta</option>
                                <option value="Informação">Pedido de Informação</option>
                                <option value="Reclamação">Reclamação</option>
                                <option value="Sugestão">Sugestão</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Mensagem *</label>
                        <textarea name="message" required rows="5" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                  placeholder="Escreva a sua mensagem..."></textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                        <i class="fas fa-paper-plane mr-2"></i>Enviar Mensagem
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Mapa -->
        <div class="mt-12 bg-white rounded-lg shadow-lg p-6 max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Nossa Localização</h2>
            <div class="bg-gray-200 h-96 rounded-lg flex items-center justify-center">
                <div class="text-center">
                    <i class="fas fa-map-marked-alt text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">Mapa da localização da clínica</p>
                    <p class="text-sm text-gray-500 mt-2">(Integre com Google Maps API)</p>
                    <!-- Adicione o iframe do Google Maps aqui quando tiver o endereço real -->
                    <!--
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3587.692326793231!2d32.57631431502914!3d-25.968983983548767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjXCsDU4JzA4LjQiUyAzMsKwMzQnNDEuNyJF!5e0!3m2!1spt-PT!2smz!4v1620000000000!5m2!1spt-PT!2smz" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                    -->
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include 'footer.php';
?>