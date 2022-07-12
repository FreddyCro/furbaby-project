// import FkAnsSubmit from '@/components/fk-ans/fk-ans-submit.vue';
// import FkAnsCorrect from '@/components/fk-ans/fk-ans-correct.vue';
// import FkAnsDoctor from '@/components/fk-ans/fk-ans-doctor.vue';
// import FkBtnPrimary from '@/components/fk-btn/fk-btn-primary.vue';
import { answerQuiz } from '@/api/quiz';

const isEqual = (a, b) => JSON.stringify(a) === JSON.stringify(b);

const multiStrategyMixins = {
  data() {
    return {
      hasSelect: false,
      hasSubmitted: false,
      isCorrect: false,
      myAns: [],
    };
  },
  methods: {
    selectAnswer(isCorrec) {
      this.hasSelect = this.myAns.length > 0;
      this.isCorrect = isCorrec;
    },
    submitAnswer(cate, id) {
      if (this.hasSubmitted) return;

      this.hasSubmitted = true;
      answerQuiz(cate, id, this.isCorrect ? 1 : 0);

      if (this.isCorrect) {
        this.$store.dispatch('updateScore', cate);
      }
    },
    multiStrategy(correctAns) {
      const newCorrectAns = correctAns.map((item) => +item).sort();
      const newMyAns = this.myAns.map((item) => +item).sort();
      return isEqual(newCorrectAns, newMyAns);
    },
  },
};

const singleStrategyMixins = {
  data() {
    return {
      hasSelect: false,
      hasSubmitted: false,
      isCorrect: false,
      myAns: undefined,
    };
  },
  methods: {
    selectAnswer(isCorrec) {
      this.hasSelect = this.myAns !== undefined;
      this.isCorrect = isCorrec;
    },
    submitAnswer(cate, id) {
      if (this.hasSubmitted) return;

      this.hasSubmitted = true;
      answerQuiz(cate, id, this.isCorrect ? 1 : 0);

      if (this.isCorrect) {
        this.$store.dispatch('updateScore', cate);
      }
    },
    singleStrategy(correctAns, myAns) {
      this.myAns = myAns;
      return +correctAns === +this.myAns;
    },
  },
};

export {
  multiStrategyMixins,
  singleStrategyMixins,
};
