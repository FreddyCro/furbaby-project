<template lang="pug">
.fk-dq4.fk-page
  .fk-container
    h3 Q{{ question.idx }} - {{ str.title }}

    .ans(v-if="!hasSubmitted")
      button(
        v-for="item in question.options"
        :key="item.idx"
        @click="selectAnswer(singleStrategy(question.ans, item))"
      ) {{ str.ans[item] }}

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
        p {{ str.ans[question.ans] }}
        p {{ str.explain }}

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
import { submitAnswer, singleStrategy } from '@/assets/js/mixins';

const str = {
  title: '餵食幼犬可將幼犬飼料泡水軟化更好入口？',
  ans: {
    1: '是',
    2: '否',
  },
  next: '下一題',
  explain:
    '幼犬在四至五週的離乳開始，可嘗試逐漸轉換過渡到乾糧，但一開始應選擇高水合性高消化率的幼犬專用飼料加水泡軟後餵食，加水比例每周減少以幫助幼犬逐漸適應固體食物，也更好入口及消化。(註4-1)',
  doc: {
    name: '王尚麟獸醫師',
    title: '國立臺灣大學附設動物醫院內科主治醫師',
    say: {
      title: '給飼主的餵食建議',
      content:
        '餵食幼犬除了需注意須餵食專用的幼犬配方，當餵食份量過多容易使得狗狗成長過快，引起骨骼問題，而且可能有「便便特別臭等食物消化不良情況。(註4-2)',
    },
    source: '幼犬餵食和營養─幼犬什麼時候可以吃乾糧食物？(註4-1)規畫正確的幼犬餵食時間表(註4-2)常見問題解答─我的寵物糞便味道很重，是飼料的問題嗎？(註4-2)',
    sourceUrl: '#',
  },
};

export default {
  name: 'DogQ4',
  data: () => ({
    str,
    cate: 'dog',
    question: {
      idx: 4,
      options: [1, 2],
      ans: 1,
    },
  }),
  mixins: [submitAnswer, singleStrategy],
  methods: {},
  created() {
    console.log(process.env.VUE_APP_API_ROOT);
  },
};
</script>
