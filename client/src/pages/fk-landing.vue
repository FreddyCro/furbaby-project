<template lang="pug">
.fk-l
  //- intro section
  .fk-l-intro.fk-section
    fk-bg

    .fk-container
      //- TODO: Add a title here.
      h1.fk-l-intro__title {{ str.intro.title }}
      .fk-l-intro__hero
        .fk-l-intro__pic-wrapper
          img.fk-l-intro__pic(
            src="assets/img/landing/title.png"
            :alt="str.intro.title"
          )

        .fk-l-intro__video-wrapper
          video.fk-l-intro__video(
            autoplay
            loop
            type="video/mp4"
            muted
          )
            source(src="assets/vid/landing.mp4")

      a.fk-l-intro__scroll-down(href="#" v-scroll-to="'#start-quiz'")
        Mouse
        //- img(src="assets/img/landing/mouse.svg", alt="scroll down")

  //- start section
  #start-quiz.fk-l-start.fk-section
    .fk-l-start__bg
      .fk-l-start__bg-footprint-first
        img(
          src="assets/img/common/footprint_1.png"
          alt="background"
        )
    .fk-container
      .fk-l-start__frame
        .fk-l-start__frame-halo.fk-l-start__frame-halo--1
        .fk-l-start__frame-halo.fk-l-start__frame-halo--2
        .fk-l-start__frame-halo.fk-l-start__frame-halo--3
        .fk-l-start__frame-halo.fk-l-start__frame-halo--4

        .fk-l-start__frame-content.pure-g.reverse-sm
          .fk-l-start__frame-text-wrapper.pure-u-1-1.pure-u-sm-1-2
            h2.fk-l-start__title
              span {{ str.start.title }}
              span {{ str.start.subTitle }}
            p.fk-l-start__desc {{ str.start.desc }}

            .fk-l-start__enter-btn-container
              router-link(to="/quiz/dog")
                button.fk-btn-prim {{ str.start.dog }}
              router-link(to="/quiz/cat")
                button.fk-btn-prim {{ str.start.cat }}

          .fk-l-start__frame-img-wrapper.pure-u-1-1.pure-u-sm-1-2
            img.fk-l-start__frame-img(
              src="assets/img/landing/play.png"
              :alt="str.start.title"
            )

  //- suggestiton section
  .fk-l-suggest.fk-section
    .fk-l-suggest__decoration-container
      .fk-l-suggest__decoration.fk-l-suggest__footprint-second
        img(
          src="assets/img/common/footprint_2.png"
          alt="background"
        )
        
      //- eat dog illustration
      .fk-l-suggest__decoration.fk-l-suggest__eat-dog
        img(
          src="assets/img/landing/dog_eat.png"
          :alt="str.suggest.title"
        )
      
      //- cat board illustration 
      .fk-l-suggest__decoration.fk-l-suggest__cat-board
        img(
          src="assets/img/landing/cat_board.png"
          :alt="str.suggest.title"
        )

    .fk-container
      .fk-l-halo 
      .fk-l-suggest__principle
        .fk-l-suggest__title-wrapper
          .fk-l-suggest__avator
            img(
              src="assets/img/landing/suggestion_avator.png"
              :alt="str.suggest.title"
            )

          h2.fk-l-suggest__title {{ str.suggest.title }}

          img(
            src="assets/img/common/footprint_icon.png"
            :alt="str.suggest.title"
          )

        .fk-l-suggest__desc-wrapper
          p.fk-l-suggest__desc {{ str.suggest.desc }}

        .fk-l-suggest__share-btn-container
          a.fk-l-suggest__share-btn(:href="str.suggest.royalBtnUrl")
            button.fk-btn-prim {{ str.suggest.royalBtnText }}
          a.fk-l-suggest__share-btn(:href="str.suggest.lineBtnUrl")
            button.fk-btn-prim
              span
                img(src="assets/img/common/line_white.png", alt="share to line")
              span {{ str.suggest.lineBtnText }}
    
</template>

<script>
// import FkPic from '@/components/fk-pic.vue';
import FkBg from '@/components/fk-bg.vue';
import FkBtnPrimary from '@/components/fk-btn/fk-btn-primary.vue';
import str from '@/assets/json/landing.json';
import Mouse from '@/assets/img/mouse.svg';

export default {
  name: 'FkLanding',
  components: {
    Mouse,
    FkBg,
    FkBtnPrimary,
    // FkPic,
  },
  data: () => ({
    str,
  }),
};
</script>

<style lang="scss" scoped>

