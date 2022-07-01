import FkAnsSubmit from '@/components/fk-ans/fk-ans-submit.vue';

const submitAnswer = {
  components: { FkAnsSubmit },
  data() {
    return {
      hasSelect: false,
      hasSubmitted: false,
      isCorrect: false,
    };
  },
  methods: {
    selectAnswer(boolean) {
      this.hasSelect = true;
      this.isCorrect = boolean;
    },
    submitAnswer(cate) {
      console.log(cate);
      if (this.hasSubmitted) return;

      this.hasSubmitted = true;

      if (this.isCorrect) {
        this.$store.dispatch('updateScore', cate);
      }
    },
  },
};

const singleStrategy = {
  methods: {
    singleStrategy(correctAns, myAns) {
      return correctAns === myAns;
    },
  },
};

const multiStrategy = {
  methods: {
    multiStrategy(correctAns, myAns) {
      if (correctAns.length === myAns.length) {
        for (let i = 0; i < correctAns.length; i++) {
          if (correctAns[i] !== myAns[i]) {
            return false;
          }
        }

        return true;
      }

      return false;
    },
  },
};

export { submitAnswer, singleStrategy, multiStrategy };
