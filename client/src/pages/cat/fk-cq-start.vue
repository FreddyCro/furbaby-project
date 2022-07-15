<template lang="pug">
.fk-start.fk-page
  .fk-container
    fk-ans-start(
      :title="str.title"
      :desc="str.desc"
      cate="cat"
    )
</template>

<script>
import FkAnsStart from '@/components/fk-ans/fk-ans-start.vue';
import str from '@/assets/json/start.json';

export default {
  name: 'CqStart',
  components: {
    FkAnsStart,
  },
  data: () => ({
    str,
  }),
};
</script>

<style lang="scss" scoped>
</style>
