import axios from './axios.js';

export default {
    auth: {
        login(data) {
            return axios.post('/auth/login', data);
        },
        logout() {
            return axios.post('/auth/logout');
        },
        user() {
            return axios.get('/auth/user');
        },
        register(data) {
            return axios.post('/auth/register', data);
        }
    },
    notes: {
        index() {
            return axios.get('/notes');
        },
        store(note) {
            return axios.post('/notes', note);
        }
    },
}