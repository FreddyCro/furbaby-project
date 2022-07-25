<template lang="pug">
.fk-cq5
  fk-ans(
    :idx="+data.idx"
    :title="data.title"
    questionType="drag"
    :has-select="hasSelect"
    :has-submitted="hasSubmitted"
    :submit-answer="submitAnswer"
    :cate="cate"
  )
    template(#my-ans)
      .fk-cq5-months
        span.digit {{ inputValue }}
        span.text 個月
      .fk-cq5-slider-wrapper
        .fk-cq5-slider
          img.cat-img(src="assets/img/quiz/cat/5/small_cat.png", alt="small cat")
          .fk-cq5-slider__range-input-wrapper
            .fk-cq5-slider__range-input-index(:style="rangeInputTooltipsStyle")
              span {{ inputValue }}

            .fk-cq5-slider__range-input-tooltips(
              v-if="myAns === undefined"
              :style="rangeInputTooltipsStyle"
            )
              span.gesture
                img(src="assets/img/quiz/cat/5/gesture.png", alt="gesture")
              span.text 請拖曳圓圈

            .fk-cq5-slider__range-input-track
              .fk-cq5-slider__range-input-track__bar(:style="rangeInputTrackStyle")
            input.fk-cq5-slider__range-input(
              type="range"
              :min="min"
              :max="max"
              v-model="inputValue"
              @change="selectAnswer(singleStrategy(data.ans, inputValue))"
            )
          img.cat-img(src="assets/img/quiz/cat/5/big_cat.png", alt="big cat")
            
    template(#correct-ans)
      fk-ans-correct(
        :question="data.title"
        :cate="cate"
        :is-my-ans-correct="singleStrategy(data.ans, myAns)"
        :illustration="`assets/img/quiz/${cate}/${data.idx}/ans_illus.png`"
      )
        template(#ans)
          .fk-ans-opt-container.fk-ans-opt-container--correct
            button.fk-ans-opt-small.fk-ans-opt-small--correct {{ data.options[data.ans] }}

      fk-ans-suggest(
        :say-title="data.doc.say.title"
        :say-content="data.doc.say.content"
        :source="data.doc.source"
      )

</template>

<script>
/**
 * @mixin submitAnswer
 * data: [hasSelect, hasSubmitted, isCorrect, myAns]
 * methods: [selectAnswer, submitAnswer, singleStrategy]
 */
import { singleStrategyMixins } from '@/assets/js/mixins';
import quiz from '@/assets/json/quiz-cat.json';
import FkAns from '@/components/fk-ans/fk-ans.vue';
import FkAnsCorrect from '@/components/fk-ans/fk-ans-correct.vue';
import FkAnsSuggest from '@/components/fk-ans/fk-ans-suggest.vue';

export default {
  name: 'CatQ5',
  components: {
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
  },
  data: () => ({
    data: quiz.cat5,
    cate: 'cat',
    min: 1,
    max: 24,
    inputValue: 2,
  }),
  computed: {
    rangeInputTrackStyle() {
      return `transform: translateX(${
        (this.inputValue / this.max - 1) * 100
      }%)`;
    },
    rangeInputTooltipsStyle() {
      let offset = 40;

      if (window.innerWidth > 768) {
        offset = 24;
      }

      return `transform: translateX(calc(${
        ((this.inputValue - 1) / this.max) * 100
      }%  - ${offset * ((this.inputValue - 1) / (this.max - 1))}px))`;
    },
  },

  mixins: [singleStrategyMixins],
};
</script>

<style lang="scss" scoped>
.fk-cq5 {
  overflow: hidden;

  .cat-img {
    @include rwd-max(xs) {
      max-height: 36px;
    }

    @include rwd-max(sm) {
      max-height: 60px;
    }
  }
}
.fk-cq5-months {
  margin-top: $spacing-8;
  margin-bottom: 1rem;
  text-align: center;
  font-weight: boldwer;

  .digit {
    font-size: 3rem;
    margin-right: 0.5rem;
    color: darken($gray-160, 10%);
  }
  .text {
    font-size: 1rem;
    font-weight: bold;
    color: darken($gray-160, 20%);
  }
}

.fk-cq5-slider-wrapper {
  position: relative;
  max-width: 800px;
  margin: 0 auto;
}

.fk-cq5-slider {
  max-width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;

  &__range-input-wrapper {
    position: relative;
    height: 10px;
    width: 100%;
    background-color: $gray-2;
    border-radius: 100px;
  }

  &__range-input-index,
  &__range-input-tooltips {
    position: relative;
    z-index: 1;
    pointer-events: none;
  }

  &__range-input-index {
    margin-top: -20px;
    color: $white;
    font-size: 24px;

    span {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      text-align: center;
    }
  }

  &__range-input-tooltips {
    padding: $spacing-4;
    .gesture {
      display: block;
    }

    .text {
      font-size: $p-1;
      display: inline-block;
      transform: translateX(-0.8rem);
      font-weight: bolder;
      color: darken($gray-160, 20%);
    }
  }

  &__range-input-track,
  &__range-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 10px;
  }

  &__range-input-track {
    overflow: hidden;
    border-radius: 100px;

    &__bar {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: $gray-160;
    }
  }

  &__range-input {
    -webkit-appearance: none;
    appearance: none;
    background-color: transparent;
    cursor: pointer;
  }

  // chrome, safari, edge
  input[type='range']::-webkit-slider-thumb {
    width: 48px;
    height: 48px;
    appearance: none;
    margin-top: -2px;
    border-radius: 50%;
    background-color: $color-primary;
    box-sizing: border-box;
    -webkit-appearance: none;
  }

  // firefox
  input[type='range']::-moz-range-thumb {
    width: 48px;
    height: 48px;
    border-style: solid;
    border-radius: 50%;
    background-color: $color-primary;
    box-sizing: border-box;
  }
}
</style>
