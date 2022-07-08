<template lang="pug">
.fk-cq5.fk-page
  .fk-container
    .fk-quiz-progress-wrapper
      fk-progress(:idx="data.idx")
    h3 Q{{ data.idx }} - {{ data.title }}

    .ans(v-if="!hasSubmitted")
      button(
        v-for="item in Object.keys(data.options)"
        :key="`cq-${data.idx}-${item}`"
        @click="selectAnswer(singleStrategy(data.ans, item))"
      ) {{ data.options[item] }}

    //- submit and show answer
    fk-ans-submit(
      v-if="hasSelect"
      :idx="data.idx"
      :has-select="hasSelect"
      :has-submitted="hasSubmitted"
      :is-correct="isCorrect"
      :submit-answer="submitAnswer"
      :cate="cate"
      :is-last="false"
    )
      fk-ans-correct(
        :question="data.title"
        illustration="img/faker_sm.jpg"
      )
        p {{ data.ans[data.ans] }}

      fk-ans-doctor(
        avator="img/faker_avator.jpg"
        :name="data.doc.name"
        :title="data.doc.title"
        :say-title="data.doc.say.title"
        :say-content="data.doc.say.content"
        :source="data.doc.source"
      )

      .fk-cq5__next-wrapper
        router-link(:to="`/quiz/${cate}/${data.idx + 1}`")
          fk-btn-primary(:text="data.next")
</template>

<script>
/**
 * @mixin submitAnswer
 * data: [hasSelect, hasSubmitted, isCorrect]
 * methods: [selectAnswer, submitAnswer]
 * components: [FkAnsCorrect, FkAnsSubmit, FkAnsDoctor, FkBtnPrimary]
 */
import { submitAnswer, singleStrategy } from '@/assets/js/mixins';
import quiz from '@/assets/json/quiz-cat.json';
import FkProgress from '@/components/fk-progress.vue';

export default {
  name: 'CatQ5',
  components: {
    FkProgress,
  },
  data: () => ({
    data: quiz.cat5,
    cate: 'cat',
  }),
  mixins: [submitAnswer, singleStrategy],
  methods: {},
  created() {
    console.log(process.env.VUE_APP_API_ROOT);
  },
};
</script>
