<template lang="pug">
.fk-start.fk-page
  .fk-container
    fk-ans-start(
      :title="str.title"
      :desc="str.desc"
      cate="dog"
    )
</template>

<script>
import FkAnsStart from '@/components/fk-ans/fk-ans-start.vue';
import str from '@/assets/json/quiz-dog.json';

export default {
  name: 'DgStart',
  components: {
    FkAnsStart,
  },
  data: ()=>({
    str: str.start,
  }),
};
</script>

<style lang="scss" scoped>
.fk-start {
  .fk-container {
    max-width: 600px;
  }
}
</style>
