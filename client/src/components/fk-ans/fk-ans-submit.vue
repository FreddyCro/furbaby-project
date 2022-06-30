<template lang="pug">
.fk-ans-submit(v-if="hasSelect")
  button(@click="submitAnswer(cate)") Look Answer

  .fk-ans-submit__correct-result(v-if="hasSubmitted")
    slot
</template>

<script>
export default {
  name: 'FkAnsSubmit',
  props: {
    question: {
      type: Object,
      required: true,
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
  methods: {},
  created() {},
};
</script>

<style lang="scss"></style>
