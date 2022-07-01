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
      .next
        fk-btn-primary(text="下一題")
</template>

<script>
import { submitAnswer, multiStrategy } from '@/assets/js/mixins';
import FkBtnPrimary from '@/components/fk-btn/fk-btn-primary.vue';

const str = {
  title: '下列何者食物是狗狗的飲食地雷？(複選題)',
  ans: {
    1: '牛奶',
    2: '巧克力',
    3: '堅果',
    4: '煮熟肉塊',
    5: '鳳梨',
  },
};

export default {
  name: 'DogQ1',
  components: {
    FkBtnPrimary,
  },
  data: () => ({
    str,
    cate: 'dog',
    myAns: [],
    question: {
      idx: 1,
      type: 'multiple',
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
