<template lang="pug">
.fk-cat-q3
  h1 Cat Q3
  .q Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, commodi saepe possimus qui obcaecati sit veritatis quibusdam magnam corrupti, temporibus impedit delectus nam expedita similique, perspiciatis cum cumque tempore voluptates?

  .ans
    button(v-for="item in getQuestion()(config).options" :key="item.id") {{ item }}

  .next
    router-link(to="/result") Result

</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'CatQ3',
  data: () => ({
    config: {
      type: 'cat',
      idx: 3,
    },
  }),
  methods: {
    ...mapGetters({
      getQuestion: 'getQuestion',
    }),
  },
};
</script>
