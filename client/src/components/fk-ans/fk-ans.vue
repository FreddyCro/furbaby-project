<template lang="pug">
.fk-ans.fk-page
  fk-bg

  .fk-ans-content
    .fk-container
      .fk-ans__wizard-wrapper(v-if="!hasSubmitted")
        fk-wizard(:idx="idx || 1")

      .fk-ans__quiz
        template(v-if="!hasSubmitted")
          .fk-ans__title-wrapper
            h3.fk-ans__title
              span.fk-ans__title-idx Q{{ idx }}
              span.fk-ans__title-name-group
                span.fk-ans__title-name {{ title }} 
                span.fk-ans__title-label(v-if="getQuizTypeText") {{ getQuizTypeText }}
              span.fk-ans__title-footsprint
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
        .fk-ans__pagination-quiz
          //- submit
          .fk-ans__next-step(v-if="hasSelect && !hasSubmitted")
            button.fk-btn-prim(@click="submitAnswer(cate, idx)") 看解答

          //- next step
          router-link(
            v-if="hasSubmitted"
            :to="idx === 7 ? '/result' : `/quiz/${cate}/${idx + 1}`"
          )
            button.fk-btn-prim {{ idx === 7 ? '看最終成績' : '下一題' }}

</template>

<script>
import FkBg from '@/components/fk-bg.vue';
import FkWizard from '@/components/fk-wizard.vue';
import FkBtnPrimary from '@/components/fk-btn/fk-btn-primary.vue';
import FootprintCat from '@/assets/img/quiz/cat/footprint_cat.svg';
import FootprintDog from '@/assets/img/quiz/dog/footprint_dog.svg';

export default {
  name: 'FkAns',
  props: {
    idx: {
      type: Number,
      // required: true,
    },
    cate: {
      type: String,
      // required: true,
    },
    title: {
      type: String,
      // required: true,
    },
    questionType: {
      type: String,
    },
    hasSelect: {
      type: Boolean,
      // required: true,
    },
    hasSubmitted: {
      type: Boolean,
      // required: true,
    },
    submitAnswer: {
      type: Function,
      // required: true,
    },
    suggestionDialog: {
      type: Boolean,
      default: false,
    },
  },
  components: {
    FkBg,
    FkWizard,
    FkBtnPrimary,
    FootprintCat,
    FootprintDog,
  },
  computed: {
    getQuizTypeText() {
      if (this.questionType === 'multi') return '複選題';
      if (this.questionType === 'drag') return '拖曳題';
      return null;
    },
  },
};
</script>

<style lang="scss">
.fk-ans {
}
</style>
