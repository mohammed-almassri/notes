import axios from "axios";
import store from './store/index.js'
import router from "./router.js";

const instance = axios.create({
    baseURL: "/api"
});

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