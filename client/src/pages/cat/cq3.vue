<template lang="pug">
.fk-cat-q3
  h1 Cat Q3
  .q Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, commodi saepe possimus qui obcaecati sit veritatis quibusdam magnam corrupti, temporibus impedit delectus nam expedita similique, perspiciatis cum cumque tempore voluptates?

  .ans
    button(
      v-for="item in question.options"
      :key="item.idx"
      @click="submitAnswer(item, type)"
    ) {{ item }}

  .next
    router-link(to="/result") Result

</template>

<script>
import { submitAnswer } from '@/assets/js/mixins';

export default {
  name: 'CatQ3',
  data: () => ({
    type: 'cat',
    question: {
      idx: 3,
      options: ['A', 'B', 'C', 'D'],
      ans: 'A',
    },
  }),
  mixins: [submitAnswer],
};
</script>
