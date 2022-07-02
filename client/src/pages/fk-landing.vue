<template lang="pug">
.fk-l
  .fk-l-intro.fk-section
    .fk-container
      h1 {{ str.intro.title }}
      fk-pic(
        src="/img/faker_lg.jpg"
        :alt="str.intro.title"
      )

      button.fk-l-intro__scroll-down
        fk-pic(
          src="/img/faker_icon.jpg"
          alt="scroll down"
        )
  .fk-l-start.fk-section
    .fk-container
      h2 {{ str.start.title }}
      p {{ str.start.desc }}

      fk-pic(
        src="/img/faker_md.jpg"
        :alt="str.start.title"
      )

      .fk-l-start__enter-btn-container
        router-link(to="/quiz/dog")
          .fk-l-start__enter-btn {{ str.start.dog }}
        router-link(to="/quiz/cat")
          .fk-l-start__enter-btn {{ str.start.cat }}
  .fk-l-suggest.fk-section
    .fk-container
      fk-pic(
        src="/img/faker_avator.jpg"
        :alt="str.suggest.title"
      )

      h2 {{ str.suggest.title }}
      p {{ str.suggest.desc }}

      
      fk-pic(
        src="/img/faker_md.jpg"
        :alt="str.suggest.title"
      )
      
      fk-pic(
        src="/img/faker_sm.jpg"
        :alt="str.suggest.title"
      )

      .fk-l-suggest__share
        a(:href="str.suggest.royalBtnUrl")
          fk-btn-primary(:text="str.suggest.royalBtnText")

        a(:href="str.suggest.lineBtnUrl")
          fk-btn-primary(:text="str.suggest.lineBtnText")

  fk-footer
  
</template>

<script>
import FkPic from '@/components/fk-pic.vue';
import FkBtnPrimary from '@/components/fk-btn/fk-btn-primary.vue';
import FkFooter from '@/components/fk-footer.vue';
import str from '@/assets/json/landing.json';

export default {
  name: 'FkLanding',
  components: {
    FkPic,
    FkBtnPrimary,
    FkFooter,
  },
  data: () => ({
    str,
  }),
};
</script>

<style lang="scss" scoped>
.fk-l-intro {
  /* @include bg-2x('/img/faker_bg', 'jpg'); */
  position: relative;
  background-color: $gray-2;

  &__scroll-down {
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 64px;
    height: 64px;
    transition: all 0.3s ease-in-out;
    transform: translate(-50%, 50%);

    &:hover {
      transform: translate(-50%, 50%);
    }
  }
}

.fk-l-start {
  /* @include bg-2x('/img/faker_bg', 'jpg'); */
  background-color: $gray-3;

  &__enter-btn {
    display: block;
    padding: $spacing-3;
    border: solid 1px #000;
  }
}

.fk-l-suggest {
  /* @include bg-2x('/img/faker_bg', 'jpg'); */
  background-color: $gray-4;
}
</style>
