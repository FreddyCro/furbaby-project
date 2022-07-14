import Vue from 'vue';
import store from './store';
import Router from 'vue-router';
import FkLanding from '@/pages/fk-landing.vue';
import FkResult from '@/pages/fk-result.vue';

// cat questions
import CatStart from '@/pages/cat/fk-cq-start.vue';
import Cat1 from '@/pages/cat/fk-cq-1.vue';
import Cat2 from '@/pages/cat/fk-cq-2.vue';
import Cat3 from '@/pages/cat/fk-cq-3.vue';
import Cat4 from '@/pages/cat/fk-cq-4.vue';
import Cat5 from '@/pages/cat/fk-cq-5.vue';
import Cat6 from '@/pages/cat/fk-cq-6.vue';
import Cat7 from '@/pages/cat/fk-cq-7.vue';

// dog questions
import DogStart from '@/pages/dog/fk-dq-start.vue';
import Dog1 from '@/pages/dog/fk-dq-1.vue';
import Dog2 from '@/pages/dog/fk-dq-2.vue';
import Dog3 from '@/pages/dog/fk-dq-3.vue';
import Dog4 from '@/pages/dog/fk-dq-4.vue';
import Dog5 from '@/pages/dog/fk-dq-5.vue';
import Dog6 from '@/pages/dog/fk-dq-6.vue';
import Dog7 from '@/pages/dog/fk-dq-7.vue';

Vue.use(Router);

const routes = [
  { path: '/', name: 'landing', component: FkLanding },
  { path: '/result', component: FkResult },

  // cat quiz
  { path: '/quiz/cat', component: CatStart },
  { path: '/quiz/cat/1', component: Cat1 },
  { path: '/quiz/cat/2', component: Cat2 },
  { path: '/quiz/cat/3', component: Cat3 },
  { path: '/quiz/cat/4', component: Cat4 },
  { path: '/quiz/cat/5', component: Cat5 },
  { path: '/quiz/cat/6', component: Cat6 },
  { path: '/quiz/cat/7', component: Cat7 },

  // dog quiz
  { path: '/quiz/dog', component: DogStart },
  { path: '/quiz/dog/1', component: Dog1 },
  { path: '/quiz/dog/2', component: Dog2 },
  { path: '/quiz/dog/3', component: Dog3 },
  { path: '/quiz/dog/4', component: Dog4 },
  { path: '/quiz/dog/5', component: Dog5 },
  { path: '/quiz/dog/6', component: Dog6 },
  { path: '/quiz/dog/7', component: Dog7 },
];

const router = new Router({
  store,
  routes,
  scrollBehavior() {
    return new Promise((resolve) => {
      setTimeout(() => {
        resolve({ x: 0, y: 0 });
      }, 250);
    });
  },
});

router.beforeEach((to, from, next) => {
  const getPage = (path) => {
    const page = path.split('/').pop();
    return page;
  };

  // back to landing page
  if (store.state.user === '' || !store.state.cate) {
    if (to.path !== '/' && to.path !== '/quiz/cat' && to.path !== '/quiz/dog') {
      // router.go(-1);
    }
  }

  // go to next page
  if (+getPage(to.path) > +store.currentIndex + 1) {
    router.go(-1);
  }

  // // go to previous page
  // if (!checkCategory(to.path, store.state.cate)) {
  //   next();
  // }

  next();
});

export default router;
