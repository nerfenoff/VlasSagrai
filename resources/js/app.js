import './bootstrap';

import {createApp} from 'vue'

import App from './App.vue'
import router from './router'
import store from './store'

import "vue-pagination-tw/styles"; // tailwind basic styles
import VuePaginationTw from "vue-pagination-tw";

// Vue.use(router)

const app = createApp(App)
app.use(router)
app.use(store)
app.component("VuePaginationTw", VuePaginationTw);
app.mount("#app")
