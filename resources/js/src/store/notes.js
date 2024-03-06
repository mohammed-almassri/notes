import api from '../api.js';
export default {
    namespaced: true,
    actions: {
        async addNote({ commit, state }, payload) {
            await api.notes.store(payload);
            commit('addNote', payload);
        },
        async updateNote({ commit, state }, payload) {
            await api.notes.update(payload.id, payload);
            const notes = state.notes.map(note => {
                if (note.id === payload.id) {
                    return payload;
                }
                return note;
            });
            commit('setNotes', notes);
        },
        async getNotes({ commit }) {
            const response = await api.notes.index();
            commit('setNotes', response.data);
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