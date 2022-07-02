<template lang="pug">
.fk-dq7.fk-page
  .fk-container
    h3 Q{{ data.idx }} - {{ data.title }}

    .fk-dq7__option-container(v-if="!hasSubmitted")
      .fk-dq7__option(
        v-for="item in Object.keys(data.options)"
        :key="`dq-${data.idx}-${item}`"
      )
        span {{ data.options[item] }}
        input(
          :id="`dq-input-${data.idx}-${item}`"
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
        .fk-dq7__correct-ans-container 
          .fk-dq7__correct-ans(v-for="item in data.ans" :key="item.id") {{  data.options[item] }}
        p {{ data.explain }}

      .fk-dq7__next-wrapper
        router-link(:to="`/result`")
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
import quiz from '@/assets/json/quiz-dog.json';

export default {
  name: 'DogQ7',
  data: () => ({
    data: quiz.dog7,
    cate: 'dog',
    myAns: [],
  }),
  mixins: [submitAnswer, multiStrategy],
  methods: {},
  created() {
    console.log(process.env.VUE_APP_API_ROOT);
  },
};
</script>
