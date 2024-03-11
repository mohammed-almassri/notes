import { createStore } from 'vuex'
import auth from './auth'
import notes from './notes'
import files from './files'
import settings from './settings'
const store = createStore({
  modules: {
    auth,
    notes,
    files,
    settings,
  }
})

export default store