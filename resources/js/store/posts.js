import axios from 'axios'

export default {
    state: {
        posts: [],
        pages: null
    },
    mutations: {
        setPosts(state, payload) {
            state.posts = payload.data
            state.pages = payload.pages
        }
    },
    actions: {
        async getPosts({commit}, data) {
            var posts = await axios.get('/api/posts/', {params: data})
            commit('setPosts', posts.data)
        },
        async getSinglePost({commit}, id) {
            var post = await axios.get('/api/SinglePostd/', {params: {id: id}})
            return post.data
        },
        async addNewPost({commit}, data) {
            var post = await axios.post('/api/postsSave/', data)
            return post.data
        }
        
    }, 
    getters: {
        posts(state) {
            return state.posts
        },
        pages(state) {
            return state.pages
        }
    }
}