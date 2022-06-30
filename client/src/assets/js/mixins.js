const submitAnswer = {
  data() {
    return {
      hasSubmitted: false,
    };
  },
  methods: {
    submitAnswer(ans, type) {
      if (this.hasSubmitted) return;

      this.hasSubmitted = true;

      if (this.question.ans === ans) {
        this.$store.dispatch('updateScore', type);
      }
    },
  },
};

export { submitAnswer };
