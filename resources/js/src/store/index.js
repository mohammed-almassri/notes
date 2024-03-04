import { createStore } from 'vuex'
import auth from './auth'
import notes from './notes'
const store = createStore({
  modules: {
    auth,
    notes,
  }
})

export default store