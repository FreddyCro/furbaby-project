<template lang="pug">
.fk-cat-q1
  h1 Cat Q1
  .q Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit magnam, molestias exercitationem eius numquam, sunt velit beatae earum placeat corrupti nam laborum maxime aliquid. Officia reiciendis sed itaque deleniti voluptatem.

  .ans
    button(
      v-for="item in question.options"
      :key="item.idx"
      @click="submitAnswer(item, type)"
    ) {{ item }}

  .next
    router-link(to="/quiz/cat/2") Next

</template>

<script>
import { submitAnswer } from '@/assets/js/mixins';

export default {
  name: 'CatQ1',
  data: () => ({
    type: 'cat',
    question: {
      idx: 1,
      options: ['A', 'B', 'C', 'D'],
      ans: 'A',
    },
  }),
  mixins: [submitAnswer],
  methods: {},
  created() {
    console.log(process.env.VUE_APP_API_ROOT);
  },
};
</script>
