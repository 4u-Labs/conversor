<?php
declare(strict_types=1);
$currentYear = date('Y');
?>
<!DOCTYPE html>
<html lang="pt-BR" data-lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidade | Privacy Policy — UniConvert Pro 4U.IA.BR</title>
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
            <!-- Header Text -->
            <div class="border-b border-white/10 pb-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 text-cyan-400 text-xs font-bold mb-3">
                    <i class="fas fa-shield-alt"></i>
                    <span data-i18n-pt>Privacidade & LGPD / GDPR</span>
                    <span data-i18n-en>Privacy & Zero-Retention</span>
                </div>
                <h2 class="text-2xl md:text-3xl font-extrabold" data-i18n-pt>Política de Privacidade</h2>
                <h2 class="text-2xl md:text-3xl font-extrabold" data-i18n-en>Privacy Policy</h2>
                <p class="text-gray-400 text-sm mt-2" data-i18n-pt>Última atualização: <?= $currentYear ?> • Em conformidade com a LGPD (Lei nº 13.709/2018) e GDPR</p>
                <p class="text-gray-400 text-sm mt-2" data-i18n-en>Last updated: <?= $currentYear ?> • Fully compliant with GDPR and LGPD standards</p>
            </div>

            <!-- PT Content -->
            <div data-i18n-pt class="space-y-6 text-sm text-gray-300 leading-relaxed">
                <div>
                    <h3 class="text-white font-bold text-base mb-2">1. Princípio Fundamental: Retenção Zero & Processamento Local</h3>
                    <p>O <strong>UniConvert Pro</strong> opera sob o princípio de <em>Privacy by Design</em>. Todos os cálculos matemáticos, conversões de grandezas, histórico de uso e preferências de precisão são processados e armazenados <strong>exclusivamente na memória do seu navegador</strong> (via LocalStorage e IndexedDB). Nenhum valor inserido é enviado para servidores centrais.</p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">2. Cotações de Câmbio em Tempo Real</h3>
                    <p>Para fornecer taxas de câmbio de moedas (fiat e criptomoedas), o aplicativo consulta APIs públicas de mercado (AwesomeAPI e CoinGecko). Essas requisições solicitam apenas os pares monetários genéricos (ex: USD/BRL). <strong>Nenhum dado pessoal, valor convertido ou identificador de dispositivo é transmitido.</strong></p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">3. Entrada por Voz & Processamento NLP</h3>
                    <p>O recurso de entrada por voz utiliza a Web Speech API nativa do próprio navegador. Nenhum áudio é gravado, retido ou transferido para servidores da 4U.IA.BR.</p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">4. Ausência de Rastreadores & Cookies Invasivos</h3>
                    <p>Não utilizamos cookies de rastreamento de terceiros, pixels de redes sociais ou ferramentas de perfilamento comercial. O aplicativo é 100% livre de anúncios intrusivos.</p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">5. Contato & Encarregado de Dados (DPO)</h3>
                    <p>Para dúvidas ou solicitações referentes à privacidade, utilize nossa central de atendimento em <a href="suporte.php" class="text-cyan-400 hover:underline">suporte.php</a> ou pelo e-mail oficial: <code class="text-indigo-300">contato@4u.ia.br</code>.</p>
                </div>
            </div>

            <!-- EN Content -->
            <div data-i18n-en class="space-y-6 text-sm text-gray-300 leading-relaxed">
                <div>
                    <h3 class="text-white font-bold text-base mb-2">1. Core Principle: Zero Data Retention & Local Processing</h3>
                    <p><strong>UniConvert Pro</strong> is built upon the foundation of <em>Privacy by Design</em>. All unit conversions, mathematical computations, history records, and custom settings are processed and saved <strong>exclusively inside your local browser</strong> (via LocalStorage and IndexedDB). No input values or calculation data are transmitted to external servers.</p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">2. Real-Time Currency Exchange Rates</h3>
                    <p>To provide real-time currency and cryptocurrency conversions, the app queries public market APIs. These requests only fetch general currency pair rates (e.g. USD/EUR). <strong>No personal data, user amounts, or device identifiers are ever attached or shared.</strong></p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">3. Voice Input & NLP Parsing</h3>
                    <p>The optional voice input functionality relies strictly on your browser's native Web Speech API. Audio is never recorded, stored, or sent to 4U.IA.BR servers.</p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">4. No Trackers or Invasive Cookies</h3>
                    <p>We do not employ third-party tracking scripts, social media tracking pixels, or cross-site profiling cookies. UniConvert Pro is 100% ad-free.</p>
                </div>

                <div>
                    <h3 class="text-white font-bold text-base mb-2">5. Contact & Privacy Inquiries</h3>
                    <p>For questions regarding our privacy practices, contact our support desk at <a href="suporte.php" class="text-cyan-400 hover:underline">suporte.php</a> or email us at <code class="text-indigo-300">contato@4u.ia.br</code>.</p>
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
