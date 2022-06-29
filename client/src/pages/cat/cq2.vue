<template lang="pug">
.fk-cat-q2
  h1 Cat Q2
  .q Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est provident debitis aspernatur, nostrum, molestiae natus esse quam eum accusamus cum error laudantium. Veritatis, et hic ullam officiis nulla voluptatum magnam?

  .ans
    button(
      v-for="item in question.options"
      :key="item.idx"
      @click="submitAnswer(item, type)"
    ) {{ item }}

  .next
    router-link(to="/quiz/cat/3") Next

</template>

<script>
import { submitAnswer } from '@/assets/js/mixins';

export default {
  name: 'CatQ2',
  data: () => ({
    type: 'cat',
    question: {
      idx: 2,
      options: ['A', 'B', 'C', 'D'],
      ans: 'A',
    },
  }),
  mixins: [submitAnswer],
};
</script>
