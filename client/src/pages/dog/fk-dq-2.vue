<template lang="pug">
.fk-dq2.fk-page
  .fk-container
    h3 Q{{ question.idx }} - {{ str.title }}

    .fk-dq2__option-container(v-if="!hasSubmitted")
      .fk-dq2__option(
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
        .fk-dq2__correct-ans-container 
          .fk-dq2__correct-ans(v-for="item in question.ans" :key="item.id") {{  str.ans[item] }}

      fk-ans-doctor(
        avator="/img/faker_avator.jpg"
        :name="str.doc.name"
        :title="str.doc.title"
        :say-title="str.doc.say.title"
        :say-content="str.doc.say.content"
        :source="str.doc.source"
        :sourceUrl="str.doc.sourceUrl"
      )

      .fk-dq1__next-wrapper
        router-link(:to="`/quiz/${cate}/${question.idx + 1}`")
          fk-btn-primary(:text="str.next")
</template>

<script>
import { submitAnswer, multiStrategy } from '@/assets/js/mixins';

const str = {
  title: '未滿6個月大的幼犬適合哪些食物？(拖曳題)',
  ans: {
    1: '幼犬專用濕糧',
    2: '幼犬飼料',
    3: '鈣粉補充包',
    4: '蔬菜',
  },
  next: '下一題',
  doc: {
    name: '王尚麟獸醫師',
    title: '國立臺灣大學附設動物醫院內科主治醫師',
    say: {
      title: '給飼主的餵食建議',
      content:
        '幼犬專用飼料已含適當且均衡的營養鈣質，無需額外補充。若有個別需求，餵食前請諮詢獸醫師。(註2)',
    },
    source: '幼犬餵食和營養─幼犬需要吃補品嗎？',
    sourceUrl: '#',
  },
};

export default {
  name: 'DogQ2',
  data: () => ({
    str,
    cate: 'dog',
    myAns: [],
    question: {
      idx: 2,
      options: [1, 2, 3, 4],
      ans: [1, 2],
    },
  }),
  mixins: [submitAnswer, multiStrategy],
  methods: {},
  created() {
    console.log(process.env.VUE_APP_API_ROOT);
  },
};
</script>
