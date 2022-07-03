import FkAnsSubmit from '@/components/fk-ans/fk-ans-submit.vue';
import FkAnsCorrect from '@/components/fk-ans/fk-ans-correct.vue';
import FkAnsDoctor from '@/components/fk-ans/fk-ans-doctor.vue';
import FkBtnPrimary from '@/components/fk-btn/fk-btn-primary.vue';
import { answerQuiz } from '@/api/quiz';

const submitAnswer = {
  components: { FkAnsCorrect, FkAnsSubmit, FkAnsDoctor, FkBtnPrimary },
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
    submitAnswer(cate, id) {
      if (this.hasSubmitted) return;

      this.hasSubmitted = true;
      answerQuiz(cate, id, this.isCorrect ? 1 : 0);

      if (this.isCorrect) {
        this.$store.dispatch('updateScore', cate);
      }
    },
  },
};

const singleStrategy = {
  methods: {
    singleStrategy(correctAns, myAns) {
      return +correctAns === +myAns;
    },
  },
};

const isEqual = (a, b) => JSON.stringify(a) === JSON.stringify(b);

const multiStrategy = {
  methods: {
    multiStrategy(correctAns, myAns) {
      const newCorrectAns = correctAns.map((item) => +item).sort();
      const newMyAns = myAns.map((item) => +item).sort();
      return isEqual(newCorrectAns, newMyAns);
    },
  },
};

export { submitAnswer, singleStrategy, multiStrategy };
