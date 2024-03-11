import axios from "axios";
import store from './store/index.js'
import router from "./router.js";

const instance = axios.create({
    baseURL: "/api"
});

// const locale = store.state.settings.locale;

// instance.defaults.headers.common['Accept-Language'] = locale;

instance.interceptors.request.use(
    config => {
        const locale = store.state.settings.locale;
        config.headers['Accept-Language'] = locale;

        return config;
    },
    error => {
        return Promise.reject(error);
    }
);

instance.interceptors.response.use(
    response => response,
    error => {
        console.log('axios error', error);
        if (error.response.status === 401) {
            store.dispatch('auth/logout');
            router.push('/login');
        }
        return Promise.reject(error);
    }
);

export default instance;