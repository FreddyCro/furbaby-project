<template lang="pug">
.fk-result
  h1 Result
  p your point: {{ result.point }}
  p your ranking: {{ result.ranking }}
</template>

<script>
export default {
  name: 'Result',
  data: () => ({
    result: {
      point: 0,
      ranking: 0,
    },
  }),
  created() {
    // TODO: get result from vuex
    // TODO: get ranking from server
  },
};
</script>
