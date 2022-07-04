<template lang="pug">
.fk-ans-submit(v-if="hasSelect")
  button(v-if="!hasSubmitted" @click="submitAnswer(cate, idx)") Look Answer

  .fk-ans-submit__correct-result(v-else)
    slot
</template>

<script>
export default {
  name: 'FkAnsSubmit',
  props: {
    idx: {
      type: Number,
      required: true
    },
    hasSelect: {
      type: Boolean,
      required: true,
    },
    hasSubmitted: {
      type: Boolean,
      required: true,
    },
    submitAnswer: {
      type: Function,
      required: true,
    },
    cate: {
      type: String,
      required: true,
    },
    isLast: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {};
  },
};
</script>

<style lang="scss"></style>
