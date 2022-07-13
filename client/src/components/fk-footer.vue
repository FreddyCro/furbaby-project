<template lang="pug">
.fk-footer
  .fk-u-container
    .fk-footer__logo-container
      .fk-footer__logo-wrapper(:href="str.dotcom.url")
        a.fk-footer__logo
          img(
            src="assets/img/footer/udn_logo.png"
            :alt="str.dotcom.name"
          )
      
      .fk-footer__logo-wrapper(:href="str.orange.url")
        a.fk-footer__logo
          img(
            src="assets/img/footer/orange_logo.png"
            :alt="str.orange.name"
          )
        
      .fk-footer__logo-wrapper(:href="str.royal.url")
        a.fk-footer__logo
          img(
            src="assets/img/footer/royal_logo.png"
            :alt="str.royal.name"
          )
      
  img(
    src="assets/img/footer/orange_ribbon.png"
    :alt="str.royal.name"
  )
</template>

<script>
const str = {
  dotcom: { name: 'udn.com', url: '#' },
  orange: { name: 'Orange', url: '#' },
  royal: { name: 'Royal Canin', url: '#' },
};

export default {
  name: 'FkFooter',
  data() {
    return {
      str,
    };
  },
};
</script>

<style lang="scss">
.fk-footer {
  background-color: $white;

  &__logo-container {
    height: 112px;
    display: flex;
    justify-content: center;
    align-items: center;

    @include rwd-min(sm) {
      max-width: 80%;
      margin: 0 auto;
    }
  }

  &__logo-wrapper {
    height: 56px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 $spacing-3;
    border-right: #000 1px solid;

    &:last-child {
      border-right: 0;
    }

    @include rwd-min(sm) {
      padding: 0 $spacing-6;
    }

    @include rwd-min(md) {
      padding: 0 56px;
    }
  }

  &__logo {
    transition: 0.15s ease-in-out;
    cursor: pointer;

    &:hover {
      transform: translateY(-$spacing-1);
    }
  }
}
</style>
