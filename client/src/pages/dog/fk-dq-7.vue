<template lang="pug">
.fk-dq7
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
      //- bowl options
      .fk-ans-opt-container
        .pure-g.autopad-2
          .pure-u-1-3.align-center(
            v-for="item, index in shuffleOptions"
            :key="`${cate}q-${data.idx}-${item}`"
            :class="{'fk-ans-opt--selected': myAns.includes(+item)}"
          )
            .fk-ans-opt
              .fk-ans-opt__img-wrapper
                img(
                  :src="`assets/img/quiz/${cate}/${data.idx}/option${item}.png`"
                  :alt="data.options[item]"
                )
              .fk-ans-opt__name {{ data.options[item] }}
              input.fk-ans-opt__input(
                :id="`${cate}q-input-${data.idx}-${item}`"
                type="checkbox"
                :value="+item"
                v-model="myAns"
                @change="selectAnswer(multiStrategy(data.ans))"
              )

    template(#correct-ans)
      fk-ans-correct(
        :question="data.title"
        :cate="cate"
        :is-my-ans-correct="multiStrategy(data.ans)"
      )
        template(#ans)
          .fk-dq7__ans-item-container
            .fk-dq7__ans-item(
              v-for="item, index in Object.keys(data.options)"
              :key="`${cate}q-correct-${data.idx}-${item}`"
            )
              .fk-dq7__ans-item-img-wrapper
                img(
                  :src="`assets/img/quiz/dog/${data.idx}/option${index + 1}.png`"
                  :alt="data.options[item]"
                )
              .fk-dq7__ans-item-text
                .fk-dq7__ans-item-text-title
                  span.fk-dq7__ans-item-text-check(v-if="data.ans.includes(+item)") 
                  span {{ data.options[item] }}
                .fk-dq7__ans-item-text-desc {{ data.ansDetail[item] }}
</template>

<script>
/**
 * @mixin multiStrategyMixins
 * data: [hasSelect, hasSubmitted, isCorrect, myAns]
 * methods: [selectAnswer, submitAnswer, multiStrategy]
 */
import { multiStrategyMixins } from '@/assets/js/mixins';

import quiz from '@/assets/json/quiz-dog.json';
import FkAns from '@/components/fk-ans/fk-ans.vue';
import FkAnsCorrect from '@/components/fk-ans/fk-ans-correct.vue';

export default {
  name: 'DogQ7',
  components: {
    FkAns,
    FkAnsCorrect,
  },
  data: () => ({
    data: quiz.dog7,
    cate: 'dog',
  }),
  mixins: [multiStrategyMixins],
};
</script>

<style lang="scss">
.fk-dq7 {
  &__ans-item-container {
    display: flex;
    flex-direction: column;
    width: 100%;
  }

  &__ans-item {
    width: 100%;
    display: flex;
    flex-direction: column;
    border-bottom: solid 1px $gray-160;
    padding: $spacing-4 0;

    @include rwd-min(sm) {
      flex-direction: row;
    }

    @include rwd-min(md) {
      padding: $spacing-6 0;
    }

    &:last-child {
      border-bottom: none;
    }
  }

  &__ans-item-img-wrapper {
    min-width: 120px;
    margin-right: $spacing-5;
    margin-bottom: $spacing-2;

    @include rwd-min(sm) {
      margin-bottom: 0;
      text-align: center;
    }
  }

  &__ans-item-text {
    color: $gray-160;
    align-self: center;
  }

  &__ans-item-text-title {
    font-weight: 600;
    display: flex;
    align-items: flex-end;
    margin-bottom: $spacing-2;
    color: lighten($color: $color-primary, $amount: 10%);
  }

  &__ans-item-text-check {
    display: inline-block;
    width: 1.25rem;
    height: 1.25rem;
    margin-right: $spacing-1;
    background-image: url('~@/assets/img/common/icon_check.png');
    background-repeat: no-repeat;
    background-position: center;
    background-color: lighten($color: $color-primary, $amount: 10%);
    border-radius: 50%;
    overflow: hidden;
  }

  .fk-ans-correct {
    width: 100%;

    &__question {
      margin: 0 auto;
    }

    &__question-title {
      margin-bottom: $spacing-7;
    }
  }
}
</style>
