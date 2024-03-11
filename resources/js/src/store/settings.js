export default {
    namespaced: true,
    actions: {
        setLocale({ commit }, locale) {
            commit('setLocale', locale)
            localStorage.setItem('locale', locale)
            document.querySelector('html').setAttribute('lang', locale)
            document.querySelector('html').setAttribute('dir', locale === 'ar' ? 'rtl' : 'ltr')
        },
        initLocale({ commit }) {
            const locale = localStorage.getItem('locale') || 'en'
            commit('setLocale', locale)
        }
    },
    mutations: {
        setLocale(state, locale) {
            state.locale = locale
        }
    },
    state: {
        locale: 'en'
    }
}