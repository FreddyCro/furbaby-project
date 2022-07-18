<template lang="pug">
.fk-bg
  .fk-bg__floor
  .fk-bg__furniture
  .fk-bg__halo
    fk-halo
</template>

<script>
import FkHalo from '@/components/fk-halo.vue';

export default {
  name: 'FkBg',
  components: {
    FkHalo,
  },
};
</script>

<style lang="scss">
.fk-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;

  &__floor,
  &__furniture {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
  }

  &__floor {
    background-image: url('~@/assets/img/common/bg_merge.png');
    background-size: cover;
    background-position: center bottom;
  }
}
</style>
