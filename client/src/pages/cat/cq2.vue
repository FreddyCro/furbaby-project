<template lang="pug">
.fk-cat-q2
  h1 Cat Q2
  .q Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est provident debitis aspernatur, nostrum, molestiae natus esse quam eum accusamus cum error laudantium. Veritatis, et hic ullam officiis nulla voluptatum magnam?

  .ans
    button(v-for="item in getQuestion()(config).options" :key="item.id") {{ item }}

  .next
    router-link(to="/quiz/cat/3") Next

</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'CatQ2',
  data: () => ({
    config: {
      type: 'cat',
      idx: 2,
    },
  }),
  methods: {
    ...mapGetters({
      getQuestion: 'getQuestion',
    }),
  },
};
</script>
