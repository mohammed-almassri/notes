import { createStore } from 'vuex'
import auth from './auth'
import notes from './notes'
import files from './files'
const store = createStore({
  modules: {
    auth,
    notes,
    files,
  }
})

export default store