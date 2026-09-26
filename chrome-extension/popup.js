// UniConvert Pro - Chrome Extension Popup Logic
const UNITS_DATA = {
  currency: {
    base: 'BRL',
    rates: {
      BRL: 1.0, USD: 5.65, EUR: 6.15, GBP: 7.20, BTC: 360000.0, ETH: 19500.0, USDT: 5.65
    },
    names: {
      USD: 'Dólar (USD)', BRL: 'Real (BRL)', EUR: 'Euro (EUR)', GBP: 'Libra (GBP)',
      BTC: 'Bitcoin (BTC)', ETH: 'Ethereum (ETH)', USDT: 'Tether (USDT)'
    }
  },
  pressure: {
    factors: {
      bar: 100000, psi: 6894.757, mpa: 1000000, kpa: 1000, pa: 1, atm: 101325, kgf_cm2: 98066.5, mmhg: 133.322
    },
    names: {
      bar: 'Bar (bar)', psi: 'PSI (lbf/in²)', mpa: 'Megapascal (MPa)', kpa: 'Quilopascal (kPa)',
      atm: 'Atmosfera (atm)', kgf_cm2: 'kgf/cm²', mmhg: 'mmHg'
    }
  },
  length: {
    factors: {
      m: 1, km: 1000, cm: 0.01, mm: 0.001, mi: 1609.344, yd: 0.9144, ft: 0.3048, in: 0.0254
    },
    names: {
      m: 'Metros (m)', km: 'Quilômetros (km)', cm: 'Centímetros (cm)', mm: 'Milímetros (mm)',
      mi: 'Milhas (mi)', ft: 'Pés (ft)', in: 'Polegadas (in)'
    }
  },
  mass: {
    factors: {
      kg: 1, g: 0.001, mg: 1e-6, t: 1000, lb: 0.45359237, oz: 0.02834952
    },
    names: {
      kg: 'Quilogramas (kg)', g: 'Gramas (g)', t: 'Toneladas (t)', lb: 'Libras (lb)', oz: 'Onças (oz)'
    }
  },
  volume: {
    factors: {
      l: 1, ml: 0.001, m3: 1000, gal_us: 3.78541, cup_us: 0.24, tbsp: 0.015
    },
    names: {
      l: 'Litros (L)', ml: 'Mililitros (mL)', m3: 'Metros Cúbicos (m³)', gal_us: 'Galões EUA', cup_us: 'Xícaras (copo)'
    }
  },
  power: {
    factors: {
      w: 1, kw: 1000, cv: 735.49875, hp: 745.69987, btu_h: 0.293071
    },
    names: {
      cv: 'Cavalo-Vapor (cv)', hp: 'Horsepower (HP)', kw: 'Quilowatts (kW)', w: 'Watts (W)', btu_h: 'BTU/h'
    }
  },
  data: {
    factors: {
      b: 1, kb: 1024, mb: 1048576, gb: 1073741824, tb: 1099511627776
    },
    names: {
      mb: 'Megabytes (MB)', gb: 'Gigabytes (GB)', tb: 'Terabytes (TB)', kb: 'Kilobytes (KB)'
    }
  },
  temperature: {
    isSpecial: true,
    names: {
      c: 'Graus Celsius (°C)', f: 'Graus Fahrenheit (°F)', k: 'Kelvin (K)'
    }
  }
};

