<?php
include 'db_config.php';
include 'header.php';
?>

<main class="py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-bold text-gray-800 mb-4 text-center">Nossos Serviços Médicos</h1>
        <p class="text-gray-600 mb-12 text-center max-w-2xl mx-auto">
            Cuidados de saúde completos para você e sua família com profissionais qualificados
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- Serviço 1 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition duration-300">
                <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                     alt="Consultas Gerais" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Consulta Geral</h3>
                    <p class="text-gray-600 mb-4">Atendimento médico geral para diagnóstico e tratamento de diversas condições de saúde.</p>
                    <ul class="text-sm text-gray-600 space-y-2 mb-4">
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Check-up anual</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Diagnóstico de doenças</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Prescrição médica</li>
                    </ul>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-blue-600">500 MZN</span>
                        <a href="agendamento.php?servico=Consulta Geral" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                            Agendar
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Serviço 2 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition duration-300">
                <img src="Why your child should have a black, male doctor https___www_kevinmd.com_blog_2018_09_why-your-child-should-have-a-black-male-doctor.png" 
                     alt="Pediatria" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Pediatria</h3>
                    <p class="text-gray-600 mb-4">Cuidados especializados para crianças e adolescentes, desde o nascimento até os 18 anos.</p>
                    <ul class="text-sm text-gray-600 space-y-2 mb-4">
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Consultas de rotina</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Vacinação</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Acompanhamento do desenvolvimento</li>
                    </ul>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-blue-600">600 MZN</span>
                        <a href="agendamento.php?servico=Pediatria" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                            Agendar
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Serviço 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition duration-300">
                <img src="https://images.unsplash.com/photo-1551601651-2a8555f1a136?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                     alt="Exames Laboratoriais" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Exames Laboratoriais</h3>
                    <p class="text-gray-600 mb-4">Realizamos diversos exames laboratoriais para diagnóstico preciso e acompanhamento.</p>
                    <ul class="text-sm text-gray-600 space-y-2 mb-4">
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Análises de sangue</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Testes de urina</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Testes de COVID-19</li>
                    </ul>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-blue-600">Variável</span>
                        <a href="agendamento.php?servico=Exames" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                            Agendar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Serviço 4 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition duration-300">
                <img src="Urologic Oncology _ Fortis Healthcare.jpg" 
                     alt="Ginecologia" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Ginecologia</h3>
                    <p class="text-gray-600 mb-4">Cuidados especializados em saúde feminina e reprodução humana.</p>
                    <ul class="text-sm text-gray-600 space-y-2 mb-4">
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Consulta ginecológica</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Planeamento familiar</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Pré-natal</li>
                    </ul>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-blue-600">700 MZN</span>
                        <a href="agendamento.php?servico=Ginecologia" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                            Agendar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Serviço 5 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition duration-300">
                <img src="lets take care our heart.jpg" 
                     alt="Cardiologia" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Cardiologia</h3>
                    <p class="text-gray-600 mb-4">Especialidade médica dedicada ao diagnóstico e tratamento de doenças do coração.</p>
                    <ul class="text-sm text-gray-600 space-y-2 mb-4">
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Consulta cardiológica</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> ECG</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Acompanhamento de hipertensão</li>
                    </ul>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-blue-600">800 MZN</span>
                        <a href="agendamento.php?servico=Cardiologia" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                            Agendar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Serviço 6 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition duration-300">
                <img src="" 
                     alt="Check-up Completo" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Check-up Completo</h3>
                    <p class="text-gray-600 mb-4">Avaliação de saúde completa com diversos exames preventivos.</p>
                    <ul class="text-sm text-gray-600 space-y-2 mb-4">
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Análises completas</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Consulta médica</li>
                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Relatório detalhado</li>
                    </ul>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-blue-600">1.200 MZN</span>
                        <a href="agendamento.php?servico=Check-up" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                            Agendar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="bg-blue-600 text-white rounded-lg shadow-lg p-8 text-center">
            <h2 class="text-2xl font-bold mb-4">Precisa de Ajuda para Escolher o Serviço Certo?</h2>
            <p class="text-blue-100 mb-6 max-w-2xl mx-auto">
                Nossa equipa está disponível para ajudar você a escolher o serviço mais adequado para suas necessidades de saúde.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="contacto.php" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                    <i class="fas fa-phone mr-2"></i>Falar com Atendimento
                </a>
                <a href="https://wa.me/258841234567" target="_blank" class="bg-green-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-600 transition duration-300">
                    <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                </a>
            </div>
        </div>
    </div>
</main>

<?php
include 'footer.php';
?>