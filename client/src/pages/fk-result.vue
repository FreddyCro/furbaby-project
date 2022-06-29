<template lang="pug">
.fk-result
  h1 Result
  p your point: {{ getScore() }}
  p your ranking: {{ result.ranking }}
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'Result',
  data: () => ({
    result: {
      point: 0,
      ranking: 0,
    },
  }),
  methods: {
    ...mapGetters({
      getScore: 'getScore',
    }),
  },

  created() {
    // TODO: get result from vuex
    // TODO: get ranking from server
  },
};
</script>