document.addEventListener('DOMContentLoaded', () => {
  const catSelect = document.getElementById('catSelect');
  const unitFrom = document.getElementById('unitFrom');
  const unitTo = document.getElementById('unitTo');
  const valFrom = document.getElementById('valFrom');
  const valTo = document.getElementById('valTo');
  const btnSwap = document.getElementById('btnSwap');
  const btnOpenWeb = document.getElementById('btnOpenWeb');
  const nlpInput = document.getElementById('nlpInput');
  const nlpBtn = document.getElementById('nlpBtn');
  const nlpFeedback = document.getElementById('nlpFeedback');

  // Load currency rates from API
  async function refreshRates() {
    try {
      const res = await fetch('https://economia.awesomeapi.com.br/last/USD-BRL,EUR-BRL,GBP-BRL,BTC-BRL,ETH-BRL,USDT-BRL');
      if (res.ok) {
        const d = await res.json();
        if (d.USDBRL) UNITS_DATA.currency.rates.USD = parseFloat(d.USDBRL.bid);
        if (d.EURBRL) UNITS_DATA.currency.rates.EUR = parseFloat(d.EURBRL.bid);
        if (d.GBPBRL) UNITS_DATA.currency.rates.GBP = parseFloat(d.GBPBRL.bid);
        if (d.BTCBRL) UNITS_DATA.currency.rates.BTC = parseFloat(d.BTCBRL.bid);
        if (d.ETHBRL) UNITS_DATA.currency.rates.ETH = parseFloat(d.ETHBRL.bid);
        if (d.USDTBRL) UNITS_DATA.currency.rates.USDT = parseFloat(d.USDTBRL.bid);
        convert();
      }
    } catch (e) {
      // offline fallback is already populated
    }
  }

  function populateUnits() {
    const cat = catSelect.value;
    const catData = UNITS_DATA[cat];
    const prevFrom = unitFrom.value;
    const prevTo = unitTo.value;

    unitFrom.innerHTML = '';
    unitTo.innerHTML = '';

    const keys = Object.keys(catData.names);
    keys.forEach((key, idx) => {
      const opt1 = document.createElement('option');
      opt1.value = key;
      opt1.textContent = catData.names[key];
      unitFrom.appendChild(opt1);

      const opt2 = document.createElement('option');
      opt2.value = key;
      opt2.textContent = catData.names[key];
      unitTo.appendChild(opt2);
    });

    if (keys.includes(prevFrom)) unitFrom.value = prevFrom;
    else unitFrom.selectedIndex = 0;

    if (keys.includes(prevTo) && prevTo !== unitFrom.value) {
      unitTo.value = prevTo;
    } else {
      unitTo.selectedIndex = keys.length > 1 ? 1 : 0;
    }

    convert();
  }

  function convert() {
    const cat = catSelect.value;
    const v = parseFloat(valFrom.value);
    if (isNaN(v)) {
      valTo.value = '';
      return;
    }

    const uFrom = unitFrom.value;
    const uTo = unitTo.value;

    if (uFrom === uTo) {
      valTo.value = v;
      return;
    }

    if (cat === 'currency') {
      const rateFrom = UNITS_DATA.currency.rates[uFrom] || 1;
      const rateTo = UNITS_DATA.currency.rates[uTo] || 1;
      const valInBrl = v * rateFrom;
      const res = valInBrl / rateTo;
      valTo.value = formatResult(res);
      return;
    }

    if (cat === 'temperature') {
      let cVal;
      if (uFrom === 'c') cVal = v;
      else if (uFrom === 'f') cVal = (v - 32) * 5 / 9;
      else if (uFrom === 'k') cVal = v - 273.15;

      let res;
      if (uTo === 'c') res = cVal;
      else if (uTo === 'f') res = (cVal * 9 / 5) + 32;
      else if (uTo === 'k') res = cVal + 273.15;

      valTo.value = formatResult(res);
      return;
    }

    const catData = UNITS_DATA[cat];
    if (catData && catData.factors) {
      const fFrom = catData.factors[uFrom];
      const fTo = catData.factors[uTo];
      const baseVal = v * fFrom;
      const res = baseVal / fTo;
      valTo.value = formatResult(res);
    }
  }

  function formatResult(num) {
    if (Math.abs(num) < 1e-4 || Math.abs(num) >= 1e9) {
      return num.toExponential(4);
    }
    return parseFloat(num.toFixed(6));
  }

  // Swap
  btnSwap.addEventListener('click', () => {
    const tmp = unitFrom.value;
    unitFrom.value = unitTo.value;
    unitTo.value = tmp;
    convert();
  });

  // NLP Parser
  function parseNLP(text) {
    text = text.trim().toLowerCase();
    if (!text) return;

    const regex = /([\d]+(?:[\.,][\d]+)?)\s*([a-záéíóúãõç°$€£]+)\s*(?:em|para|to|in|\->)?\s*([a-záéíóúãõç°$€£]+)?/i;
    const match = text.match(regex);

    if (!match) {
      showFeedback('Não compreendi. Tente algo como: "50 usd em brl" ou "100 psi em bar"', '#f87171');
      return;
    }

    const num = parseFloat(match[1].replace(',', '.'));
    const rawFrom = match[2].trim();
    const rawTo = (match[3] || '').trim();

    const aliasMap = {
      'dolar': 'USD', 'dólar': 'USD', 'usd': 'USD', '$': 'USD',
      'real': 'BRL', 'reais': 'BRL', 'brl': 'BRL', 'r$': 'BRL',
      'euro': 'EUR', 'euros': 'EUR', 'eur': 'EUR', '€': 'EUR',
      'libra': 'GBP', 'libras': 'GBP', 'gbp': 'GBP', '£': 'GBP',
      'btc': 'BTC', 'bitcoin': 'BTC', 'eth': 'ETH', 'ethereum': 'ETH',
      'psi': 'psi', 'bar': 'bar', 'mpa': 'mpa', 'kpa': 'kpa', 'atm': 'atm',
      'km': 'km', 'm': 'm', 'cm': 'cm', 'mm': 'mm', 'milha': 'mi', 'milhas': 'mi', 'mi': 'mi',
      'pol': 'in', 'polegada': 'in', 'polegadas': 'in', 'in': 'in', 'ft': 'ft', 'pe': 'ft', 'pes': 'ft', 'pés': 'ft',
      'kg': 'kg', 'kilo': 'kg', 'quilo': 'kg', 'g': 'g', 'grama': 'g', 'gramas': 'g', 'lb': 'lb', 'libra_peso': 'lb',
      'cv': 'cv', 'hp': 'hp', 'w': 'w', 'kw': 'kw', 'btu': 'btu_h',
      'c': 'c', 'celsius': 'c', '°c': 'c', 'f': 'f', 'fahrenheit': 'f', '°f': 'f', 'k': 'k', 'kelvin': 'k',
      'mb': 'mb', 'gb': 'gb', 'tb': 'tb'
    };

    const normFrom = aliasMap[rawFrom];
    const normTo = aliasMap[rawTo];

    // Find category
    for (const [catKey, catObj] of Object.entries(UNITS_DATA)) {
      const keys = Object.keys(catObj.names);
      if (keys.includes(normFrom)) {
        catSelect.value = catKey;
        populateUnits();
        unitFrom.value = normFrom;
        if (normTo && keys.includes(normTo)) {
          unitTo.value = normTo;
        }
        valFrom.value = num;
        convert();
        showFeedback(`✓ Convertido: ${num} ${normFrom} → ${unitTo.value}`, '#4ade80');
        return;
      }
    }

    showFeedback('Unidade não encontrada. Tente outra expressão!', '#f87171');
  }

  function showFeedback(msg, color) {
    nlpFeedback.textContent = msg;
    nlpFeedback.style.color = color;
    nlpFeedback.style.display = 'block';
    setTimeout(() => {
      nlpFeedback.style.display = 'none';
    }, 4500);
  }

  nlpBtn.addEventListener('click', () => parseNLP(nlpInput.value));
  nlpInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') parseNLP(nlpInput.value);
  });

  catSelect.addEventListener('change', populateUnits);
  unitFrom.addEventListener('change', convert);
  unitTo.addEventListener('change', convert);
  valFrom.addEventListener('input', convert);

  // Open Web App
  btnOpenWeb.addEventListener('click', () => {
    if (typeof chrome !== 'undefined' && chrome.tabs && chrome.tabs.create) {
      chrome.tabs.create({ url: 'https://4u.ia.br/app/conversor/' });
    } else {
      window.open('https://4u.ia.br/app/conversor/', '_blank');
    }
  });

  // Init
  populateUnits();
  refreshRates();
});
