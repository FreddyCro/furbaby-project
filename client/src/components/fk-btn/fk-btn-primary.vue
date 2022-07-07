<template lang="pug">
button.fk-btn-prim {{ text }}
</template>

<script>
export default {
  name: 'FkBtnPrimary',
  props: {
    text: {
      type: String,
      default: '',
    },
  },
};
</script>

<style lang="scss">
.fk-btn-prim {
  
}
</style>
