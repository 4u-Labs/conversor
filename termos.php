<?php
declare(strict_types=1);
$currentYear = date('Y');
?>
<!DOCTYPE html>
<html lang="pt-BR" data-lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termos de Uso | Terms of Service — UniConvert Pro 4U.IA.BR</title>
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <link rel="apple-touch-icon" href="icon-192.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%); min-height: 100vh; color: #f1f5f9; }
        .glass { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(25px); border: 1px solid rgba(255, 255, 255, 0.08); }
        [data-lang="en"] [data-i18n-pt], [data-lang="pt"] [data-i18n-en] { display: none !important; }
    </style>
</head>
<body class="p-4 md:p-8">
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Top Nav -->
        <header class="flex items-center justify-between glass rounded-2xl px-6 py-4">
            <a href="index.php" class="flex items-center gap-3 hover:opacity-90 transition-opacity">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-cyan-500 flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div>
                    <h1 class="font-extrabold text-lg tracking-tight">Uni<span class="text-cyan-400">Convert</span> Pro</h1>
                    <p class="text-[11px] text-gray-400">4U.IA.BR Ecosystem</p>
                </div>
            </a>
            
            <div class="flex items-center gap-3">
                <div class="inline-flex items-center p-0.5 rounded-xl bg-gray-900/90 border border-gray-700/80 shadow-inner text-xs font-semibold">
                    <button id="btnLangPt" onclick="setLang('pt')" class="px-2.5 py-1 rounded-lg transition-all text-white bg-indigo-600">🇧🇷 PT</button>
                    <button id="btnLangEn" onclick="setLang('en')" class="px-2.5 py-1 rounded-lg transition-all text-gray-400 hover:text-white">🇺🇸 EN</button>
                </div>
                <a href="index.php" class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-sm font-semibold transition-all flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    <span data-i18n-pt>Voltar</span>
                    <span data-i18n-en>Back</span>
                </a>
            </div>
        </header>

        <!-- Content Card -->
        <main class="glass-card rounded-3xl p-6 md:p-10 space-y-8">
            <div class="border-b border-white/10 pb-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-xs font-bold mb-3">
                    <i class="fas fa-file-contract"></i>
                    <span data-i18n-pt>Termos & Condições de Uso</span>
                    <span data-i18n-en>Terms of Service & Usage</span>
                </div>
                <h2 class="text-2xl md:text-3xl font-extrabold" data-i18n-pt>Termos de Uso</h2>
                <h2 class="text-2xl md:text-3xl font-extrabold" data-i18n-en>Terms of Service</h2>
                <p class="text-gray-400 text-sm mt-2" data-i18n-pt>Válido para uso web e extensão • <?= $currentYear ?></p>
                <p class="text-gray-400 text-sm mt-2" data-i18n-en>Effective for web app and browser extension • <?= $currentYear ?></p>
            </div>

            <!-- PT Content -->
            <div data-i18n-pt class="space-y-6 text-sm text-gray-300 leading-relaxed">
                <div>
                    <h3 class="text-white font-bold text-base mb-2">1. Aceitação dos Termos</h3>
                    <p>Ao acessar e utilizar o <strong>UniConvert Pro</strong>, você concorda com estes Termos de Uso. Caso não concorde com qualquer item, recomendamos não utilizar a aplicação.</p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">2. Finalidade & Licença de Uso</h3>
                    <p>O UniConvert Pro é fornecido gratuitamente para uso pessoal, acadêmico, comercial e de engenharia. É permitida a incorporação dos resultados em projetos, orçamentos, memoriais de cálculo e relatórios técnicos sem cobrança de royalties.</p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">3. Precisão das Conversões & Isenção de Responsabilidade</h3>
                    <p>Embora todos os algoritmos de conversão, fatores físicos e constantes adotem os padrões do Sistema Internacional (SI) e normas técnicas consagradas (ABNT, ASTM, ISO), o aplicativo é fornecido "no estado em que se encontra" (<em>as is</em>). Para projetos críticos de engenharia estrutural ou transações financeiras de câmbio de grande porte, recomendamos sempre a conferência humana ou institucional.</p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">4. Cotações Financeiras e de Criptoativos</h3>
                    <p>As cotações de moedas e criptomoedas são obtidas de fontes públicas com fins estritamente informativos. O UniConvert Pro não constitui consultoria financeira ou plataforma de corretagem.</p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">5. Propriedade Intelectual</h3>
                    <p>A marca, interface e códigos-fonte do UniConvert Pro são de titularidade do ecossistema <strong>4U.IA.BR</strong>. Os dados e conversões gerados pelo usuário pertencem exclusivamente a ele.</p>
                </div>
            </div>

            <!-- EN Content -->
            <div data-i18n-en class="space-y-6 text-sm text-gray-300 leading-relaxed">
                <div>
                    <h3 class="text-white font-bold text-base mb-2">1. Acceptance of Terms</h3>
                    <p>By accessing or using <strong>UniConvert Pro</strong>, you agree to be bound by these Terms of Service. If you disagree with any part of these terms, please discontinue using the service.</p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">2. Intended Purpose & License</h3>
                    <p>UniConvert Pro is provided free of charge for personal, academic, professional, and commercial engineering use. You are free to integrate converted values into technical reports, blueprints, or commercial projects without royalty obligations.</p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">3. Calculation Accuracy & Disclaimer</h3>
                    <p>All conversion equations and physical constants follow International System of Units (SI) standards and recognized norms (ISO, ASTM, ABNT). However, software is provided on an "as is" basis without warranties of any kind. For life-safety critical engineering or high-volume financial exchange, double verification is recommended.</p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">4. Currency & Cryptocurrency Rates</h3>
                    <p>Exchange rates and crypto prices are aggregated from public market sources solely for informational purposes. UniConvert Pro is not a financial brokerage or trading advisory tool.</p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">5. Intellectual Property</h3>
                    <p>Design, branding, and proprietary assets are owned by the <strong>4U.IA.BR</strong> ecosystem. All calculation results and user inputs remain the sole property of the user.</p>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="text-center text-gray-500 text-xs py-4">
            &copy; <?= $currentYear ?> 4U.IA.BR — UniConvert Pro. <span data-i18n-pt>Todos os direitos reservados.</span><span data-i18n-en>All rights reserved.</span>
        </footer>
    </div>

    <script>
        function setLang(lang) {
            document.documentElement.setAttribute('data-lang', lang);
            localStorage.setItem('uniconvert_lang', lang);
            document.getElementById('btnLangPt').className = lang === 'pt' ? 'px-2.5 py-1 rounded-lg text-white bg-indigo-600' : 'px-2.5 py-1 rounded-lg text-gray-400 hover:text-white';
            document.getElementById('btnLangEn').className = lang === 'en' ? 'px-2.5 py-1 rounded-lg text-white bg-indigo-600' : 'px-2.5 py-1 rounded-lg text-gray-400 hover:text-white';
        }
        const savedLang = localStorage.getItem('uniconvert_lang') || (navigator.language.startsWith('en') ? 'en' : 'pt');
        setLang(savedLang);
    </script>
</body>
</html>
