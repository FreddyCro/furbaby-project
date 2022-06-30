<template lang="pug">
.cq-start
  h2 Start
  fk-name-input
  router-link(to="/quiz/cat/1") next
</template>

<script>
import FkNameInput from '@/components/fk-name-input.vue';

export default {
  name: 'CqStart',
  components: {
    FkNameInput,
  },
  created() {
    this.$store.dispatch('setType', 'cat');
  },
};
</script>
