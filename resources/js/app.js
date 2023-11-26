import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../css/app.css';

import axios from 'axios';
import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router/router';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import store from './store/store';

axios.interceptors.response.use(
    response => response,
    error => {
        console.error('Axios error:', error); // Для відладки
        if (error.response && error.response.status === 401) {
            console.log('401 error');
            router.push('/login');
        }
        return Promise.reject(error);
    }
);


const app = createApp(App);
app.use(router);
app.use(Toast);
app.use(store);
app.mount('#app');

export default app;
