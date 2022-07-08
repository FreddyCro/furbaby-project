<template lang="pug">
header.fk-header
  .fk-header__navigator-wrapper
    .fk-header__navigator
      .fk-header__logo-wrapper
        router-link(to="/")
          button.fk-header__logo(@click="reset")
            fk-pic(
              src="/assets/img/header/title.png"
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
      // reset all data
      this.$store.dispatch('resetState');
    },
  },
};
</script>

<style lang="scss">
.fk-header {
  height: $header-height;

  &__navigator-wrapper {
    position: fixed;
    z-index: 200;
    top: 0;
    left: 0;
    width: 100%;

    &::before {
      content: '';
      position: absolute;
      z-index: -1;
      bottom: -4px;
      left: 0;
      width: 100%;
      height: 8px;
      background: linear-gradient(to bottom, rgb(0, 0, 0, 0.3), transparent);
    }
  }

  &__navigator {
    height: $header-height;
    display: flex;
    justify-content: flex-end;
    background-color: $white;
    border-bottom: solid 4px rgb(233, 163, 55);
  }

  &__logo-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: $spacing-4;
  }

  &__logo {
    @include reset-btn;
  }
}
</style>
