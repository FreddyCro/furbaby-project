<template lang="pug">
button.fk-btn-prim(:class="{ [className]: className }") {{ text }} >
</template>

<script>
export default {
  name: 'FkBtnPrimary',
  props: {
    className: {
      type: String,
      default: '',
    },
    text: {
      type: String,
      default: '',
    },
  },
};
</script>

<style lang="scss">
.fk-btn-prim {
  @include reset-btn;

  padding: $spacing-4 $spacing-5;
  color: $white;
  border-top-right-radius: 20px;
  border-bottom-right-radius: 20px;
  border-bottom-left-radius: 20px;
  background-color: rgb(238, 29, 35);
  box-shadow: 0px $spacing-2 0px 0px rgb(210, 0, 3);
}
</style>
