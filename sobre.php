<?php
include 'db_config.php';
include 'header.php';
?>

<main class="py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Sobre a Clínica Muahivire</h1>
            
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Nossa História</h2>
                        <p class="text-gray-600 mb-4">
                            A Clínica Muahivire nasceu com o compromisso de oferecer cuidados de saúde 
                            de excelência à comunidade moçambicana. Com anos de experiência no sector 
                            de saúde, nossa equipa dedica-se ao bem-estar integral dos nossos pacientes.
                        </p>
                        <p class="text-gray-600">
                            Combinamos tecnologia avançada com um atendimento humanizado para 
                            proporcionar a melhor experiência em cuidados de saúde.
                        </p>
                    </div>
                    <div class="text-center">
                        <img src="https://images.unsplash.com/photo-1551076805-e1869033e561?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                             alt="Nossa Clínica" class="rounded-lg shadow-md mx-auto">
                    </div>
                </div>
            </div>

            <!-- Missão, Visão, Valores -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-blue-50 p-6 rounded-lg text-center">
                    <div class="bg-blue-100 text-blue-600 rounded-full p-3 inline-block mb-4">
                        <i class="fas fa-bullseye text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Missão</h3>
                    <p class="text-gray-600">Oferecer cuidados de saúde integrais e acessíveis, promovendo o bem-estar da comunidade com excelência e humanização.</p>
                </div>
                
                <div class="bg-green-50 p-6 rounded-lg text-center">
                    <div class="bg-green-100 text-green-600 rounded-full p-3 inline-block mb-4">
                        <i class="fas fa-eye text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Visão</h3>
                    <p class="text-gray-600">Ser referência em cuidados de saúde em Moçambique, reconhecida pela qualidade e inovação nos serviços prestados.</p>
                </div>
                
                <div class="bg-purple-50 p-6 rounded-lg text-center">
                    <div class="bg-purple-100 text-purple-600 rounded-full p-3 inline-block mb-4">
                        <i class="fas fa-heart text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Valores</h3>
                    <p class="text-gray-600">Ética, Qualidade, Humanização, Inovação e Compromisso com a comunidade.</p>
                </div>
            </div>

            <!-- Equipa Médica -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Nossa Equipa</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="text-center">
                        <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" 
                             alt="Dr. João Muahivire" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-lg font-semibold text-gray-800">Dr. João Muahivire</h3>
                        <p class="text-blue-600 mb-2">Médico Geral</p>
                        <p class="text-gray-600 text-sm">15 anos de experiência em medicina geral</p>
                    </div>
                    
                    <div class="text-center">
                        <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" 
                             alt="Dra. Maria Santos" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-lg font-semibold text-gray-800">Dra. Maria Santos</h3>
                        <p class="text-blue-600 mb-2">Pediatra</p>
                        <p class="text-gray-600 text-sm">Especialista em saúde infantil</p>
                    </div>
                    
                    <div class="text-center">
                        <img src="https://images.unsplash.com/photo-1591604021695-0c69b7c05981?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" 
                             alt="Dr. Carlos Fernandes" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-lg font-semibold text-gray-800">Dr. Carlos Fernandes</h3>
                        <p class="text-blue-600 mb-2">Cardiologista</p>
                        <p class="text-gray-600 text-sm">Especialista em doenças cardiovasculares</p>
                    </div>

                </div>

                
            </div>
             <!-- Estatísticas -->
            <div class="bg-blue-600 text-white rounded-lg shadow-lg p-8 text-center">
                <h2 class="text-2xl font-bold mb-6">Nossos Números</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div>
                        <div class="text-3xl font-bold mb-2">+5.000</div>
                        <div class="text-blue-200">Pacientes Atendidos</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold mb-2">+10</div>
                        <div class="text-blue-200">Anos de Experiência</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold mb-2">+50</div>
                        <div class="text-blue-200">Parcerias</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold mb-2">24/7</div>
                        <div class="text-blue-200">Suporte</div>
                    </div>
        </div>
    </div>
</main>

<?php
include 'footer.php';
?>