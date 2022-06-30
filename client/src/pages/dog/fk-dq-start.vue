<template lang="pug">
.dg-start
  h2 Start
  fk-name-input(cate="dog")
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
