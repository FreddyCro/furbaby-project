<template lang="pug">
.fk-dq3.fk-page
  .fk-co2tainer
    h3 Q{{ question.idx }} - {{ str.title }}

    .fk-dq3__option-container(v-if="!hasSubmitted")
      .fk-d3__option(
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
        .fk-dq3__correct-ans-container 
          .fk-dq3__correct-ans(v-for="item in question.ans" :key="item.id") {{  str.ans[item] }}
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

      .fk-dq3__next-wrapper
        router-link(:to="`/quiz/${cate}/${question.idx + 1}`")
          fk-btn-primary(:text="str.next")
</template>

<script>
import { submitAnswer, multiStrategy } from '@/assets/js/mixins';

const str = {
  title: 'Q3 狗狗愛抓癢，毛髮上出現很多小白屑，哪些是皮屑出現的原因？(複選題)',
  ans: {
    1: '寄生蟲',
    2: '食物',
    3: '環境',
    4: '內分泌',
  },
  explain:
    '引起狗狗皮膚問題的原因有很多，其中皮屑出現最常見的原因是食物中缺乏毛髮和皮膚發育需要的Omega 3和6必須脂肪酸。另外，可幫助調節狗狗皮膚細胞成長與皮脂產生的維生素A及容易消化的優質蛋白質也是牠們皮膚健康的重要營養素。(註3-1)',
  next: '下一題',
  doc: {
    name: '王尚麟獸醫師',
    title: '國立臺灣大學附設動物醫院內科主治醫師',
    say: {
      title: '給飼主保健皮膚建議',
      content:
        '輕度的皮膚搔癢、皮屑，可先開始改變環境及飲食，若調整一段時間後發現仍有皮屑、發癢、抓搔及其他皮膚問題，務必諮詢獸醫師，避免寄生蟲感染導致過敏性皮膚炎等問題。(註3-2)',
    },
    source:
      '犬皮屑和皮膚乾燥問題─什麼原因導致犬出現皮屑？如何解決我的愛犬皮屑問題？',
    sourceUrl: '#',
  },
};

export default {
  name: 'DogQ3',
  data: () => ({
    str,
    cate: 'dog',
    myAns: [],
    question: {
      idx: 3,
      options: [1, 2, 3, 4],
      ans: [1, 2, 3, 4],
    },
  }),
  mixins: [submitAnswer, multiStrategy],
  methods: {},
  created() {
    console.log(process.env.VUE_APP_API_ROOT);
  },
};
</script>
