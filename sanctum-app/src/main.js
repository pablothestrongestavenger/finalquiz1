import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import 'bootstrap/dist/css/bootstrap.css'

axios.defaults.baseURL = 'http://your-api-url.com/api';

axios.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

createApp(App).use(router).mount('#app')
