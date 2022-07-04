<template lang="pug">
button.fk-btn-secd {{ text }}
</template>

<script>
export default {
  name: 'FkBtnSecondary',
  props: {
    text: {
      type: String,
      default: '',
    },
  },
};
</script>

<style lang="scss"></style>
