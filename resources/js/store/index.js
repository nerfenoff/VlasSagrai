import {createStore}  from 'vuex'

import posts from './posts'
import characteristics from './characteristics'

// Vue.use(Vuex)

export default createStore({
    modules: {
        posts,
        characteristics
    }
})