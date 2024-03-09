import axios from "axios";
import store from './store/index.js'

const instance = axios.create({
    baseURL: "/api"
});

instance.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === 401) {
            store.dispatch('auth/logout');
        }
        return Promise.reject(error);
    }
);

export default instance;