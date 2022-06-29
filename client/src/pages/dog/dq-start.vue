<template lang="pug">
.dg-start
  h2 Start
  fk-name-input
  router-link(to="/quiz/dog/1") next
</template>

<script>
import FkNameInput from '@/components/fk-name-input.vue';

export default {
  name: 'DgStart',
  components: {
    FkNameInput,
  },
};
</script>
