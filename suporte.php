<?php
declare(strict_types=1);

$currentYear = date('Y');
$msgSuccess = '';
$msgError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $assunto = trim($_POST['assunto'] ?? 'Suporte UniConvert Pro');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($nome === '' || $email === '' || $mensagem === '') {
        $msgError = 'Por favor, preencha todos os campos obrigatórios.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msgError = 'Por favor, informe um endereço de e-mail válido.';
    } else {
        $logDir = __DIR__ . '/uploads';
        if (!is_dir($logDir)) {
            @mkdir($logDir, 0777, true);
        }

        $logFile = $logDir . '/messages_log.json';
        $logData = [];
        if (file_exists($logFile)) {
            $existing = @file_get_contents($logFile);
            if ($existing) {
                $decoded = json_decode($existing, true);
                if (is_array($decoded)) {
                    $logData = $decoded;
                }
            }
        }

        $newEntry = [
            'id' => uniqid('msg_', true),
            'timestamp' => date('Y-m-d H:i:s'),
            'nome' => htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'),
            'email' => htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
            'assunto' => htmlspecialchars($assunto, ENT_QUOTES, 'UTF-8'),
            'mensagem' => htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'),
            'ip' => $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
        ];

        $logData[] = $newEntry;
        @file_put_contents($logFile, json_encode($logData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Envio de E-mail
        $to = 'contato@4u.ia.br';
        $headers = "From: contato@4u.ia.br\r\n";
        $headers .= "Reply-To: {$email}\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $mailBody = "Novo contato recebido via UniConvert Pro:\n\n";
        $mailBody .= "Nome: {$nome}\nE-mail: {$email}\nAssunto: {$assunto}\nIP: " . ($newEntry['ip']) . "\n\nMensagem:\n{$mensagem}\n";

        @mail($to, "[UniConvert Pro] " . $assunto, $mailBody, $headers);

        $msgSuccess = 'Mensagem enviada com sucesso! Nossa equipe retornará em breve no seu e-mail.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR" data-lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte & FAQ | Support — UniConvert Pro 4U.IA.BR</title>
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

        <!-- Feedback Alerts -->
        <?php if ($msgSuccess): ?>
            <div class="p-4 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-sm flex items-center gap-3">
                <i class="fas fa-check-circle text-lg"></i>
                <span><?= htmlspecialchars($msgSuccess) ?></span>
            </div>
        <?php endif; ?>
        <?php if ($msgError): ?>
            <div class="p-4 rounded-2xl bg-rose-500/20 border border-rose-500/40 text-rose-300 text-sm flex items-center gap-3">
                <i class="fas fa-exclamation-triangle text-lg"></i>
                <span><?= htmlspecialchars($msgError) ?></span>
            </div>
        <?php endif; ?>

        <!-- Content Grid -->
        <div class="grid md:grid-cols-2 gap-6">
            <!-- FAQ Section -->
            <div class="glass-card rounded-3xl p-6 md:p-8 space-y-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 text-cyan-400 text-xs font-bold mb-2">
                        <i class="fas fa-question-circle"></i>
                        <span data-i18n-pt>Dúvidas Frequentes</span>
                        <span data-i18n-en>Frequently Asked Questions</span>
                    </div>
                    <h2 class="text-xl font-bold" data-i18n-pt>Perguntas Frequentes (FAQ)</h2>
                    <h2 class="text-xl font-bold" data-i18n-en>Frequently Asked Questions</h2>
                </div>

                <div class="space-y-3 text-sm">
                    <!-- Q1 -->
                    <details class="group bg-white/5 border border-white/10 rounded-2xl p-4 cursor-pointer" open>
                        <summary class="font-bold flex items-center justify-between text-white">
                            <span data-i18n-pt>O conversor funciona sem internet (offline)?</span>
                            <span data-i18n-en>Does the converter work offline without internet?</span>
                            <i class="fas fa-chevron-down text-xs text-gray-400 group-open:rotate-180 transition-transform"></i>
                        </summary>
                        <p class="text-gray-300 mt-2 text-xs leading-relaxed" data-i18n-pt>
                            Sim! O UniConvert Pro é um Progressive Web App (PWA). Todas as grandezas físicas (comprimento, pressão, potência, vazão, culinária, etc.) são calculadas localmente pelo seu processador. As cotações de moedas usam a última taxa gravada em cache caso você fique sem conexão.
                        </p>
                        <p class="text-gray-300 mt-2 text-xs leading-relaxed" data-i18n-en>
                            Yes! UniConvert Pro is a full Progressive Web App (PWA). All physical conversion units are processed locally on your device. Currency exchange rates use the latest cached rates when you are offline.
                        </p>
                    </details>

                    <!-- Q2 -->
                    <details class="group bg-white/5 border border-white/10 rounded-2xl p-4 cursor-pointer">
                        <summary class="font-bold flex items-center justify-between text-white">
                            <span data-i18n-pt>Como funciona a Conversão Inteligente por IA?</span>
                            <span data-i18n-en>How does the Smart AI Conversion work?</span>
                            <i class="fas fa-chevron-down text-xs text-gray-400 group-open:rotate-180 transition-transform"></i>
                        </summary>
                        <p class="text-gray-300 mt-2 text-xs leading-relaxed" data-i18n-pt>
                            Você pode digitar ou falar naturalmente frases como "50 dólares em reais", "250 psi em bar" ou "15 kN em toneladas". O motor de processamento em linguagem natural identifica o valor e as unidades instantaneamente sem você precisar procurar nos menus.
                        </p>
                        <p class="text-gray-300 mt-2 text-xs leading-relaxed" data-i18n-en>
                            You can type or speak natural phrases like "50 usd to eur", "250 psi in bar", or "100 miles to km". The built-in parser immediately maps the numbers and units without manual dropdown browsing.
                        </p>
                    </details>

                    <!-- Q3 -->
                    <details class="group bg-white/5 border border-white/10 rounded-2xl p-4 cursor-pointer">
                        <summary class="font-bold flex items-center justify-between text-white">
                            <span data-i18n-pt>Como instalar o app no celular ou no computador?</span>
                            <span data-i18n-en>How do I install the app on mobile or desktop?</span>
                            <i class="fas fa-chevron-down text-xs text-gray-400 group-open:rotate-180 transition-transform"></i>
                        </summary>
                        <p class="text-gray-300 mt-2 text-xs leading-relaxed" data-i18n-pt>
                            Basta clicar no botão "📲 Instalar App" no cabeçalho do conversor, ou no menu do navegador (ícone de instalar na barra de endereços no Chrome/Edge, ou "Adicionar à Tela Inicial" no Safari do iPhone).
                        </p>
                        <p class="text-gray-300 mt-2 text-xs leading-relaxed" data-i18n-en>
                            Click the "📲 Install App" button in the header, or use your browser's install prompt (Chrome/Edge address bar icon, or "Add to Home Screen" on iOS Safari).
                        </p>
                    </details>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="glass-card rounded-3xl p-6 md:p-8 space-y-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-xs font-bold mb-2">
                        <i class="fas fa-envelope"></i>
                        <span data-i18n-pt>Contato Direto</span>
                        <span data-i18n-en>Direct Contact</span>
                    </div>
                    <h2 class="text-xl font-bold" data-i18n-pt>Fale Conosco</h2>
                    <h2 class="text-xl font-bold" data-i18n-en>Send Us a Message</h2>
                    <p class="text-gray-400 text-xs mt-1" data-i18n-pt>Sugira novas unidades, reporte bugs ou envie feedbacks.</p>
                    <p class="text-gray-400 text-xs mt-1" data-i18n-en>Suggest new units, report issues, or send your feedback.</p>
                </div>

                <form method="POST" action="suporte.php" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1" data-i18n-pt>Seu Nome *</label>
                        <label class="block text-xs font-bold text-gray-300 mb-1" data-i18n-en>Your Name *</label>
                        <input type="text" name="nome" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 focus:bg-white/10 transition-all" placeholder="Ex: Carlos Silva">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1" data-i18n-pt>Seu E-mail *</label>
                        <label class="block text-xs font-bold text-gray-300 mb-1" data-i18n-en>Your Email *</label>
                        <input type="email" name="email" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 focus:bg-white/10 transition-all" placeholder="nome@email.com">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1" data-i18n-pt>Assunto</label>
                        <label class="block text-xs font-bold text-gray-300 mb-1" data-i18n-en>Subject</label>
                        <select name="assunto" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                            <option value="Sugestão de Nova Unidade">Sugestão de Nova Unidade / Categoria</option>
                            <option value="Dúvida ou Suporte">Dúvida ou Suporte Geral</option>
                            <option value="Reportar Bug">Reportar Erro / Bug</option>
                            <option value="Parceria ou Integração">Parceria ou Integração</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1" data-i18n-pt>Mensagem *</label>
                        <label class="block text-xs font-bold text-gray-300 mb-1" data-i18n-en>Message *</label>
                        <textarea name="mensagem" rows="4" required class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 focus:bg-white/10 transition-all" placeholder="Como podemos ajudar você?"></textarea>
                    </div>

                    <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 text-white font-bold text-sm hover:opacity-95 transition-opacity shadow-lg shadow-indigo-500/25 flex items-center justify-center gap-2">
                        <i class="fas fa-paper-plane"></i>
                        <span data-i18n-pt>Enviar Mensagem</span>
                        <span data-i18n-en>Send Message</span>
                    </button>
                </form>
            </div>
        </div>

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
