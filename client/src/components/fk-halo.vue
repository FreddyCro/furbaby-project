<template lang="pug">
.fk-halo-wrapper
  .fk-halo
</template>

<script>
export default {
  name: 'FkHalo',
};
</script>

<style lang="scss">
.fk-halo-wrapper {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  pointer-events: none;
}

.fk-halo {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 200%;
  height: 100%;
  background: radial-gradient(
    rgba(255, 255, 255, 1),
    rgba(255, 255, 255, 1),
    rgba(255, 255, 255, 1),
    rgba(255, 255, 255, 0),
    rgba(255, 255, 255, 0),
    rgba(255, 255, 255, 0),
    rgba(255, 255, 255, 0)
  );
  transform: translate(-50%, -50%);
  pointer-events: none;

  @include rwd-min(sm) {
    width: 180%;
    height: 180%;
  }

  @include rwd-min(md) {
    width: 125%;
    height: 125%;
  }
}
</style>
