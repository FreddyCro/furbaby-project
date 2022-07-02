<template lang="pug">
header.fk-header
  .fk-header-navigator
    button(@click="reset")
      span logo
      fk-pic(
        src="/img/faker_icon.jpg"
        alt="Furkid Master"
      )
</template>

<script>
import FkPic from '@/components/fk-pic.vue';

export default {
  name: 'FkHeader',
  components: {
    FkPic,
  },
  methods: {
    reset() {
      // back to home
      this.$router.push('/');

      // reset all data
      this.$store.dispatch('resetState');
    },
  },
};
</script>

<style lang="scss">

.fk-header {
  height: $header-height;

  .fk-header-navigator {
    position: fixed;
    z-index: 200;
    top: 0;
    left: 0;
    width: 100%;
    height: $header-height;
    display: flex;
    justify-content: flex-end;
    background-color: $gray-1;
  }
}
</style>
