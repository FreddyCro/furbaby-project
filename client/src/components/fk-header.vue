<template lang="pug">
header.fk-header
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
      this.$store.dispatch('reset');
    },
  },
};
</script>

<style lang="scss">
.fk-header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  display: flex;
  justify-content: flex-end;
  background-color: lightyellow;
}
</style>
