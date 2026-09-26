# UniConvert Pro — Conversor Universal Inteligente

> **UniConvert Pro** é um conversor moderno, ultrarrápido e universal de unidades de medida, moedas fiduciárias em tempo real, criptomoedas e grandezas técnicas de engenharia, com comando por linguagem natural (texto e voz), suporte PWA offline e extensão para o Google Chrome.

🌐 **Acesse online:** [https://4u.ia.br/app/conversor/](https://4u.ia.br/app/conversor/)  
📦 **Organização:** [4U Labs](https://github.com/4u-Labs)

---

## ⚡ Principais Recursos

1. **19 Categorias Completas:**
   - 💰 **Moedas & Criptomoedas:** Cotações em tempo real (BRL, USD, EUR, GBP, JPY, CAD, AUD, CHF, CNY, ARS, BTC, ETH, SOL, USDT) via AwesomeAPI com cache e fallback offline.
   - 🧭 **Pressão:** bar, psi, MPa, kPa, Pa, atm, kgf/cm², mmHg.
   - 🏗️ **Tensão & Resistência:** MPa, GPa, N/mm², kgf/cm², psi, ksi.
   - 🏋️ **Força:** Newton (N), Quilonewton (kN), kgf, dyn, lbf, tf.
   - 🔩 **Torque:** N·m, kgf·m, lbf·ft, lbf·in, kN·m.
   - ⚡ **Potência:** Watts (W), Quilowatts (kW), Cavalo-Vapor (cv), Horsepower (HP), BTU/h, TR.
   - 🌊 **Vazão Volumétrica:** m³/h, L/min, L/s, GPM (EUA), CFM.
   - ⛽ **Consumo de Combustível:** km/L, L/100km, MPG (US), MPG (UK).
   - 📐 **Ângulos:** Graus (°), Radianos (rad), Grados (grad), Minutos de arco (′), Segundos (″).
   - 🍳 **Culinária & Cozinha:** Xícara, Colher de sopa, Colher de chá, mL, Litro, Copo americano, Onça fluida (fl oz).
   - 📏 **Comprimento:** m, km, cm, mm, mi, yd, ft, in, milhas náuticas (NM).
   - ⚖️ **Massa & Peso:** kg, g, mg, t, lb, oz, arroba (@), quilate (ct).
   - 🌡️ **Temperatura:** Celsius (°C), Fahrenheit (°F), Kelvin (K).
   - 🧪 **Volume:** Litros, mL, m³, galões, barris de petróleo (bbl), pés cúbicos.
   - 📐 **Área:** m², km², cm², ha, alqueire paulista, alqueire mineiro, acre, ft².
   - 🚀 **Velocidade:** km/h, m/s, mph, nós (knots), Mach.
   - ⏱️ **Tempo:** ms, s, min, h, dias, semanas, meses, anos.
   - 💾 **Armazenamento:** Bytes, KB, MB, GB, TB, PB, KiB, MiB, GiB, TiB.
   - 🔥 **Energia & Trabalho:** Joules (J), kJ, calorias (cal), kcal, kWh, BTU, eV.

2. **Comando por Linguagem Natural Inteligente (NLP):**
   - Reconhece consultas livres como *"100 USD em BRL"*, *"250 psi em bar"*, *"35 MPa em kgf/cm²"*, *"5 cv em kW"*, *"120 km/h em m/s"*.
   - Reconhecimento de voz integrado via Web Speech API.

3. **PWA (Progressive Web App):**
   - Instalável no desktop, Android e iOS diretamente pelo navegador com Service Worker (`sw.js`).
   - Modo offline completo (as taxas de câmbio são salvas no cache local).

4. **Bilingue Nativo (PT/EN):**
   - Alternador rápido `[ 🇧🇷 PT | 🇺🇸 EN ]` na barra superior com persistência em `localStorage`.

5. **Extensão para Google Chrome (Manifest V3):**
   - Disponível em `chrome-extension/` para conversões instantâneas em qualquer aba.

6. **Padrão Institucional 4U.IA.BR:**
   - 🔒 Política de Privacidade LGPD/GDPR com zero retenção de dados (`privacidade.php`).
   - 📜 Termos de Uso com licença permissiva e gratuita (`termos.php`).
   - 💬 Central de Suporte e FAQ interativo com envio de mensagens (`suporte.php`).
   - ☕ Apoio ao projeto via PayPal oficial: `https://www.paypal.com/ncp/payment/L7YRCS984T33N`.

---

## 📂 Estrutura de Arquivos

```
conversor/
├── index.php             # Aplicação principal (19 categorias, NLP, cotações ao vivo)
├── manifest.json         # Manifesto PWA
├── sw.js                 # Service Worker para execução offline
├── privacidade.php       # Política de Privacidade (LGPD / GDPR)
├── termos.php            # Termos de Uso
├── suporte.php           # Central de Suporte & FAQ interativo
├── favicon.svg           # Ícone vetorial oficial
├── favicon-32x32.png     # Favicon rasterizado
├── icon-192.png          # Ícone PWA 192x192
├── icon-512.png          # Ícone PWA 512x512
├── uploads/              # Armazenamento local de mensagens de suporte
├── chrome-extension/     # Extensão para Google Chrome Manifest V3
│   ├── manifest.json
│   ├── popup.html
│   ├── popup.css
│   ├── popup.js
│   ├── icon-16.png
│   ├── icon-48.png
│   └── icon-128.png
└── README.md             # Documentação do projeto
```

---

## 🛠️ Tecnologias Utilizadas

- **Frontend:** Vanilla HTML5, CSS3 moderno (Tailwind-like dark theme), JavaScript ES6+
- **Backend:** PHP 8.x (Hostinger Serverless/Apache)
- **API Externa:** AwesomeAPI (Cotações de Câmbio e Cripto em tempo real, CORS liberado)
- **Extensão:** Chrome Extensions Manifest V3

---

## ☕ Apoie o Projeto

Se o UniConvert Pro te ajudou ou agregou valor ao seu trabalho, considere fazer uma contribuição:
👉 [Fazer uma doação via PayPal](https://www.paypal.com/ncp/payment/L7YRCS984T33N)
