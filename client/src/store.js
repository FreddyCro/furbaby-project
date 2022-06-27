import Vue from 'vue';
import Vuex from 'vuex';
import questions from '@/assets/json/questions.json';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    questions,
  },
  mutations: {},
  actions: {},
  getters: {
    getQuestion: (state) => ({type, idx}) =>
      state.questions[type][idx],
  },
  modules: {},
});
