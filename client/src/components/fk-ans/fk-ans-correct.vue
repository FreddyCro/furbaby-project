<template lang="pug">
.fk-ans-correct
  .fk-ans-correct__question {{ question }}
  .fk-ans-correct__ans
    slot
  .fk-ans-correct__illus
    fk-pic(
      :src="illustration"
      :alt="question"
    )
</template>

<script>
import FkPic from '@/components/fk-pic.vue';

export default {
  name: 'FkAnsCorrect',
  components: {
    FkPic,
  },
  props: {
    question: {
      type: String,
    },
    illustration: {
      type: String,
    },
  }
};
</script>

<style lang="scss"></style>
