<template lang="pug">
.fk-cq1.fk-page
  .fk-container
    .fk-quiz-progress-wrapper
      fk-progress(:idx="data.idx")
    h3 Q{{ data.idx }} - {{ data.title }}

    .fk-cq1__option-container(v-if="!hasSubmitted")
      .fk-cq1__option(
        v-for="item in Object.keys(data.options)"
        :key="`cq-${data.idx}-${item}`"
      )
        span {{ data.options[item] }}
        input(
          :id="`cq-input-${data.idx}-${item}`"
          type="checkbox"
          :value="+item"
          v-model="myAns"
          @change="selectAnswer(multiStrategy(data.ans, myAns))"
        )

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
        .fk-cq1__correct-ans-container 
          .fk-cq1__correct-ans(v-for="item in data.ans" :key="item.id") {{  data.options[item] }}

      fk-ans-doctor(
        avator="img/faker_avator.jpg"
        :name="data.doc.name"
        :title="data.doc.title"
        :say-title="data.doc.say.title"
        :say-content="data.doc.say.content"
        :source="data.doc.source"
      )

      .fk-cq1__next-wrapper
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
import { submitAnswer, multiStrategy } from '@/assets/js/mixins';
import quiz from '@/assets/json/quiz-cat.json';
import FkProgress from '@/components/fk-progress.vue';

export default {
  name: 'CatQ1',
  components: {
    FkProgress,
  },
  data: () => ({
    data: quiz.cat1,
    cate: 'cat',
    myAns: [],
  }),
  mixins: [submitAnswer, multiStrategy],
  created() {
    console.log(process.env.VUE_APP_API_ROOT);
  },
};
</script>
