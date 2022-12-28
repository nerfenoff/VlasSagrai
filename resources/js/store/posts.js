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
            var posts = await axios.get('/VlasSagrai/api/posts/', {params: data})
            commit('setPosts', posts.data)
        },
        async getSinglePost({commit}, id) {
            var post = await axios.get('/VlasSagrai/api/SinglePostd/', {params: {id: id}})
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