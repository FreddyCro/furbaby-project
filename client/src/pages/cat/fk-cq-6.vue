<template lang="pug">
.fk-cq6.fk-page
  .fk-container
    h3 Q{{ data.idx }} - {{ data.title }}

    .fk-cq6__option-container(v-if="!hasSubmitted")
      .fk-cq6__option(
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
        .fk-cq6__correct-ans-container 
          .fk-cq6__correct-ans(v-for="item in data.ans" :key="item.id") {{  data.options[item] }}
        p {{ data.explain }}

      fk-ans-doctor(
        avator="img/faker_avator.jpg"
        :name="data.doc.name"
        :title="data.doc.title"
        :say-title="data.doc.say.title"
        :say-content="data.doc.say.content"
        :source="data.doc.source"
      )

      .fk-cq6__next-wrapper
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

export default {
  name: 'CatQ6',
  data: () => ({
    data: quiz.cat6,
    cate: 'cat',
    myAns: [],
  }),
  mixins: [submitAnswer, multiStrategy],
  created() {
    console.log(process.env.VUE_APP_API_ROOT);
  },
};
</script>
