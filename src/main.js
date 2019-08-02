import Vue from 'vue'
import App from './App.vue'
import router from './router';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';

Vue.prototype.$http = axios;

new Vue({
  el: '#app',
  router,
  render: h => h(App)
})
