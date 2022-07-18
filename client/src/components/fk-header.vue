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
  height: $header-height-sm;

  @include rwd-min(sm) {
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
    height: $header-height-sm;
    display: flex;
    justify-content: center;
    background-color: $white;
    border-bottom: solid 4px rgb(233, 163, 55);

    @include rwd-min(sm) {
      height: $header-height;
      justify-content: flex-end;
    }
  }

  &__logo-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 $spacing-2;
    border-radius: 10px;
    transition: 0.15s ease-in-out;

    @include rwd-min(md) {
      padding: 0 $spacing-4;
    }

    &:hover {
      background-color: $gray-1;
    }

    a,
    button {
      width: 100%;
      height: 100%;
    }

    a {
      display: flex;
      align-items: center;
      justify-content: center;
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
