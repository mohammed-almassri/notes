import api from '../api';
export default {
    namespaced: true,
    actions: {
        async upload({ commit }, formData) {
            const progressCallback = (progressEvent) => {
                const progress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                commit('setFileUploading', { file: formData.get('file'), progress });
            }
            const response = await api.files.upload(formData, progressCallback);
            commit('removeFileUploading', formData.get('file'));
            return response.data;
        }
    },
    mutations: {
        setFileUploading(state, { file, progress }) {
            console.log('setFileUploading', state);
            state.filesUploading = {
                ...state.filesUploading,
                [file.name]: progress
            }
        },
        removeFileUploading(state, file) {
            const filesUploading = { ...state.filesUploading };
            delete filesUploading[file.name];
            state.filesUploading = filesUploading;
        }
    },
    state: {
        filesUploading: {},
    }
}