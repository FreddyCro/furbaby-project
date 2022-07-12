<template lang="pug">
.fk-dq7
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
      //- bowl options
      .fk-ans-opt-container
        .pure-g.autopad-4
          .pure-u-1-5.align-center(
            v-for="item, index in Object.keys(data.options)"
            :key="`${cate}q-${data.idx}-${item}`"
            :class="{'fk-ans-opt--selected': myAns.includes(+item)}"
          )
            .fk-ans-opt
              .fk-ans-opt__img-wrapper
                img(
                  :src="`/assets/img/quiz/${cate}/${data.idx}/option${index + 1}.png`"
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
          .fk-ans-opt-container.fk-ans-opt-container--correct.autopad-1
            .fk-ans-opt.fk-ans-opt--correct(
              v-for="item, index in data.ans"
              :key="`${cate}q-correct-${data.idx}-${item}`"
            )
              .fk-ans-opt__img-wrapper
                img(
                  :src="`/assets/img/quiz/dog/${data.idx}/option${index + 1}.png`"
                  :alt="data.options[item]"
                )
              .fk-ans-opt__name {{ data.options[item] }}
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
