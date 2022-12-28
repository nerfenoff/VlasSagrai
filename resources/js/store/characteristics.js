import axios from 'axios'

export default {
    state: {
        education_levels: null,
        citys: null,
        educational_institutions: null,
        form_of_educations: null,
        specializations: null
    },
    mutations: {
        saveCharacteristics(state, payload) {
            state.education_levels = payload.education_levels
            state.citys = payload.citys
            state.educational_institutions = payload.educational_institutions
            state.form_of_educations = payload.form_of_educations
            state.specializations = payload.specializations
        }
    },
    actions: {
        async getCharacteristics({commit}) {
            var posts = await axios.get('/api/characteristics/')
            commit('saveCharacteristics', posts.data)
        }
        
    }, 
    getters: {
        education_levels(state) {
            return state.education_levels
        },
        citys(state) {
            return state.citys
        },
        educational_institutions(state) {
            return state.educational_institutions
        },
        form_of_educations(state) {
            return state.form_of_educations
        },
        specializations(state) {
            return state.specializations
        },
    }
}