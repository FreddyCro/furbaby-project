import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    cate: undefined,
    user: '',
    cat: {
      score: 0,
    },
    dog: {
      score: 0,
    },
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    setCategory(state, cate) {
      state.cate = cate;
    },
    updateScore(state, cate) {
      state[cate].score++;
    },
  },
  actions: {
    setUser(context, user) {
      context.commit('setUser', user);
    },
    setCategory(context, cate) {
      context.commit('setCategory', cate);
    },
    updateScore(context, cate) {
      context.commit('updateScore', cate);
    },
  },
  getters: {
    getScore(state) {
      if (!state.cate) return 0;
      return state[state.cate].score;
    },
  },
  modules: {},
});
