<template lang="pug">
.fk-dq1.fk-page
  .fk-container
    h3 Q{{ question.idx }} - {{ str.title }}

    .fk-dq1__option-container(v-if="!hasSubmitted")
      .fk-dq1__option(
        v-for="item, index in question.options"
        :key="`dq-${question.idx}-${index}`"
      )
        span {{ str.ans[item] }}
        input(
          :id="`dq-input-${question.idx}-${index}`"
          type="checkbox"
          :value="item"
          v-model="myAns"
          @change="selectAnswer(multiStrategy(question.ans, myAns))"
        )

    //- submit and show answer
    fk-ans-submit(
      v-if="hasSelect"
      :question="question"
      :has-select="hasSelect"
      :has-submitted="hasSubmitted"
      :is-correct="isCorrect"
      :submit-answer="submitAnswer"
      :cate="cate"
      :is-last="false"
    )
      fk-ans-correct(
        :question="str.title"
        illustration="/img/faker_sm.jpg"
      )
        .fk-dq1__correct-ans-container 
          .fk-dq1__correct-ans(v-for="item in question.ans" :key="item.id") {{  str.ans[item] }}

      fk-ans-doctor(
        avator="/img/faker_avator.jpg"
        :name="str.doc.name"
        :title="str.doc.title"
        :say-title="str.doc.say.title"
        :say-content="str.doc.say.content"
        :source="str.doc.source"
        :source-url="str.doc.sourceUrl"
      )

      .fk-dq1__next-wrapper
        router-link(:to="`/quiz/${cate}/${question.idx + 1}`")
          fk-btn-primary(:text="str.next")
</template>

<script>
// mixins
// variables: [hasSelect, hasSubmitted, isCorrect]
// methods: [selectAnswer, submitAnswer]
// components: [FkAnsCorrect, FkAnsSubmit, FkAnsDoctor, FkBtnPrimary]
// from submitAnswr
import { submitAnswer, multiStrategy } from '@/assets/js/mixins';

const str = {
  title: '下列何者食物是狗狗的飲食地雷？(複選題)',
  ans: {
    1: '牛奶',
    2: '巧克力',
    3: '堅果',
    4: '煮熟肉塊',
    5: '鳳梨',
  },
  next: '下一題',
  doc: {
    name: '王尚麟獸醫師',
    title: '國立臺灣大學附設動物醫院內科主治醫師',
    say: {
      title: '給飼主的餵食提醒',
      content:
        '狗狗身體缺乏消化酶，無法消化乳製品。堅果高脂容易造成牠們腸胃不適、嘔吐窒息。而科學實證巧克力中的可可鹼會中斷狗狗的代謝過程，嚴重恐致死。(註1)',
    },
    source: '10種不可以給犬吃的有毒食物',
    sourceUrl: '#',
  },
};

export default {
  name: 'DogQ1',
  data: () => ({
    str,
    cate: 'dog',
    myAns: [],
    question: {
      idx: 1,
      options: [1, 2, 3, 4, 5],
      ans: [1, 2, 3],
    },
  }),
  mixins: [submitAnswer, multiStrategy],
  created() {
    console.log(process.env.VUE_APP_API_ROOT);
  },
};
</script>
