<template lang="pug">
.fk-ans-correct
  .pure-g.autopad-3
    div(:class="{'pure-u-1-1 pure-u-sm-5-8': illustration}")
      .fk-ans-correct__question
        .fk-ans-correct__question-title
          span.fk-ans-correct__question-title-footprint
            footprint-cat(v-if="cate === 'cat'")
            footprint-dog(v-if="cate === 'dog'")
          span
            span {{ question }}
            span.is-my-ans-correct {{ isMyAnsCorrect ? str.myAnsIsCorrect : str.myAnsIsIncorrect }}

        .fk-ans-correct__question-ans
          slot(name="ans")
        
        .fk-ans-correct__suggest
          slot(name="suggest")

    .pure-u-1-1.pure-u-sm-3-8(v-if="illustration")
      .fk-ans-correct__illus
        video(
          v-if="useVideo"
          playsinline
          autoplay
          loop
          type="video/mp4"
          muted
        )
          source(src="assets/vid/dog5.mp4")
        img(
          v-else
          :src="illustration"
          :alt="question"
        )
</template>

<script>
import str from '@/assets/json/quiz.json';

import FootprintCat from '@/assets/img/quiz/cat/footprint_cat_red.svg';
import FootprintDog from '@/assets/img/quiz/dog/footprint_dog_red.svg';

export default {
  name: 'FkAnsCorrect',
  components: {
    FootprintCat,
    FootprintDog,
  },
  props: {
    question: {
      type: String,
    },
    isMyAnsCorrect: {
      type: Boolean,
      default: false,
    },
    cate: {
      type: String,
      required: true,
    },
    useVideo: {
      type: Boolean,
      default: false,
    },
    illustration: {
      type: String,
    },
  },
  data() {
    return {
      str,
    };
  },
};
</script>

<style lang="scss">
.fk-ans-correct {
  display: flex;
  width: 100%;
  margin-bottom: $spacing-7;

  &__question {
    display: flex;
    flex-direction: column;
  }

  &__question-title {
    display: flex;
    margin-bottom: 20px;
    padding-bottom: $spacing-1;
    border-bottom: solid 1px $gray-4;
    color: $color-primary;
    font-size: 1.5rem;
  }

  .is-my-ans-correct {
    display: block;
    color: $gray-160;
    font-weight: 700;
    font-size: larger;
    line-height: 2;
  }

  &__question-title-footprint {
    width: 32px;
    height: 32px;
    margin-right: $spacing-3;
  }

  &__question-ans {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;

    @include rwd-min(sm) {
      justify-content: flex-start;
    }
  }

  &__suggest {
    line-height: 1.67;
  }

  &__illus {
    display: flex;
    justify-content: center;
    align-items: center;

    video {
      max-width: 100%;
    }

    @include rwd-min(md) {
      padding-left: $spacing-4;
    }
  }
}
</style>
