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
                  :src="`assets/img/quiz/${cate}/${data.idx}/option${index + 1}.png`"
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
      )
        template(#ans)
          .fk-dq7__ans-item-container
            .fk-dq7__ans-item(
              v-for="item, index in data.ans"
              :key="`${cate}q-correct-${data.idx}-${item}`"
            )
              .fk-dq7__ans-item-img-wrapper
                img(
                  :src="`assets/img/quiz/dog/${data.idx}/option${index + 1}.png`"
                  :alt="data.options[item]"
                )
              .fk-dq7__ans-item-text {{ data.ansDetail[item] }}
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
    border-bottom: solid 1px $gray-160;
    padding: $spacing-4;
  }

  &__ans-item-img-wrapper {
    min-width: 120px;
    margin-right: $spacing-5;
    text-align: center;
  }

  &__ans-item-text {
    color: $gray-160;
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
