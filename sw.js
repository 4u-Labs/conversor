/**
 * UniConvert Pro — Service Worker para Suporte a PWA & Execução Offline
 * 4U.IA.BR Ecosystem Standard
 */

const CACHE_NAME = 'uniconvert-pwa-v1.0.0';
const ASSETS = [
    './',
    './index.php',
    './manifest.json',
    './favicon.svg',
    './favicon-32x32.png',
    './icon-192.png',
    './icon-512.png',
    './common.js'
];

self.addEventListener('install', (event) => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(ASSETS).catch((err) => {
                console.warn('[SW] Cache parcial de ativos:', err);
            });
        })
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) => {
            return Promise.all(
                keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key))
            );
        }).then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', (event) => {
    if (event.request.method !== 'GET') return;

    const url = new URL(event.request.url);

    // Não intercepta chamadas externas de cotação de câmbio (AwesomeAPI / CoinGecko) nem APIs dinâmicas
    if (url.origin !== self.location.origin || url.pathname.includes('/api/')) {
        return;
    }

    // Navegações e HTML: Network First com fallback de Cache
    if (event.request.mode === 'navigate') {
        event.respondWith(
            fetch(event.request).catch(async () => {
                const cached = await caches.match(event.request);
                if (cached) return cached;
                const fallback = await caches.match('./index.php');
                if (fallback) return fallback;
                return new Response('Offline', { status: 503, statusText: 'Offline' });
            })
        );
        return;
    }

    // Ativos estáticos locais: Cache First com fallback de rede
    event.respondWith(
        caches.match(event.request).then((cachedResponse) => {
            if (cachedResponse) return cachedResponse;
            return fetch(event.request).then((networkResponse) => {
                if (networkResponse && networkResponse.status === 200) {
                    const clone = networkResponse.clone();
                    caches.open(CACHE_NAME).then((cache) => cache.put(event.request, clone));
                }
                return networkResponse;
            });
        }).catch(() => {
            return new Response('', { status: 408, statusText: 'Network request failed' });
        })
    );
});
