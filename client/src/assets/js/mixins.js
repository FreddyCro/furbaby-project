import { answerQuiz } from '@/api/quiz';
import { shuffle } from '@/assets/js/utils';

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
  computed: {
    shuffleOptions() {
      return shuffle(Object.keys(this.data.options));
    },
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

      this.$store.dispatch('setCurrentStepSumit', true);
      this.$store.dispatch('setCurrentStep', Math.min(this.data.idx + 1, 7));
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
  computed: {
    shuffleOptions() {
      return shuffle(Object.keys(this.data.options));
    },
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

      this.$store.dispatch('setCurrentStepSumit', true);
      this.$store.dispatch('setCurrentStep', Math.min(this.data.idx + 1, 7));
      // console.log('go:', this.$store.state.currentStep);
    },
    singleStrategy(correctAns, myAns) {
      this.myAns = myAns;
      return +correctAns === +this.myAns;
    },
  },
};

export { multiStrategyMixins, singleStrategyMixins };
