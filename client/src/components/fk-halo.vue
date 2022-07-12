<template lang="pug">
.fk-halo
</template>

<script>
export default {
  name: 'FkHalo',
};
</script>

<style lang="scss">
.fk-halo {
  position: absolute;
  top: 20%;
  left: 0;
  width: 100%;
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
  pointer-events: none;
}
</style>
