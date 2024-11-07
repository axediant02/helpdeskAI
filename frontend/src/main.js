import './assets/style.css';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import axios from 'axios';
import { createPinia } from 'pinia';
import { useAuthStore } from '@/store/auth';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import { ToastPlugin } from 'vue-toast-notification';

// Create Vue app instance
const app = createApp(App);

// Set Axios base URL
axios.defaults.baseURL = 'http://127.0.0.1:8000';

// Initialize Pinia store
const pinia = createPinia();
app.use(pinia);

// Access the auth store and set the Authorization header if a token exists
const authStore = useAuthStore();
if (authStore.token) { 
    axios.defaults.headers.common['Authorization'] = `Bearer ${authStore.token}`;
}

app.use(ToastPlugin);

// Use router
app.use(router);

// Mount the app
app.mount('#app');
