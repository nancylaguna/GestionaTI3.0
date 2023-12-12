import _ from 'lodash';
window._ = _;

/**
 * Cargaremos la biblioteca HTTP de axios que nos permite emitir solicitudes fácilmente
 * a nuestro back-end de Laravel. Esta biblioteca maneja automáticamente el envío del
 * Token CSRF como encabezado basado en el valor de la cookie del token "XSRF".
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo expone una API expresiva para suscribirse a canales y escuchar
 *para eventos que son transmitidos por Laravel. Transmisión de ecos y eventos
 * permite a su equipo crear fácilmente aplicaciones web sólidas en tiempo real.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
