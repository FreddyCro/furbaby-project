<template lang="pug">
.fk-l
  //- intro section
  .fk-l-intro
    fk-bg

    .fk-l-intro__hero-wrapper
      .fk-container
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
              playsinline
              loop
              type="video/mp4"
              muted
            )
              source(src="assets/vid/landing.webm")
              source(src="assets/vid/landing.mp4")
  .fk-l-mouse
    a.fk-l-mouse__scroll-down(href="#" v-scroll-to="'#start-quiz'")
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
              span.main(v-html="str.start.title")
              span.sub(v-html="str.start.subTitle")
            p.fk-l-start__desc(v-html="str.start.desc")

            .fk-l-start__enter-btn-container
              router-link(to="/quiz/dog")
                button.fk-btn-prim
                  span {{ str.start.dog }}
                  span.btn-arrow
              router-link(to="/quiz/cat")
                button.fk-btn-prim
                  span {{ str.start.cat }}
                  span.btn-arrow

          .fk-l-start__frame-img-wrapper.pure-u-1-1.pure-u-sm-1-2
            img.fk-l-start__frame-img(
              src="assets/img/landing/play.png"
              :alt="str.start.title"
            )
    
    .fk-l-start__mouse
      a.fk-l-mouse__scroll-down(href="#" v-scroll-to="'#suggestion'")
        Mouse
        
  //- suggestiton section
  #suggestion.fk-l-suggest.fk-section
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
          .fk-l-suggest__avator-wrapper
            .fk-l-suggest__avator
              img(
                src="assets/img/landing/suggestion_avator.png"
                :alt="str.suggest.title"
              )

          h2.fk-l-suggest__title {{ str.suggest.title }}

          img.fk-l-suggest__footprint(
            src="assets/img/common/footprint_icon.png"
            :alt="str.suggest.title"
          )

        .fk-l-suggest__desc-wrapper
          p.fk-l-suggest__desc(v-html="str.suggest.desc")

        .fk-l-suggest__share-btn-container
          a.fk-l-suggest__share-btn(
            :href="str.suggest.royalBtnUrl",
            target="_blank",
            rel="noopener noreferrer"
          )
            button.fk-btn-prim
              span {{ str.suggest.royalBtnText }}
              span.btn-arrow
          a.fk-l-suggest__share-btn(
            :href="str.suggest.lineBtnUrl",
            target="_blank",
            rel="noopener noreferrer"
          )
            button.fk-btn-prim
              img(src="assets/img/common/line_white.png", alt="share to line")
              span {{ str.suggest.lineBtnText }}
              span.btn-arrow
    
</template>

<script>
// import FkPic from '@/components/fk-pic.vue';
import FkBg from '@/components/fk-bg.vue';
import str from '@/assets/json/landing.json';
import Mouse from '@/assets/img/mouse.svg';

export default {
  name: 'FkLanding',
  components: {
    Mouse,
    FkBg,
    // FkPic,
  },
  data: () => ({
    str,
  }),
};
</script>

<style lang="scss" scoped>
.fk-l {
  overflow: hidden;
}

