<template lang="pug">
header.fk-header
  .fk-header__navigator-wrapper
    .fk-header__navigator
      .fk-header__logo-wrapper
        router-link(to="/")
          button.fk-header__logo(@click="reset")
            img(
              src="assets/img/header/title.png"
              alt="Furkid Master"
          )
</template>

<script>
export default {
  name: 'FkHeader',
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
  @include rwd-min(md) {
    height: $header-height;
  }

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
    padding: 0 $spacing-2;
    border-radius: 10px;
    transition: .15s ease-in-out;

    @include rwd-min(md) {
      padding: 0 $spacing-4;
    }

    &:hover {
      background-color: $gray-1;
    }
  }

  &__logo {
    @include reset-btn;

    img {
      max-width: 240px;
    }
  }
}
</style>
