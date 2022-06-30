import Vue from 'vue';
import Router from 'vue-router';
import FkLanding from '@/pages/fk-landing.vue';
import FkResult from '@/pages/fk-result.vue';

// cat questions
import CatStart from '@/pages/cat/fk-cq-start.vue';
import Cat1 from '@/pages/cat/fk-cq-1.vue';
import Cat2 from '@/pages/cat/fk-cq-2.vue';
import Cat3 from '@/pages/cat/fk-cq-3.vue';
// import Cat4 from '@/pages/cat/fk-cq-4.vue';
// import Cat5 from '@/pages/cat/fk-cq-5.vue';
// import Cat6 from '@/pages/cat/fk-cq-6.vue';
// import Cat7 from '@/pages/cat/fk-cq-7.vue';
// import Cat8 from '@/pages/cat/fk-cq-8.vue';
// import Cat9 from '@/pages/cat/fk-cq-9.vue';
// import Cat10 from '@/pages/cat/fk-cq-10.vue';
// import Cat11 from '@/pages/cat/fk-cq-11.vue';
// import Cat12 from '@/pages/cat/fk-cq-12.vue';
// import Cat13 from '@/pages/cat/fk-cq-13.vue';
// import Cat14 from '@/pages/cat/fk-cq-14.vue';

// dog questions
import DogStart from '@/pages/dog/fk-dq-start.vue';
import Dog1 from '@/pages/dog/fk-dq-1.vue';
import Dog2 from '@/pages/dog/fk-dq-2.vue';
import Dog3 from '@/pages/dog/fk-dq-3.vue';
// import Dog4 from '@/pages/dog/fk-dq-4.vue';
// import Dog5 from '@/pages/dog/fk-dq-5.vue';
// import Dog6 from '@/pages/dog/fk-dq-6.vue';
// import Dog7 from '@/pages/dog/fk-dq-7.vue';
// import Dog8 from '@/pages/dog/fk-dq-8.vue';
// import Dog9 from '@/pages/dog/fk-dq-9.vue';
// import Dog10 from '@/pages/dog/fk-dq-10.vue';
// import Dog11 from '@/pages/dog/fk-dq-11.vue';
// import Dog12 from '@/pages/dog/fk-dq-12.vue';
// import Dog13 from '@/pages/dog/fk-dq-13.vue';
// import Dog14 from '@/pages/dog/fk-dq-14.vue';

Vue.use(Router);

const routes = [
  { path: '/', component: FkLanding },
  { path: '/result', component: FkResult },

  // cat quiz
  { path: '/quiz/cat', component: CatStart },
  { path: '/quiz/cat/1', component: Cat1 },
  { path: '/quiz/cat/2', component: Cat2 },
  { path: '/quiz/cat/3', component: Cat3 },

  // dog quiz
  { path: '/quiz/dog', component: DogStart },
  { path: '/quiz/dog/1', component: Dog1 },
  { path: '/quiz/dog/2', component: Dog2 },
  { path: '/quiz/dog/3', component: Dog3 },
];

export default new Router({
  routes,
});