.fk-l-intro {
  position: relative;
  min-height: 65vh;
  display: flex;
  align-items: flex-end;
  padding:  0 0 $spacing-8 0;
  box-sizing: border-box;
  background-color: $white;

  @include rwd-min(sm) {
    min-height: 80vh;
    align-items: center;
    padding: $spacing-6 0;
  }

  @include rwd-min(md) {
    padding: $spacing-8 0;
  }

  &__hero-wrapper {
    width: 100%;
  }

  &__hero {
    position: relative;
    width: 100%;
    padding-bottom: 65%;

    @include rwd-max(xs) {
      transform: scale(1.25);
      transform-origin: center;
    }
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

  &__title {
    display: none;
  }
}

.fk-l-mouse {
  position: relative;

  @include rwd-max(xs) {
    height: 10vh;
  }

  &__scroll-down {
    @include reset-btn;

    position: absolute;
    z-index: 1;
    bottom: 0;
    left: 50%;
    border-radius: 10px;
    transition: all 0.3s ease-in-out;
    transform: translate(-50%, 50%);

    &:hover {
      background-color: rgba($color: $gray-1, $alpha: 0.5);
      transform: translate(-50%, 50%);
    }

    svg {
      transform: scale(0.75);
    }
  }
}

.fk-l-start {
  position: relative;

  @include rwd-max(xs) {
    padding-bottom: 172px;
  }

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
    .main {
      color: $color-primary;
      font-size: 32px;
      line-height: 1.67;
      display: block;

      @include rwd-min(md) {
        font-size: 36px;
      }
    }

    .sub {
      font-size: 24px;
      font-weight: 500;
      color: lighten($color: $color-primary, $amount: 15%);

      @include rwd-min(md) {
        font-size: 32px;
      }
    }
  }

  &__desc {
    line-height: 1.5;
  }

  &__frame-img-wrapper {
    padding-bottom: $spacing-10;

    @include rwd-min(sm) {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      padding-bottom: 0;
      transform: scale(1.1) translate(-$spacing-6, $spacing-9);
    }
  }

  &__frame-img {
    @include rwd-max(xs) {
      position: absolute;
      left: 50%;
      bottom: 0;
      width: 272px;
      transform: translate(-50%, 50%);
    }
  }

  &__frame-text-wrapper {
    padding: $spacing-4 $spacing-6;
    text-align: left;

    @include rwd-min(md) {
      padding: $spacing-6;
    }
  }

  &__enter-btn-container {
    margin-top: $spacing-6;
    text-align: center;

    @include rwd-min(sm) {
      text-align: left;
    }

    @include rwd-min(md) {
      margin-top: $spacing-7;
    }

    button {
      min-width: 240px;
      margin-bottom: $spacing-5;
      font-weight: 600;

      @include rwd-min(md) {
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

  &__mouse {
    position: absolute;
    left: 50%;
    bottom: 0;
  }
}

.fk-l-suggest {
  position: relative;
  background-color: $white;
  background-image: url('~@/assets/img/landing/bg_brick.png');
  background-repeat: round;
  padding-bottom: 280px;
  overflow: hidden;

  @include rwd-min(sm) {
    background-size: contain;
    padding-bottom: 400px;
  }

  @include rwd-min(md) {
    padding-bottom: 360px;
  }

  &__principle {
    position: relative;
  }

  &__title-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: $spacing-2;

    @include rwd-min(md) {
      margin-right: $spacing-7;
    }
  }

  &__title {
    margin: 0 $spacing-3 0 $spacing-3;
    font-size: 32px;
    font-weight: 500;
    color: rgb(230, 5, 5);

    @include rwd-min(md) {
      margin: 0 $spacing-4 0 $spacing-4;
      font-size: 36px;
    }
  }

  &__avator-wrapper {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border-style: solid;
    border-color: $color-primary;
    border-width: 4px;

    @include rwd-min(sm) {
      width: 60px;
      height: 60px;
    }

    @include rwd-min(md) {
      width: 100px;
      height: 100px;
      border-width: 8px;
    }
  }

  &__avator {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: flex-end;
    align-items: flex-end;
    background-color: $white;
    border-radius: 50%;
    transform: translate(-2px, 2px);

    img {
      width: 135px;
      margin-right: $spacing-2;
      max-width: none;
    }

    @include rwd-min(md) {
      transform: translate(-$spacing-1, $spacing-1);

      img {
        width: 135px;
        margin-right: $spacing-4;
        max-width: none;
      }
    }
  }

  &__footprint {
    height: 1.5rem;
  }

  &__desc-wrapper {
    max-width: 280px;
    margin: 0 auto;
    text-align: center;
    line-height: 1.5;
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
      left: 15%;
      width: 260px;
    }
  }

  &__cat-board {
    right: 0;
    bottom: 0;
    width: 56vw;
    transform: translateY(136px);

    @include rwd-min(sm) {
      right: 5%;
      width: 30vw;
      transform: translateY(36px);
    }

    @include rwd-min(md) {
      width: 360px;
      transform: none;
    }

    @include rwd-min(xl) {
      right: 12.5%;
    }

    /* img {
      height: 750px;
    } */
  }
}
.btn-arrow {
  display: inline-block;
  border-style: solid;
  border-width: 2px;
  border-color: $white $white transparent transparent;
  width: 0.75rem;
  height: 0.75rem;
  margin-left: $spacing-2;
  transform: rotate(45deg);
}
</style>
