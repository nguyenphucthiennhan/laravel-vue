import './bootstrap';
import './bootstrap';
import './jquery.min.js';
import './custom.js';
import './isotope.min.js';
import { createApp } from 'vue';
import router from '../router/index.js';
import App from './App.vue';
import 'bootstrap/dist/css/bootstrap-grid.min.css';
import 'bootstrap/dist/css/bootstrap-utilities.min.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import '../css/animate.css';
import '../css/flex-slider.css';
import '../css/fontawesome.css';
import '../css/owl.css';
import '../css/templatemo-lugx-gaming.css';
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'
library.add(faUserSecret)
import axios from 'axios';
window.axios = axios;
const app = createApp(App);
app.component('font-awesome-icon', FontAwesomeIcon);
app.use(router);
app.mount('#app');
