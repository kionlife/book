import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../css/app.css';

import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router/router';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import store from './store/store';


const app = createApp(App);
app.use(router);
app.use(Toast);
app.use(store);
app.mount('#app');

export default app;
