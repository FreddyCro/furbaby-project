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
    currentStep: 0,
    currentStepSumit: false,
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
    resetState(state) {
      state.cate = undefined;
      state.user = '';
      state.cat.score = 0;
      state.dog.score = 0;
      state.currentStep = 0;
      state.currentStepSumit = false;
    },
    setCurrentStep(state, step) {
      state.currentStep = step;
    },
    setCurrentStepSumit(state, sumit) {
      state.currentStepSumit = sumit;
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
    resetState(context) {
      context.commit('resetState');
    },
    setCurrentStep(context, step) {
      context.commit('setCurrentStep', step);
    },
    setCurrentStepSumit(context, sumit) {
      context.commit('setCurrentStepSumit', sumit);
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
