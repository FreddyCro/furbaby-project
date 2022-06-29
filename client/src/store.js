import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    type: undefined,
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
    setType(state, type) {
      state.type = type;
    },
    updateScore(state, type) {
      state[type].score++;
    },
  },
  actions: {
    setUser(context, user) {
      context.commit('setUser', user);
    },
    setType(context, type) {
      context.commit('setType', type);
    },
    updateScore(context, type) {
      context.commit('updateScore', type);
    },
  },
  getters: {
    getScore(state) {
      if (!state.type) return 0;
      return state[state.type].score;
    },
  },
  modules: {},
});
