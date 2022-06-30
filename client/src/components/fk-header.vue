<template lang="pug">
header.fk-header
  router-link(to="/") back to home
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
};
</script>

<style lang="scss">
.fk-header {
  display: flex;
  justify-content: flex-end;
}
</style>
