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


//set the moment locale
import moment from 'moment';
import 'moment/locale/en-gb';
import 'moment/locale/ar';
moment.locale('en-gb');
const locale = localStorage.getItem('locale') || 'en';

if (locale === 'ar') {
    document.querySelector('html').setAttribute('dir', 'rtl');
    document.querySelector('html').setAttribute('lang', 'ar');
    moment.locale('ar');
}



createApp(App)
    .use(router)
    .use(store)
    .use(i18n)
    .mount('#app');


