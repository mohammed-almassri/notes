import api from '../api'
import axios from '../axios.js'

export default {
    namespaced: true,
    actions: {
        async login({ commit }, credentials) {
            const response = await api.auth.login(credentials)
            localStorage.setItem('token', response.data.token)
            axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`
            commit('setToken', response.data.token)
            return response
        },
        async register({ commit }, credentials) {
            const response = await api.auth.register(credentials)
            localStorage.setItem('token', response.data.token)
            axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`
            commit('setToken', response.data.token)
            return response
        },
        async logout({ commit }) {
            localStorage.removeItem('token')
            commit('setToken', null)
        },
        async user({ commit }) {
            const response = await api.auth.user()
            commit('setUser', response.data.user)
            return response
        },

        initAuth({ commit }) {
            const token = localStorage.getItem('token')
            if (token) {
                commit('setToken', token)
                console.log('setToken', token);
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
            }
        }

    },
    mutations: {
        setToken(state, token) {
            console.log('setToken 2', token);
            state.token = token
        },
        setUser(state, user) {
            state.user = user
        },
    },

    state: {
        token: null,
        user: null,
    },
}