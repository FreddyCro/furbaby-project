import Vue from 'vue';
import Router from 'vue-router';
import Landing from '@/pages/landing.vue';
import Result from '@/pages/result.vue';
import Cat1 from '@/pages/cat/q1.vue';
import Dog2 from '@/pages/dog/q1.vue';

Vue.use(Router);


const routes = [
  { path: '/', component: Landing },
  { path: '/about', component: Result },
  { path: '/exam/cat/1', component: Cat1 },
  { path: '/exam/dog/1', component: Dog2 },
];

export default new Router({
  routes,
});
