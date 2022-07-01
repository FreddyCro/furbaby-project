<template lang="pug">
.fk-dq5.fk-page
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
  title: 'Q5 關於幼犬成長階段的營養知識，以下何者錯誤？',
  next: '下一題',
  ans: {
    1: '幼犬出生後會經歷一段免疫空窗期，需注意抗氧化營養成分(包括維生素E與維生素C)，幫助免疫系統發展。',
    2: '幼犬成長第2階段進入大腦發育黃金期，需要富含ω-3脂肪酸（DHA）的營養配方幫助大腦發育。',
    3: '幼犬成長速度緩慢，需刻意區分成長階段，餵食單一一種飼料即可提供幼犬所需的營養。',
    4: '幼犬在一年之內，骨骼的強度可達到水泥的4倍，適當的鈣和磷營養素，可幫助鞏固骨骼結構與牙齒健康',
  },
  doc: {
    name: '王尚麟獸醫師',
    title: '國立臺灣大學附設動物醫院內科主治醫師',
    say: {
      title: '給飼主的營養提醒',
      content:
        '狗狗的生理和行為在幼犬期會發生巨大的變化，因應牠們的高速成長需要量身訂製的營養配方，才能幫助牠們健康、強壯。(註5)',
    },
    source: '幼犬成長計畫、幼犬照顧指南',
    sourceUrl: '#',
  },
};

export default {
  name: 'DogQ5',
  data: () => ({
    str,
    cate: 'dog',
    question: {
      idx: 5,
      type: 'single',
      options: [1, 2, 3, 4],
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
