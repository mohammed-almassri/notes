import './bootstrap';

import { createApp } from 'vue';
import App from './src/App.vue';
import router from './src/router';
import store from './src/store/index';
import { createI18n } from 'vue-i18n'
import messages from './src/i18n';

const i18n = createI18n({
    locale: 'en', // set locale
    messages, // set locale messages
})


createApp(App)
    .use(router)
    .use(store)
    .use(i18n)
    .mount('#app');


