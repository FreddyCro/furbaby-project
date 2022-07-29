<template lang="pug">
.fk-footer
  .fk-container
    .fk-footer__logo-container
      .fk-footer__logo-wrapper
        a.fk-footer__logo(:href="str.dotcom.url", target="_blank", rel="noopener noreferrer")
          img(
            src="assets/img/footer/udn_logo.png"
            :alt="str.dotcom.name"
          )
      
      .fk-footer__logo-wrapper
        a.fk-footer__logo(:href="str.orange.url", target="_blank", rel="noopener noreferrer")
          img(
            src="assets/img/footer/orange_logo.png"
            :alt="str.orange.name"
          )
        
      .fk-footer__logo-wrapper
        a.fk-footer__logo(:href="str.royal.url", target="_blank", rel="noopener noreferrer")
          img(
            src="assets/img/footer/royal_logo.png"
            :alt="str.royal.name"
          )
      
  img(
    class="full-vw"
    src="assets/img/footer/orange_ribbon.png"
    :alt="str.royal.name"
  )
</template>

<script>
const str = {
  dotcom: { name: 'udn.com', url: 'https://udn.com/news/index' },
  orange: { name: 'Orange', url: 'https://orange.udn.com/orange/index' },
  royal: { name: 'Royal Canin', url: 'https://www.royalcanin.com/tw' },
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
    display: flex;
    justify-content: center;
    align-items: center;
    padding: $spacing-1 0;

    @media screen and (min-width: 576px) {
      min-height: 72px;
    }

    @include rwd-min(sm) {
      max-width: 80%;
      margin: 0 auto;
    }
  }

  &__logo-wrapper {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 $spacing-5;

    &::before {
      content: '';
      position: absolute;
      top: 50%;
      right: 0;
      height: 36px;
      border-right: #000 1px solid;
      transform: translate(0, -50%);
    }

    &:last-child {
      &::before {
        border: 0;
      }
    }

    @include rwd-max(xs) {
      max-width: 160px;
    }

    @include rwd-min(sm) {
      height: 40px;
      padding: 0 $spacing-6;
    }

    @include rwd-min(md) {
      padding: 0 48px;
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
