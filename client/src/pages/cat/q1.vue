<template lang="pug">
.fk-cat-q1
  h1 Cat Q1
  .q Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit magnam, molestias exercitationem eius numquam, sunt velit beatae earum placeat corrupti nam laborum maxime aliquid. Officia reiciendis sed itaque deleniti voluptatem.

  .ans
    button(v-for="item in getQuestion()(config).options" :key="item.id") {{ item }}

  .next
    router-link(to="/exam/cat/2") Next

</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'CatQ1',
  data: () => ({
    config: {
      type: 'cat',
      idx: 1,
    },
  }),
  methods: {
    ...mapGetters({
      getQuestion: 'getQuestion',
    }),
  },
  created() {
    console.log(process.env.VUE_APP_API_ROOT);
  },
};
</script>
