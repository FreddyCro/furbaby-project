<template lang="pug">
.fk-ans.fk-page
  fk-bg

  .fk-ans-content
    .fk-ans-content__main
      .fk-ans__wizard-wrapper(v-if="!hasSubmitted")
        fk-wizard(:idx="idx || 1")

      .fk-container
        .fk-ans__quiz
          template(v-if="!hasSubmitted")
            .fk-ans__title-wrapper
              h3.fk-ans__title
                span.fk-ans__title-idx Q{{ idx }}
                span.fk-ans__title-name-group
                  span.fk-ans__title-name {{ title }} 
                  span.fk-ans__title-label(v-if="getQuizTypeText") {{ getQuizTypeText }}
                span.fk-ans__title-footprint
                  footprint-cat(v-if="cate === 'cat'")
                  footprint-dog(v-if="cate === 'dog'")

            //- my answer
            .fk-ans__my-ans-wrapper
              slot(name="my-ans")

          //- correct answer
          .fk-ans__correct-ans-wrapper(v-else)
            slot(name="correct-ans")

    //- pagination
    .fk-container
      .fk-ans__pagination
        //- submit
        .fk-ans__next-step(v-if="hasSelect && !hasSubmitted")
          button.fk-btn-prim(@click="handleSumbitClick")
            span {{ str.showAns }}
            span.fk-ans__next-step-icon

        //- next step
        router-link(
          v-if="hasSubmitted"
          :to="idx === 7 ? '/result' : `/quiz/${cate}/${idx + 1}`"
        )
          button.fk-btn-prim(@click="scrollToTop")
            span {{ idx === 7 ? str.showFinalScore : str.next }}
            span.fk-ans__next-step-icon

</template>

<script>
import str from '@/assets/json/quiz.json';

import FkBg from '@/components/fk-bg.vue';
import FkWizard from '@/components/fk-wizard.vue';
import FootprintCat from '@/assets/img/quiz/cat/footprint_cat.svg';
import FootprintDog from '@/assets/img/quiz/dog/footprint_dog.svg';

export default {
  name: 'FkAns',
  props: {
    idx: {
      type: Number,
    },
    cate: {
      type: String,
    },
    title: {
      type: String,
    },
    questionType: {
      type: String,
    },
    hasSelect: {
      type: Boolean,
    },
    hasSubmitted: {
      type: Boolean,
    },
    submitAnswer: {
      type: Function,
    },
    suggestionDialog: {
      type: Boolean,
      default: false,
    },
  },
  components: {
    FkBg,
    FkWizard,
    FootprintCat,
    FootprintDog,
  },
  data() {
    return {
      str,
    };
  },
  computed: {
    getQuizTypeText() {
      if (this.questionType === 'multi') return '複選題';
      if (this.questionType === 'drag') return '拖曳題';
      return null;
    },
  },
  methods: {
    scrollToTop() {
      this.$nextTick(() => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });
    },
    handleSumbitClick() {
      this.submitAnswer(this.cate, this.idx);
      this.scrollToTop();
    },
  },
  created() {
    // TODO: redirect to current step if route to another step
    this.$store.dispatch('setCurrentStepSumit', false);

    if (this.$store.state.currentStep > 7) this.$router.push('/result');
  },
};
</script>
