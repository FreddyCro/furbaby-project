<template lang="pug">
.fk-cq5
  fk-ans(
    :idx="+data.idx"
    :title="data.title"
    questionType="single"
    :has-select="hasSelect"
    :has-submitted="hasSubmitted"
    :submit-answer="submitAnswer"
    :cate="cate"
  )
    template(#my-ans)
      .fk-cq5-months {{ inputValue }} 個月
      .fk-cq5-slider-wrapper
        .fk-cq5-slider
          .fk-cq5-slider__range-input-wrapper
            .fk-cq5-slider__range-input-tooltips(:style="rangeInputTooltipsStyle") 請拖曳圓圈
            .fk-cq5-slider__range-input-index(:style="rangeInputTooltipsStyle") {{ inputValue }}
            .fk-cq5-slider__range-input-track
              .fk-cq5-slider__range-input-track__bar(:style="rangeInputTrackStyle")

            input.fk-cq5-slider__range-input(
              type="range"
              :min="min"
              :max="max"
              v-model="inputValue"
              @change="selectAnswer(singleStrategy(data.ans, inputValue))"
            )

      //- .fk-ans-opt-container
      //-   .pure-g.autopad-3
      //-     .pure-u-1-12(
      //-       v-for="item, index in Object.keys(data.options)"
      //-       :key="`${cate}q-${data.idx}-${item}`"
      //-     )
      //-       button(
      //-         :class="{'fk-ans-opt--selected': +myAns === +item}"
      //-         :id="`${cate}q-input-${data.idx}-${item}`"
      //-         :value="+item"
      //-         @click="selectAnswer(singleStrategy(data.ans, item))"
      //-       ) {{ data.options[item] }}

    template(#correct-ans)
      fk-ans-correct(
        :question="data.title"
        :cate="cate"
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
 * data: [hasSelect, hasSubmitted, isCorrect]
 * methods: [selectAnswer, submitAnswer]
 * components: [FkAnsCorrect, FkAnsSubmit, FkAnsDoctor, FkBtnPrimary]
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
      return `transform: translateX(${(this.inputValue / this.max - 1) * 100}%)`;
    },
    rangeInputTooltipsStyle() {
      return `transform: translateX(${(this.inputValue / this.max - 1 + 1) * 100}%)`;
    }
  },

  mixins: [singleStrategyMixins],
};
</script>

<style lang="scss" scoped>
.fk-cq5 {
  overflow: hidden;
}
.fk-cq5-months {
  padding: 0.5rem;
  margin-bottom: 1rem;
  font-size: 1.5rem;
  text-align: center;
  font-weight: bold;
  border-radius: 0.5rem;
}

.fk-cq5-slider-wrapper {
  position: relative;
}

.fk-cq5-slider {
  &__range-input-wrapper {
    position: relative;
    height: 10px;
    background-color: $gray-2;
    border-radius: 100px;
  }

  &__range-input-index, &__range-input-tooltips {
    position: relative;
    z-index: 1;
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
