<template lang="pug">
.fk-dq3
  fk-ans(
    :idx="+data.idx"
    :title="data.title"
    questionType="multi"
    :has-select="hasSelect"
    :has-submitted="hasSubmitted"
    :submit-answer="submitAnswer"
    :cate="cate"
  )
    template(#my-ans)
      //- bowl options
      .fk-ans-opt-container
        .pure-g.autopad-4
          .pure-u-1-2.pure-u-sm-1-4.align-center(
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
        :illustration="`assets/img/quiz/${cate}/${data.idx}/ans_illus.png`"
      )
        template(#ans)
          .fk-ans-opt-container.fk-ans-opt-container--correct.pure-g.autopad-1
            .pure-u-1-2.align-center(
              v-for="item, index in data.ans"
              :key="`${cate}q-correct-${data.idx}-${item}`"
            )
              .fk-ans-opt-small.fk-ans-opt-small--correct {{ data.options[item] }}

      fk-ans-suggest(
        :say-title="data.doc.say.title"
        :say-content="data.doc.say.content"
        :source="data.doc.source"
      )

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
import FkAnsSuggest from '@/components/fk-ans/fk-ans-suggest.vue';

export default {
  name: 'DogQ3',
  components: {
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
  },
  data: () => ({
    data: quiz.dog3,
    cate: 'dog',
    myAns: [],
  }),
  mixins: [multiStrategyMixins],
};
</script>

<style lang="scss" scoped>
.fk-dq3 {
  .fk-ans-opt-small {
    min-width: auto;
  }
}
</style>
