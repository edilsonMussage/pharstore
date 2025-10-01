<?php
include 'db_config.php';
include 'header.php';

// Processar agendamento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_name = $conn->real_escape_string($_POST['patient_name']);
    $patient_email = $conn->real_escape_string($_POST['patient_email']);
    $patient_phone = $conn->real_escape_string($_POST['patient_phone']);
    $appointment_date = $conn->real_escape_string($_POST['appointment_date']);
    $appointment_time = $conn->real_escape_string($_POST['appointment_time']);
    $service_type = $conn->real_escape_string($_POST['service_type']);
    $notes = $conn->real_escape_string($_POST['notes']);
    
    $sql = "INSERT INTO appointments (patient_name, patient_email, patient_phone, appointment_date, appointment_time, service_type, notes) 
            VALUES ('$patient_name', '$patient_email', '$patient_phone', '$appointment_date', '$appointment_time', '$service_type', '$notes')";
    
    if ($conn->query($sql) === TRUE) {
        $success_message = "Agendamento realizado com sucesso! Entraremos em contacto para confirmação.";
    } else {
        $error_message = "Erro ao agendar: " . $conn->error;
    }
}
?>

<main class="py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Agendar Consulta</h1>
            <p class="text-gray-600 mb-8">Marque sua consulta de forma rápida e fácil</p>
            
            <?php if (isset($success_message)): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error_message)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <div class="bg-white rounded-lg shadow-md p-8">
                <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nome Completo *</label>
                        <input type="text" name="patient_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email *</label>
                        <input type="email" name="patient_email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Telefone *</label>
                        <input type="tel" name="patient_phone" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Tipo de Serviço *</label>
                        <select name="service_type" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Selecione o serviço</option>
                            <option value="Consulta Geral">Consulta Geral</option>
                            <option value="Pediatria">Pediatria</option>
                            <option value="Ginecologia">Ginecologia</option>
                            <option value="Cardiologia">Cardiologia</option>
                            <option value="Dermatologia">Dermatologia</option>
                            <option value="Exames Laboratoriais">Exames Laboratoriais</option>
                            <option value="Check-up">Check-up</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Data da Consulta *</label>
                        <input type="date" name="appointment_date" required min="<?php echo date('Y-m-d'); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Horário *</label>
                        <select name="appointment_time" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Selecione o horário</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                        </select>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-semibold mb-2">Observações</label>
                        <textarea name="notes" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Alguma informação adicional que devemos saber..."></textarea>
                    </div>
                    
                    <div class="md:col-span-2">
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                            <i class="fas fa-calendar-check mr-2"></i>Confirmar Agendamento
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Informações de Contacto -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="bg-blue-100 text-blue-600 rounded-full p-3 inline-block mb-4">
                        <i class="fas fa-phone text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Telefone</h3>
                    <p class="text-gray-600">+258 84 123 4567</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="bg-green-100 text-green-600 rounded-full p-3 inline-block mb-4">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">WhatsApp</h3>
                    <p class="text-gray-600">+258 84 123 4567</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="bg-purple-100 text-purple-600 rounded-full p-3 inline-block mb-4">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Horário</h3>
                    <p class="text-gray-600">Seg-Sex: 8h-18h<br>Sáb: 8h-13h</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
$conn->close();
include 'footer.php';
?>
<script>
// Validações do formulário de agendamento
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const appointmentDate = document.querySelector('input[name="appointment_date"]');
    const appointmentTime = document.querySelector('select[name="appointment_time"]');
    
    // Definir data mínima como hoje
    const today = new Date().toISOString().split('T')[0];
    appointmentDate.min = today;
    
    // Validar horários de fim de semana
    appointmentDate.addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const dayOfWeek = selectedDate.getDay();
        
        // Domingo = 0, Sábado = 6
        if (dayOfWeek === 0 || dayOfWeek === 6) {
            // Limitar horários para fim de semana
            const weekendTimes = ['08:00', '09:00', '10:00', '11:00'];
            updateTimeOptions(weekendTimes);
        } else {
            // Horários normais de semana
            const weekTimes = ['08:00', '09:00', '10:00', '11:00', '14:00', '15:00', '16:00', '17:00'];
            updateTimeOptions(weekTimes);
        }
    });
    
    function updateTimeOptions(times) {
        appointmentTime.innerHTML = '<option value="">Selecione o horário</option>';
        times.forEach(time => {
            const option = document.createElement('option');
            option.value = time;
            option.textContent = time;
            appointmentTime.appendChild(option);
        });
    }
    
    // Validação antes do envio
    form.addEventListener('submit', function(e) {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = 'red';
            } else {
                field.style.borderColor = '';
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Por favor, preencha todos os campos obrigatórios.');
        }
    });
});
</script>
</body>
</html> 