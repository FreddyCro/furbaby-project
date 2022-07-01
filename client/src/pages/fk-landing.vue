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

const str = {
  intro: {
    title: '毛寵達人大會考',
  },
  start: {
    title: '你有自信成為皇家級的飼主嗎？',
    desc: '軟萌的幼貓、幼犬惹人憐愛，需要特殊營養為體質打底，隨著牠一天天成長，正確的轉糧與飼主照護觀念更為重要，找朋友一起挑戰你的毛寵達人級數吧！',
    dog: '我是狗主人 GO',
    cat: '我是貓主人 GO',
  },
  suggest: {
    title: '好飼主必知守則',
    desc: '守護愛犬、愛貓的健康成長，除了飼主的細心觀察、照護，遵循獸醫師的專業建議，打造最適合牠們成長的環境。',
    royalBtnText: '了解更多寵養攻略',
    royalBtnUrl: '#',
    lineBtnText: '寵養新知不漏接',
    lineBtnUrl: '#',
  },
};

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
  background-color: lightblue;

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
  background-color: lightgreen;

  &__enter-btn {
    display: block;
    padding: $spacing-3;
    border: solid 1px #000;
  }
}

.fk-l-suggest {
  /* @include bg-2x('/img/faker_bg', 'jpg'); */
  background-color: lightpink;
}
</style>
