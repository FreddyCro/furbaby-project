<template lang="pug">
.fk-dog-q3
  h3 Q{{ question.idx }} - {{ str.title }}
  .q {{ str.question}}

  .ans(v-if="!hasSubmitted")
    button(
      v-for="item in question.options"
      :key="item.idx"
      @click="submitAnswer(item, type)"
    ) {{ str.ans[item] }}

  .next
    router-link(to="/result") result

</template>

<script>
import { submitAnswer } from '@/assets/js/mixins';

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
    type: 'dog',
    question: {
      idx: 3,
      options: [1, 2, 3, 4],
      ans: 1,
    },
  }),
  mixins: [submitAnswer],
  methods: {},
  created() {
    console.log(process.env.VUE_APP_API_ROOT);
  },
};
</script>