.fk-l-intro {
  position: relative;
  background-color: $white;

  /* @include rwd-min(md) {
    height: 800px;
  } */

  &__hero {
    position: relative;
    width: 100%;
    padding-bottom: 65%;
  }

  &__pic-wrapper {
    position: absolute;
    z-index: 2;
    left: 50%;
    top: 0;
    width: 80%;
    margin: 0 auto;
    transform: translateX(-50%);
  }

  &__video-wrapper {
    position: absolute;
    z-index: 1;
    left: 50%;
    bottom: 0;
    width: 100%;
    transform: translateX(-50%);
  }

  &__video {
    max-width: 100%;
    border-radius: 60px;
    box-shadow: 0 0 100px $white;
  }

  &__scroll-down {
    @include reset-btn;

    position: absolute;
    z-index: 1;
    bottom: 0;
    left: 50%;
    transition: all 0.3s ease-in-out;
    transform: translate(-50%, 50%);

    &:hover {
      transform: translate(-50%, 50%);
    }
  }

  &__title {
    display: none;
  }
}

.fk-l-start {
  position: relative;
  overflow: hidden;

  &__bg,
  &__bg-footprint-first {
    position: absolute;
    pointer-events: none;
  }

  &__bg {
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
  }

  &__bg-footprint-first {
    left: 0;
    top: 0;
  }

  &__frame,
  &__frame-content {
    border-bottom-left-radius: 40px;
  }

  &__frame {
    position: relative;
    padding: $spacing-5 $spacing-2 $spacing-2 $spacing-2;
    background-color: rgb(145, 145, 150);
  }

  &__frame-content {
    position: relative;
    z-index: 1;
    background-color: rgb(240, 240, 240);
  }

  &__title {
    color: rgb(230, 5, 5);
  }

  &__frame-img-wrapper {
    @include rwd-min(md) {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      transform: scale(1.1) translate(-$spacing-6, $spacing-8);
    }
  }

  &__frame-text-wrapper {
    padding: $spacing-6;
    text-align: center;

    @include rwd-min(md) {
      text-align: left;
    }
  }

  &__enter-btn-container {
    button {
      min-width: 240px;
      margin-bottom: $spacing-5;

      @include rwd-min(sm) {
        min-width: 320px;
        margin-bottom: $spacing-6;
      }
    }
  }

  &__frame-halo {
    position: absolute;
    width: 2000px;
    height: 2000px;
    border-radius: 50%;
    pointer-events: none;
    background: radial-gradient(
      rgba(255, 255, 255, 1),
      rgba(255, 255, 255, 0.3),
      rgba(255, 255, 255, 0.2),
      rgba(255, 255, 255, 0.1),
      rgba(255, 255, 255, 0),
      rgba(255, 255, 255, 0),
      rgba(255, 255, 255, 0),
      rgba(255, 255, 255, 0),
      rgba(255, 255, 255, 0),
      rgba(255, 255, 255, 0)
    );

    &--1 {
      left: 50%;
      top: 0;
      transform: translate(-50%, -50%);
    }

    &--2 {
      left: 0;
      bottom: 0;
      transform: translate(-50%, 50%);
    }

    &--3 {
      right: -50px;
      top: -50px;
      transform: translate(50%, -50%);
    }

    &--4 {
      right: 25%;
      bottom: 0;
      transform: translate(50%, 50%);
    }
  }
}

.fk-l-suggest {
  position: relative;
  background-color: $white;
  background-image: url('~@/assets/img/landing/bg_brick.png');
  background-size: contain;
  background-repeat: round;
  padding-bottom: 360px;

  &__principle {
    position: relative;
  }

  &__title-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  &__title {
    margin: $spacing-6;
    color: rgb(230, 5, 5);
  }

  &__avatar {
    position: relative;
    width: 100%;
    margin-bottom: $spacing-6;
  }

  &__desc-wrapper {
    max-width: 260px;
    margin: 0 auto;
    text-align: center;
  }

  &__share-btn-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: $spacing-9;

    @include rwd-min(sm) {
      flex-direction: row;
    }
  }

  &__share-btn {
    margin-bottom: $spacing-5;

    @include rwd-min(sm) {
      margin: 0 $spacing-6;
    }

    button {
      min-width: 240px;
    }

    img {
      height: 1rem;
      margin-right: $spacing-2;
    }
  }

  &__decoration {
    position: absolute;
    pointer-events: none;
  }

  &__footprint-second {
    right: 0;
    top: 0;
    transform: translateY(-50%);
  }

  &__eat-dog {
    left: 0;
    bottom: 0;
    width: 36vw;

    @include rwd-min(sm) {
      left: 10%;
      width: 25vw;
    }

    @include rwd-min(md) {
      left: 10%;
      width: 260px;
    }
  }

  &__cat-board {
    right: 0;
    bottom: 0;
    width: 56vw;

    @include rwd-min(sm) {
      width: 30vw;
    }

    @include rwd-min(md) {
      right: 5%;
      width: 360px;
    }

    /* img {
      height: 750px;
    } */
  }
}
</style>
