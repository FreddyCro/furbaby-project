import Vue from 'vue';
import Router from 'vue-router';
import Landing from '@/pages/landing.vue';
import Result from '@/pages/result.vue';

// cat questions
import Cat1 from '@/pages/cat/q1.vue';
import Cat2 from '@/pages/cat/q2.vue';
import Cat3 from '@/pages/cat/q3.vue';
// import Cat4 from '@/pages/cat/q4.vue';
// import Cat5 from '@/pages/cat/q5.vue';
// import Cat6 from '@/pages/cat/q6.vue';
// import Cat7 from '@/pages/cat/q7.vue';
// import Cat8 from '@/pages/cat/q8.vue';
// import Cat9 from '@/pages/cat/q9.vue';
// import Cat10 from '@/pages/cat/q10.vue';
// import Cat11 from '@/pages/cat/q11.vue';
// import Cat12 from '@/pages/cat/q12.vue';
// import Cat13 from '@/pages/cat/q13.vue';
// import Cat14 from '@/pages/cat/q14.vue';

// dog questions
import Dog1 from '@/pages/dog/q1.vue';
import Dog2 from '@/pages/dog/q2.vue';
import Dog3 from '@/pages/dog/q3.vue';
// import Dog4 from '@/pages/dog/q4.vue';
// import Dog5 from '@/pages/dog/q5.vue';
// import Dog6 from '@/pages/dog/q6.vue';
// import Dog7 from '@/pages/dog/q7.vue';
// import Dog8 from '@/pages/dog/q8.vue';
// import Dog9 from '@/pages/dog/q9.vue';
// import Dog10 from '@/pages/dog/q10.vue';
// import Dog11 from '@/pages/dog/q11.vue';
// import Dog12 from '@/pages/dog/q12.vue';
// import Dog13 from '@/pages/dog/q13.vue';
// import Dog14 from '@/pages/dog/q14.vue';

Vue.use(Router);

const routes = [
  { path: '/', component: Landing },
  { path: '/result', component: Result },
  { path: '/exam/cat/1', component: Cat1 },
  { path: '/exam/cat/2', component: Cat2 },
  { path: '/exam/cat/3', component: Cat3 },
  { path: '/exam/dog/1', component: Dog1 },
  { path: '/exam/dog/2', component: Dog2 },
  { path: '/exam/dog/3', component: Dog3 },
];

export default new Router({
  routes,
});
