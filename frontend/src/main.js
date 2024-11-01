import './assets/style.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios';
import { createPinia } from 'pinia';

const app = createApp(App)

app.use(router)
app.use(createPinia())
app.mount('#app')

axios.defaults.baseURL = 'http://127.0.0.1:8000';