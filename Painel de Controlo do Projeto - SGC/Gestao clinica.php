<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controlo do Projeto - SGC</title>
    <!-- Chosen Palette: Calm Harmony -->
    <!-- Application Structure Plan: Foi concebida uma estrutura de painel de controlo interativo. A página principal apresenta os 5 módulos principais do projeto em cartões para uma visão geral imediata. Um roteiro visual permite a navegação cronológica pelas fases. Clicar num cartão ou numa fase do roteiro revela uma secção de detalhes específica, com visualizações de dados, fluxogramas e esquemas de base de dados. Esta abordagem de "hub-and-spoke" é superior a um documento linear, pois permite que as partes interessadas explorem os módulos de interesse de forma não linear, facilitando a compreensão da arquitetura modular do sistema e dos objetivos de cada fase. -->
    <!-- Visualization & Content Choices: O plano foi transformado em elementos visuais: 1) Base de Dados (Fase 1/3): Esquemas de tabelas HTML para informar sobre a estrutura. 2) Fluxo de Agendamento (Fase 2): Um fluxograma HTML/CSS para organizar o processo. 3) Desempenho Financeiro (Fase 4): Gráficos de linhas e anéis (Chart.js) para comparar e informar sobre as projeções financeiras. 4) Gestão de Stock (Fase 4): Um gráfico de barras (Chart.js) para comparar os níveis de stock com os limites mínimos, fornecendo alertas visuais. 5) Funcionalidades de Segurança (Fase 5): Uma lista de verificação com ícones para informar de forma clara e concisa. Esta seleção visa traduzir os objetivos de cada fase do plano em visualizações interativas e de fácil digestão, apoiando a estrutura geral do painel. -->
    <!-- CONFIRMATION: NO SVG graphics used. NO Mermaid JS used. -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8F7F4;
            color: #3D405B;
        }
        .main-title { color: #3D405B; }
        .card-bg { background-color: #FFFFFF; }
        .accent-color { color: #E07A5F; }
        .accent-bg { background-color: #E07A5F; }
        .accent-bg-hover:hover { background-color: #d8684a; }
        .success-color { color: #81B29A; }
        .success-bg { background-color: #81B29A; }
        .section-hidden { display: none; }
        .section-visible { display: block; animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .chart-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            height: 300px;
            max-height: 400px;
        }
        @media (min-width: 768px) {
            .chart-container { height: 350px; }
        }
        .timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }
        .timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: #e2e8f0;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }
        .timeline-container {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }
        .timeline-container::after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            right: -12.5px;
            background-color: white;
            border: 4px solid #E07A5F;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
            cursor: pointer;
        }
        .timeline-left { left: 0; }
        .timeline-right { left: 50%; }
        .timeline-right::after { left: -12.5px; }
        .timeline-content {
            padding: 20px 30px;
            background-color: white;
            position: relative;
            border-radius: 6px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
    </style>
</head>
<body class="antialiased">
    <div id="app" class="container mx-auto p-4 md:p-8">
        
        <header class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold main-title mb-2">Plano de Ação Interativo</h1>
            <p class="text-lg text-gray-600">Sistema de Gestão de Clínica (SGC)</p>
        </header>

        <!-- Navigation Cards -->
        <nav id="nav-cards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-12">
            <div data-target="fase1" class="card-bg p-6 rounded-lg shadow-sm cursor-pointer border-2 border-transparent hover:border-orange-400 transition-all duration-300 text-center">
                <i class="fas fa-shield-halved fa-2x accent-color mb-3"></i>
                <h3 class="font-bold text-lg">Fase 1: Base e Segurança</h3>
                <p class="text-sm text-gray-500 mt-1">Estrutura, Login e Dashboard.</p>
            </div>
            <div data-target="fase2" class="card-bg p-6 rounded-lg shadow-sm cursor-pointer border-2 border-transparent hover:border-orange-400 transition-all duration-300 text-center">
                <i class="fas fa-calendar-alt fa-2x accent-color mb-3"></i>
                <h3 class="font-bold text-lg">Fase 2: Agendamentos</h3>
                <p class="text-sm text-gray-500 mt-1">Gestão de Consultas e Calendário.</p>
            </div>
            <div data-target="fase3" class="card-bg p-6 rounded-lg shadow-sm cursor-pointer border-2 border-transparent hover:border-orange-400 transition-all duration-300 text-center">
                <i class="fas fa-file-medical fa-2x accent-color mb-3"></i>
                <h3 class="font-bold text-lg">Fase 3: Prontuário Eletrónico</h3>
                <p class="text-sm text-gray-500 mt-1">Histórico e Dados do Paciente.</p>
            </div>
            <div data-target="fase4" class="card-bg p-6 rounded-lg shadow-sm cursor-pointer border-2 border-transparent hover:border-orange-400 transition-all duration-300 text-center">
                <i class="fas fa-chart-pie fa-2x accent-color mb-3"></i>
                <h3 class="font-bold text-lg">Fase 4: Gestão e Finanças</h3>
                <p class="text-sm text-gray-500 mt-1">Relatórios, Stock e Faturação.</p>
            </div>
            <div data-target="fase5" class="card-bg p-6 rounded-lg shadow-sm cursor-pointer border-2 border-transparent hover:border-orange-400 transition-all duration-300 text-center">
                <i class="fas fa-lock fa-2x accent-color mb-3"></i>
                <h3 class="font-bold text-lg">Fase 5: Conformidade</h3>
                <p class="text-sm text-gray-500 mt-1">Segurança de Dados e LGPD.</p>
            </div>
        </nav>

        <!-- Main Content Area -->
        <main id="content-area">
            <!-- Fase 1: Base e Segurança -->
            <section id="fase1" class="content-section section-hidden card-bg p-6 md:p-8 rounded-lg shadow-lg">
                <h2 class="text-3xl font-bold mb-6 flex items-center"><i class="fas fa-shield-halved accent-color mr-4"></i>Fase 1: A Base de Tudo (Estrutura e Segurança)</h2>
                <p class="mb-8 text-gray-600">Esta fase estabelece a fundação do sistema, focando na gestão de acesso e no cadastro inicial de pacientes. A segurança é prioritária, com diferentes níveis de acesso para garantir que os dados sensíveis sejam protegidos desde o início.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="font-bold text-xl mb-4">Sistema de Login e Acesso</h4>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start"><i class="fas fa-user-shield success-color w-5 mt-1 mr-3"></i><span><b>Admin:</b> Controlo total sobre o sistema, gestão de utilizadores e configurações.</span></li>
                            <li class="flex items-start"><i class="fas fa-user-doctor success-color w-5 mt-1 mr-3"></i><span><b>Médico:</b> Acesso a agendamentos, prontuários dos seus pacientes e registo de consultas.</span></li>
                            <li class="flex items-start"><i class="fas fa-user-edit success-color w-5 mt-1 mr-3"></i><span><b>Recepcionista:</b> Acesso à gestão de agendamentos, cadastro de pacientes e tarefas administrativas.</span></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-xl mb-4">Esquema da Base de Dados Inicial</h4>
                         <div class="space-y-4">
                            <details class="bg-gray-50 p-3 rounded">
                                <summary class="font-semibold cursor-pointer">Tabela `usuarios`</summary>
                                <p class="text-xs text-gray-500 mt-2">`id`, `nome`, `email`, `senha_hash`, `nivel_acesso`</p>
                            </details>
                            <details class="bg-gray-50 p-3 rounded">
                                <summary class="font-semibold cursor-pointer">Tabela `pacientes`</summary>
                                <p class="text-xs text-gray-500 mt-2">`id`, `nome_completo`, `data_nascimento`, `cpf`, `telefone`, `email`, `endereco`</p>
                            </details>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Fase 2: Agendamento e Atendimento -->
            <section id="fase2" class="content-section section-hidden card-bg p-6 md:p-8 rounded-lg shadow-lg">
                <h2 class="text-3xl font-bold mb-6 flex items-center"><i class="fas fa-calendar-alt accent-color mr-4"></i>Fase 2: Módulo de Agendamento e Atendimento</h2>
                <p class="mb-8 text-gray-600">O coração operacional da clínica. Este módulo permite a gestão completa da agenda dos profissionais de forma visual e intuitiva. O objetivo é otimizar o tempo, automatizar lembretes e reduzir as faltas dos pacientes.</p>
                 <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
                        <h4 class="font-bold text-xl mb-4">Fluxo de Agendamento Interativo</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center"><span class="success-bg text-white font-bold w-6 h-6 text-center rounded-full mr-3">1</span><span>Utilizador clica na data/hora no calendário (FullCalendar.js).</span></div>
                            <div class="ml-3 pl-2 border-l-2 border-gray-200"><i class="fas fa-arrow-down text-gray-400"></i></div>
                            <div class="flex items-center"><span class="success-bg text-white font-bold w-6 h-6 text-center rounded-full mr-3">2</span><span>Abre um pop-up (Modal Bootstrap) para preencher os dados.</span></div>
                             <div class="ml-3 pl-2 border-l-2 border-gray-200"><i class="fas fa-arrow-down text-gray-400"></i></div>
                            <div class="flex items-center"><span class="success-bg text-white font-bold w-6 h-6 text-center rounded-full mr-3">3</span><span>Dados são enviados ao servidor via AJAX, sem recarregar a página.</span></div>
                             <div class="ml-3 pl-2 border-l-2 border-gray-200"><i class="fas fa-arrow-down text-gray-400"></i></div>
                            <div class="flex items-center"><span class="success-bg text-white font-bold w-6 h-6 text-center rounded-full mr-3">4</span><span>PHP verifica a disponibilidade e insere na base de dados.</span></div>
                             <div class="ml-3 pl-2 border-l-2 border-gray-200"><i class="fas fa-arrow-down text-gray-400"></i></div>
                            <div class="flex items-center"><span class="success-bg text-white font-bold w-6 h-6 text-center rounded-full mr-3">5</span><span>Sistema envia lembrete automático via E-mail/SMS.</span></div>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-bold text-xl mb-4 text-center">Impacto Previsto dos Lembretes</h4>
                        <div class="chart-container">
                            <canvas id="absenteeismChart"></canvas>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Fase 3: Prontuário Eletrónico -->
            <section id="fase3" class="content-section section-hidden card-bg p-6 md:p-8 rounded-lg shadow-lg">
                <h2 class="text-3xl font-bold mb-6 flex items-center"><i class="fas fa-file-medical accent-color mr-4"></i>Fase 3: Módulo de Prontuário Eletrónico</h2>
                 <p class="mb-8 text-gray-600">Este módulo centraliza todas as informações clínicas do paciente de forma segura e acessível. Permite que os médicos acedam rapidamente ao histórico completo, diagnósticos anteriores, e exames, melhorando a qualidade e a continuidade do cuidado.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                     <div>
                        <h4 class="font-bold text-xl mb-4">Estrutura de Dados do Prontuário</h4>
                        <div class="space-y-4">
                            <details class="bg-gray-50 p-3 rounded">
                                <summary class="font-semibold cursor-pointer">Tabela `prontuarios`</summary>
                                <p class="text-xs text-gray-500 mt-2">`id`, `id_consulta`, `id_paciente`, `diagnostico`, `prescricao`, `data_criacao`</p>
                            </details>
                            <details class="bg-gray-50 p-3 rounded">
                                <summary class="font-semibold cursor-pointer">Tabela `anexos_prontuario`</summary>
                                <p class="text-xs text-gray-500 mt-2">`id`, `id_prontuario`, `nome_arquivo`, `caminho_arquivo`</p>
                            </details>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-bold text-xl mb-4">Funcionalidades Principais</h4>
                        <ul class="space-y-3 text-gray-700">
                           <li class="flex items-start"><i class="fas fa-history success-color w-5 mt-1 mr-3"></i><span>Acesso rápido ao histórico cronológico completo do paciente.</span></li>
                           <li class="flex items-start"><i class="fas fa-prescription-bottle-alt success-color w-5 mt-1 mr-3"></i><span>Formulários digitais para registo de diagnósticos e prescrições.</span></li>
                           <li class="flex items-start"><i class="fas fa-upload success-color w-5 mt-1 mr-3"></i><span>Upload seguro de ficheiros (exames, laudos, imagens).</span></li>
                           <li class="flex items-start"><i class="fas fa-lock success-color w-5 mt-1 mr-3"></i><span>Acesso restrito aos registos apenas para profissionais autorizados.</span></li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Fase 4: Gestão e Finanças -->
            <section id="fase4" class="content-section section-hidden card-bg p-6 md:p-8 rounded-lg shadow-lg">
                <h2 class="text-3xl font-bold mb-6 flex items-center"><i class="fas fa-chart-pie accent-color mr-4"></i>Fase 4: Módulos Financeiro e Administrativo</h2>
                 <p class="mb-8 text-gray-600">Para garantir a sustentabilidade da clínica, este módulo oferece ferramentas para a gestão do negócio. Inclui controlo financeiro, gestão de stock e a geração de relatórios de desempenho para apoiar a tomada de decisões estratégicas.</p>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="w-full">
                         <h4 class="font-bold text-xl mb-4 text-center">Relatório Financeiro (Projeção)</h4>
                        <div class="chart-container">
                            <canvas id="financialChart"></canvas>
                        </div>
                    </div>
                     <div class="w-full">
                         <h4 class="font-bold text-xl mb-4 text-center">Consultas por Status (Exemplo)</h4>
                        <div class="chart-container h-64 md:h-80">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                     <div class="w-full lg:col-span-2">
                        <h4 class="font-bold text-xl mb-4 text-center">Controlo de Stock (Nível de Alerta)</h4>
                        <div class="chart-container">
                            <canvas id="stockChart"></canvas>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Fase 5: Segurança e Conformidade -->
            <section id="fase5" class="content-section section-hidden card-bg p-6 md:p-8 rounded-lg shadow-lg">
                 <h2 class="text-3xl font-bold mb-6 flex items-center"><i class="fas fa-lock accent-color mr-4"></i>Fase 5: Segurança, Comunicação e Conformidade</h2>
                 <p class="mb-8 text-gray-600">A fase final foca-se em robustecer o sistema com as melhores práticas de segurança, garantir a conformidade com leis de proteção de dados como a LGPD, e adicionar ferramentas de comunicação para fidelização de pacientes.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                     <div>
                        <h4 class="font-bold text-xl mb-4">Protocolos de Segurança</h4>
                        <ul class="space-y-3 text-gray-700">
                           <li class="flex items-start"><i class="fas fa-database success-color w-5 mt-1 mr-3"></i><span>Uso de **Prepared Statements (PDO/MySQLi)** para prevenir SQL Injection.</span></li>
                           <li class="flex items-start"><i class="fas fa-user-lock success-color w-5 mt-1 mr-3"></i><span>Verificação rigorosa de **Níveis de Acesso** em todas as ações.</span></li>
                           <li class="flex items-start"><i class="fas fa-shield-virus success-color w-5 mt-1 mr-3"></i><span>Implementação de **HTTPS (SSL)** no servidor de produção.</span></li>
                           <li class="flex items-start"><i class="fas fa-save success-color w-5 mt-1 mr-3"></i><span>Sistema de **Backup regular** e automatizado da base de dados.</span></li>
                        </ul>
                    </div>
                     <div>
                        <h4 class="font-bold text-xl mb-4">Comunicação e Conformidade</h4>
                        <ul class="space-y-3 text-gray-700">
                           <li class="flex items-start"><i class="fas fa-envelope success-color w-5 mt-1 mr-3"></i><span>Módulo de **Marketing por E-mail** para campanhas e lembretes.</span></li>
                           <li class="flex items-start"><i class="fas fa-balance-scale success-color w-5 mt-1 mr-3"></i><span>Adequação à **LGPD** com registo de logs e gestão de dados.</span></li>
                           <li class="flex items-start"><i class="fas fa-file-contract success-color w-5 mt-1 mr-3"></i><span>Criação de páginas de **Política de Privacidade** e Termos de Uso.</span></li>
                        </ul>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const app = {
                navCards: document.getElementById('nav-cards'),
                contentSections: document.querySelectorAll('.content-section'),
                charts: {},
                
                init() {
                    this.setupEventListeners();
                    // Show the first section by default or a welcome message
                },

                setupEventListeners() {
                    this.navCards.addEventListener('click', (e) => {
                        const card = e.target.closest('div[data-target]');
                        if (card) {
                            const targetId = card.dataset.target;
                            this.showSection(targetId);
                        }
                    });
                },

                showSection(id) {
                    this.contentSections.forEach(section => {
                        if (section.id === id) {
                            section.classList.remove('section-hidden');
                            section.classList.add('section-visible');
                            // Scroll to the section smoothly
                            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            // Initialize chart if it exists and hasn't been created
                            this.initChart(id);
                        } else {
                            section.classList.add('section-hidden');
                            section.classList.remove('section-visible');
                        }
                    });
                },

                initChart(sectionId) {
                    if (this.charts[sectionId]) {
                        return; // Chart already initialized
                    }

                    switch (sectionId) {
                        case 'fase2':
                            this.createAbsenteeismChart();
                            break;
                        case 'fase4':
                            this.createFinancialChart();
                            this.createStatusChart();
                            this.createStockChart();
                            break;
                    }
                },

                createAbsenteeismChart() {
                    const ctx = document.getElementById('absenteeismChart').getContext('2d');
                    this.charts['fase2'] = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Sem Lembretes', 'Com Lembretes (Projeção)'],
                            datasets: [{
                                label: 'Taxa de Faltas (%)',
                                data: [25, 8],
                                backgroundColor: ['#E07A5F', '#81B29A'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: { y: { beginAtZero: true, max: 30 } },
                            plugins: { legend: { display: false } }
                        }
                    });
                },

                createFinancialChart() {
                    const ctx = document.getElementById('financialChart').getContext('2d');
                    this.charts['fase4_financial'] = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
                            datasets: [
                                {
                                    label: 'Entradas',
                                    data: [12000, 19000, 15000, 22000, 18000, 25000],
                                    borderColor: '#81B29A',
                                    backgroundColor: 'rgba(129, 178, 154, 0.2)',
                                    fill: true,
                                    tension: 0.3
                                },
                                {
                                    label: 'Saídas',
                                    data: [8000, 9500, 7000, 8500, 9000, 11000],
                                    borderColor: '#E07A5F',
                                    backgroundColor: 'rgba(224, 122, 95, 0.2)',
                                    fill: true,
                                    tension: 0.3
                                },
                            ]
                        },
                        options: { responsive: true, maintainAspectRatio: false }
                    });
                    this.charts['fase4'] = true; // Mark section as initialized
                },
                
                createStatusChart() {
                    const ctx = document.getElementById('statusChart').getContext('2d');
                    this.charts['fase4_status'] = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Realizadas', 'Agendadas', 'Canceladas'],
                            datasets: [{
                                label: 'Status das Consultas',
                                data: [120, 55, 15],
                                backgroundColor: ['#81B29A', '#3D405B', '#E07A5F'],
                                hoverOffset: 4
                            }]
                        },
                        options: { responsive: true, maintainAspectRatio: false }
                    });
                },
                
                createStockChart() {
                    const ctx = document.getElementById('stockChart').getContext('2d');
                    const stockData = {
                        labels: ['Analgésico', 'Luvas Descartáveis', 'Seringas', 'Algodão', 'Gaze'],
                        quantities: [50, 25, 15, 80, 22],
                        limits: [30, 20, 20, 50, 30],
                    };
                    
                    const backgroundColors = stockData.quantities.map((qty, index) => {
                        return qty < stockData.limits[index] ? '#E07A5F' : '#81B29A';
                    });

                    this.charts['fase4_stock'] = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: stockData.labels,
                            datasets: [{
                                label: 'Quantidade em Stock',
                                data: stockData.quantities,
                                backgroundColor: backgroundColors,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: {
                                        afterLabel: function(context) {
                                            const limit = stockData.limits[context.dataIndex];
                                            return `Limite Mínimo: ${limit}`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            };
            app.init();
        });
    </script>
</body>
</html>
