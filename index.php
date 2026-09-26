<?php
declare(strict_types=1);
$currentYear = date('Y');
$assetVersion = time();
?>
<!DOCTYPE html>
<html lang="pt-BR" data-lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniConvert Pro — Conversor Universal de Unidades, Engenharia e Moedas</title>
    <meta name="description" content="Conversor universal profissional de grandezas físicas, engenharia civil, mecânica, culinária e moedas em tempo real com inteligência artificial e modo offline (PWA).">
    
    <!-- PWA & Favicon -->
    <link rel="manifest" href="manifest.json">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="apple-touch-icon" href="icon-192.png">
    <meta name="theme-color" content="#4f46e5">

    <!-- Estilos & Fontes -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #06b6d4;
            --dark: #0f172a;
            --dark-light: #1e293b;
        }
        
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
            min-height: 100vh;
            color: #f1f5f9;
        }
        
        body.light-mode {
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 50%, #f8fafc 100%);
            color: #1e293b;
        }
        
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .light-mode .glass {
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(99, 102, 241, 0.2);
            color: #1e293b;
        }
        
        .glass-strong {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.14);
        }
        .light-mode .glass-strong {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(99, 102, 241, 0.25);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.08);
        }
        
        .light-mode .text-white { color: #0f172a !important; }
        .light-mode .text-white\/60, .light-mode .text-white\/40, .light-mode .text-gray-400 { color: #64748b !important; }
        
        .glow { box-shadow: 0 0 35px rgba(99, 102, 241, 0.35); }
        .glow-cyan { box-shadow: 0 0 30px rgba(6, 182, 212, 0.35); }
        
        .category-card {
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .category-card:hover {
            transform: translateY(-4px) scale(1.02);
        }
        .category-card.active {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%) !important;
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.45);
        }
        .category-card.active .cat-icon {
            background: rgba(255, 255, 255, 0.25) !important;
            color: #ffffff !important;
        }
        .category-card.active p, .category-card.active span {
            color: #ffffff !important;
        }
        
        .input-modern {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.12);
            transition: all 0.25s ease;
        }
        .input-modern:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
            background: rgba(255, 255, 255, 0.1);
        }
        .light-mode .input-modern {
            background: #ffffff;
            border: 2px solid rgba(99, 102, 241, 0.2);
            color: #0f172a;
        }
        .light-mode .input-modern:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        }
        
        .select-modern {
            background-color: #1e293b;
            color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.25rem;
        }
        .light-mode .select-modern {
            background-color: #ffffff;
            color: #0f172a;
        }
        .select-modern option {
            background-color: #1e293b;
            color: #ffffff;
            padding: 10px;
        }
        .light-mode .select-modern option {
            background-color: #ffffff;
            color: #0f172a;
        }
        
        .swap-btn {
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        .swap-btn:hover {
            transform: rotate(180deg) scale(1.1);
        }
        
        .pulse-live {
            animation: pulseLive 2s infinite;
        }
        @keyframes pulseLive {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.15); }
        }
        
        /* I18n Language Helpers */
        [data-lang="en"] [data-i18n-pt], [data-lang="pt"] [data-i18n-en] {
            display: none !important;
        }
        
        /* Rodapé Padronizado 4U.IA.BR */
        .footer-clean {
            position: relative;
            padding: 2.5rem 0 1.5rem;
            color: #94a3b8;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            margin-top: 4rem;
        }
        .light-mode .footer-clean {
            border-top: 1px solid rgba(99, 102, 241, 0.15);
            color: #64748b;
        }
        .footer-links {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.85rem;
            flex-wrap: wrap;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .footer-links a {
            transition: all 0.2s;
            text-decoration: none;
            color: inherit;
        }
        .footer-links a:hover {
            color: #06b6d4;
        }
        .footer-links .donate-link {
            color: #f59e0b;
            font-weight: 700;
        }
        .footer-links .donate-link:hover {
            color: #fbbf24;
        }
    </style>
</head>
<body class="p-3 md:p-6 lg:p-8 transition-colors duration-500">
    <!-- Toast Container -->
    <div id="toastContainer" class="fixed top-4 right-4 z-50 space-y-2 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <header class="flex flex-col lg:flex-row items-center justify-between mb-6 gap-4">
            <!-- Brand -->
            <div class="flex items-center gap-3.5 text-center lg:text-left justify-center lg:justify-start">
                <div class="w-13 h-13 rounded-2xl bg-gradient-to-br from-indigo-500 via-purple-600 to-cyan-500 flex items-center justify-center glow p-3">
                    <i class="fas fa-exchange-alt text-white text-2xl"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2 justify-center lg:justify-start">
                        <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">
                            Uni<span class="bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">Convert</span> Pro
                        </h1>
                        <span class="px-2 py-0.5 rounded-md bg-indigo-500/20 text-indigo-400 text-[11px] font-bold border border-indigo-500/30">v2.0 PWA</span>
                    </div>
                    <p class="text-gray-400 text-xs md:text-sm">
                        <span data-i18n-pt>Conversor Universal de Grandezas, Engenharia & Moedas em Tempo Real</span>
                        <span data-i18n-en>Universal Unit, Engineering & Real-Time Currency Converter with AI</span>
                    </p>
                </div>
            </div>
            
            <!-- Actions & Controls -->
            <div class="flex items-center gap-2 flex-wrap justify-center">
                <!-- Seletor de Idioma Bilíngue -->
                <div class="inline-flex items-center p-1 rounded-xl bg-gray-900/90 border border-gray-700/80 shadow-inner text-xs font-semibold">
                    <button id="btnLangPt" onclick="setAppLanguage('pt')" class="px-2.5 py-1.5 rounded-lg transition-all text-white bg-indigo-600 flex items-center gap-1.5 shadow">
                        <span>🇧🇷</span> <span>PT</span>
                    </button>
                    <button id="btnLangEn" onclick="setAppLanguage('en')" class="px-2.5 py-1.5 rounded-lg transition-all text-gray-400 hover:text-white flex items-center gap-1.5">
                        <span>🇺🇸</span> <span>EN</span>
                    </button>
                </div>

                <!-- Botão PWA Instalar App (Padrão 4U) -->
                <button id="btnPwaInstall" class="px-3.5 py-2 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold text-xs shadow-md shadow-cyan-500/20 hover:opacity-95 transition-all hidden items-center gap-2">
                    <i class="fas fa-download"></i>
                    <span data-i18n-pt>Instalar App</span>
                    <span data-i18n-en>Install App</span>
                </button>

                <!-- Calculadora -->
                <button id="calcToggle" class="w-10 h-10 rounded-xl glass flex items-center justify-center text-white hover:bg-white/10 transition-all" title="Calculadora Integrada">
                    <i class="fas fa-calculator"></i>
                </button>

                <!-- Histórico -->
                <button id="historyToggle" class="w-10 h-10 rounded-xl glass flex items-center justify-center text-white hover:bg-white/10 transition-all relative" title="Histórico de Conversões">
                    <i class="fas fa-history"></i>
                    <span id="historyBadge" class="absolute -top-1 -right-1 w-4 h-4 bg-rose-500 rounded-full text-[10px] font-bold flex items-center justify-center hidden">0</span>
                </button>
                
                <!-- Tema Claro/Escuro -->
                <button id="themeToggle" class="w-10 h-10 rounded-xl glass flex items-center justify-center text-white hover:bg-white/10 transition-all" title="Alternar Tema">
                    <i class="fas fa-moon" id="themeIcon"></i>
                </button>

                <!-- Configurações -->
                <button id="settingsToggle" class="w-10 h-10 rounded-xl glass flex items-center justify-center text-white hover:bg-white/10 transition-all" title="Configurações & Casas Decimais">
                    <i class="fas fa-cog"></i>
                </button>
            </div>
        </header>

        <!-- Barra Inteligente de Conversão com Linguagem Natural (Smart NLP / IA) -->
        <section class="glass-strong rounded-3xl p-4 md:p-5 mb-6 glow">
            <div class="flex flex-col md:flex-row items-center gap-3">
                <div class="flex items-center gap-2 text-indigo-400 font-bold text-sm shrink-0">
                    <div class="w-8 h-8 rounded-lg bg-indigo-500/20 flex items-center justify-center">
                        <i class="fas fa-wand-magic-sparkles"></i>
                    </div>
                    <span data-i18n-pt>Conversão Inteligente por IA:</span>
                    <span data-i18n-en>Smart Natural Language:</span>
                </div>
                
                <div class="relative flex-1 w-full">
                    <input 
                        type="text" 
                        id="smartInput" 
                        class="w-full px-4 py-2.5 pl-10 pr-24 rounded-xl bg-white/5 border border-white/15 text-white placeholder-gray-400 text-sm focus:outline-none focus:border-indigo-500 focus:bg-white/10 transition-all"
                        placeholder="Ex: 100 USD em BRL, 250 psi em bar, 35 MPa em kgf/cm², 15 kN em tf, 80 km/h em mph..."
                    >
                    <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    
                    <div class="absolute right-2 top-1/2 -translate-y-1/2 flex items-center gap-1">
                        <button id="voiceBtn" class="w-7 h-7 rounded-lg bg-white/10 hover:bg-indigo-500 text-white text-xs flex items-center justify-center transition-all" title="Falar comando por voz">
                            <i class="fas fa-microphone"></i>
                        </button>
                        <button id="btnExecSmart" class="px-2.5 py-1 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold transition-all">
                            <span data-i18n-pt>Converter</span>
                            <span data-i18n-en>Convert</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Chips de Sugestão Rápida -->
            <div class="flex items-center gap-2 mt-3 overflow-x-auto pb-1 text-xs text-gray-400">
                <span class="font-semibold shrink-0" data-i18n-pt>💡 Sugestões Rápidas:</span>
                <span class="font-semibold shrink-0" data-i18n-en>💡 Quick Chips:</span>
                <div class="flex gap-1.5 shrink-0" data-i18n-pt>
                    <button class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 text-cyan-300 transition-all" onclick="applySmartQuery('100 USD em BRL')">💵 100 USD ➔ BRL</button>
                    <button class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 text-cyan-300 transition-all" onclick="applySmartQuery('250 psi em bar')">🌪️ 250 psi ➔ bar</button>
                    <button class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 text-cyan-300 transition-all" onclick="applySmartQuery('35 MPa em kgf/cm2')">🏗️ 35 MPa ➔ kgf/cm²</button>
                    <button class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 text-cyan-300 transition-all" onclick="applySmartQuery('15 kN em tf')">⚡ 15 kN ➔ tf</button>
                    <button class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 text-cyan-300 transition-all" onclick="applySmartQuery('100 km/h em mph')">🏎️ 100 km/h ➔ mph</button>
                    <button class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 text-cyan-300 transition-all" onclick="applySmartQuery('12000 btu em kw')">❄️ 12.000 BTU ➔ kW</button>
                </div>
                <div class="flex gap-1.5 shrink-0" data-i18n-en>
                    <button class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 text-cyan-300 transition-all" onclick="applySmartQuery('100 USD to EUR')">💵 100 USD ➔ EUR</button>
                    <button class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 text-cyan-300 transition-all" onclick="applySmartQuery('250 psi to bar')">🌪️ 250 psi ➔ bar</button>
                    <button class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 text-cyan-300 transition-all" onclick="applySmartQuery('100 miles to km')">🏎️ 100 miles ➔ km</button>
                    <button class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 text-cyan-300 transition-all" onclick="applySmartQuery('50 kg to lbs')">⚖️ 50 kg ➔ lbs</button>
                    <button class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/15 border border-white/10 text-cyan-300 transition-all" onclick="applySmartQuery('75 F to C')">🌡️ 75 °F ➔ °C</button>
                </div>
            </div>
        </section>

        <!-- Stats Bar & Live Currency Indicator -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
            <div class="glass rounded-2xl p-3 text-center">
                <div class="text-2xl font-bold text-cyan-400" id="totalConversions">0</div>
                <div class="text-white/40 text-xs font-medium" data-i18n-pt>Conversões Realizadas</div>
                <div class="text-white/40 text-xs font-medium" data-i18n-en>Total Conversions</div>
            </div>
            <div class="glass rounded-2xl p-3 text-center">
                <div class="text-2xl font-bold text-purple-400" id="totalCategories">19</div>
                <div class="text-white/40 text-xs font-medium" data-i18n-pt>Categorias Especializadas</div>
                <div class="text-white/40 text-xs font-medium" data-i18n-en>Categories</div>
            </div>
            <div class="glass rounded-2xl p-3 text-center">
                <div class="text-2xl font-bold text-green-400" id="totalUnits">250+</div>
                <div class="text-white/40 text-xs font-medium" data-i18n-pt>Grandezas & Unidades</div>
                <div class="text-white/40 text-xs font-medium" data-i18n-en>Supported Units</div>
            </div>
            <div class="glass rounded-2xl p-3 text-center relative group cursor-pointer" onclick="fetchLiveExchangeRates(true)" title="Clique para atualizar cotações de câmbio agora">
                <div class="flex items-center justify-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 pulse-live"></span>
                    <span class="text-xs font-bold text-emerald-400" id="currencyStatusText">Live Câmbio</span>
                </div>
                <div class="text-white/50 text-[11px] mt-0.5" id="currencyLastUpdate">Atualizando taxas...</div>
            </div>
        </div>

        <!-- Seletor de Categorias em Carrossel Horizontal -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-white/60 text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                    <i class="fas fa-layer-group text-indigo-400"></i>
                    <span data-i18n-pt>Escolha a Categoria de Conversão:</span>
                    <span data-i18n-en>Select Conversion Category:</span>
                </h2>
                <div class="flex gap-2">
                    <button id="scrollLeft" class="w-8 h-8 rounded-lg glass text-white/60 hover:text-white hover:bg-white/10 transition-all flex items-center justify-center">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </button>
                    <button id="scrollRight" class="w-8 h-8 rounded-lg glass text-white/60 hover:text-white hover:bg-white/10 transition-all flex items-center justify-center">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </button>
                </div>
            </div>
            <div id="categoriesContainer" class="flex gap-2.5 overflow-x-auto pb-3 scroll-smooth no-scrollbar">
                <!-- Inserido dinamicamente via JS com 19 categorias -->
            </div>
        </div>

        <!-- Grid Principal do Conversor -->
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Conversor Central -->
            <div class="lg:col-span-2 space-y-6">
                <div class="glass-strong rounded-3xl p-6 md:p-8 glow">
                    <!-- Abas -->
                    <div class="flex gap-1.5 mb-6 p-1 bg-white/5 rounded-2xl w-fit">
                        <button class="tab-btn active px-4 py-2 rounded-xl text-white text-xs font-bold transition-all" data-tab="single">
                            <i class="fas fa-exchange-alt mr-1.5"></i>
                            <span data-i18n-pt>Simples</span><span data-i18n-en>Single</span>
                        </button>
                        <button class="tab-btn px-4 py-2 rounded-xl text-white/60 text-xs font-bold transition-all" data-tab="multi">
                            <i class="fas fa-list mr-1.5"></i>
                            <span data-i18n-pt>Todas as Unidades</span><span data-i18n-en>All Units</span>
                        </button>
                        <button class="tab-btn px-4 py-2 rounded-xl text-white/60 text-xs font-bold transition-all" data-tab="compare">
                            <i class="fas fa-chart-bar mr-1.5"></i>
                            <span data-i18n-pt>Visual</span><span data-i18n-en>Visual</span>
                        </button>
                    </div>

                    <!-- Aba 1: Conversão Simples (1 para 1) -->
                    <div id="singleTab" class="space-y-6">
                        <!-- De: -->
                        <div>
                            <label class="flex items-center gap-2 text-white/70 text-xs font-bold mb-2">
                                <span class="w-5 h-5 rounded-md bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                                <span data-i18n-pt>Converter de:</span>
                                <span data-i18n-en>Convert from:</span>
                            </label>
                            <div class="flex flex-col md:flex-row gap-3">
                                <div class="relative flex-1">
                                    <input 
                                        type="text" 
                                        id="inputValue" 
                                        class="input-modern w-full px-5 py-4 text-2xl md:text-3xl font-extrabold text-white rounded-2xl focus:outline-none"
                                        placeholder="0"
                                        value="1"
                                        inputmode="decimal"
                                    >
                                    <button id="clearInput" class="absolute right-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-lg bg-white/10 text-white/40 hover:text-white hover:bg-white/20 transition-all flex items-center justify-center" title="Limpar">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                                <div class="relative md:w-72">
                                    <select id="fromUnit" class="select-modern input-modern w-full px-4 py-4 text-base font-semibold text-white rounded-2xl focus:outline-none appearance-none cursor-pointer">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Botão de Inverter (Swap) -->
                        <div class="flex justify-center py-1">
                            <button id="swapBtn" class="swap-btn w-12 h-12 rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white shadow-lg glow hover:scale-105 active:scale-95" title="Inverter Unidades">
                                <i class="fas fa-sync-alt text-lg"></i>
                            </button>
                        </div>

                        <!-- Para (Resultado): -->
                        <div>
                            <label class="flex items-center gap-2 text-white/70 text-xs font-bold mb-2">
                                <span class="w-5 h-5 rounded-md bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-arrow-left"></i>
                                </span>
                                <span data-i18n-pt>Resultado Convertido:</span>
                                <span data-i18n-en>Converted Result:</span>
                            </label>
                            <div class="flex flex-col md:flex-row gap-3">
                                <div class="flex-1 relative group">
                                    <div class="bg-gradient-to-r from-cyan-500/15 via-purple-500/10 to-indigo-500/15 border-2 border-cyan-500/30 px-5 py-4 rounded-2xl flex items-center justify-between">
                                        <span id="resultValue" class="text-2xl md:text-3xl font-extrabold bg-gradient-to-r from-cyan-300 via-teal-200 to-purple-300 bg-clip-text text-transparent break-all">1</span>
                                    </div>
                                    <div class="absolute right-3 top-1/2 -translate-y-1/2 flex gap-1.5 opacity-90 group-hover:opacity-100 transition-all">
                                        <button id="copyResult" class="w-9 h-9 rounded-xl bg-white/10 text-white/70 hover:text-cyan-400 hover:bg-cyan-500/20 transition-all flex items-center justify-center" title="Copiar Resultado">
                                            <i class="fas fa-copy text-sm"></i>
                                        </button>
                                        <button id="shareResult" class="w-9 h-9 rounded-xl bg-white/10 text-white/70 hover:text-emerald-400 hover:bg-emerald-500/20 transition-all flex items-center justify-center" title="Compartilhar">
                                            <i class="fas fa-share-alt text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                                <select id="toUnit" class="select-modern input-modern md:w-72 px-4 py-4 text-base font-semibold text-white rounded-2xl focus:outline-none appearance-none cursor-pointer">
                                </select>
                            </div>
                        </div>

                        <!-- Card de Fórmula Explicada & Favoritar -->
                        <div class="flex flex-col md:flex-row gap-3 mt-4 pt-4 border-t border-white/10">
                            <div class="flex-1 p-3.5 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center">
                                        <i class="fas fa-square-root-variable text-sm"></i>
                                    </div>
                                    <div>
                                        <span class="text-white/40 text-[10px] uppercase font-bold tracking-wider" data-i18n-pt>Fórmula de Conversão:</span>
                                        <span class="text-white/40 text-[10px] uppercase font-bold tracking-wider" data-i18n-en>Conversion Formula:</span>
                                        <p id="formula" class="text-white font-medium text-xs md:text-sm">1 Metro = 100 Centímetros</p>
                                    </div>
                                </div>
                                <button id="copyFormula" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-white/15 text-white/40 hover:text-indigo-400 flex items-center justify-center transition-all" title="Copiar Fórmula">
                                    <i class="fas fa-copy text-xs"></i>
                                </button>
                            </div>
                            
                            <button id="addFavFromMain" class="px-5 py-3.5 rounded-2xl bg-amber-500/10 hover:bg-amber-500/20 border border-amber-500/25 text-amber-400 font-bold text-xs flex items-center justify-center gap-2 transition-all">
                                <i class="fas fa-star"></i>
                                <span data-i18n-pt>Favoritar Par</span>
                                <span data-i18n-en>Bookmark</span>
                            </button>
                        </div>
                    </div>

                    <!-- Aba 2: Todas as Unidades em Tabela Rápida -->
                    <div id="multiTab" class="hidden space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="text-white/70 text-xs font-bold" data-i18n-pt>Conversão Simultânea para Todas as Unidades:</label>
                            <label class="text-white/70 text-xs font-bold" data-i18n-en>Simultaneous Conversion for All Units:</label>
                            <button id="copyAllMulti" class="text-xs text-indigo-400 hover:text-indigo-300 font-semibold flex items-center gap-1">
                                <i class="fas fa-copy"></i>
                                <span data-i18n-pt>Copiar Todas</span>
                                <span data-i18n-en>Copy All</span>
                            </button>
                        </div>
                        <div id="multiResults" class="grid gap-2 max-h-96 overflow-y-auto pr-1">
                            <!-- Inserido dinamicamente via JS -->
                        </div>
                    </div>

                    <!-- Aba 3: Comparativo Visual -->
                    <div id="compareTab" class="hidden space-y-4">
                        <label class="text-white/70 text-xs font-bold block" data-i18n-pt>Proporção Visual em Escala:</label>
                        <label class="text-white/70 text-xs font-bold block" data-i18n-en>Visual Proportional Scale:</label>
                        <div id="compareResults" class="space-y-3 max-h-96 overflow-y-auto pr-1">
                            <!-- Inserido dinamicamente via JS -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Painel Lateral: Favoritos & Guia Técnico -->
            <div class="space-y-6">
                <!-- Card de Favoritos -->
                <div class="glass-strong rounded-3xl p-6 glow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-white font-bold text-sm flex items-center gap-2">
                            <i class="fas fa-star text-amber-400"></i>
                            <span data-i18n-pt>Conversões Salvas</span>
                            <span data-i18n-en>Saved Conversions</span>
                        </h3>
                        <span id="favsCountBadge" class="px-2 py-0.5 rounded-full bg-white/10 text-white/60 text-xs">0</span>
                    </div>
                    
                    <div id="favoritesList" class="space-y-2 max-h-48 overflow-y-auto pr-1">
                        <p class="text-gray-400 text-xs text-center py-4" data-i18n-pt>Nenhum par favoritado ainda. Clique em "Favoritar Par" para salvar acessos rápidos.</p>
                        <p class="text-gray-400 text-xs text-center py-4" data-i18n-en>No bookmarks yet. Click "Bookmark" to save quick conversions.</p>
                    </div>
                </div>

                <!-- Info Card da Unidade Ativa -->
                <div class="glass-strong rounded-3xl p-6">
                    <div class="flex items-center gap-2.5 text-cyan-400 font-bold text-sm mb-3">
                        <i class="fas fa-circle-info"></i>
                        <span data-i18n-pt>Informações & Definição Técnica</span>
                        <span data-i18n-en>Technical Definition</span>
                    </div>
                    <div id="unitTechnicalInfo" class="text-xs text-gray-300 leading-relaxed space-y-2">
                        <!-- Atualizado via JS -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Rodapé Padronizado 4U.IA.BR (webapp-footer-standard.md) -->
        <footer class="footer-clean text-center">
            <div class="flex items-center justify-center gap-2 mb-2 font-bold text-sm text-white">
                <div class="w-6 h-6 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-xs">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <span>UniConvert Pro — 4U.IA.BR</span>
            </div>

            <div class="footer-links">
                <a href="privacidade.php">
                    <span data-i18n-pt>Privacidade</span><span data-i18n-en>Privacy</span>
                </a>
                <span class="text-gray-600">•</span>
                <a href="termos.php">
                    <span data-i18n-pt>Termos de Uso</span><span data-i18n-en>Terms of Use</span>
                </a>
                <span class="text-gray-600">•</span>
                <a href="suporte.php">
                    <span data-i18n-pt>Suporte & FAQ</span><span data-i18n-en>Support & FAQ</span>
                </a>
                <span class="text-gray-600">•</span>
                <a href="https://www.paypal.com/ncp/payment/L7YRCS984T33N" target="_blank" rel="noopener noreferrer" class="donate-link" title="Apoie o Projeto via PayPal">
                    ☕ <span data-i18n-pt>Apoie o Projeto</span><span data-i18n-en>Support with PayPal</span>
                </a>
                <span class="text-gray-600">•</span>
                <a href="https://github.com/4u-Labs" target="_blank" rel="noopener noreferrer" title="Perfil 4u-Labs no GitHub">
                    <i class="fab fa-github"></i> GitHub
                </a>
            </div>

            <div class="mt-4 text-[11px] text-gray-500">
                &copy; <span id="year"><?= $currentYear ?></span> 4U.IA.BR — <span data-i18n-pt>Todos os direitos reservados. Processamento 100% no cliente com retenção zero de dados.</span><span data-i18n-en>All rights reserved. 100% Client-Side Processing with Zero Server Data Retention.</span>
            </div>
        </footer>
    </div>

    <!-- Modais: Calculadora, Histórico, Configurações, Compartilhar -->
    <!-- Modal Calculadora -->
    <div id="calculatorModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('calculatorModal')"></div>
        <div class="relative w-full max-w-xs glass-strong rounded-3xl p-5 border border-white/15 z-10">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-white font-bold text-sm flex items-center gap-2">
                    <i class="fas fa-calculator text-indigo-400"></i>
                    <span data-i18n-pt>Calculadora</span><span data-i18n-en>Calculator</span>
                </h3>
                <button onclick="closeModal('calculatorModal')" class="text-white/40 hover:text-white transition-all">✕</button>
            </div>
            <div class="bg-white/5 rounded-xl p-3 mb-3 text-right">
                <div id="calcExpression" class="text-xs text-white/40 h-4"></div>
                <div id="calcDisplay" class="text-2xl font-bold text-white overflow-x-auto">0</div>
            </div>
            <div class="grid grid-cols-4 gap-1.5 text-sm font-bold">
                <button class="py-2.5 rounded-xl bg-rose-500/20 text-rose-400" onclick="calcClear()">C</button>
                <button class="py-2.5 rounded-xl bg-white/10 text-white/70" onclick="calcInput('(')">(</button>
                <button class="py-2.5 rounded-xl bg-white/10 text-white/70" onclick="calcInput(')')">)</button>
                <button class="py-2.5 rounded-xl bg-indigo-500/30 text-indigo-300" onclick="calcInput('/')">÷</button>
                
                <button class="py-2.5 rounded-xl bg-white/10 text-white" onclick="calcInput('7')">7</button>
                <button class="py-2.5 rounded-xl bg-white/10 text-white" onclick="calcInput('8')">8</button>
                <button class="py-2.5 rounded-xl bg-white/10 text-white" onclick="calcInput('9')">9</button>
                <button class="py-2.5 rounded-xl bg-indigo-500/30 text-indigo-300" onclick="calcInput('*')">×</button>
                
                <button class="py-2.5 rounded-xl bg-white/10 text-white" onclick="calcInput('4')">4</button>
                <button class="py-2.5 rounded-xl bg-white/10 text-white" onclick="calcInput('5')">5</button>
                <button class="py-2.5 rounded-xl bg-white/10 text-white" onclick="calcInput('6')">6</button>
                <button class="py-2.5 rounded-xl bg-indigo-500/30 text-indigo-300" onclick="calcInput('-')">−</button>
                
                <button class="py-2.5 rounded-xl bg-white/10 text-white" onclick="calcInput('1')">1</button>
                <button class="py-2.5 rounded-xl bg-white/10 text-white" onclick="calcInput('2')">2</button>
                <button class="py-2.5 rounded-xl bg-white/10 text-white" onclick="calcInput('3')">3</button>
                <button class="py-2.5 rounded-xl bg-indigo-500/30 text-indigo-300" onclick="calcInput('+')">+</button>
                
                <button class="py-2.5 rounded-xl bg-white/10 text-white" onclick="calcInput('0')">0</button>
                <button class="py-2.5 rounded-xl bg-white/10 text-white" onclick="calcInput('.')">.</button>
                <button class="py-2.5 rounded-xl bg-white/10 text-white/70" onclick="calcBackspace()">⌫</button>
                <button class="py-2.5 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 text-white" onclick="calcEquals()">=</button>
            </div>
            <button onclick="useCalcResult()" class="w-full mt-3 py-2.5 rounded-xl bg-cyan-500/20 text-cyan-300 hover:bg-cyan-500/30 text-xs font-bold transition-all">
                <span data-i18n-pt>Usar Valor no Conversor</span>
                <span data-i18n-en>Use Value in Converter</span>
            </button>
        </div>
    </div>

    <!-- Modal Histórico -->
    <div id="historyModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('historyModal')"></div>
        <div class="relative w-full max-w-md glass-strong rounded-3xl p-6 border border-white/15 z-10">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-white font-bold text-sm flex items-center gap-2">
                    <i class="fas fa-history text-cyan-400"></i>
                    <span data-i18n-pt>Histórico de Conversões</span>
                    <span data-i18n-en>Conversion History</span>
                </h3>
                <div class="flex items-center gap-2">
                    <button onclick="clearHistory()" class="text-xs text-rose-400 hover:text-rose-300" data-i18n-pt>Limpar</button>
                    <button onclick="clearHistory()" class="text-xs text-rose-400 hover:text-rose-300" data-i18n-en>Clear</button>
                    <button onclick="closeModal('historyModal')" class="text-white/40 hover:text-white transition-all ml-2">✕</button>
                </div>
            </div>
            <div id="historyList" class="space-y-2 max-h-80 overflow-y-auto pr-1">
                <!-- Itens via JS -->
            </div>
        </div>
    </div>

    <!-- Modal Configurações -->
    <div id="settingsModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('settingsModal')"></div>
        <div class="relative w-full max-w-sm glass-strong rounded-3xl p-6 border border-white/15 z-10 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-white font-bold text-sm flex items-center gap-2">
                    <i class="fas fa-cog text-indigo-400"></i>
                    <span data-i18n-pt>Configurações</span>
                    <span data-i18n-en>Settings</span>
                </h3>
                <button onclick="closeModal('settingsModal')" class="text-white/40 hover:text-white transition-all">✕</button>
            </div>
            <div>
                <label class="text-xs font-bold text-gray-300 block mb-1">
                    <span data-i18n-pt>Casas Decimais de Precisão (0 a 10):</span>
                    <span data-i18n-en>Decimal Precision (0 to 10):</span>
                </label>
                <div class="flex items-center gap-3">
                    <input type="range" id="precisionRange" min="0" max="10" value="4" class="w-full accent-indigo-500 cursor-pointer">
                    <span id="precisionDisplay" class="text-sm font-bold text-cyan-400 w-6 text-center">4</span>
                </div>
            </div>
            <button onclick="closeModal('settingsModal')" class="w-full py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold transition-all">
                <span data-i18n-pt>Salvar & Fechar</span>
                <span data-i18n-en>Save & Close</span>
            </button>
        </div>
    </div>

    <!-- Modal Compartilhar -->
    <div id="shareModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('shareModal')"></div>
        <div class="relative w-full max-w-sm glass-strong rounded-3xl p-6 border border-white/15 z-10 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-white font-bold text-sm flex items-center gap-2">
                    <i class="fas fa-share-alt text-emerald-400"></i>
                    <span data-i18n-pt>Compartilhar Conversão</span>
                    <span data-i18n-en>Share Conversion</span>
                </h3>
                <button onclick="closeModal('shareModal')" class="text-white/40 hover:text-white transition-all">✕</button>
            </div>
            <div class="p-3 rounded-xl bg-white/5 border border-white/10 text-center">
                <p id="shareTextDisplay" class="text-white font-bold text-sm"></p>
            </div>
            <div class="grid grid-cols-2 gap-2 text-xs font-bold">
                <button onclick="shareViaApp('whatsapp')" class="py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white flex items-center justify-center gap-1.5">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </button>
                <button onclick="shareViaApp('telegram')" class="py-2.5 rounded-xl bg-sky-600 hover:bg-sky-500 text-white flex items-center justify-center gap-1.5">
                    <i class="fab fa-telegram"></i> Telegram
                </button>
            </div>
            <button onclick="copyShareText()" class="w-full py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold transition-all">
                <i class="fas fa-copy mr-1"></i> <span data-i18n-pt>Copiar Texto</span><span data-i18n-en>Copy Text</span>
            </button>
        </div>
    </div>

    <!-- Scripts da Aplicação -->
    <script>
        /* ==========================================================================
           1. DADOS DE TODAS AS 19 CATEGORIAS (FÍSICAS, ENGENHARIA, CULINÁRIA, MOEDAS)
           ========================================================================== */
        const unitData = {
            moedas: {
                icon: 'fa-coins',
                color: 'from-amber-500 to-yellow-500',
                namePt: 'Moedas & Cripto',
                nameEn: 'Currency & Crypto',
                isCurrency: true,
                units: {
                    'BRL': { namePt: 'Real Brasileiro', nameEn: 'Brazilian Real', symbol: 'R$', rateToBrl: 1.0, info: 'Moeda oficial do Brasil' },
                    'USD': { namePt: 'Dólar Americano', nameEn: 'US Dollar', symbol: '$', rateToBrl: 5.18, info: 'Moeda de reserva global dos Estados Unidos' },
                    'EUR': { namePt: 'Euro', nameEn: 'Euro', symbol: '€', rateToBrl: 5.65, info: 'Moeda oficial da Zona do Euro' },
                    'GBP': { namePt: 'Libra Esterlina', nameEn: 'British Pound', symbol: '£', rateToBrl: 6.72, info: 'Moeda oficial do Reino Unido' },
                    'JPY': { namePt: 'Iene Japonês', nameEn: 'Japanese Yen', symbol: '¥', rateToBrl: 0.035, info: 'Moeda oficial do Japão' },
                    'CAD': { namePt: 'Dólar Canadense', nameEn: 'Canadian Dollar', symbol: 'C$', rateToBrl: 3.82, info: 'Moeda oficial do Canadá' },
                    'AUD': { namePt: 'Dólar Australiano', nameEn: 'Australian Dollar', symbol: 'A$', rateToBrl: 3.45, info: 'Moeda oficial da Austrália' },
                    'CHF': { namePt: 'Franco Suíço', nameEn: 'Swiss Franc', symbol: 'CHF', rateToBrl: 5.85, info: 'Moeda oficial da Suíça' },
                    'CNY': { namePt: 'Yuan Chinês', nameEn: 'Chinese Yuan', symbol: '¥', rateToBrl: 0.72, info: 'Moeda oficial da China' },
                    'ARS': { namePt: 'Peso Argentino', nameEn: 'Argentine Peso', symbol: '$', rateToBrl: 0.0055, info: 'Moeda oficial da Argentina' },
                    'BTC': { namePt: 'Bitcoin', nameEn: 'Bitcoin', symbol: '₿', rateToBrl: 345000.0, info: 'Primeira e maior criptomoeda descentralizada' },
                    'ETH': { namePt: 'Ethereum', nameEn: 'Ethereum', symbol: 'Ξ', rateToBrl: 18500.0, info: 'Criptoativo da rede Ethereum' },
                    'SOL': { namePt: 'Solana', nameEn: 'Solana', symbol: 'SOL', rateToBrl: 780.0, info: 'Criptomoeda de alta velocidade Solana' },
                    'USDT': { namePt: 'Tether (USDT)', nameEn: 'Tether USD', symbol: '₮', rateToBrl: 5.18, info: 'Stablecoin pareada 1:1 com o dólar americano' }
                }
            },
            tensao: {
                icon: 'fa-shield-halved',
                color: 'from-blue-600 to-indigo-600',
                namePt: 'Tensão & Resistência',
                nameEn: 'Stress & Pressure (Eng)',
                baseUnit: 'pascal',
                units: {
                    'megapascal': { namePt: 'Megapascal (MPa)', nameEn: 'Megapascal (MPa)', symbol: 'MPa', factor: 1e6, info: 'Unidade universal de resistência do concreto e aço (1 MPa = 10,197 kgf/cm²).' },
                    'kgf_cm2': { namePt: 'Quilograma-força/cm²', nameEn: 'Kilogram-force/cm²', symbol: 'kgf/cm²', factor: 98066.5, info: 'Unidade tradicional de resistência do concreto no Brasil (1 kgf/cm² ≈ 0,098 MPa).' },
                    'bar': { namePt: 'Bar', nameEn: 'Bar', symbol: 'bar', factor: 1e5, info: '1 bar = 100.000 Pa ≈ 1,0197 kgf/cm².' },
                    'psi': { namePt: 'Libras por pol² (PSI)', nameEn: 'Pound per sq inch (psi)', symbol: 'psi', factor: 6894.757, info: 'Unidade imperial comum em pneus e testes hidráulicos.' },
                    'n_mm2': { namePt: 'Newton por mm²', nameEn: 'Newton per sq mm', symbol: 'N/mm²', factor: 1e6, info: 'Exatamente igual a 1 Megapascal (1 N/mm² = 1 MPa).' },
                    'kilopascal': { namePt: 'Kilopascal (kPa)', nameEn: 'Kilopascal (kPa)', symbol: 'kPa', factor: 1e3, info: 'Usado em geotecnia e capacidade de carga do solo.' },
                    'pascal': { namePt: 'Pascal (Pa)', nameEn: 'Pascal (Pa)', symbol: 'Pa', factor: 1, info: 'Unidade fundamental do SI (1 N/m²).' },
                    'gigapascal': { namePt: 'Gigapascal (GPa)', nameEn: 'Gigapascal (GPa)', symbol: 'GPa', factor: 1e9, info: 'Usado para módulo de elasticidade do aço (E ≈ 210 GPa).' },
                    'atmosfera': { namePt: 'Atmosfera padrão (atm)', nameEn: 'Atmosphere (atm)', symbol: 'atm', factor: 101325, info: 'Pressão ao nível do mar (1 atm = 101.325 Pa).' },
                    'mmhg': { namePt: 'Milímetros de mercúrio', nameEn: 'mmHg', symbol: 'mmHg', factor: 133.322, info: 'Usado em manometria médica e vácuo.' }
                }
            },
            forca: {
                icon: 'fa-dumbbell',
                color: 'from-amber-600 to-red-600',
                namePt: 'Força & Carga',
                nameEn: 'Force & Load',
                baseUnit: 'newton',
                units: {
                    'quilonewton': { namePt: 'Quilonewton (kN)', nameEn: 'Kilonewton (kN)', symbol: 'kN', factor: 1000, info: 'Unidade padrão em projetos estruturais (1 kN ≈ 101,97 kgf ≈ 0,102 tf).' },
                    'quilograma_forca': { namePt: 'Quilograma-força (kgf)', nameEn: 'Kilogram-force (kgf)', symbol: 'kgf', factor: 9.80665, info: 'Força gravitacional exercida por 1 kg.' },
                    'tonelada_forca': { namePt: 'Tonelada-força (tf)', nameEn: 'Tonne-force (tf)', symbol: 'tf', factor: 9806.65, info: '1 tf = 1.000 kgf ≈ 9,807 kN.' },
                    'newton': { namePt: 'Newton (N)', nameEn: 'Newton (N)', symbol: 'N', factor: 1, info: 'Unidade padrão de força do Sistema Internacional.' },
                    'meganewton': { namePt: 'Meganewton (MN)', nameEn: 'Meganewton (MN)', symbol: 'MN', factor: 1e6, info: 'Usado em grandes cargas de fundações (1 MN = 1.000 kN).' },
                    'libra_forca': { namePt: 'Libra-força (lbf)', nameEn: 'Pound-force (lbf)', symbol: 'lbf', factor: 4.448222, info: 'Unidade imperial de força (1 lbf ≈ 4,448 N).' },
                    'kip': { namePt: 'Kip (1000 lbf)', nameEn: 'Kip (kilo-pound)', symbol: 'kip', factor: 4448.222, info: '1.000 libras-força usadas na engenharia norte-americana.' },
                    'dina': { namePt: 'Dina (dyn)', nameEn: 'Dyne (dyn)', symbol: 'dyn', factor: 1e-5, info: 'Unidade CGS de força.' }
                }
            },
            torque: {
                icon: 'fa-rotate',
                color: 'from-orange-500 to-amber-500',
                namePt: 'Torque & Momento',
                nameEn: 'Torque & Moment',
                baseUnit: 'newton_metro',
                units: {
                    'newton_metro': { namePt: 'Newton-metro (N·m)', nameEn: 'Newton-meter (N·m)', symbol: 'N·m', factor: 1, info: 'Unidade padrão de momento torsor e fletor.' },
                    'quilonewton_metro': { namePt: 'Quilonewton-metro (kN·m)', nameEn: 'Kilonewton-meter (kN·m)', symbol: 'kN·m', factor: 1000, info: 'Unidade clássica de momento fletor em vigas e lajes.' },
                    'quilograma_forca_metro': { namePt: 'Quilograma-força metro', nameEn: 'Kilogram-force meter', symbol: 'kgf·m', factor: 9.80665, info: 'Usado na mecânica automotiva e ferramentas.' },
                    'libra_forca_pe': { namePt: 'Libra-força pé (lbf·ft)', nameEn: 'Pound-force foot', symbol: 'lbf·ft', factor: 1.355818, info: 'Torque no padrão imperial britânico/americano.' },
                    'libra_forca_pol': { namePt: 'Libra-força pol (lbf·in)', nameEn: 'Pound-force inch', symbol: 'lbf·in', factor: 0.1129848, info: 'Torque para componentes pequenos e parafusos.' }
                }
            },
            potencia: {
                icon: 'fa-bolt-lightning',
                color: 'from-yellow-500 to-amber-600',
                namePt: 'Potência & Clima',
                nameEn: 'Power & HVAC',
                baseUnit: 'watt',
                units: {
                    'quilowatt': { namePt: 'Quilowatt (kW)', nameEn: 'Kilowatt (kW)', symbol: 'kW', factor: 1000, info: '1.000 Watts. Usado em motores e consumo elétrico.' },
                    'cavalo_vapor': { namePt: 'Cavalo-vapor (cv)', nameEn: 'Metric Horsepower (cv)', symbol: 'cv', factor: 735.49875, info: 'Unidade métrica de potência de veículos no Brasil (1 cv = 735,5 W).' },
                    'horsepower': { namePt: 'Horsepower (HP)', nameEn: 'Horsepower (HP)', symbol: 'HP', factor: 745.69987, info: 'Unidade imperial de potência mecânica (1 HP = 745,7 W).' },
                    'watt': { namePt: 'Watt (W)', nameEn: 'Watt (W)', symbol: 'W', factor: 1, info: 'Unidade SI de potência (1 Joule por segundo).' },
                    'megawatt': { namePt: 'Megawatt (MW)', nameEn: 'Megawatt (MW)', symbol: 'MW', factor: 1e6, info: '1 milhão de Watts. Geração de usinas e redes elétricas.' },
                    'btu_hora': { namePt: 'BTU por hora (BTU/h)', nameEn: 'BTU per hour (BTU/h)', symbol: 'BTU/h', factor: 0.293071, info: 'Capacidade de aparelhos de ar-condicionado (12.000 BTU/h ≈ 3,516 kW).' },
                    'ton_refrigeracao': { namePt: 'Ton. de Refrigeração (TR)', nameEn: 'Ton of Refrigeration (TR)', symbol: 'TR', factor: 3516.853, info: 'Usado em sistemas de climatização central (1 TR = 12.000 BTU/h).' },
                    'kcal_hora': { namePt: 'Kilocaloria/hora', nameEn: 'Kilocalorie per hour', symbol: 'kcal/h', factor: 1.163, info: 'Usado em caldeiras e aquecimento térmico.' }
                }
            },
            vazao: {
                icon: 'fa-water',
                color: 'from-cyan-500 to-blue-500',
                namePt: 'Vazão Hidráulica',
                nameEn: 'Flow Rate',
                baseUnit: 'litro_segundo',
                units: {
                    'litro_segundo': { namePt: 'Litros por segundo (L/s)', nameEn: 'Liters per sec (L/s)', symbol: 'L/s', factor: 1, info: 'Unidade padrão em projetos de hidráulica predial.' },
                    'metro_cubico_hora': { namePt: 'Metro cúbico por hora (m³/h)', nameEn: 'Cubic meters per hour', symbol: 'm³/h', factor: 1000/3600, info: 'Vazão em bombas e consumo de água (1 L/s = 3,6 m³/h).' },
                    'litro_minuto': { namePt: 'Litros por minuto (L/min)', nameEn: 'Liters per min', symbol: 'L/min', factor: 1/60, info: 'Usado em torneiras, chuveiros e filtros.' },
                    'metro_cubico_segundo': { namePt: 'Metro cúbico por seg (m³/s)', nameEn: 'Cubic meters per sec', symbol: 'm³/s', factor: 1000, info: 'Vazão de rios, canais e vertedouros de barragens.' },
                    'galao_minuto': { namePt: 'Galões por minuto (GPM)', nameEn: 'Gallons per min (GPM)', symbol: 'gpm', factor: 0.0630902, info: 'Padrão norte-americano de combate a incêndio e bombas.' }
                }
            },
            combustivel: {
                icon: 'fa-gas-pump',
                color: 'from-emerald-500 to-teal-600',
                namePt: 'Consumo de Combustível',
                nameEn: 'Fuel Consumption',
                isSpecial: true,
                units: {
                    'km_l': { namePt: 'Quilômetros por litro', nameEn: 'Kilometers per liter', symbol: 'km/L', info: 'Padrão brasileiro de eficiência energética veicular.' },
                    'l_100km': { namePt: 'Litros por 100 km', nameEn: 'Liters per 100 km', symbol: 'L/100km', info: 'Padrão europeu de consumo de combustível.' },
                    'mpg_us': { namePt: 'Milhas por galão (US)', nameEn: 'Miles per gallon (US)', symbol: 'MPG US', info: 'Padrão nos Estados Unidos.' },
                    'mpg_uk': { namePt: 'Milhas por galão (UK)', nameEn: 'Miles per gallon (UK)', symbol: 'MPG UK', info: 'Padrão britânico imperial.' }
                }
            },
            angulo: {
                icon: 'fa-shapes',
                color: 'from-violet-500 to-purple-600',
                namePt: 'Ângulos & Geodésia',
                nameEn: 'Angle & Geometry',
                baseUnit: 'radiano',
                units: {
                    'grau': { namePt: 'Grau (°)', nameEn: 'Degree (°)', symbol: '°', factor: Math.PI / 180, info: 'Círculo completo = 360°.' },
                    'radiano': { namePt: 'Radiano (rad)', nameEn: 'Radian (rad)', symbol: 'rad', factor: 1, info: 'Unidade fundamental do SI (2π rad = 360°).' },
                    'grado': { namePt: 'Grado (gon)', nameEn: 'Gradian (gon)', symbol: 'gon', factor: Math.PI / 200, info: 'Círculo dividido em 400 grados.' },
                    'minuto_arco': { namePt: 'Minuto de arco (\')', nameEn: 'Arcminute (\')', symbol: '\'', factor: Math.PI / (180 * 60), info: '1/60 de um grau.' },
                    'segundo_arco': { namePt: 'Segundo de arco (\")', nameEn: 'Arcsecond (\")', symbol: '\"', factor: Math.PI / (180 * 3600), info: '1/3600 de um grau.' }
                }
            },
            culinaria: {
                icon: 'fa-kitchen-set',
                color: 'from-rose-500 to-pink-500',
                namePt: 'Culinária & Cozinha',
                nameEn: 'Cooking & Kitchen',
                baseUnit: 'mililitro',
                units: {
                    'xicara': { namePt: 'Xícara de Chá (padrão)', nameEn: 'Standard Cup', symbol: 'xícara', factor: 240, info: '1 xícara padrão de receita = 240 mL.' },
                    'colher_sopa': { namePt: 'Colher de Sopa', nameEn: 'Tablespoon (tbsp)', symbol: 'c. sopa', factor: 15, info: '1 colher de sopa = 15 mL.' },
                    'colher_cha': { namePt: 'Colher de Chá', nameEn: 'Teaspoon (tsp)', symbol: 'c. chá', factor: 5, info: '1 colher de chá = 5 mL.' },
                    'copo_americano': { namePt: 'Copo Americano (200mL)', nameEn: 'American Tumbler (200mL)', symbol: 'copo', factor: 200, info: 'Copo comum de medidas em receitas brasileiras.' },
                    'copo_requeijao': { namePt: 'Copo de Requeijão (250mL)', nameEn: 'Cream Cheese Cup (250mL)', symbol: 'copo req.', factor: 250, info: 'Copo tradicional de requeijão = 250 mL.' },
                    'mililitro': { namePt: 'Mililitro', nameEn: 'Milliliter', symbol: 'mL', factor: 1, info: 'Unidade básica de líquidos.' },
                    'litro': { namePt: 'Litro', nameEn: 'Liter', symbol: 'L', factor: 1000, info: '1000 mL.' }
                }
            },
            comprimento: {
                icon: 'fa-ruler-combined',
                color: 'from-blue-500 to-cyan-500',
                namePt: 'Comprimento',
                nameEn: 'Length',
                baseUnit: 'metro',
                units: {
                    'metro': { namePt: 'Metro', nameEn: 'Meter', symbol: 'm', factor: 1, info: 'Unidade base do SI para comprimento.' },
                    'quilometro': { namePt: 'Quilômetro', nameEn: 'Kilometer', symbol: 'km', factor: 1000, info: '1.000 metros.' },
                    'centimetro': { namePt: 'Centímetro', nameEn: 'Centimeter', symbol: 'cm', factor: 0.01, info: '1/100 de um metro.' },
                    'milimetro': { namePt: 'Milímetro', nameEn: 'Millimeter', symbol: 'mm', factor: 0.001, info: '1/1000 de um metro.' },
                    'micrometro': { namePt: 'Micrômetro (Mícron)', nameEn: 'Micrometer', symbol: 'μm', factor: 1e-6, info: '1/1.000.000 de metro.' },
                    'nanometro': { namePt: 'Nanômetro', nameEn: 'Nanometer', symbol: 'nm', factor: 1e-9, info: 'Usado em física atômica.' },
                    'polegada': { namePt: 'Polegada', nameEn: 'Inch', symbol: 'in', factor: 0.0254, info: 'Exatamente 2,54 centímetros.' },
                    'pe': { namePt: 'Pé', nameEn: 'Foot', symbol: 'ft', factor: 0.3048, info: '12 polegadas = 30,48 centímetros.' },
                    'jarda': { namePt: 'Jarda', nameEn: 'Yard', symbol: 'yd', factor: 0.9144, info: '3 pés = 0,9144 metro.' },
                    'milha': { namePt: 'Milha Terrestre', nameEn: 'Mile', symbol: 'mi', factor: 1609.344, info: '1.609,344 metros.' },
                    'milha_nautica': { namePt: 'Milha Náutica', nameEn: 'Nautical Mile', symbol: 'nmi', factor: 1852, info: 'Exatamente 1.852 metros.' }
                }
            },
            peso: {
                icon: 'fa-weight-hanging',
                color: 'from-orange-500 to-red-500',
                namePt: 'Peso & Massa',
                nameEn: 'Weight & Mass',
                baseUnit: 'quilograma',
                units: {
                    'quilograma': { namePt: 'Quilograma', nameEn: 'Kilogram', symbol: 'kg', factor: 1, info: 'Unidade base do SI para massa.' },
                    'grama': { namePt: 'Grama', nameEn: 'Gram', symbol: 'g', factor: 0.001, info: '1/1000 de quilograma.' },
                    'miligrama': { namePt: 'Miligrama', nameEn: 'Milligram', symbol: 'mg', factor: 1e-6, info: '1/1000 de grama.' },
                    'tonelada': { namePt: 'Tonelada Métrica', nameEn: 'Metric Ton', symbol: 't', factor: 1000, info: '1.000 quilogramas.' },
                    'libra': { namePt: 'Libra (pound)', nameEn: 'Pound', symbol: 'lb', factor: 0.45359237, info: '1 libra = ~0,4536 kg.' },
                    'onca': { namePt: 'Onça (ounce)', nameEn: 'Ounce', symbol: 'oz', factor: 0.0283495, info: '1/16 de libra ≈ 28,35 g.' },
                    'arroba': { namePt: 'Arroba', nameEn: 'Arroba (BR)', symbol: '@', factor: 15, info: 'Unidade agropecuária brasileira = 15 kg.' },
                    'quilate': { namePt: 'Quilate', nameEn: 'Carat', symbol: 'ct', factor: 0.0002, info: 'Usado em joalheria = 0,2 g.' }
                }
            },
            temperatura: {
                icon: 'fa-thermometer-half',
                color: 'from-red-500 to-amber-500',
                namePt: 'Temperatura',
                nameEn: 'Temperature',
                isSpecial: true,
                units: {
                    'celsius': { namePt: 'Celsius', nameEn: 'Celsius', symbol: '°C', info: '0° congela a água, 100° ferve a água.' },
                    'fahrenheit': { namePt: 'Fahrenheit', nameEn: 'Fahrenheit', symbol: '°F', info: 'Padrão nos EUA: 32° congela, 212° ferve.' },
                    'kelvin': { namePt: 'Kelvin', nameEn: 'Kelvin', symbol: 'K', info: 'Escala termodinâmica absoluta (0 K = zero absoluto).' },
                    'rankine': { namePt: 'Rankine', nameEn: 'Rankine', symbol: '°R', info: 'Escala absoluta baseada em Fahrenheit.' }
                }
            },
            volume: {
                icon: 'fa-flask',
                color: 'from-purple-500 to-pink-500',
                namePt: 'Volume',
                nameEn: 'Volume',
                baseUnit: 'litro',
                units: {
                    'litro': { namePt: 'Litro', nameEn: 'Liter', symbol: 'L', factor: 1, info: '1 decímetro cúbico.' },
                    'mililitro': { namePt: 'Mililitro', nameEn: 'Milliliter', symbol: 'mL', factor: 0.001, info: '1/1000 de litro.' },
                    'metro_cubico': { namePt: 'Metro Cúbico', nameEn: 'Cubic Meter', symbol: 'm³', factor: 1000, info: '1.000 litros.' },
                    'centimetro_cubico': { namePt: 'Centímetro Cúbico (cm³ / cc)', nameEn: 'Cubic Centimeter', symbol: 'cm³', factor: 0.001, info: 'Igual a 1 mililitro.' },
                    'galao_us': { namePt: 'Galão Americano (US)', nameEn: 'Gallon (US)', symbol: 'gal', factor: 3.78541, info: 'Galão americano ≈ 3,785 litros.' },
                    'galao_uk': { namePt: 'Galão Imperial (UK)', nameEn: 'Gallon (UK)', symbol: 'gal UK', factor: 4.54609, info: 'Galão britânico ≈ 4,546 litros.' },
                    'barril': { namePt: 'Barril de Petróleo', nameEn: 'Oil Barrel', symbol: 'bbl', factor: 158.987, info: '1 barril de petróleo = 42 galões US ≈ 159 L.' }
                }
            },
            area: {
                icon: 'fa-vector-square',
                color: 'from-green-500 to-teal-500',
                namePt: 'Área',
                nameEn: 'Area',
                baseUnit: 'metro_quadrado',
                units: {
                    'metro_quadrado': { namePt: 'Metro Quadrado', nameEn: 'Square Meter', symbol: 'm²', factor: 1, info: 'Unidade fundamental de área no SI.' },
                    'quilometro_quadrado': { namePt: 'Quilômetro Quadrado', nameEn: 'Square Kilometer', symbol: 'km²', factor: 1e6, info: '1 milhão de metros quadrados.' },
                    'hectare': { namePt: 'Hectare', nameEn: 'Hectare', symbol: 'ha', factor: 10000, info: '10.000 metros quadrados (quadrado de 100m x 100m).' },
                    'acre': { namePt: 'Acre', nameEn: 'Acre', symbol: 'ac', factor: 4046.856, info: 'Unidade agrária anglo-saxônica ≈ 4.047 m².' },
                    'alqueire_sp': { namePt: 'Alqueire Paulista', nameEn: 'Alqueire Paulista', symbol: 'alq-SP', factor: 24200, info: '24.200 metros quadrados.' },
                    'alqueire_mg': { namePt: 'Alqueire Mineiro', nameEn: 'Alqueire Mineiro', symbol: 'alq-MG', factor: 48400, info: '48.400 metros quadrados.' },
                    'pe_quadrado': { namePt: 'Pé Quadrado', nameEn: 'Square Foot', symbol: 'ft²', factor: 0.092903, info: 'Unidade imperial de área.' }
                }
            },
            tempo: {
                icon: 'fa-clock',
                color: 'from-indigo-500 to-blue-500',
                namePt: 'Tempo',
                nameEn: 'Time',
                baseUnit: 'segundo',
                units: {
                    'segundo': { namePt: 'Segundo', nameEn: 'Second', symbol: 's', factor: 1, info: 'Unidade base do SI para tempo.' },
                    'minuto': { namePt: 'Minuto', nameEn: 'Minute', symbol: 'min', factor: 60, info: '60 segundos.' },
                    'hora': { namePt: 'Hora', nameEn: 'Hour', symbol: 'h', factor: 3600, info: '60 minutos = 3.600 segundos.' },
                    'dia': { namePt: 'Dia', nameEn: 'Day', symbol: 'd', factor: 86400, info: '24 horas.' },
                    'semana': { namePt: 'Semana', nameEn: 'Week', symbol: 'sem', factor: 604800, info: '7 dias.' },
                    'mes': { namePt: 'Mês (30 dias)', nameEn: 'Month (30d)', symbol: 'mês', factor: 2592000, info: 'Aproximadamente 30 dias.' },
                    'ano': { namePt: 'Ano (365 dias)', nameEn: 'Year (365d)', symbol: 'ano', factor: 31536000, info: '365 dias.' },
                    'milissegundo': { namePt: 'Milissegundo', nameEn: 'Millisecond', symbol: 'ms', factor: 0.001, info: '1/1000 de segundo.' }
                }
            },
            velocidade: {
                icon: 'fa-tachometer-alt',
                color: 'from-yellow-500 to-orange-500',
                namePt: 'Velocidade',
                nameEn: 'Speed',
                baseUnit: 'metro_segundo',
                units: {
                    'km_hora': { namePt: 'Quilômetros por hora', nameEn: 'Kilometers per hour', symbol: 'km/h', factor: 1/3.6, info: 'Padrão em trânsito e rodovias no Brasil e Europa.' },
                    'milha_hora': { namePt: 'Milhas por hora', nameEn: 'Miles per hour', symbol: 'mph', factor: 0.44704, info: 'Padrão nos EUA e Reino Unido (1 mph ≈ 1,609 km/h).' },
                    'metro_segundo': { namePt: 'Metro por segundo', nameEn: 'Meter per second', symbol: 'm/s', factor: 1, info: 'Unidade fundamental de velocidade do SI.' },
                    'no': { namePt: 'Nó (náutico)', nameEn: 'Knot', symbol: 'kn', factor: 0.514444, info: '1 milha náutica por hora ≈ 1,852 km/h.' },
                    'mach': { namePt: 'Mach (Vel. do Som)', nameEn: 'Mach (Sound Speed)', symbol: 'Ma', factor: 340.29, info: 'Velocidade do som no ar ao nível do mar (aprox. 1.225 km/h).' }
                }
            },
            dados: {
                icon: 'fa-database',
                color: 'from-cyan-500 to-blue-500',
                namePt: 'Dados & Informática',
                nameEn: 'Digital Data',
                baseUnit: 'byte',
                units: {
                    'byte': { namePt: 'Byte', nameEn: 'Byte', symbol: 'B', factor: 1, info: '8 bits.' },
                    'kilobyte': { namePt: 'Kilobyte', nameEn: 'Kilobyte', symbol: 'KB', factor: 1024, info: '1.024 Bytes.' },
                    'megabyte': { namePt: 'Megabyte', nameEn: 'Megabyte', symbol: 'MB', factor: 1048576, info: '1.024 KB.' },
                    'gigabyte': { namePt: 'Gigabyte', nameEn: 'Gigabyte', symbol: 'GB', factor: 1073741824, info: '1.024 MB.' },
                    'terabyte': { namePt: 'Terabyte', nameEn: 'Terabyte', symbol: 'TB', factor: 1099511627776, info: '1.024 GB.' },
                    'petabyte': { namePt: 'Petabyte', nameEn: 'Petabyte', symbol: 'PB', factor: 1125899906842624, info: '1.024 TB.' },
                    'bit': { namePt: 'Bit', nameEn: 'Bit', symbol: 'b', factor: 0.125, info: '1/8 de um Byte.' }
                }
            },
            energia: {
                icon: 'fa-bolt',
                color: 'from-amber-500 to-yellow-500',
                namePt: 'Energia & Trabalho',
                nameEn: 'Energy & Work',
                baseUnit: 'joule',
                units: {
                    'joule': { namePt: 'Joule', nameEn: 'Joule', symbol: 'J', factor: 1, info: 'Unidade fundamental do SI (1 N × 1 m).' },
                    'kilojoule': { namePt: 'Kilojoule', nameEn: 'Kilojoule', symbol: 'kJ', factor: 1000, info: '1.000 Joules.' },
                    'kilowatt_hora': { namePt: 'Kilowatt-hora', nameEn: 'Kilowatt-hour', symbol: 'kWh', factor: 3.6e6, info: 'Unidade padrão de faturamento de energia elétrica.' },
                    'caloria': { namePt: 'Caloria', nameEn: 'Calorie', symbol: 'cal', factor: 4.184, info: 'Caloria termoquímica.' },
                    'kilocaloria': { namePt: 'Kilocaloria (kcal)', nameEn: 'Kilocalorie', symbol: 'kcal', factor: 4184, info: '1.000 calorias. Usada em nutrição e alimentos.' },
                    'btu': { namePt: 'BTU (British Thermal Unit)', nameEn: 'BTU', symbol: 'BTU', factor: 1055.06, info: 'Unidade de energia térmica inglesa.' }
                }
            }
        };

        /* ==========================================================================
           2. ESTADO GLOBAL DA APLICAÇÃO
           ========================================================================== */
        let currentCategory = 'moedas';
        let currentLang = 'pt';
        let decimalPrecision = 4;
        let conversionHistory = [];
        let favoritePairs = [];
        let calcVal = '0';
        let calcOp = null;
        let calcPrev = null;
        let deferredPrompt = null;

        /* ==========================================================================
           3. INICIALIZAÇÃO & SERVICE WORKER
           ========================================================================== */
        document.addEventListener('DOMContentLoaded', () => {
            // Carregar preferências salvas
            currentLang = localStorage.getItem('uniconvert_lang') || (navigator.language.startsWith('en') ? 'en' : 'pt');
            decimalPrecision = parseInt(localStorage.getItem('uniconvert_precision') || '4', 10);
            
            try {
                conversionHistory = JSON.parse(localStorage.getItem('uniconvert_history') || '[]');
                favoritePairs = JSON.parse(localStorage.getItem('uniconvert_favs') || '[]');
            } catch(e) {
                conversionHistory = [];
                favoritePairs = [];
            }

            // Aplicar Idioma
            setAppLanguage(currentLang);
            document.getElementById('precisionRange').value = decimalPrecision;
            document.getElementById('precisionDisplay').textContent = decimalPrecision;

            // Renderizar Categorias
            renderCategoryCarousel();
            selectCategory(currentCategory);
            updateHistoryBadge();
            renderFavoritesList();

            // Buscar Cotações de Câmbio em Tempo Real
            fetchLiveExchangeRates();

            // Registrar Service Worker PWA
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('sw.js?v=<?= $assetVersion ?>')
                    .then(() => console.log('[PWA] Service Worker registrado com sucesso.'))
                    .catch(err => console.warn('[PWA] Falha ao registrar Service Worker:', err));
            }

            // PWA Install Prompt
            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
                deferredPrompt = e;
                const installBtn = document.getElementById('btnPwaInstall');
                if (installBtn) installBtn.classList.remove('hidden'), installBtn.classList.add('flex');
            });

            document.getElementById('btnPwaInstall')?.addEventListener('click', async () => {
                if (deferredPrompt) {
                    deferredPrompt.prompt();
                    const { outcome } = await deferredPrompt.userChoice;
                    if (outcome === 'accepted') {
                        document.getElementById('btnPwaInstall').classList.add('hidden');
                    }
                    deferredPrompt = null;
                } else {
                    alert(currentLang === 'pt' ? 'Para instalar no celular/Safari: toque em Compartilhar ➔ "Adicionar à Tela de Início".' : 'To install: use your browser menu and choose "Add to Home Screen".');
                }
            });

            // Event Listeners dos Inputs
            document.getElementById('inputValue').addEventListener('input', calculateConversion);
            document.getElementById('fromUnit').addEventListener('change', calculateConversion);
            document.getElementById('toUnit').addEventListener('change', calculateConversion);

            document.getElementById('swapBtn').addEventListener('click', swapUnits);
            document.getElementById('clearInput').addEventListener('click', () => {
                document.getElementById('inputValue').value = '';
                document.getElementById('inputValue').focus();
                calculateConversion();
            });

            // Abas
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.tab-btn').forEach(b => {
                        b.classList.remove('active', 'text-white');
                        b.classList.add('text-white/60');
                    });
                    btn.classList.add('active', 'text-white');
                    btn.classList.remove('text-white/60');

                    const tab = btn.dataset.tab;
                    document.getElementById('singleTab').classList.toggle('hidden', tab !== 'single');
                    document.getElementById('multiTab').classList.toggle('hidden', tab !== 'multi');
                    document.getElementById('compareTab').classList.toggle('hidden', tab !== 'compare');

                    if (tab === 'multi') renderMultiTab();
                    if (tab === 'compare') renderCompareTab();
                });
            });

            // Botões de Copiar & Compartilhar
            document.getElementById('copyResult').addEventListener('click', () => {
                const val = document.getElementById('resultValue').textContent;
                copyToClipboard(val, currentLang === 'pt' ? 'Resultado copiado!' : 'Result copied!');
            });

            document.getElementById('copyFormula').addEventListener('click', () => {
                const val = document.getElementById('formula').textContent;
                copyToClipboard(val, currentLang === 'pt' ? 'Fórmula copiada!' : 'Formula copied!');
            });

            document.getElementById('shareResult').addEventListener('click', openShareModal);
            document.getElementById('addFavFromMain').addEventListener('click', addCurrentToFavorites);

            // Modais
            document.getElementById('calcToggle').addEventListener('click', () => openModal('calculatorModal'));
            document.getElementById('historyToggle').addEventListener('click', () => {
                renderHistoryList();
                openModal('historyModal');
            });
            document.getElementById('settingsToggle').addEventListener('click', () => openModal('settingsModal'));

            // Slider de Precisão
            document.getElementById('precisionRange').addEventListener('input', (e) => {
                decimalPrecision = parseInt(e.target.value, 10);
                document.getElementById('precisionDisplay').textContent = decimalPrecision;
                localStorage.setItem('uniconvert_precision', decimalPrecision);
                calculateConversion();
                if (!document.getElementById('multiTab').classList.contains('hidden')) renderMultiTab();
                if (!document.getElementById('compareTab').classList.contains('hidden')) renderCompareTab();
            });

            // Tema Claro / Escuro
            document.getElementById('themeToggle').addEventListener('click', toggleTheme);

            // Botão Executar Smart Input & Enter
            document.getElementById('btnExecSmart').addEventListener('click', () => {
                const query = document.getElementById('smartInput').value;
                if (query.trim()) executeSmartConversion(query);
            });
            document.getElementById('smartInput').addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    const query = e.target.value;
                    if (query.trim()) executeSmartConversion(query);
                }
            });

            // Entrada por Voz
            initVoiceRecognition();

            // Carrossel Scroll
            document.getElementById('scrollLeft').addEventListener('click', () => {
                document.getElementById('categoriesContainer').scrollBy({ left: -250, behavior: 'smooth' });
            });
            document.getElementById('scrollRight').addEventListener('click', () => {
                document.getElementById('categoriesContainer').scrollBy({ left: 250, behavior: 'smooth' });
            });
        });

        /* ==========================================================================
           4. SISTEMA DE IDIOMAS BILÍNGUE (PT / EN)
           ========================================================================== */
        function setAppLanguage(lang) {
            currentLang = lang;
            document.documentElement.setAttribute('data-lang', lang);
            localStorage.setItem('uniconvert_lang', lang);

            const isPt = lang === 'pt';
            document.getElementById('btnLangPt').className = isPt ? 'px-2.5 py-1.5 rounded-lg text-white bg-indigo-600 flex items-center gap-1.5 shadow' : 'px-2.5 py-1.5 rounded-lg text-gray-400 hover:text-white flex items-center gap-1.5';
            document.getElementById('btnLangEn').className = !isPt ? 'px-2.5 py-1.5 rounded-lg text-white bg-indigo-600 flex items-center gap-1.5 shadow' : 'px-2.5 py-1.5 rounded-lg text-gray-400 hover:text-white flex items-center gap-1.5';

            renderCategoryCarousel();
            populateUnitSelectors();
            calculateConversion();
            renderFavoritesList();
        }

        /* ==========================================================================
           5. MOTOR DE CÂMBIO EM TEMPO REAL (AWESOMEAPI & COINGECKO)
           ========================================================================== */
        async function fetchLiveExchangeRates(forceManual = false) {
            const statusEl = document.getElementById('currencyStatusText');
            const lastUpdateEl = document.getElementById('currencyLastUpdate');
            
            statusEl.textContent = currentLang === 'pt' ? 'Atualizando...' : 'Updating...';

            try {
                // AwesomeAPI cotações de moedas fiat e cripto pareadas com BRL
                const res = await fetch('https://economia.awesomeapi.com.br/last/USD-BRL,EUR-BRL,GBP-BRL,JPY-BRL,CAD-BRL,AUD-BRL,CHF-BRL,CNY-BRL,ARS-BRL,BTC-BRL,ETH-BRL');
                if (!res.ok) throw new Error('API indisponível');
                const data = await res.json();

                if (data.USDBRL) unitData.moedas.units['USD'].rateToBrl = parseFloat(data.USDBRL.bid);
                if (data.EURBRL) unitData.moedas.units['EUR'].rateToBrl = parseFloat(data.EURBRL.bid);
                if (data.GBPBRL) unitData.moedas.units['GBP'].rateToBrl = parseFloat(data.GBPBRL.bid);
                if (data.JPYBRL) unitData.moedas.units['JPY'].rateToBrl = parseFloat(data.JPYBRL.bid);
                if (data.CADBRL) unitData.moedas.units['CAD'].rateToBrl = parseFloat(data.CADBRL.bid);
                if (data.AUDBRL) unitData.moedas.units['AUD'].rateToBrl = parseFloat(data.AUDBRL.bid);
                if (data.CHFBRL) unitData.moedas.units['CHF'].rateToBrl = parseFloat(data.CHFBRL.bid);
                if (data.CNYBRL) unitData.moedas.units['CNY'].rateToBrl = parseFloat(data.CNYBRL.bid);
                if (data.ARSBRL) unitData.moedas.units['ARS'].rateToBrl = parseFloat(data.ARSBRL.bid);
                if (data.BTCBRL) unitData.moedas.units['BTC'].rateToBrl = parseFloat(data.BTCBRL.bid);
                if (data.ETHBRL) unitData.moedas.units['ETH'].rateToBrl = parseFloat(data.ETHBRL.bid);

                // USDT e SOL aproximados
                if (data.USDBRL) unitData.moedas.units['USDT'].rateToBrl = parseFloat(data.USDBRL.bid);
                if (data.USDBRL) unitData.moedas.units['SOL'].rateToBrl = parseFloat(data.USDBRL.bid) * 150.0;

                const now = new Date();
                const timeStr = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                
                statusEl.textContent = currentLang === 'pt' ? 'Live Câmbio Ativo' : 'Live Rates Active';
                lastUpdateEl.textContent = (currentLang === 'pt' ? 'Última: ' : 'Updated: ') + timeStr;

                // Salvar em cache offline
                localStorage.setItem('uniconvert_rates_cache', JSON.stringify({
                    rates: {
                        USD: unitData.moedas.units['USD'].rateToBrl,
                        EUR: unitData.moedas.units['EUR'].rateToBrl,
                        GBP: unitData.moedas.units['GBP'].rateToBrl,
                        BTC: unitData.moedas.units['BTC'].rateToBrl,
                        ETH: unitData.moedas.units['ETH'].rateToBrl
                    },
                    time: timeStr
                }));

                if (currentCategory === 'moedas') {
                    calculateConversion();
                }

                if (forceManual) {
                    showToast(currentLang === 'pt' ? 'Cotações de câmbio atualizadas!' : 'Exchange rates updated successfully!');
                }
            } catch (err) {
                console.warn('[Câmbio] Erro na requisição ao vivo, utilizando cache:', err);
                const cached = localStorage.getItem('uniconvert_rates_cache');
                if (cached) {
                    try {
                        const parsed = JSON.parse(cached);
                        if (parsed.rates) {
                            if (parsed.rates.USD) unitData.moedas.units['USD'].rateToBrl = parsed.rates.USD;
                            if (parsed.rates.EUR) unitData.moedas.units['EUR'].rateToBrl = parsed.rates.EUR;
                            if (parsed.rates.GBP) unitData.moedas.units['GBP'].rateToBrl = parsed.rates.GBP;
                            if (parsed.rates.BTC) unitData.moedas.units['BTC'].rateToBrl = parsed.rates.BTC;
                            if (parsed.rates.ETH) unitData.moedas.units['ETH'].rateToBrl = parsed.rates.ETH;
                        }
                        statusEl.textContent = currentLang === 'pt' ? 'Câmbio (Cache)' : 'Rates (Cached)';
                        lastUpdateEl.textContent = (currentLang === 'pt' ? 'Salvo às ' : 'Cached at ') + (parsed.time || 'recente');
                    } catch(e) {}
                } else {
                    statusEl.textContent = currentLang === 'pt' ? 'Câmbio Base' : 'Base Rates';
                    lastUpdateEl.textContent = currentLang === 'pt' ? 'Offline' : 'Offline';
                }
            }
        }

        /* ==========================================================================
           6. RENDERIZAÇÃO DO CARROSSEL DE CATEGORIAS
           ========================================================================== */
        function renderCategoryCarousel() {
            const container = document.getElementById('categoriesContainer');
            container.innerHTML = '';

            Object.keys(unitData).forEach(catKey => {
                const cat = unitData[catKey];
                const displayName = currentLang === 'pt' ? cat.namePt : cat.nameEn;
                const isActive = catKey === currentCategory;

                const btn = document.createElement('button');
                btn.className = `category-card shrink-0 flex items-center gap-2.5 px-4 py-3 rounded-2xl glass border ${isActive ? 'active' : 'border-white/10 hover:border-white/25 text-white/80'}`;
                btn.onclick = () => selectCategory(catKey);

                btn.innerHTML = `
                    <div class="cat-icon w-8 h-8 rounded-xl bg-gradient-to-tr ${cat.color} flex items-center justify-center text-white text-xs shadow-md">
                        <i class="fas ${cat.icon}"></i>
                    </div>
                    <span class="text-xs font-bold whitespace-nowrap">${displayName}</span>
                `;

                container.appendChild(btn);
            });
        }

        function selectCategory(catKey) {
            currentCategory = catKey;
            renderCategoryCarousel();
            populateUnitSelectors();
            calculateConversion();

            if (!document.getElementById('multiTab').classList.contains('hidden')) renderMultiTab();
            if (!document.getElementById('compareTab').classList.contains('hidden')) renderCompareTab();
        }

        function populateUnitSelectors() {
            const cat = unitData[currentCategory];
            const fromSelect = document.getElementById('fromUnit');
            const toSelect = document.getElementById('toUnit');

            const prevFrom = fromSelect.value;
            const prevTo = toSelect.value;

            fromSelect.innerHTML = '';
            toSelect.innerHTML = '';

            const unitKeys = Object.keys(cat.units);

            unitKeys.forEach((key, index) => {
                const u = cat.units[key];
                const label = `${currentLang === 'pt' ? u.namePt : u.nameEn} (${u.symbol})`;

                const optFrom = new Option(label, key);
                const optTo = new Option(label, key);

                fromSelect.appendChild(optFrom);
                toSelect.appendChild(optTo);
            });

            // Preservar seleções anteriores ou definir defaults inteligentes
            if (unitKeys.includes(prevFrom)) {
                fromSelect.value = prevFrom;
            } else {
                fromSelect.value = unitKeys[0];
            }

            if (unitKeys.includes(prevTo) && prevTo !== fromSelect.value) {
                toSelect.value = prevTo;
            } else {
                toSelect.value = unitKeys.length > 1 ? unitKeys[1] : unitKeys[0];
            }
        }

        function swapUnits() {
            const fromSelect = document.getElementById('fromUnit');
            const toSelect = document.getElementById('toUnit');
            const tmp = fromSelect.value;
            fromSelect.value = toSelect.value;
            toSelect.value = tmp;
            calculateConversion();
        }

        /* ==========================================================================
           7. NÚCLEO DE CÁLCULO E CONVERSÃO
           ========================================================================== */
        function convertValues(val, fromKey, toKey, catKey) {
            const cat = unitData[catKey];
            if (!cat || isNaN(val)) return 0;

            // 1. Câmbio de Moedas
            if (cat.isCurrency) {
                const fromRate = cat.units[fromKey]?.rateToBrl || 1.0;
                const toRate = cat.units[toKey]?.rateToBrl || 1.0;
                const inBrl = val * fromRate;
                return inBrl / toRate;
            }

            // 2. Temperatura
            if (catKey === 'temperatura') {
                return convertTemperature(val, fromKey, toKey);
            }

            // 3. Consumo de Combustível
            if (catKey === 'combustivel') {
                return convertFuel(val, fromKey, toKey);
            }

            // 4. Grandezas Lineares Baseadas em Fator
            const fromUnit = cat.units[fromKey];
            const toUnit = cat.units[toKey];
            if (!fromUnit || !toUnit) return 0;

            // Converter para unidade base, depois para destino
            const baseValue = val * fromUnit.factor;
            return baseValue / toUnit.factor;
        }

        function convertTemperature(val, from, to) {
            if (from === to) return val;
            let c = val;
            if (from === 'fahrenheit') c = (val - 32) * (5 / 9);
            else if (from === 'kelvin') c = val - 273.15;
            else if (from === 'rankine') c = (val - 491.67) * (5 / 9);

            if (to === 'celsius') return c;
            if (to === 'fahrenheit') return (c * (9 / 5)) + 32;
            if (to === 'kelvin') return c + 273.15;
            if (to === 'rankine') return (c + 273.15) * (9 / 5);
            return c;
        }

        function convertFuel(val, from, to) {
            if (from === to || val <= 0) return val;
            // Normalizar para km/L
            let kmL = val;
            if (from === 'l_100km') kmL = 100 / val;
            else if (from === 'mpg_us') kmL = val / 2.35215;
            else if (from === 'mpg_uk') kmL = val / 2.82481;

            if (to === 'km_l') return kmL;
            if (to === 'l_100km') return 100 / kmL;
            if (to === 'mpg_us') return kmL * 2.35215;
            if (to === 'mpg_uk') return kmL * 2.82481;
            return kmL;
        }

        function formatDisplayNumber(num) {
            if (num === null || isNaN(num)) return '0';
            if (Math.abs(num) > 0 && (Math.abs(num) < 0.0001 || Math.abs(num) >= 1e12)) {
                return num.toExponential(decimalPrecision);
            }
            return parseFloat(num.toFixed(decimalPrecision)).toLocaleString(currentLang === 'pt' ? 'pt-BR' : 'en-US', {
                maximumFractionDigits: decimalPrecision
            });
        }

        function calculateConversion() {
            const inputValStr = document.getElementById('inputValue').value.replace(',', '.');
            const inputVal = parseFloat(inputValStr);
            const fromKey = document.getElementById('fromUnit').value;
            const toKey = document.getElementById('toUnit').value;

            if (isNaN(inputVal)) {
                document.getElementById('resultValue').textContent = '0';
                return;
            }

            const result = convertValues(inputVal, fromKey, toKey, currentCategory);
            document.getElementById('resultValue').textContent = formatDisplayNumber(result);

            // Atualizar Fórmula Explicada
            updateFormulaDisplay(inputVal, result, fromKey, toKey);

            // Atualizar Informações Técnicas
            updateTechnicalInfo(fromKey, toKey);

            // Incrementar contador
            incrementConversionStats();

            // Salvar no histórico silenciosamente
            recordHistory(inputVal, result, fromKey, toKey, currentCategory);
        }

        function updateFormulaDisplay(inVal, outVal, fromKey, toKey) {
            const cat = unitData[currentCategory];
            const uFrom = cat.units[fromKey];
            const uTo = cat.units[toKey];
            const formulaEl = document.getElementById('formula');

            if (!uFrom || !uTo) return;

            const nameFrom = currentLang === 'pt' ? uFrom.namePt : uFrom.nameEn;
            const nameTo = currentLang === 'pt' ? uTo.namePt : uTo.nameEn;

            if (fromKey === toKey) {
                formulaEl.textContent = `1 ${uFrom.symbol} = 1 ${uTo.symbol}`;
                return;
            }

            const unitRate = convertValues(1, fromKey, toKey, currentCategory);
            formulaEl.textContent = `1 ${uFrom.symbol} = ${formatDisplayNumber(unitRate)} ${uTo.symbol} (${nameFrom} ➔ ${nameTo})`;
        }

        function updateTechnicalInfo(fromKey, toKey) {
            const cat = unitData[currentCategory];
            const uFrom = cat.units[fromKey];
            const uTo = cat.units[toKey];
            const container = document.getElementById('unitTechnicalInfo');

            if (!uFrom || !uTo) return;

            container.innerHTML = `
                <div>
                    <span class="text-white font-bold">${uFrom.symbol}:</span> ${uFrom.info || 'Unidade de medição.'}
                </div>
                <div class="pt-1.5 border-t border-white/5">
                    <span class="text-cyan-300 font-bold">${uTo.symbol}:</span> ${uTo.info || 'Unidade de medição.'}
                </div>
            `;
        }

        /* ==========================================================================
           8. CONVERSÃO INTELIGENTE POR PLN (NATURAL LANGUAGE PARSER)
           ========================================================================== */
        function applySmartQuery(text) {
            document.getElementById('smartInput').value = text;
            executeSmartConversion(text);
        }

        function executeSmartConversion(text) {
            const raw = text.toLowerCase().trim();
            // Regex para capturar: [número] [unidadeDe] [em/para/to/in] [unidadePara]
            // Ex: 100 usd em brl, 250 psi em bar, 35 mpa para kgf/cm2, 80 km/h to mph
            const regex = /([\d.,]+)\s*([a-zá-ú\/°²³#@]+)\s*(?:em|para|to|in|->|➔)?\s*([a-zá-ú\/°²³#@]+)?/i;
            const match = raw.match(regex);

            if (!match) {
                showToast(currentLang === 'pt' ? 'Tente: 100 usd em brl, 250 psi em bar...' : 'Try: 100 usd to eur, 250 psi in bar...');
                return;
            }

            const numStr = match[1].replace(',', '.');
            const num = parseFloat(numStr);
            const tokenFrom = match[2] ? match[2].trim() : '';
            const tokenTo = match[3] ? match[3].trim() : '';

            // Mapeamento de termos
            const matched = findCategoryAndUnits(tokenFrom, tokenTo);

            if (matched) {
                currentCategory = matched.category;
                selectCategory(matched.category);

                document.getElementById('inputValue').value = num;
                document.getElementById('fromUnit').value = matched.fromKey;
                if (matched.toKey) {
                    document.getElementById('toUnit').value = matched.toKey;
                }

                calculateConversion();

                // Destaque visual
                const box = document.getElementById('resultValue').parentElement;
                box.classList.add('ring-4', 'ring-cyan-400');
                setTimeout(() => box.classList.remove('ring-4', 'ring-cyan-400'), 1200);

                showToast(currentLang === 'pt' ? `Convertido: ${matched.category.toUpperCase()}!` : `Converted: ${matched.category.toUpperCase()}!`);
            } else {
                showToast(currentLang === 'pt' ? 'Unidade não identificada. Escolha a categoria abaixo.' : 'Unit not matched. Select a category below.');
            }
        }

        function findCategoryAndUnits(fromToken, toToken) {
            const aliasMap = {
                // Moedas
                'usd': { cat: 'moedas', key: 'USD' }, 'dolar': { cat: 'moedas', key: 'USD' }, 'dólar': { cat: 'moedas', key: 'USD' }, 'dolares': { cat: 'moedas', key: 'USD' },
                'brl': { cat: 'moedas', key: 'BRL' }, 'real': { cat: 'moedas', key: 'BRL' }, 'reais': { cat: 'moedas', key: 'BRL' },
                'eur': { cat: 'moedas', key: 'EUR' }, 'euro': { cat: 'moedas', key: 'EUR' }, 'euros': { cat: 'moedas', key: 'EUR' },
                'gbp': { cat: 'moedas', key: 'GBP' }, 'libra': { cat: 'moedas', key: 'GBP' }, 'libras': { cat: 'moedas', key: 'GBP' },
                'btc': { cat: 'moedas', key: 'BTC' }, 'bitcoin': { cat: 'moedas', key: 'BTC' },
                'eth': { cat: 'moedas', key: 'ETH' }, 'ethereum': { cat: 'moedas', key: 'ETH' },

                // Tensão / Pressão
                'mpa': { cat: 'tensao', key: 'megapascal' }, 'megapascal': { cat: 'tensao', key: 'megapascal' },
                'kpa': { cat: 'tensao', key: 'kilopascal' }, 'gpa': { cat: 'tensao', key: 'gigapascal' },
                'psi': { cat: 'tensao', key: 'psi' }, 'bar': { cat: 'tensao', key: 'bar' },
                'kgf/cm2': { cat: 'tensao', key: 'kgf_cm2' }, 'kgf': { cat: 'forca', key: 'quilograma_forca' },
                'n/mm2': { cat: 'tensao', key: 'n_mm2' }, 'atm': { cat: 'tensao', key: 'atmosfera' },

                // Força
                'kn': { cat: 'forca', key: 'quilonewton' }, 'quilonewton': { cat: 'forca', key: 'quilonewton' },
                'n': { cat: 'forca', key: 'newton' }, 'newton': { cat: 'forca', key: 'newton' },
                'tf': { cat: 'forca', key: 'tonelada_forca' }, 'toneladas': { cat: 'peso', key: 'tonelada' },

                // Potência
                'cv': { cat: 'potencia', key: 'cavalo_vapor' }, 'cavalo': { cat: 'potencia', key: 'cavalo_vapor' },
                'hp': { cat: 'potencia', key: 'horsepower' }, 'kw': { cat: 'potencia', key: 'quilowatt' },
                'w': { cat: 'potencia', key: 'watt' }, 'btu': { cat: 'potencia', key: 'btu_hora' },

                // Velocidade
                'km/h': { cat: 'velocidade', key: 'km_hora' }, 'kmh': { cat: 'velocidade', key: 'km_hora' },
                'mph': { cat: 'velocidade', key: 'milha_hora' }, 'm/s': { cat: 'velocidade', key: 'metro_segundo' },

                // Comprimento
                'm': { cat: 'comprimento', key: 'metro' }, 'metro': { cat: 'comprimento', key: 'metro' }, 'metros': { cat: 'comprimento', key: 'metro' },
                'km': { cat: 'comprimento', key: 'quilometro' }, 'cm': { cat: 'comprimento', key: 'centimetro' },
                'mm': { cat: 'comprimento', key: 'milimetro' }, 'milha': { cat: 'comprimento', key: 'milha' }, 'miles': { cat: 'comprimento', key: 'milha' },

                // Peso
                'kg': { cat: 'peso', key: 'quilograma' }, 'quilo': { cat: 'peso', key: 'quilograma' }, 'quilos': { cat: 'peso', key: 'quilograma' },
                'g': { cat: 'peso', key: 'grama' }, 'gramas': { cat: 'peso', key: 'grama' },
                'lb': { cat: 'peso', key: 'libra' }, 'lbs': { cat: 'peso', key: 'libra' },

                // Temperatura
                'c': { cat: 'temperatura', key: 'celsius' }, 'celsius': { cat: 'temperatura', key: 'celsius' },
                'f': { cat: 'temperatura', key: 'fahrenheit' }, 'fahrenheit': { cat: 'temperatura', key: 'fahrenheit' }
            };

            const f = aliasMap[fromToken];
            const t = aliasMap[toToken];

            if (f) {
                return {
                    category: f.cat,
                    fromKey: f.key,
                    toKey: t && t.cat === f.cat ? t.key : Object.keys(unitData[f.cat].units).find(k => k !== f.key)
                };
            }
            return null;
        }

        /* ==========================================================================
           9. RECONHECIMENTO DE VOZ (WEB SPEECH API)
           ========================================================================== */
        function initVoiceRecognition() {
            const btn = document.getElementById('voiceBtn');
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

            if (!SpeechRecognition) {
                btn.style.display = 'none';
                return;
            }

            const recognizer = new SpeechRecognition();
            recognizer.lang = currentLang === 'pt' ? 'pt-BR' : 'en-US';
            recognizer.continuous = false;
            recognizer.interimResults = false;

            btn.onclick = () => {
                try {
                    recognizer.lang = currentLang === 'pt' ? 'pt-BR' : 'en-US';
                    btn.classList.add('bg-rose-600', 'animate-pulse');
                    recognizer.start();
                    showToast(currentLang === 'pt' ? 'Ouvindo... Fale a conversão.' : 'Listening... Speak your conversion.');
                } catch(e) {
                    recognizer.stop();
                    btn.classList.remove('bg-rose-600', 'animate-pulse');
                }
            };

            recognizer.onresult = (event) => {
                const speechText = event.results[0][0].transcript;
                document.getElementById('smartInput').value = speechText;
                executeSmartConversion(speechText);
            };

            recognizer.onend = () => {
                btn.classList.remove('bg-rose-600', 'animate-pulse');
            };

            recognizer.onerror = () => {
                btn.classList.remove('bg-rose-600', 'animate-pulse');
            };
        }

        /* ==========================================================================
           10. ABA MÚLTIPLA & COMPARATIVO VISUAL
           ========================================================================== */
        function renderMultiTab() {
            const inputValStr = document.getElementById('inputValue').value.replace(',', '.');
            const inputVal = parseFloat(inputValStr) || 1;
            const fromKey = document.getElementById('fromUnit').value;
            const cat = unitData[currentCategory];
            const container = document.getElementById('multiResults');

            container.innerHTML = '';

            Object.keys(cat.units).forEach(key => {
                const u = cat.units[key];
                const res = convertValues(inputVal, fromKey, key, currentCategory);
                const name = currentLang === 'pt' ? u.namePt : u.nameEn;
                const isOrigin = key === fromKey;

                const row = document.createElement('div');
                row.className = `p-3 rounded-xl flex items-center justify-between transition-all ${isOrigin ? 'bg-indigo-600/30 border border-indigo-500/40' : 'bg-white/5 hover:bg-white/10'}`;

                row.innerHTML = `
                    <div class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg bg-white/10 font-bold text-xs flex items-center justify-center text-cyan-300">${u.symbol}</span>
                        <div>
                            <span class="text-xs font-bold text-white block">${name}</span>
                            <span class="text-[10px] text-gray-400">${u.info || ''}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-extrabold text-cyan-300">${formatDisplayNumber(res)}</span>
                        <button class="w-7 h-7 rounded-lg bg-white/5 hover:bg-white/15 text-white/50 hover:text-white flex items-center justify-center text-xs" onclick="copyToClipboard('${res}', '${name} copiado!')">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                `;
                container.appendChild(row);
            });
        }

        function renderCompareTab() {
            const inputValStr = document.getElementById('inputValue').value.replace(',', '.');
            const inputVal = parseFloat(inputValStr) || 1;
            const fromKey = document.getElementById('fromUnit').value;
            const cat = unitData[currentCategory];
            const container = document.getElementById('compareResults');

            container.innerHTML = '';

            // Achar o valor máximo para percentual da barra
            const allKeys = Object.keys(cat.units);
            let maxVal = 0;
            const calculated = allKeys.map(k => {
                const val = convertValues(inputVal, fromKey, k, currentCategory);
                if (val > maxVal && isFinite(val)) maxVal = val;
                return { key: k, val: val, unit: cat.units[k] };
            });

            calculated.forEach(item => {
                const pct = maxVal > 0 ? Math.min(100, Math.max(3, (item.val / maxVal) * 100)) : 10;
                const name = currentLang === 'pt' ? item.unit.namePt : item.unit.nameEn;

                const card = document.createElement('div');
                card.className = 'p-3 rounded-2xl bg-white/5 space-y-1.5';
                card.innerHTML = `
                    <div class="flex justify-between text-xs font-bold text-white">
                        <span>${name} (${item.unit.symbol})</span>
                        <span class="text-cyan-300">${formatDisplayNumber(item.val)}</span>
                    </div>
                    <div class="w-full h-2.5 rounded-full bg-white/10 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-indigo-500 to-cyan-400 rounded-full" style="width: ${pct}%"></div>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        /* ==========================================================================
           11. FAVORITOS & HISTÓRICO
           ========================================================================== */
        function addCurrentToFavorites() {
            const fromKey = document.getElementById('fromUnit').value;
            const toKey = document.getElementById('toUnit').value;
            const cat = currentCategory;

            const exists = favoritePairs.some(f => f.cat === cat && f.from === fromKey && f.to === toKey);
            if (exists) {
                showToast(currentLang === 'pt' ? 'Este par já está nos seus favoritos!' : 'Pair already bookmarked!');
                return;
            }

            favoritePairs.unshift({ cat, from: fromKey, to: toKey });
            if (favoritePairs.length > 20) favoritePairs.pop();

            localStorage.setItem('uniconvert_favs', JSON.stringify(favoritePairs));
            renderFavoritesList();
            showToast(currentLang === 'pt' ? 'Adicionado aos favoritos!' : 'Saved to bookmarks!');
        }

        function renderFavoritesList() {
            const container = document.getElementById('favoritesList');
            const badge = document.getElementById('favsCountBadge');
            badge.textContent = favoritePairs.length;

            if (favoritePairs.length === 0) {
                container.innerHTML = `<p class="text-gray-400 text-xs text-center py-4">${currentLang === 'pt' ? 'Nenhum par favoritado ainda.' : 'No bookmarks yet.'}</p>`;
                return;
            }

            container.innerHTML = '';
            favoritePairs.forEach((fav, idx) => {
                const cat = unitData[fav.cat];
                if (!cat) return;
                const uFrom = cat.units[fav.from];
                const uTo = cat.units[fav.to];
                if (!uFrom || !uTo) return;

                const item = document.createElement('div');
                item.className = 'p-2.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/5 flex items-center justify-between text-xs cursor-pointer transition-all';
                item.innerHTML = `
                    <div class="flex items-center gap-2" onclick="loadFavorite(${idx})">
                        <i class="fas ${cat.icon} text-amber-400"></i>
                        <span class="font-bold text-white">${uFrom.symbol} ➔ ${uTo.symbol}</span>
                    </div>
                    <button class="text-rose-400 hover:text-rose-300 p-1" onclick="removeFavorite(${idx})">✕</button>
                `;
                container.appendChild(item);
            });
        }

        function loadFavorite(idx) {
            const fav = favoritePairs[idx];
            if (!fav) return;
            selectCategory(fav.cat);
            document.getElementById('fromUnit').value = fav.from;
            document.getElementById('toUnit').value = fav.to;
            calculateConversion();
        }

        function removeFavorite(idx) {
            favoritePairs.splice(idx, 1);
            localStorage.setItem('uniconvert_favs', JSON.stringify(favoritePairs));
            renderFavoritesList();
        }

        function recordHistory(inVal, outVal, fromKey, toKey, catKey) {
            const cat = unitData[catKey];
            if (!cat) return;
            const uFrom = cat.units[fromKey];
            const uTo = cat.units[toKey];
            if (!uFrom || !uTo) return;

            const entry = {
                cat: catKey,
                inVal: inVal,
                outVal: outVal,
                fromSym: uFrom.symbol,
                toSym: uTo.symbol,
                time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            };

            // Evitar duplicatas idênticas consecutivas
            if (conversionHistory.length > 0 && conversionHistory[0].inVal === inVal && conversionHistory[0].fromSym === uFrom.symbol && conversionHistory[0].toSym === uTo.symbol) {
                return;
            }

            conversionHistory.unshift(entry);
            if (conversionHistory.length > 30) conversionHistory.pop();
            localStorage.setItem('uniconvert_history', JSON.stringify(conversionHistory));
            updateHistoryBadge();
        }

        function updateHistoryBadge() {
            const badge = document.getElementById('historyBadge');
            if (conversionHistory.length > 0) {
                badge.textContent = conversionHistory.length;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }

        function renderHistoryList() {
            const list = document.getElementById('historyList');
            if (conversionHistory.length === 0) {
                list.innerHTML = `<p class="text-gray-400 text-xs text-center py-6">${currentLang === 'pt' ? 'Nenhuma conversão recente.' : 'No recent conversions.'}</p>`;
                return;
            }

            list.innerHTML = '';
            conversionHistory.forEach(item => {
                const row = document.createElement('div');
                row.className = 'p-2.5 rounded-xl bg-white/5 border border-white/5 flex items-center justify-between text-xs';
                row.innerHTML = `
                    <div>
                        <span class="font-bold text-white">${formatDisplayNumber(item.inVal)} ${item.fromSym} ➔ <span class="text-cyan-300">${formatDisplayNumber(item.outVal)} ${item.toSym}</span></span>
                    </div>
                    <span class="text-[10px] text-gray-500">${item.time}</span>
                `;
                list.appendChild(row);
            });
        }

        function clearHistory() {
            conversionHistory = [];
            localStorage.setItem('uniconvert_history', '[]');
            renderHistoryList();
            updateHistoryBadge();
        }

        /* ==========================================================================
           12. CALCULADORA INTEGRADA
           ========================================================================== */
        function calcClear() {
            calcVal = '0';
            calcOp = null;
            calcPrev = null;
            updateCalcDisplay();
        }
        function calcInput(char) {
            if (calcVal === '0' && !isNaN(char)) calcVal = char;
            else calcVal += char;
            updateCalcDisplay();
        }
        function calcBackspace() {
            if (calcVal.length > 1) calcVal = calcVal.slice(0, -1);
            else calcVal = '0';
            updateCalcDisplay();
        }
        function calcEquals() {
            try {
                // Sanitização simples para eval segura de expressões matemáticas
                const sanitized = calcVal.replace(/[^0-9+\-*/().]/g, '');
                const res = Function(`'use strict'; return (${sanitized})`)();
                calcVal = String(res);
            } catch(e) {
                calcVal = 'Erro';
            }
            updateCalcDisplay();
        }
        function updateCalcDisplay() {
            document.getElementById('calcDisplay').textContent = calcVal;
        }
        function useCalcResult() {
            const num = parseFloat(calcVal);
            if (!isNaN(num)) {
                document.getElementById('inputValue').value = num;
                calculateConversion();
                closeModal('calculatorModal');
            }
        }

        /* ==========================================================================
           13. UTILITÁRIOS: TEMA, TOAST, MODAIS & STATS
           ========================================================================== */
        function toggleTheme() {
            document.body.classList.toggle('light-mode');
            const isLight = document.body.classList.contains('light-mode');
            document.getElementById('themeIcon').className = isLight ? 'fas fa-sun text-amber-400' : 'fas fa-moon';
            localStorage.setItem('uniconvert_theme', isLight ? 'light' : 'dark');
        }

        if (localStorage.getItem('uniconvert_theme') === 'light') {
            document.body.classList.add('light-mode');
            document.getElementById('themeIcon').className = 'fas fa-sun text-amber-400';
        }

        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }

        function showToast(msg) {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = 'px-4 py-2.5 rounded-xl bg-gray-900 border border-indigo-500/40 text-white text-xs font-bold shadow-xl flex items-center gap-2 animate-bounce';
            toast.innerHTML = `<i class="fas fa-check text-cyan-400"></i> <span>${msg}</span>`;
            container.appendChild(toast);
            setTimeout(() => toast.remove(), 2500);
        }

        function copyToClipboard(text, msg) {
            navigator.clipboard.writeText(text).then(() => showToast(msg || 'Copiado!'));
        }

        function openShareModal() {
            const inVal = document.getElementById('inputValue').value;
            const fromText = document.getElementById('fromUnit').selectedOptions[0]?.text || '';
            const resVal = document.getElementById('resultValue').textContent;
            const toText = document.getElementById('toUnit').selectedOptions[0]?.text || '';

            const shareStr = `${inVal} ${fromText} = ${resVal} ${toText} | UniConvert Pro ➔ https://4u.ia.br/app/conversor/`;
            document.getElementById('shareTextDisplay').textContent = shareStr;
            openModal('shareModal');
        }

        function shareViaApp(app) {
            const text = encodeURIComponent(document.getElementById('shareTextDisplay').textContent);
            if (app === 'whatsapp') window.open(`https://api.whatsapp.com/send?text=${text}`, '_blank');
            if (app === 'telegram') window.open(`https://t.me/share/url?url=https://4u.ia.br/app/conversor/&text=${text}`, '_blank');
        }

        function copyShareText() {
            const text = document.getElementById('shareTextDisplay').textContent;
            copyToClipboard(text, currentLang === 'pt' ? 'Texto de compartilhamento copiado!' : 'Share text copied!');
            closeModal('shareModal');
        }

        function incrementConversionStats() {
            let count = parseInt(localStorage.getItem('uniconvert_total_conversions') || '0', 10) + 1;
            localStorage.setItem('uniconvert_total_conversions', count);
            document.getElementById('totalConversions').textContent = count;
        }
        document.getElementById('totalConversions').textContent = localStorage.getItem('uniconvert_total_conversions') || '0';
    </script>
</body>
</html>
