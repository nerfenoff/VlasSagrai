// import Vue from 'vue'
import {createRouter, createWebHistory} from 'vue-router'

import Home from '../components/Home.vue'
import About from '../components/About.vue'
import SinglePost from '../components/SinglePost.vue'

// Vue.use(Router)

const routes = [
    { 
        path: '/',
        name: "Home",
        component: Home,
        beforeEnter: (to, from, next) => {
            next('/posts/1')
        }
    },
    {
        path: '/posts/:id',
        name: "HomePosts",
        component: Home
    },
    {
        path: '/post/:id',
        name: "SinglePost",
        component: SinglePost
    },
    { 
        path: '/About',
        name: "About",
        component: About
    },
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})
export default router