<template lang="pug">
.fk-dog-q3
  h3 Q{{ question.idx }} - {{ str.title }}
  .q {{ str.question}}

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
    .next
      router-link(:to="`/quiz/${cate}/${question.idx + 1}`") Next
</template>

<script>
import { submitAnswer, singleStrategy } from '@/assets/js/mixins';

const str = {
  title: 'lorem ipsum dolor sit amet',
  question:
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit magnam, molestias exercitationem eius numquam, sunt velit beatae earum placeat corrupti nam laborum maxime aliquid. Officia reiciendis sed itaque deleniti voluptatem.',
  ans: {
    1: 'A',
    2: 'B',
    3: 'C',
    4: 'D',
  },
};

export default {
  name: 'DogQ3',
  data: () => ({
    str,
    cate: 'dog',
    question: {
      idx: 3,
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
