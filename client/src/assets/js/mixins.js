const submitAnswer = {
  methods: {
    submitAnswer(ans, type) {
      if (this.question.ans === ans) {
        this.$store.dispatch('updateScore', type);
      }
    },
  },
};

export { submitAnswer };
