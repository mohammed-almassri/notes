import api from '../api.js';
export default {
    namespaced: true,
    actions: {
        async addNote({ commit, state }, payload) {
            const res = await api.notes.store(payload);
            commit('addNote', payload);
            return res;
        },
        async updateNote({ commit, state }, payload) {
            const res = await api.notes.update(payload.id, payload);
            const notes = state.notes.map(note => {
                if (note.id === payload.id) {
                    return payload;
                }
                return note;
            });
            commit('setNotes', notes);
            return res;
        },
        async deleteNote({ commit, state }, id) {
            const res = await api.notes.delete(id);
            const notes = state.notes.filter(note => note.id != id);
            commit('setNotes', notes);
            return res;
        },
        async getNotes({ commit }) {
            const res = await api.notes.index();
            commit('setNotes', res.data);
            return res;
        },
        setNotes({ commit }, payload) {
            commit('setNotes', payload);
        }
    },
    mutations: {
        addNote(state, payload) {
            state.notes = [payload, ...state.notes];
        },
        setNotes(state, payload) {
            state.notes = payload;
        }
    },
    state: {
        notes: [
        ],
    }
}