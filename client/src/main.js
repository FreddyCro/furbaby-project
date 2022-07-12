import Vue from 'vue';
import App from './App.vue';
import store from './store';
import router from './router';
import VueScrollTo from 'vue-scrollto';
import './assets/style/main.scss';

Vue.use(VueScrollTo);

new Vue({
  store,
  router,
  render: (h) => h(App),
}).$mount('#app');
